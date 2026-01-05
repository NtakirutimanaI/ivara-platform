import { Router } from 'express';
import {
    getResourcesByType,
    getFeaturedResources,
    getResourceBySlug,
    getFaqs
} from '../controllers/resource.controller';

const router = Router();

// Public Routes
router.get('/featured', getFeaturedResources); // For Menu
router.get('/faqs', getFaqs);
router.get('/:type', getResourcesByType); // /api/resources/blog, /api/resources/guide
router.get('/item/:slug', getResourceBySlug); // /api/resources/item/my-slug

export default router;
