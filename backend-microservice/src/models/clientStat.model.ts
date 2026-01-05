import mongoose, { Schema, Document } from 'mongoose';

export interface IClientStat extends Document {
    icon: string;
    number: string;
    label: string;
    color: string;
    order: number;
    isActive: boolean;
    createdAt: Date;
    updatedAt: Date;
}

const ClientStatSchema: Schema = new Schema(
    {
        icon: {
            type: String,
            required: true,
            default: 'fa-chart-line',
        },
        number: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
        color: {
            type: String,
            required: true,
            default: '#3b82f6',
        },
        order: {
            type: Number,
            default: 0,
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

export default mongoose.model<IClientStat>('ClientStat', ClientStatSchema);
