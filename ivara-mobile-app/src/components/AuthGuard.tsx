'use client';

import { useEffect, useState } from 'react';
import { useRouter, usePathname } from 'next/navigation';

interface User {
    id: string;
    username: string;
    email: string;
    role: string;
    name?: string;
    profilePhoto?: string;
}

interface AuthGuardProps {
    children: React.ReactNode;
    allowedRoles?: string[];
    redirectTo?: string;
}

/**
 * AuthGuard component that protects routes based on authentication and role
 * 
 * Usage:
 * <AuthGuard allowedRoles={['technician', 'admin']}>
 *   <ProtectedContent />
 * </AuthGuard>
 */
export default function AuthGuard({
    children,
    allowedRoles = [],
    redirectTo = '/login'
}: AuthGuardProps) {
    const router = useRouter();
    const pathname = usePathname();
    const [isLoading, setIsLoading] = useState(true);
    const [isAuthorized, setIsAuthorized] = useState(false);

    useEffect(() => {
        checkAuth();
    }, [pathname]);

    const checkAuth = () => {
        try {
            // Check for token
            const token = localStorage.getItem('token');
            if (!token) {
                console.log('[AuthGuard] No token found, redirecting to login');
                router.push(redirectTo);
                return;
            }

            // Check for user data
            const userStr = localStorage.getItem('user');
            if (!userStr) {
                console.log('[AuthGuard] No user data found, redirecting to login');
                localStorage.removeItem('token');
                router.push(redirectTo);
                return;
            }

            const user: User = JSON.parse(userStr);

            // Verify token expiration (basic check - decode JWT)
            try {
                const tokenPayload = JSON.parse(atob(token.split('.')[1]));
                const currentTime = Math.floor(Date.now() / 1000);

                if (tokenPayload.exp && tokenPayload.exp < currentTime) {
                    console.log('[AuthGuard] Token expired, redirecting to login');
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    router.push(redirectTo);
                    return;
                }
            } catch (e) {
                console.log('[AuthGuard] Invalid token format');
            }

            // Check role authorization if roles are specified
            if (allowedRoles.length > 0) {
                const userRole = user.role?.toLowerCase();
                const hasAllowedRole = allowedRoles.some(role =>
                    role.toLowerCase() === userRole ||
                    userRole === 'admin' ||
                    userRole === 'super-admin' ||
                    userRole === 'super_admin'
                );

                if (!hasAllowedRole) {
                    console.log('[AuthGuard] User role not authorized:', userRole);
                    router.push('/unauthorized');
                    return;
                }
            }

            setIsAuthorized(true);
        } catch (error) {
            console.error('[AuthGuard] Auth check error:', error);
            router.push(redirectTo);
        } finally {
            setIsLoading(false);
        }
    };

    if (isLoading) {
        return (
            <div className="min-h-screen bg-background flex items-center justify-center">
                <div className="flex flex-col items-center gap-4">
                    <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
                    <p className="text-sm text-muted">Verifying authentication...</p>
                </div>
            </div>
        );
    }

    if (!isAuthorized) {
        return null;
    }

    return <>{children}</>;
}

/**
 * Hook to get current authenticated user
 */
export function useAuth() {
    const [user, setUser] = useState<User | null>(null);
    const [token, setToken] = useState<string | null>(null);
    const [isLoading, setIsLoading] = useState(true);
    const router = useRouter();

    useEffect(() => {
        const storedToken = localStorage.getItem('token');
        const storedUser = localStorage.getItem('user');

        if (storedToken && storedUser) {
            try {
                setToken(storedToken);
                setUser(JSON.parse(storedUser));
            } catch (e) {
                console.error('Failed to parse user data');
            }
        }
        setIsLoading(false);
    }, []);

    const logout = () => {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        sessionStorage.clear();
        setUser(null);
        setToken(null);
        router.push('/login');
    };

    const hasRole = (roles: string | string[]): boolean => {
        if (!user?.role) return false;
        const userRole = user.role.toLowerCase();
        const roleArray = Array.isArray(roles) ? roles : [roles];

        return roleArray.some(role =>
            role.toLowerCase() === userRole ||
            userRole === 'admin' ||
            userRole === 'super-admin' ||
            userRole === 'super_admin'
        );
    };

    const isAuthenticated = !!token && !!user;

    return {
        user,
        token,
        isLoading,
        isAuthenticated,
        hasRole,
        logout
    };
}

/**
 * Higher-order component for route protection
 */
export function withAuth<P extends object>(
    Component: React.ComponentType<P>,
    allowedRoles?: string[]
) {
    return function ProtectedRoute(props: P) {
        return (
            <AuthGuard allowedRoles={allowedRoles}>
                <Component {...props} />
            </AuthGuard>
        );
    };
}
