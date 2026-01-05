import { Schema, model, Document } from 'mongoose';

export interface IMeeting extends Document {
    title: string;
    description?: string;
    date: Date;
    host_id: string;
    attendees: string[];
    location?: string;
    status: 'scheduled' | 'cancelled' | 'completed';
}

const MeetingSchema = new Schema<IMeeting>({
    title: { type: String, required: true },
    description: { type: String },
    date: { type: Date, required: true },
    host_id: { type: String, required: true },
    attendees: [{ type: String }],
    location: { type: String },
    status: { type: String, enum: ['scheduled', 'cancelled', 'completed'], default: 'scheduled' },
}, { timestamps: true });

export const Meeting = model<IMeeting>('Meeting', MeetingSchema);
