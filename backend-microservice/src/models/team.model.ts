import { Schema, model, Document } from 'mongoose';

export interface ITeam extends Document {
    full_name: string;
    position: string;
    contact?: string;
    email?: string;
    image?: string;
    social_links?: {
        facebook?: string;
        twitter?: string;
        linkedin?: string;
        instagram?: string;
    };
    status: string;
}

const TeamSchema = new Schema<ITeam>({
    full_name: { type: String, required: true },
    position: { type: String, required: true },
    contact: { type: String },
    email: { type: String },
    image: { type: String },
    social_links: {
        facebook: { type: String },
        twitter: { type: String },
        linkedin: { type: String },
        instagram: { type: String },
    },
    status: { type: String, default: 'active' },
}, { timestamps: true });

export const Team = model<ITeam>('Team', TeamSchema);
