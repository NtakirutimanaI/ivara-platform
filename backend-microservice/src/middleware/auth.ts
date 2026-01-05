// src/middleware/auth.ts
import { Request, Response, NextFunction } from 'express';

/**
 * Role‑based authorization middleware.
 * Expects `req.user.role` to be set by JWT verification.
 */
export const authorize = (allowedRoles: string[]) => {
    return (req: Request, res: Response, next: NextFunction) => {
        const role = (req as any).user?.role;
        if (!role) {
            return res.status(401).json({ error: 'User role missing' });
        }
        if (!allowedRoles.includes(role)) {
            return res.status(403).json({ error: 'Forbidden: insufficient role' });
        }
        next();
    };
};
