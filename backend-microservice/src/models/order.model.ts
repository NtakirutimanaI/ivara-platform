import mongoose, { Schema, Document } from 'mongoose';

export interface IOrderItem {
    productId: mongoose.Types.ObjectId;
    productName: string;
    productImage: string;
    quantity: number;
    variant: {
        [key: string]: string;
    };
    price: number;
    subtotal: number;
}

export interface IShippingAddress {
    fullName: string;
    phone: string;
    addressLine1: string;
    addressLine2?: string;
    city: string;
    province: string;
    postalCode?: string;
    country: string;
}

export interface IOrder extends Document {
    orderId: string;
    buyerId: mongoose.Types.ObjectId;
    sellerId: mongoose.Types.ObjectId;
    items: IOrderItem[];
    totalAmount: number;
    currency: string;
    status: 'Pending' | 'Confirmed' | 'Processing' | 'Shipped' | 'Delivered' | 'Cancelled';
    paymentStatus: 'Pending' | 'Paid' | 'Failed' | 'Refunded';
    shippingAddress: IShippingAddress;
    notes?: string;
    createdAt: Date;
    updatedAt: Date;
}

const OrderSchema: Schema = new Schema({
    orderId: {
        type: String,
        required: true,
        unique: true,
        default: () => `ORD-${Date.now()}-${Math.random().toString(36).substr(2, 9).toUpperCase()}`
    },
    buyerId: {
        type: Schema.Types.ObjectId,
        ref: 'User',
        required: true
    },
    sellerId: {
        type: Schema.Types.ObjectId,
        ref: 'User',
        required: true
    },
    items: [{
        productId: {
            type: Schema.Types.ObjectId,
            ref: 'Product',
            required: true
        },
        productName: {
            type: String,
            required: true
        },
        productImage: {
            type: String,
            default: ''
        },
        quantity: {
            type: Number,
            required: true,
            min: 1
        },
        variant: {
            type: Map,
            of: String,
            default: {}
        },
        price: {
            type: Number,
            required: true,
            min: 0
        },
        subtotal: {
            type: Number,
            required: true,
            min: 0
        }
    }],
    totalAmount: {
        type: Number,
        required: true,
        min: 0
    },
    currency: {
        type: String,
        default: 'FRW'
    },
    status: {
        type: String,
        enum: ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
        default: 'Pending'
    },
    paymentStatus: {
        type: String,
        enum: ['Pending', 'Paid', 'Failed', 'Refunded'],
        default: 'Pending'
    },
    shippingAddress: {
        fullName: { type: String, required: true },
        phone: { type: String, required: true },
        addressLine1: { type: String, required: true },
        addressLine2: { type: String },
        city: { type: String, required: true },
        province: { type: String, required: true },
        postalCode: { type: String },
        country: { type: String, default: 'Rwanda' }
    },
    notes: {
        type: String,
        default: ''
    }
}, {
    timestamps: true
});

// Indexes for faster queries
OrderSchema.index({ buyerId: 1, createdAt: -1 });
OrderSchema.index({ sellerId: 1, status: 1 });
// OrderSchema.index({ orderId: 1 }); // Already indexed in schema definition

export const Order = mongoose.model<IOrder>('Order', OrderSchema);
