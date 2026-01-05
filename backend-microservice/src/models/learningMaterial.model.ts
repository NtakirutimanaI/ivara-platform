import { Schema, model, Document } from 'mongoose';

export interface ILearningMaterial extends Document {
    title: string;
    description?: string;
    content_type: 'video' | 'pdf' | 'text';
    url: string;
    category: string;
    level: 'beginner' | 'intermediate' | 'advanced';
}

const LearningMaterialSchema = new Schema<ILearningMaterial>({
    title: { type: String, required: true },
    description: { type: String },
    content_type: { type: String, enum: ['video', 'pdf', 'text'], required: true },
    url: { type: String, required: true },
    category: { type: String, required: true },
    level: { type: String, enum: ['beginner', 'intermediate', 'advanced'], default: 'beginner' },
}, { timestamps: true });

export const LearningMaterial = model<ILearningMaterial>('LearningMaterial', LearningMaterialSchema);
