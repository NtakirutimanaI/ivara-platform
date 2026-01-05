"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.LearningMaterial = void 0;
const mongoose_1 = require("mongoose");
const LearningMaterialSchema = new mongoose_1.Schema({
    title: { type: String, required: true },
    description: { type: String },
    content_type: { type: String, enum: ['video', 'pdf', 'text'], required: true },
    url: { type: String, required: true },
    category: { type: String, required: true },
    level: { type: String, enum: ['beginner', 'intermediate', 'advanced'], default: 'beginner' },
}, { timestamps: true });
exports.LearningMaterial = (0, mongoose_1.model)('LearningMaterial', LearningMaterialSchema);
