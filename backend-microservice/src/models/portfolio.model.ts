import mongoose, { Schema, Document } from 'mongoose';

export interface IPortfolio extends Document {
    title: string;
    slug: string; // For Deep Linking if needed, though ID works too
    category: string; // e.g., "Web App", "Mobile App", "Branding"
    description: string;
    client: string;
    image: string; // Thumbnail
    gallery: string[]; // Additional images
    technologies: string[];
    link: string; // Live link
    isFeatured: boolean;
    createdAt: Date;
}

const PortfolioSchema: Schema = new Schema({
    title: { type: String, required: true },
    slug: { type: String, required: true, unique: true },
    category: { type: String, required: true },
    description: { type: String, required: true },
    client: { type: String },
    image: { type: String, required: true },
    gallery: [{ type: String }],
    technologies: [{ type: String }],
    link: { type: String },
    isFeatured: { type: Boolean, default: false },
}, { timestamps: true });

export default mongoose.model<IPortfolio>('Portfolio', PortfolioSchema);
