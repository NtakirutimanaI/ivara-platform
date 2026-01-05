// src/models/technicalRepair.model.ts
import { Schema, model, Document } from 'mongoose';

export interface ITechnicalRepair extends Document {
    service_type: string;
    device_type: string;
    issue_description: string;
    status: string;
    price: number;
    technician_id: string;
}

const TechnicalRepairSchema = new Schema<ITechnicalRepair>({
    service_type: { type: String, required: true },
    device_type: { type: String, required: true },
    issue_description: { type: String, required: true },
    status: { type: String, required: true },
    price: { type: Number, required: true },
    technician_id: { type: String, required: true },
});

export const TechnicalRepair = model<ITechnicalRepair>('TechnicalRepair', TechnicalRepairSchema);
