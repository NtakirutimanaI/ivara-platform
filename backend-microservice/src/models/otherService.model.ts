// src/models/otherService.model.ts
import { Schema, model, Document } from 'mongoose';

export interface IOtherService extends Document {
    service_type: string;
    description: string;
    price: number;
    provider_id: string;
}

const OtherServiceSchema = new Schema<IOtherService>({
    service_type: { type: String, required: true },
    description: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});

export const OtherService = model<IOtherService>('OtherService', OtherServiceSchema);
