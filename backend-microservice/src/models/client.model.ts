import { Schema, model, Document } from 'mongoose';

export interface IClient extends Document {
    name: string;
    email?: string;
    phone?: string;
    address?: string;
    mediator_id?: string;
    status: 'active' | 'inactive';
}

const ClientSchema = new Schema<IClient>({
    name: { type: String, required: true },
    email: { type: String, unique: true, sparse: true },
    phone: { type: String },
    address: { type: String },
    mediator_id: { type: String },
    status: { type: String, enum: ['active', 'inactive'], default: 'active' },
}, { timestamps: true });

export const Client = model<IClient>('Client', ClientSchema);
