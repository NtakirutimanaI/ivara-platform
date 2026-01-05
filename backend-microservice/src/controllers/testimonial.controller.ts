import { Request, Response } from 'express';
import Testimonial from '../models/testimonial.model';

/**
 * Get all active testimonials
 */
export const getTestimonials = async (req: Request, res: Response) => {
    try {
        const testimonials = await Testimonial.find({ isActive: true })
            .sort({ createdAt: -1 })
            .limit(10);

        res.status(200).json(testimonials);
    } catch (error) {
        res.status(500).json({ message: 'Error fetching testimonials', error });
    }
};

/**
 * Create a new testimonial (Admin only)
 */
export const createTestimonial = async (req: Request, res: Response) => {
    try {
        const { name, role, company, rating, text, avatar } = req.body;

        if (!name || !role || !company || !text) {
            return res.status(400).json({ message: 'Missing required fields' });
        }

        const testimonial = new Testimonial({
            name,
            role,
            company,
            rating: rating || 5,
            text,
            avatar: avatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=3b82f6&color=fff`,
            isActive: true,
        });

        await testimonial.save();

        res.status(201).json({ message: 'Testimonial created successfully', testimonial });
    } catch (error) {
        res.status(500).json({ message: 'Error creating testimonial', error });
    }
};

/**
 * Update a testimonial
 */
export const updateTestimonial = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const updates = req.body;

        const testimonial = await Testimonial.findByIdAndUpdate(id, updates, { new: true });

        if (!testimonial) {
            return res.status(404).json({ message: 'Testimonial not found' });
        }

        res.status(200).json({ message: 'Testimonial updated successfully', testimonial });
    } catch (error) {
        res.status(500).json({ message: 'Error updating testimonial', error });
    }
};

/**
 * Delete a testimonial
 */
export const deleteTestimonial = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;

        const testimonial = await Testimonial.findByIdAndDelete(id);

        if (!testimonial) {
            return res.status(404).json({ message: 'Testimonial not found' });
        }

        res.status(200).json({ message: 'Testimonial deleted successfully' });
    } catch (error) {
        res.status(500).json({ message: 'Error deleting testimonial', error });
    }
};
