import { Schema, model, Document } from 'mongoose';

export interface IRepair extends Document {
    device_id: string;
    device_name: string;
    problem_description: string;
    repair_status: string;
    technician_id?: string;
    received_date: Date;
    completed_date?: Date;
    cost: number;
}

const RepairSchema = new Schema<IRepair>({
    device_id: { type: String, required: true },
    device_name: { type: String, required: true },
    problem_description: { type: String, required: true },
    repair_status: { type: String, default: 'Pending' },
    technician_id: { type: String },
    received_date: { type: Date, default: Date.now },
    completed_date: { type: Date },
    cost: { type: Number, default: 0 },
}, { timestamps: true });

export const Repair = model<IRepair>('Repair', RepairSchema);
