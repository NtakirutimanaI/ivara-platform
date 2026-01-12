import mongoose, { Schema, Document } from 'mongoose';

export interface IProductVariant {
    name: string;  // e.g., "Color", "Size"
    options: string[];  // e.g., ["Red", "Blue", "Green"] or ["S", "M", "L", "XL"]
}

export interface IProduct extends Document {
    productId: string;
    name: string;
    category: string;
    price: number;
    currency: string;
    stockQuantity: number;
    stockStatus: 'In Stock' | 'Low Stock' | 'Out of Stock';
    description: string;
    images: string[];
    variants: IProductVariant[];
    seller: mongoose.Types.ObjectId;
    sellerName?: string;
    status: 'Pending' | 'Active' | 'Inactive' | 'Rejected';
    tier: 'Basic' | 'Standard' | 'Premium';
    createdAt: Date;
    updatedAt: Date;
}

const ProductSchema: Schema = new Schema({
    productId: {
        type: String,
        required: true,
        unique: true,
        default: () => `PRD-${Date.now()}-${Math.random().toString(36).substr(2, 9).toUpperCase()}`
    },
    name: {
        type: String,
        required: true,
        trim: true
    },
    category: {
        type: String,
        required: true,
        enum: [
            'technical',
            'creative',
            'transport',
            'food-fashion',
            'education',
            'agriculture',
            'media',
            'legal',
            'other'
        ]
    },
    price: {
        type: Number,
        required: true,
        min: 0
    },
    currency: {
        type: String,
        default: 'FRW'
    },
    stockQuantity: {
        type: Number,
        required: true,
        default: 0,
        min: 0
    },
    stockStatus: {
        type: String,
        enum: ['In Stock', 'Low Stock', 'Out of Stock'],
        default: function () {
            if (this.stockQuantity === 0) return 'Out of Stock';
            if (this.stockQuantity < 10) return 'Low Stock';
            return 'In Stock';
        }
    },
    description: {
        type: String,
        required: true
    },
    images: {
        type: [String],
        default: []
    },
    variants: [{
        name: { type: String, required: true },
        options: [{ type: String }]
    }],
    seller: {
        type: Schema.Types.ObjectId,
        ref: 'User',
        required: true
    },
    sellerName: {
        type: String
    },
    status: {
        type: String,
        enum: ['Pending', 'Active', 'Inactive', 'Rejected'],
        default: 'Pending'
    },
    tier: {
        type: String,
        enum: ['Basic', 'Standard', 'Premium'],
        default: 'Basic'
    }
}, {
    timestamps: true
});

// Index for faster queries
ProductSchema.index({ category: 1, status: 1 });
ProductSchema.index({ seller: 1 });
ProductSchema.index({ name: 'text', description: 'text' });

export const Product = mongoose.model<IProduct>('Product', ProductSchema);
