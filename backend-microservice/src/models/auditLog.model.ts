import mongoose, { Schema, Document } from 'mongoose';

export interface IAuditLog extends Document {
    userId: mongoose.Types.ObjectId;
    action: string; // 'create', 'update', 'delete', 'login', 'logout', etc.
    resource: string; // 'user', 'booking', 'product', etc.
    resourceId?: mongoose.Types.ObjectId;
    changes?: any; // What was changed
    ipAddress?: string;
    userAgent?: string;
    timestamp: Date;
}

const AuditLogSchema: Schema = new Schema(
    {
        userId: {
            type: Schema.Types.ObjectId,
            ref: 'User',
            required: true,
            index: true,
        },
        action: {
            type: String,
            required: true,
            enum: ['create', 'read', 'update', 'delete', 'login', 'logout', 'approve', 'reject', 'assign'],
        },
        resource: {
            type: String,
            required: true,
            index: true,
        },
        resourceId: {
            type: Schema.Types.ObjectId,
        },
        changes: {
            type: Schema.Types.Mixed,
        },
        ipAddress: {
            type: String,
        },
        userAgent: {
            type: String,
        },
        timestamp: {
            type: Date,
            default: Date.now,
            index: true,
        },
    },
    {
        timestamps: false, // We use custom timestamp field
    }
);

// Compound index for efficient queries
AuditLogSchema.index({ userId: 1, timestamp: -1 });
AuditLogSchema.index({ resource: 1, resourceId: 1 });

export default mongoose.model<IAuditLog>('AuditLog', AuditLogSchema);
