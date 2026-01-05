import { Schema, model, Document } from 'mongoose';

export interface IProject extends Document {
    name: string;
    description?: string;
    client_id: string;
    provider_id: string;
    status: 'planned' | 'in_progress' | 'completed' | 'on_hold';
    start_date?: Date;
    end_date?: Date;
    budget: number;
}

const ProjectSchema = new Schema<IProject>({
    name: { type: String, required: true },
    description: { type: String },
    client_id: { type: String, required: true },
    provider_id: { type: String, required: true },
    status: { type: String, enum: ['planned', 'in_progress', 'completed', 'on_hold'], default: 'planned' },
    start_date: { type: Date },
    end_date: { type: Date },
    budget: { type: Number, default: 0 },
}, { timestamps: true });

export const Project = model<IProject>('Project', ProjectSchema);
