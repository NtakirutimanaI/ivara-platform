// src/middleware/jwt.ts
import { Request, Response, NextFunction } from 'express';
import jwt from 'jsonwebtoken';

const JWT_SECRET = process.env.JWT_SECRET || 'default_secret'; // fallback for dev

export interface JwtPayload {
    userId: string;
    role: string;
    email?: string;
    iat?: number;
    exp?: number;
}

export interface AuthenticatedRequest extends Request {
    user?: {
        id: string;
        role: string;
        email?: string;
    };
}

/**
 * JWT verification middleware
 * Verifies the token and attaches user info to the request
 */
export const verifyJwt = (req: Request, res: Response, next: NextFunction) => {
    const authHeader = req.headers['authorization'];

    if (!authHeader) {
        console.log('[JWT] Missing Authorization header for:', req.path);
        return res.status(401).json({
            error: 'Unauthorized',
            message: 'Missing Authorization header'
        });
    }

    const parts = authHeader.split(' ');
    if (parts.length !== 2 || parts[0] !== 'Bearer') {
        return res.status(400).json({
            error: 'Bad Request',
            message: 'Invalid Authorization format. Expected: Bearer <token>'
        });
    }

    const token = parts[1];

    try {
        const payload = jwt.verify(token, JWT_SECRET) as JwtPayload;

        // Attach user info to request
        (req as AuthenticatedRequest).user = {
            id: payload.userId,
            role: payload.role,
            email: payload.email
        };

        // Log successful authentication (only in development)
        if (process.env.NODE_ENV !== 'production') {
            console.log(`[JWT] Authenticated user ${payload.userId} (${payload.role}) accessing ${req.path}`);
        }

        next();
    } catch (err: any) {
        // Handle specific JWT errors
        if (err.name === 'TokenExpiredError') {
            return res.status(401).json({
                error: 'Unauthorized',
                message: 'Token has expired. Please login again.',
                code: 'TOKEN_EXPIRED'
            });
        }

        if (err.name === 'JsonWebTokenError') {
            return res.status(401).json({
                error: 'Unauthorized',
                message: 'Invalid token',
                code: 'INVALID_TOKEN'
            });
        }

        console.error('[JWT] Token verification error:', err.message);
        return res.status(401).json({
            error: 'Unauthorized',
            message: 'Failed to authenticate token'
        });
    }
};

/**
 * Optional JWT verification - allows unauthenticated access
 * but still attaches user info if token is provided
 */
export const optionalJwt = (req: Request, res: Response, next: NextFunction) => {
    const authHeader = req.headers['authorization'];

    if (!authHeader) {
        return next();
    }

    const parts = authHeader.split(' ');
    if (parts.length !== 2 || parts[0] !== 'Bearer') {
        return next();
    }

    const token = parts[1];

    try {
        const payload = jwt.verify(token, JWT_SECRET) as JwtPayload;
        (req as AuthenticatedRequest).user = {
            id: payload.userId,
            role: payload.role,
            email: payload.email
        };
    } catch (err) {
        // Token invalid but continue without user info
    }

    next();
};

/**
 * Helper to get userId from request
 */
export const getUserId = (req: Request): string | undefined => {
    return (req as AuthenticatedRequest).user?.id;
};

/**
 * Helper to get user role from request
 */
export const getUserRole = (req: Request): string | undefined => {
    return (req as AuthenticatedRequest).user?.role;
};
