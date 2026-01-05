"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const testimonial_controller_1 = require("../controllers/testimonial.controller");
const router = express_1.default.Router();
// Public routes
router.get('/', testimonial_controller_1.getTestimonials);
// Admin routes (add authentication middleware later)
router.post('/', testimonial_controller_1.createTestimonial);
router.put('/:id', testimonial_controller_1.updateTestimonial);
router.delete('/:id', testimonial_controller_1.deleteTestimonial);
exports.default = router;
