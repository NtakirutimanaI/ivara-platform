import mongoose, { Schema, Document } from 'mongoose';

export interface ILicense extends Document {
    licenseKey: string;
    userId: string;
    userName: string;
    userEmail: string;
    category: string; // e.g., 'technical-repair', 'creative-lifestyle', 'all'
    type: 'Individual' | 'Business' | 'Enterprise';
    status: 'active' | 'expired' | 'revoked' | 'pending';
    startDate: Date;
    endDate: Date;
    lastVerified?: Date;
    metadata?: any;
    createdAt: Date;
    updatedAt: Date;
}

const LicenseSchema: Schema = new Schema({
    licenseKey: { type: String, required: true, unique: true },
    userId: { type: String, required: true },
    userName: { type: String, required: true },
    userEmail: { type: String, required: true },
    category: { type: String, required: true, default: 'all' },
    type: { type: String, enum: ['Individual', 'Business', 'Enterprise'], default: 'Individual' },
    status: { type: String, enum: ['active', 'expired', 'revoked', 'pending'], default: 'active' },
    startDate: { type: Date, required: true },
    endDate: { type: Date, required: true },
    lastVerified: { type: Date },
    metadata: { type: Schema.Types.Mixed },
}, { timestamps: true });

export default mongoose.model<ILicense>('License', LicenseSchema);
