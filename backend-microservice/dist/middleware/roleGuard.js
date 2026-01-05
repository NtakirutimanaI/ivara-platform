"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.securityLogger = exports.rateLimit = exports.requireOwnership = exports.requireRole = void 0;
/**
 * Role-based access control middleware
 * Checks if the authenticated user has one of the allowed roles
 */
const requireRole = (...allowedRoles) => {
    return (req, res, next) => {
        const user = req.user;
        if (!user) {
            return res.status(401).json({
                error: 'Unauthorized',
                message: 'Authentication required'
            });
        }
        if (!user.role) {
            return res.status(403).json({
                error: 'Forbidden',
                message: 'User role not defined'
            });
        }
        // Check if user's role is in the allowed roles
        const hasRole = allowedRoles.some(role => user.role.toLowerCase() === role.toLowerCase());
        if (!hasRole) {
            return res.status(403).json({
                error: 'Forbidden',
                message: `Access denied. Required role: ${allowedRoles.join(' or ')}. Your role: ${user.role}`
            });
        }
        next();
    };
};
exports.requireRole = requireRole;
/**
 * Ensures user can only access their own resources
 * Compares the userId from JWT with the requested resource's userId
 */
const requireOwnership = (userIdParam = 'userId') => {
    return (req, res, next) => {
        const user = req.user;
        const requestedUserId = req.params[userIdParam] || req.body[userIdParam] || req.query[userIdParam];
        if (!user) {
            return res.status(401).json({
                error: 'Unauthorized',
                message: 'Authentication required'
            });
        }
        // Admin can access any resource
        if (user.role === 'admin' || user.role === 'super-admin') {
            return next();
        }
        // Check ownership if a userId is specified
        if (requestedUserId && requestedUserId !== user.id) {
            return res.status(403).json({
                error: 'Forbidden',
                message: 'You can only access your own resources'
            });
        }
        next();
    };
};
exports.requireOwnership = requireOwnership;
/**
 * Rate limiting per user to prevent abuse
 */
const rateLimitMap = new Map();
const rateLimit = (maxRequests = 100, windowMs = 60000) => {
    return (req, res, next) => {
        const user = req.user;
        const key = (user === null || user === void 0 ? void 0 : user.id) || req.ip || 'anonymous';
        const now = Date.now();
        const userData = rateLimitMap.get(key);
        if (!userData || now > userData.resetTime) {
            rateLimitMap.set(key, { count: 1, resetTime: now + windowMs });
            return next();
        }
        if (userData.count >= maxRequests) {
            return res.status(429).json({
                error: 'Too Many Requests',
                message: 'Rate limit exceeded. Please try again later.',
                retryAfter: Math.ceil((userData.resetTime - now) / 1000)
            });
        }
        userData.count++;
        next();
    };
};
exports.rateLimit = rateLimit;
/**
 * Log security events for auditing
 */
const securityLogger = (req, res, next) => {
    const user = req.user;
    const log = {
        timestamp: new Date().toISOString(),
        method: req.method,
        path: req.path,
        userId: (user === null || user === void 0 ? void 0 : user.id) || 'anonymous',
        userRole: (user === null || user === void 0 ? void 0 : user.role) || 'none',
        ip: req.ip,
        userAgent: req.get('user-agent')
    };
    // Log to console in development, can be extended to file/database in production
    if (process.env.NODE_ENV !== 'production') {
        console.log('[SECURITY]', JSON.stringify(log));
    }
    next();
};
exports.securityLogger = securityLogger;
