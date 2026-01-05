import { Schema, model, Document } from 'mongoose';

export interface IMeasurement extends Document {
    client_id: string;
    tailor_id: string;
    item_type: string;
    details: Record<string, any>;
    notes?: string;
}

const MeasurementSchema = new Schema<IMeasurement>({
    client_id: { type: String, required: true },
    tailor_id: { type: String, required: true },
    item_type: { type: String, required: true },
    details: { type: Schema.Types.Mixed, required: true },
    notes: { type: String },
}, { timestamps: true });

export const Measurement = model<IMeasurement>('Measurement', MeasurementSchema);
