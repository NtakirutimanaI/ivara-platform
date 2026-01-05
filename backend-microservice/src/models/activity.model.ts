import { Schema, model, Document } from 'mongoose';

export interface IActivity extends Document {
    title: string;
    description: string;
    user_id: string;
    status: string;
}

const ActivitySchema = new Schema<IActivity>({
    title: { type: String, required: true },
    description: { type: String, required: true },
    user_id: { type: String, required: true },
    status: { type: String, default: 'active' },
}, { timestamps: true });

export const Activity = model<IActivity>('Activity', ActivitySchema);
