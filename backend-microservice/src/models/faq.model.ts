import mongoose, { Schema, Document } from 'mongoose';

export interface IFaq extends Document {
    question: string;
    answer: string;
    category: string; // 'General', 'Pricing', 'Technical', etc.
    order: number;
}

const FaqSchema: Schema = new Schema({
    question: { type: String, required: true },
    answer: { type: String, required: true },
    category: { type: String, default: 'General' },
    order: { type: Number, default: 0 }
}, { timestamps: true });

export const Faq = mongoose.model<IFaq>('Faq', FaqSchema);
