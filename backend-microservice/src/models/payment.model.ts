import mongoose, { Schema, Document } from 'mongoose';

export interface IPayment extends Document {
    userId: mongoose.Types.ObjectId;
    userName: string;
    userEmail: string;
    amount: number;
    paymentMethod: string;
    transactionId: string;
    status: 'completed' | 'pending' | 'failed' | 'refunded';
    subscriptionId?: mongoose.Types.ObjectId;
    accountType: 'individual' | 'business';
    createdAt: Date;
    updatedAt: Date;
}

const PaymentSchema: Schema = new Schema({
    userId: { type: Schema.Types.ObjectId, ref: 'User', required: true },
    userName: { type: String, required: true },
    userEmail: { type: String, required: true },
    amount: { type: Number, required: true },
    paymentMethod: { type: String, default: 'Mobile Money' },
    transactionId: { type: String, unique: true, required: true },
    status: { type: String, enum: ['completed', 'pending', 'failed', 'refunded'], default: 'completed' },
    subscriptionId: { type: Schema.Types.ObjectId, ref: 'Subscription' },
    accountType: { type: String, enum: ['individual', 'business'], default: 'individual' }
}, { timestamps: true });

export const Payment = mongoose.model<IPayment>('Payment', PaymentSchema);
