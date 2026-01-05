"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.checkOwnership = exports.restrictToCategory = exports.restrictTo = exports.authorize = exports.verifyToken = void 0;
const jsonwebtoken_1 = __importDefault(require("jsonwebtoken"));
const permissions_1 = require("../config/permissions");
/**
 * Middleware to verify JWT token and attach user to request
 */
const verifyToken = (req, res, next) => {
    var _a;
    try {
        const token = (_a = req.headers.authorization) === null || _a === void 0 ? void 0 : _a.split(' ')[1]; // Bearer TOKEN
        if (!token) {
            return res.status(401).json({ message: 'No token provided' });
        }
        const secret = process.env.JWT_SECRET || 'your-secret-key';
        const decoded = jsonwebtoken_1.default.verify(token, secret);
        req.user = {
            id: decoded.id || decoded.userId,
            email: decoded.email,
            role: decoded.role,
            category: decoded.category,
        };
        next();
    }
    catch (error) {
        return res.status(401).json({ message: 'Invalid or expired token' });
    }
};
exports.verifyToken = verifyToken;
/**
 * Middleware to check if user has permission for a resource/action
 * Usage: authorize('users', 'create')
 */
const authorize = (resource, action) => {
    return (req, res, next) => {
        if (!req.user) {
            return res.status(401).json({ message: 'Authentication required' });
        }
        const { role } = req.user;
        if (!(0, permissions_1.hasPermission)(role, resource, action)) {
            return res.status(403).json({
                message: 'Forbidden: You do not have permission to perform this action',
                required: { resource, action },
                yourRole: role,
            });
        }
        next();
    };
};
exports.authorize = authorize;
/**
 * Middleware to restrict access to specific roles only
 * Usage: restrictTo('super_admin', 'admin')
 */
const restrictTo = (...allowedRoles) => {
    return (req, res, next) => {
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
exports.restrictTo = restrictTo;
/**
 * Middleware to ensure user can only access their own category
 * Usage: restrictToCategory()
 */
const restrictToCategory = (req, res, next) => {
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
exports.restrictToCategory = restrictToCategory;
/**
 * Middleware to check if user owns the resource
 * Usage: checkOwnership('userId') - checks if req.params.userId === req.user.id
 */
const checkOwnership = (userIdField = 'userId') => {
    return (req, res, next) => {
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
exports.checkOwnership = checkOwnership;
