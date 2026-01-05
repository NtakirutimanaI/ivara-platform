<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class IvaraRoleMiddleware
{
    /**
     * Allowed admin roles that can access any role-protected route
     */
    private array $adminRoles = ['super_admin', 'admin', 'technical_admin'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // Log unauthenticated access attempt
            $this->logSecurityEvent('unauthenticated_access', [
                'path' => $request->path(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Unauthenticated',
                    'message' => 'Please login to access this resource.'
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $user = Auth::user();
        $userRole = strtolower($user->role ?? '');
        $allowedRoles = explode(',', strtolower($role));

        // Check if user has any of the specific roles OR is an admin
        if (in_array($userRole, $allowedRoles) || in_array($userRole, $this->adminRoles)) {
            // Log successful access
            $this->logSecurityEvent('access_granted', [
                'user_id' => $user->id,
                'user_role' => $userRole,
                'required_role' => $role,
                'path' => $request->path(),
            ]);

            return $next($request);
        }

        // Log unauthorized access attempt
        $this->logSecurityEvent('unauthorized_access', [
            'user_id' => $user->id,
            'user_role' => $userRole,
            'required_role' => $role,
            'path' => $request->path(),
            'ip' => $request->ip(),
        ], 'warning');

        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Forbidden',
                'message' => "You do not have permission to access this resource. Required role: {$role}"
            ], 403);
        }

        abort(403, 'Unauthorized access. You do not have the required role.');
    }

    /**
     * Log security events for audit trail
     */
    private function logSecurityEvent(string $event, array $data, string $level = 'info'): void
    {
        $logData = array_merge([
            'event' => $event,
            'timestamp' => now()->toIso8601String(),
        ], $data);

        if ($level === 'warning') {
            Log::warning('[SECURITY] ' . $event, $logData);
        } else {
            Log::info('[SECURITY] ' . $event, $logData);
        }
    }
}
