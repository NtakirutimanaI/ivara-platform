import mongoose, { Schema, Document } from 'mongoose';

export interface INotification extends Document {
    userId: mongoose.Types.ObjectId;
    type: 'account_action' | 'booking' | 'payment' | 'system' | 'approval' | 'assignment';
    title: string;
    message: string;
    actionBy?: mongoose.Types.ObjectId;
    relatedEntity?: {
        type: string; // 'booking', 'user', 'product', etc.
        id: mongoose.Types.ObjectId;
    };
    isRead: boolean;
    priority: 'low' | 'medium' | 'high' | 'urgent';
    createdAt: Date;
    readAt?: Date;
}

const NotificationSchema: Schema = new Schema(
    {
        userId: {
            type: Schema.Types.ObjectId,
            ref: 'User',
            required: true,
            index: true,
        },
        type: {
            type: String,
            enum: ['account_action', 'booking', 'payment', 'system', 'approval', 'assignment'],
            required: true,
        },
        title: {
            type: String,
            required: true,
            maxlength: 200,
        },
        message: {
            type: String,
            required: true,
            maxlength: 1000,
        },
        actionBy: {
            type: Schema.Types.ObjectId,
            ref: 'User',
        },
        relatedEntity: {
            type: {
                type: String,
            },
            id: {
                type: Schema.Types.ObjectId,
            },
        },
        isRead: {
            type: Boolean,
            default: false,
            index: true,
        },
        priority: {
            type: String,
            enum: ['low', 'medium', 'high', 'urgent'],
            default: 'medium',
        },
        readAt: {
            type: Date,
        },
    },
    {
        timestamps: true,
    }
);

// Index for efficient queries
NotificationSchema.index({ userId: 1, isRead: 1, createdAt: -1 });
NotificationSchema.index({ userId: 1, type: 1 });

export default mongoose.model<INotification>('Notification', NotificationSchema);
