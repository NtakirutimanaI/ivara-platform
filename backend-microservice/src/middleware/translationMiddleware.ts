// Translation Middleware for Backend API
// Automatically translates API responses based on Accept-Language header or locale query parameter

import { Request, Response, NextFunction } from 'express';
import translationService from '../services/translationService';

/**
 * Middleware to add translation capabilities to responses
 */
export const translationMiddleware = (req: Request, res: Response, next: NextFunction) => {
    // Get locale from request
    const locale = translationService.getLocaleFromRequest(req);

    // Store locale in request for use in controllers
    (req as any).locale = locale;

    // Override res.json to automatically translate responses
    const originalJson = res.json.bind(res);

    res.json = function (body: any) {
        // If body has data property (common API response pattern)
        if (body && typeof body === 'object') {
            if (body.data) {
                if (Array.isArray(body.data)) {
                    body.data = translationService.translateArray(body.data, locale);
                } else if (typeof body.data === 'object') {
                    body.data = translationService.translateObject(body.data, locale);
                }
            }

            // Translate common message fields
            if (body.message && typeof body.message === 'string') {
                body.message = translationService.translate(body.message, locale);
            }

            // Translate error messages
            if (body.error && typeof body.error === 'string') {
                body.error = translationService.translate(body.error, locale);
            }
        }

        return originalJson(body);
    };

    next();
};

/**
 * Helper function to translate a response object
 * Can be used manually in controllers
 */
export const translateResponse = (data: any, locale: string = 'en') => {
    if (Array.isArray(data)) {
        return translationService.translateArray(data, locale);
    } else if (typeof data === 'object') {
        return translationService.translateObject(data, locale);
    }
    return data;
};

export default translationMiddleware;
