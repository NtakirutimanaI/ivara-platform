"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.deleteTestimonial = exports.updateTestimonial = exports.createTestimonial = exports.getTestimonials = void 0;
const testimonial_model_1 = __importDefault(require("../models/testimonial.model"));
/**
 * Get all active testimonials
 */
const getTestimonials = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const testimonials = yield testimonial_model_1.default.find({ isActive: true })
            .sort({ createdAt: -1 })
            .limit(10);
        res.status(200).json(testimonials);
    }
    catch (error) {
        res.status(500).json({ message: 'Error fetching testimonials', error });
    }
});
exports.getTestimonials = getTestimonials;
/**
 * Create a new testimonial (Admin only)
 */
const createTestimonial = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { name, role, company, rating, text, avatar } = req.body;
        if (!name || !role || !company || !text) {
            return res.status(400).json({ message: 'Missing required fields' });
        }
        const testimonial = new testimonial_model_1.default({
            name,
            role,
            company,
            rating: rating || 5,
            text,
            avatar: avatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=3b82f6&color=fff`,
            isActive: true,
        });
        yield testimonial.save();
        res.status(201).json({ message: 'Testimonial created successfully', testimonial });
    }
    catch (error) {
        res.status(500).json({ message: 'Error creating testimonial', error });
    }
});
exports.createTestimonial = createTestimonial;
/**
 * Update a testimonial
 */
const updateTestimonial = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const updates = req.body;
        const testimonial = yield testimonial_model_1.default.findByIdAndUpdate(id, updates, { new: true });
        if (!testimonial) {
            return res.status(404).json({ message: 'Testimonial not found' });
        }
        res.status(200).json({ message: 'Testimonial updated successfully', testimonial });
    }
    catch (error) {
        res.status(500).json({ message: 'Error updating testimonial', error });
    }
});
exports.updateTestimonial = updateTestimonial;
/**
 * Delete a testimonial
 */
const deleteTestimonial = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const testimonial = yield testimonial_model_1.default.findByIdAndDelete(id);
        if (!testimonial) {
            return res.status(404).json({ message: 'Testimonial not found' });
        }
        res.status(200).json({ message: 'Testimonial deleted successfully' });
    }
    catch (error) {
        res.status(500).json({ message: 'Error deleting testimonial', error });
    }
});
exports.deleteTestimonial = deleteTestimonial;
