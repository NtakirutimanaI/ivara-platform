// src/models/educationKnowledge.model.ts
import { Schema, model, Document } from 'mongoose';

export interface IEducationKnowledge extends Document {
    course_title: string;
    category: string;
    duration: string;
    price: number;
    instructor_id: string;
}

const EducationKnowledgeSchema = new Schema<IEducationKnowledge>({
    course_title: { type: String, required: true },
    category: { type: String, required: true },
    duration: { type: String, required: true },
    price: { type: Number, required: true },
    instructor_id: { type: String, required: true },
});

export const EducationKnowledge = model<IEducationKnowledge>('EducationKnowledge', EducationKnowledgeSchema);
