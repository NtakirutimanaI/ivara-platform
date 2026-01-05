import express from 'express';
import {
    getTestimonials,
    createTestimonial,
    updateTestimonial,
    deleteTestimonial,
} from '../controllers/testimonial.controller';

const router = express.Router();

// Public routes
router.get('/', getTestimonials);

// Admin routes (add authentication middleware later)
router.post('/', createTestimonial);
router.put('/:id', updateTestimonial);
router.delete('/:id', deleteTestimonial);

export default router;
