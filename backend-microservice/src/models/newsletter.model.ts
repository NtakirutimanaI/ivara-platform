import mongoose, { Schema, Document } from 'mongoose';

export interface INewsletterSubscription extends Document {
    email: string;
    subscribedAt: Date;
    isActive: boolean;
}

const NewsletterSubscriptionSchema: Schema = new Schema({
    email: {
        type: String,
        required: true,
        unique: true,
        lowercase: true,
        trim: true
    },
    subscribedAt: {
        type: Date,
        default: Date.now
    },
    isActive: {
        type: Boolean,
        default: true
    }
}, { timestamps: true });

export const NewsletterSubscription = mongoose.model<INewsletterSubscription>('NewsletterSubscription', NewsletterSubscriptionSchema);
