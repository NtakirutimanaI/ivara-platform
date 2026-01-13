import { Schema, model, Document } from 'mongoose';

export interface ISubscription extends Document {
    userId: Schema.Types.ObjectId;
    userName: string;
    userEmail: string;
    plan: string;
    price: number;
    startDate: Date;
    endDate: Date;
    status: 'active' | 'inactive' | 'expired' | 'pending';
}

const SubscriptionSchema = new Schema<ISubscription>({
    userId: { type: Schema.Types.ObjectId, ref: 'User', required: true },
    userName: { type: String, required: true },
    userEmail: { type: String, required: true },
    plan: { type: String, required: true },
    price: { type: Number, required: true },
    startDate: { type: Date, default: Date.now },
    endDate: { type: Date, required: true },
    status: {
        type: String,
        enum: ['active', 'inactive', 'expired', 'pending'],
        default: 'active'
    }
}, { timestamps: true });

export const Subscription = model<ISubscription>('Subscription', SubscriptionSchema);
