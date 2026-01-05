// Translation Service for Backend Microservice
// Handles translation of dynamic content from MongoDB

interface TranslationMap {
    [key: string]: {
        en: string;
        rw: string;
        sw: string;
        fr: string;
    };
}

// Common translations for backend responses
const translations: TranslationMap = {
    // Success messages
    'success.created': {
        en: 'Created successfully',
        rw: 'Byaremwe neza',
        sw: 'Imeundwa kwa mafanikio',
        fr: 'Créé avec succès'
    },
    'success.updated': {
        en: 'Updated successfully',
        rw: 'Byavuguruwe neza',
        sw: 'Imesasishwa kwa mafanikio',
        fr: 'Mis à jour avec succès'
    },
    'success.deleted': {
        en: 'Deleted successfully',
        rw: 'Byasibwe neza',
        sw: 'Imefutwa kwa mafanikio',
        fr: 'Supprimé avec succès'
    },

    // Error messages
    'error.notFound': {
        en: 'Resource not found',
        rw: 'Ntabwo byabonetse',
        sw: 'Rasilimali haipatikani',
        fr: 'Ressource introuvable'
    },
    'error.unauthorized': {
        en: 'Unauthorized access',
        rw: 'Ntabwo ufite uburenganzira',
        sw: 'Ufikiaji usioidhinishwa',
        fr: 'Accès non autorisé'
    },
    'error.validation': {
        en: 'Validation failed',
        rw: 'Kugenzura byanze',
        sw: 'Uthibitisho umeshindwa',
        fr: 'Échec de la validation'
    },

    // Product/Service related
    'product.name': {
        en: 'Product Name',
        rw: 'Izina ry\'Igicuruzwa',
        sw: 'Jina la Bidhaa',
        fr: 'Nom du Produit'
    },
    'product.description': {
        en: 'Description',
        rw: 'Ibisobanuro',
        sw: 'Maelezo',
        fr: 'Description'
    },
    'product.price': {
        en: 'Price',
        rw: 'Igiciro',
        sw: 'Bei',
        fr: 'Prix'
    },
    'product.category': {
        en: 'Category',
        rw: 'Icyiciro',
        sw: 'Kategoria',
        fr: 'Catégorie'
    },

    // Order related
    'order.status.pending': {
        en: 'Pending',
        rw: 'Bitegerejwe',
        sw: 'Inasubiri',
        fr: 'En attente'
    },
    'order.status.processing': {
        en: 'Processing',
        rw: 'Biratunganywa',
        sw: 'Inachakatwa',
        fr: 'En cours de traitement'
    },
    'order.status.completed': {
        en: 'Completed',
        rw: 'Byarangiye',
        sw: 'Imekamilika',
        fr: 'Terminé'
    },
    'order.status.cancelled': {
        en: 'Cancelled',
        rw: 'Byahagaritswe',
        sw: 'Imeghairiwa',
        fr: 'Annulé'
    }
};

class TranslationService {
    /**
     * Translate a key to the specified language
     */
    translate(key: string, locale: string = 'en'): string {
        const translation = translations[key];
        if (!translation) {
            return key; // Return key if translation not found
        }

        return translation[locale as keyof typeof translation] || translation.en;
    }

    /**
     * Translate an object's fields
     */
    translateObject(obj: any, locale: string = 'en', fieldsToTranslate: string[] = []): any {
        if (!obj || typeof obj !== 'object') {
            return obj;
        }

        const translated = { ...obj };

        // If specific fields are provided, translate only those
        if (fieldsToTranslate.length > 0) {
            fieldsToTranslate.forEach(field => {
                if (translated[field]) {
                    // Check if the field has translation object
                    if (typeof translated[field] === 'object' && translated[field][locale]) {
                        translated[field] = translated[field][locale];
                    }
                }
            });
        } else {
            // Auto-detect and translate fields with translation objects
            Object.keys(translated).forEach(key => {
                if (translated[key] && typeof translated[key] === 'object') {
                    // Check if it's a translation object (has en, rw, sw, fr keys)
                    if (translated[key].en || translated[key].rw || translated[key].sw || translated[key].fr) {
                        translated[key] = translated[key][locale] || translated[key].en || translated[key];
                    }
                }
            });
        }

        return translated;
    }

    /**
     * Translate an array of objects
     */
    translateArray(arr: any[], locale: string = 'en', fieldsToTranslate: string[] = []): any[] {
        if (!Array.isArray(arr)) {
            return arr;
        }

        return arr.map(item => this.translateObject(item, locale, fieldsToTranslate));
    }

    /**
     * Get supported locales
     */
    getSupportedLocales(): string[] {
        return ['en', 'rw', 'sw', 'fr'];
    }

    /**
     * Validate locale
     */
    isValidLocale(locale: string): boolean {
        return this.getSupportedLocales().includes(locale);
    }

    /**
     * Get locale from request headers
     */
    getLocaleFromRequest(req: any): string {
        // Check query parameter
        if (req.query && req.query.locale && this.isValidLocale(req.query.locale)) {
            return req.query.locale;
        }

        // Check Accept-Language header
        const acceptLanguage = req.headers['accept-language'];
        if (acceptLanguage) {
            const locale = acceptLanguage.split(',')[0].split('-')[0].toLowerCase();
            if (this.isValidLocale(locale)) {
                return locale;
            }
        }

        // Default to English
        return 'en';
    }
}

export default new TranslationService();
