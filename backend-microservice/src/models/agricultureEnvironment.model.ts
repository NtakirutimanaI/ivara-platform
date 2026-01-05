// src/models/agricultureEnvironment.model.ts
import { Schema, model, Document } from 'mongoose';

export interface IAgricultureEnvironment extends Document {
    service_type: string;
    land_size: string;
    location: string;
    season: string;
    price: number;
    provider_id: string;
}

const AgricultureEnvironmentSchema = new Schema<IAgricultureEnvironment>({
    service_type: { type: String, required: true },
    land_size: { type: String, required: true },
    location: { type: String, required: true },
    season: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});

export const AgricultureEnvironment = model<IAgricultureEnvironment>('AgricultureEnvironment', AgricultureEnvironmentSchema);
