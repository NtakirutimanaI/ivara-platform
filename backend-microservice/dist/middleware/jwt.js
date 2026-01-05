"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.getUserRole = exports.getUserId = exports.optionalJwt = exports.verifyJwt = void 0;
const jsonwebtoken_1 = __importDefault(require("jsonwebtoken"));
const JWT_SECRET = process.env.JWT_SECRET || 'default_secret'; // fallback for dev
/**
 * JWT verification middleware
 * Verifies the token and attaches user info to the request
 */
const verifyJwt = (req, res, next) => {
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
        const payload = jsonwebtoken_1.default.verify(token, JWT_SECRET);
        // Attach user info to request
        req.user = {
            id: payload.userId,
            role: payload.role,
            email: payload.email
        };
        // Log successful authentication (only in development)
        if (process.env.NODE_ENV !== 'production') {
            console.log(`[JWT] Authenticated user ${payload.userId} (${payload.role}) accessing ${req.path}`);
        }
        next();
    }
    catch (err) {
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
exports.verifyJwt = verifyJwt;
/**
 * Optional JWT verification - allows unauthenticated access
 * but still attaches user info if token is provided
 */
const optionalJwt = (req, res, next) => {
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
        const payload = jsonwebtoken_1.default.verify(token, JWT_SECRET);
        req.user = {
            id: payload.userId,
            role: payload.role,
            email: payload.email
        };
    }
    catch (err) {
        // Token invalid but continue without user info
    }
    next();
};
exports.optionalJwt = optionalJwt;
/**
 * Helper to get userId from request
 */
const getUserId = (req) => {
    var _a;
    return (_a = req.user) === null || _a === void 0 ? void 0 : _a.id;
};
exports.getUserId = getUserId;
/**
 * Helper to get user role from request
 */
const getUserRole = (req) => {
    var _a;
    return (_a = req.user) === null || _a === void 0 ? void 0 : _a.role;
};
exports.getUserRole = getUserRole;
