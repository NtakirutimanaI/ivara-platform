import mongoose, { Schema, Document } from 'mongoose';

export interface IResource extends Document {
    type: string; // 'blog', 'guide', 'tutorial', 'documentation', 'update'
    title: string;
    slug: string;
    summary: string;
    content: string; // HTML or Markdown
    coverImage: string;
    author: string;
    isFeatured: boolean; // For the "Insights" section
    views: number;
}

const ResourceSchema: Schema = new Schema({
    type: { type: String, required: true, index: true },
    title: { type: String, required: true },
    slug: { type: String, required: true, unique: true },
    summary: { type: String },
    content: { type: String },
    coverImage: { type: String },
    author: { type: String, default: 'IVARA Team' },
    isFeatured: { type: Boolean, default: false },
    views: { type: Number, default: 0 }
}, { timestamps: true });

export const Resource = mongoose.model<IResource>('Resource', ResourceSchema);
