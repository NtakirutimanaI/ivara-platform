import mongoose, { Schema, Document } from 'mongoose';

export interface IService extends Document {
    name: string;
    description: string;
    category: string;
    basePrice: number;
    status: 'active' | 'inactive' | 'review';
    icon?: string;
    imageUrl?: string;
    providerCount: number;
    featured: boolean;
    createdAt: Date;
    updatedAt: Date;
}

const ServiceSchema: Schema = new Schema({
    name: { type: String, required: true },
    description: { type: String },
    category: { type: String, required: true }, // e.g., 'technical-repair', 'creative-lifestyle'
    basePrice: { type: Number, default: 0 },
    status: { type: String, enum: ['active', 'inactive', 'review'], default: 'active' },
    icon: { type: String },
    imageUrl: { type: String },
    providerCount: { type: Number, default: 0 },
    featured: { type: Boolean, default: false },
}, { timestamps: true });

export default mongoose.model<IService>('Service', ServiceSchema);
