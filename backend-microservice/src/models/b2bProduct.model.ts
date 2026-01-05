import mongoose, { Schema, Document } from 'mongoose';

export interface IPricingTier {
    minQuantity: number;
    maxQuantity: number;
    pricePerUnit: number;
}

export interface IB2BProduct extends Document {
    productId: string;
    sellerId: mongoose.Types.ObjectId;
    name: string;
    category: string;
    description: string;
    images: string[];
    specifications: Map<string, string>;
    moq: number; // Minimum Order Quantity
    pricingTiers: IPricingTier[];
    basePrice: number;
    currency: string;
    stockQuantity: number;
    unit: string; // e.g., 'pieces', 'kg', 'boxes'
    leadTime: string; // e.g., '7-14 days'
    shippingTerms: string; // e.g., 'FOB', 'CIF', 'EXW'
    paymentTerms: string[];
    certifications: string[];
    status: 'Active' | 'Inactive' | 'OutOfStock';
    views: number;
    inquiries: number;
    orders: number;
    createdAt: Date;
    updatedAt: Date;
}

const B2BProductSchema: Schema = new Schema({
    productId: {
        type: String,
        required: true,
        unique: true,
        default: () => `B2BP${Date.now()}${Math.floor(Math.random() * 1000)}`
    },
    sellerId: {
        type: Schema.Types.ObjectId,
        ref: 'B2BCompany',
        required: true
    },
    name: {
        type: String,
        required: true,
        trim: true
    },
    category: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true,
        maxlength: 2000
    },
    images: [{
        type: String
    }],
    specifications: {
        type: Map,
        of: String
    },
    moq: {
        type: Number,
        required: true,
        min: 1
    },
    pricingTiers: [{
        minQuantity: { type: Number, required: true },
        maxQuantity: { type: Number, required: true },
        pricePerUnit: { type: Number, required: true }
    }],
    basePrice: {
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
        min: 0
    },
    unit: {
        type: String,
        default: 'pieces'
    },
    leadTime: {
        type: String,
        default: '7-14 days'
    },
    shippingTerms: {
        type: String,
        default: 'FOB'
    },
    paymentTerms: [{
        type: String
    }],
    certifications: [{
        type: String
    }],
    status: {
        type: String,
        enum: ['Active', 'Inactive', 'OutOfStock'],
        default: 'Active'
    },
    views: {
        type: Number,
        default: 0
    },
    inquiries: {
        type: Number,
        default: 0
    },
    orders: {
        type: Number,
        default: 0
    }
}, {
    timestamps: true
});

// Indexes
B2BProductSchema.index({ productId: 1 });
B2BProductSchema.index({ sellerId: 1 });
B2BProductSchema.index({ category: 1 });
B2BProductSchema.index({ status: 1 });
B2BProductSchema.index({ name: 'text', description: 'text' });

export const B2BProduct = mongoose.model<IB2BProduct>('B2BProduct', B2BProductSchema);
