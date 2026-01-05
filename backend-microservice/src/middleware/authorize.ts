import { Request, Response, NextFunction } from 'express';
import jwt from 'jsonwebtoken';
import { hasPermission } from '../config/permissions';

// Extend Express Request to include user info
export interface AuthRequest extends Request {
    user?: {
        id: string;
        email: string;
        role: string;
        category?: string;
    };
}

/**
 * Middleware to verify JWT token and attach user to request
 */
export const verifyToken = (
    req: AuthRequest,
    res: Response,
    next: NextFunction
) => {
    try {
        const token = req.headers.authorization?.split(' ')[1]; // Bearer TOKEN

        if (!token) {
            return res.status(401).json({ message: 'No token provided' });
        }

        const secret = process.env.JWT_SECRET || 'your-secret-key';
        const decoded = jwt.verify(token, secret) as any;

        req.user = {
            id: decoded.id || decoded.userId,
            email: decoded.email,
            role: decoded.role,
            category: decoded.category,
        };

        next();
    } catch (error) {
        return res.status(401).json({ message: 'Invalid or expired token' });
    }
};

/**
 * Middleware to check if user has permission for a resource/action
 * Usage: authorize('users', 'create')
 */
export const authorize = (resource: string, action: string) => {
    return (req: AuthRequest, res: Response, next: NextFunction) => {
        if (!req.user) {
            return res.status(401).json({ message: 'Authentication required' });
        }

        const { role } = req.user;

        if (!hasPermission(role, resource, action)) {
            return res.status(403).json({
                message: 'Forbidden: You do not have permission to perform this action',
                required: { resource, action },
                yourRole: role,
            });
        }

        next();
    };
};

/**
 * Middleware to restrict access to specific roles only
 * Usage: restrictTo('super_admin', 'admin')
 */
export const restrictTo = (...allowedRoles: string[]) => {
    return (req: AuthRequest, res: Response, next: NextFunction) => {
        if (!req.user) {
            return res.status(401).json({ message: 'Authentication required' });
        }

        if (!allowedRoles.includes(req.user.role)) {
            return res.status(403).json({
                message: 'Forbidden: This action is restricted to specific roles',
                allowedRoles,
                yourRole: req.user.role,
            });
        }

        next();
    };
};

/**
 * Middleware to ensure user can only access their own category
 * Usage: restrictToCategory()
 */
export const restrictToCategory = (
    req: AuthRequest,
    res: Response,
    next: NextFunction
) => {
    if (!req.user) {
        return res.status(401).json({ message: 'Authentication required' });
    }

    const { role, category } = req.user;

    // Super admin can access all categories
    if (role === 'super_admin') {
        return next();
    }

    // Extract category from request path (e.g., /api/technical-repair/...)
    const requestedCategory = req.path.split('/')[2]; // Assumes /api/category/...

    // Category admins can only access their category
    if (role.includes('_admin') && category !== requestedCategory) {
        return res.status(403).json({
            message: 'Forbidden: You can only access resources in your assigned category',
            yourCategory: category,
            requestedCategory,
        });
    }

    next();
};

/**
 * Middleware to check if user owns the resource
 * Usage: checkOwnership('userId') - checks if req.params.userId === req.user.id
 */
export const checkOwnership = (userIdField: string = 'userId') => {
    return (req: AuthRequest, res: Response, next: NextFunction) => {
        if (!req.user) {
            return res.status(401).json({ message: 'Authentication required' });
        }

        const { role, id } = req.user;

        // Super admin and admins can access any resource
        if (role === 'super_admin' || role === 'admin') {
            return next();
        }

        // Check if the resource belongs to the user
        const resourceUserId = req.params[userIdField] || req.body[userIdField];

        if (resourceUserId !== id) {
            return res.status(403).json({
                message: 'Forbidden: You can only access your own resources',
            });
        }

        next();
    };
};
