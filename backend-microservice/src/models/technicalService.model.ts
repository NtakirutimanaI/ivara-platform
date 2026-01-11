import { Schema, model, Document } from 'mongoose';

export interface ITechnicalService extends Document {
    name: string;
    description: string;
    price: number;
    status: 'active' | 'inactive';
    category: string;
}

const TechnicalServiceSchema = new Schema<ITechnicalService>({
    name: { type: String, required: true },
    description: { type: String, required: false },
    price: { type: Number, required: true, default: 0 },
    status: { type: String, enum: ['active', 'inactive'], default: 'active' },
    category: { type: String, default: 'technical-repair' }
}, { timestamps: true });

export const TechnicalService = model<ITechnicalService>('TechnicalService', TechnicalServiceSchema);
