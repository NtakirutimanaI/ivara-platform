import { Schema, model, Document } from 'mongoose';

export interface IEmergencyLog extends Document {
    driver_id: string;
    incident_type: string;
    location: string;
    priority: 'low' | 'medium' | 'high' | 'critical';
    status: 'dispatched' | 'at_scene' | 'transporting' | 'completed';
    notes?: string;
}

const EmergencyLogSchema = new Schema<IEmergencyLog>({
    driver_id: { type: String, required: true },
    incident_type: { type: String, required: true },
    location: { type: String, required: true },
    priority: { type: String, enum: ['low', 'medium', 'high', 'critical'], default: 'medium' },
    status: { type: String, enum: ['dispatched', 'at_scene', 'transporting', 'completed'], default: 'dispatched' },
    notes: { type: String },
}, { timestamps: true });

export const EmergencyLog = model<IEmergencyLog>('EmergencyLog', EmergencyLogSchema);
