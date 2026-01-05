import { Schema, model, Document } from 'mongoose';

export interface ISetting extends Document {
    key: string;
    value: any;
}

const SettingSchema = new Schema<ISetting>({
    key: { type: String, required: true, unique: true },
    value: { type: Schema.Types.Mixed, required: true }, // Can be string, number, boolean, etc.
}, { timestamps: true });

export const Setting = model<ISetting>('Setting', SettingSchema);
