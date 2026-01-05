"use strict";
// Translation Middleware for Backend API
// Automatically translates API responses based on Accept-Language header or locale query parameter
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.translateResponse = exports.translationMiddleware = void 0;
const translationService_1 = __importDefault(require("../services/translationService"));
/**
 * Middleware to add translation capabilities to responses
 */
const translationMiddleware = (req, res, next) => {
    // Get locale from request
    const locale = translationService_1.default.getLocaleFromRequest(req);
    // Store locale in request for use in controllers
    req.locale = locale;
    // Override res.json to automatically translate responses
    const originalJson = res.json.bind(res);
    res.json = function (body) {
        // If body has data property (common API response pattern)
        if (body && typeof body === 'object') {
            if (body.data) {
                if (Array.isArray(body.data)) {
                    body.data = translationService_1.default.translateArray(body.data, locale);
                }
                else if (typeof body.data === 'object') {
                    body.data = translationService_1.default.translateObject(body.data, locale);
                }
            }
            // Translate common message fields
            if (body.message && typeof body.message === 'string') {
                body.message = translationService_1.default.translate(body.message, locale);
            }
            // Translate error messages
            if (body.error && typeof body.error === 'string') {
                body.error = translationService_1.default.translate(body.error, locale);
            }
        }
        return originalJson(body);
    };
    next();
};
exports.translationMiddleware = translationMiddleware;
/**
 * Helper function to translate a response object
 * Can be used manually in controllers
 */
const translateResponse = (data, locale = 'en') => {
    if (Array.isArray(data)) {
        return translationService_1.default.translateArray(data, locale);
    }
    else if (typeof data === 'object') {
        return translationService_1.default.translateObject(data, locale);
    }
    return data;
};
exports.translateResponse = translateResponse;
exports.default = exports.translationMiddleware;
