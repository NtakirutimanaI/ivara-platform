"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.EducationKnowledge = void 0;
// src/models/educationKnowledge.model.ts
const mongoose_1 = require("mongoose");
const EducationKnowledgeSchema = new mongoose_1.Schema({
    course_title: { type: String, required: true },
    category: { type: String, required: true },
    duration: { type: String, required: true },
    price: { type: Number, required: true },
    instructor_id: { type: String, required: true },
});
exports.EducationKnowledge = (0, mongoose_1.model)('EducationKnowledge', EducationKnowledgeSchema);
