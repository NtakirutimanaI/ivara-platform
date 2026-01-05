import { Schema, model, Document } from 'mongoose';

export interface ILogbook extends Document {
    user_id: string; // The intern
    date: Date;
    activity_details: string;
    hours_spent: number;
    supervisor_feedback?: string;
    status: 'pending' | 'approved' | 'rejected';
}

const LogbookSchema = new Schema<ILogbook>({
    user_id: { type: String, required: true },
    date: { type: Date, required: true, default: Date.now },
    activity_details: { type: String, required: true },
    hours_spent: { type: Number, required: true },
    supervisor_feedback: { type: String },
    status: { type: String, enum: ['pending', 'approved', 'rejected'], default: 'pending' },
}, { timestamps: true });

export const Logbook = model<ILogbook>('Logbook', LogbookSchema);
