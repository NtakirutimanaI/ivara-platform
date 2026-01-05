import { Schema, model, Document } from 'mongoose';

export interface ITask extends Document {
    title: string;
    description?: string;
    status: 'pending' | 'in_progress' | 'completed';
    user_id?: string;
    agent_id?: string;
    due_date?: Date;
    completed_at?: Date;
}

const TaskSchema = new Schema<ITask>({
    title: { type: String, required: true },
    description: { type: String },
    status: { type: String, enum: ['pending', 'in_progress', 'completed'], default: 'pending' },
    user_id: { type: String },
    agent_id: { type: String },
    due_date: { type: Date },
    completed_at: { type: Date },
}, { timestamps: true });

export const Task = model<ITask>('Task', TaskSchema);
