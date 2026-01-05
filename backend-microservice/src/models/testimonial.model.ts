import mongoose, { Schema, Document } from 'mongoose';

export interface ITestimonial extends Document {
    name: string;
    role: string;
    company: string;
    rating: number;
    text: string;
    avatar?: string;
    isActive: boolean;
    createdAt: Date;
    updatedAt: Date;
}

const TestimonialSchema: Schema = new Schema(
    {
        name: {
            type: String,
            required: true,
        },
        role: {
            type: String,
            required: true,
        },
        company: {
            type: String,
            required: true,
        },
        rating: {
            type: Number,
            required: true,
            min: 1,
            max: 5,
            default: 5,
        },
        text: {
            type: String,
            required: true,
            maxlength: 500,
        },
        avatar: {
            type: String,
            default: null,
        },
        isActive: {
            type: Boolean,
            default: true,
        },
    },
    {
        timestamps: true,
    }
);

export default mongoose.model<ITestimonial>('Testimonial', TestimonialSchema);
