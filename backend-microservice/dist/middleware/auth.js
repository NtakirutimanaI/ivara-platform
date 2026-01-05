"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.authorize = void 0;
/**
 * Role‑based authorization middleware.
 * Expects `req.user.role` to be set by JWT verification.
 */
const authorize = (allowedRoles) => {
    return (req, res, next) => {
        var _a;
        const role = (_a = req.user) === null || _a === void 0 ? void 0 : _a.role;
        if (!role) {
            return res.status(401).json({ error: 'User role missing' });
        }
        if (!allowedRoles.includes(role)) {
            return res.status(403).json({ error: 'Forbidden: insufficient role' });
        }
        next();
    };
};
exports.authorize = authorize;
