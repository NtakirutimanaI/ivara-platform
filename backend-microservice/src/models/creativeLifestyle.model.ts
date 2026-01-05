// src/models/creativeLifestyle.model.ts
import { Schema, model, Document } from 'mongoose';

export interface ICreativeLifestyle extends Document {
    service_type: string;
    duration: string;
    location: string;
    price: number;
    provider_id: string;
}

const CreativeLifestyleSchema = new Schema<ICreativeLifestyle>({
    service_type: { type: String, required: true },
    duration: { type: String, required: true },
    location: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});

export const CreativeLifestyle = model<ICreativeLifestyle>('CreativeLifestyle', CreativeLifestyleSchema);
