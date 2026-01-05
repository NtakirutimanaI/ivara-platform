import { Schema, model, Document } from 'mongoose';

export interface IContact extends Document {
    name: string;
    email: string;
    phone?: string;
    subject: string;
    message: string;
    country_code?: string;
    status: 'new' | 'read' | 'replied' | 'archived';
    createdAt: Date;
    updatedAt: Date;
}

const contactSchema = new Schema<IContact>(
    {
        name: { type: String, required: true },
        email: { type: String, required: true },
        phone: { type: String },
        subject: { type: String, required: true },
        message: { type: String, required: true },
        country_code: { type: String },
        status: { type: String, enum: ['new', 'read', 'replied', 'archived'], default: 'new' }
    },
    { timestamps: true }
);

export const ContactModel = model<IContact>('Contact', contactSchema);
