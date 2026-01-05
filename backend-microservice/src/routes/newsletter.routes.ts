import express from 'express';
import {
    subscribeToNewsletter,
    unsubscribeFromNewsletter,
    getAllSubscribers
} from '../controllers/newsletter.controller';

const router = express.Router();

// Subscribe to newsletter
router.post('/subscribe', subscribeToNewsletter);

// Unsubscribe from newsletter
router.post('/unsubscribe', unsubscribeFromNewsletter);

// Get all active subscribers (admin only - add auth middleware if needed)
router.get('/subscribers', getAllSubscribers);

export default router;
