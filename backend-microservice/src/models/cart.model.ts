import mongoose, { Schema, Document } from 'mongoose';

export interface ICartItem {
    productId: mongoose.Types.ObjectId;
    productName: string;
    productImage: string;
    quantity: number;
    variant: {
        [key: string]: string;  // e.g., { "Color": "Red", "Size": "M" }
    };
    price: number;
    subtotal: number;
}

export interface ICart extends Document {
    userId: mongoose.Types.ObjectId;
    items: ICartItem[];
    totalAmount: number;
    createdAt: Date;
    updatedAt: Date;
}

const CartSchema: Schema = new Schema({
    userId: {
        type: Schema.Types.ObjectId,
        ref: 'User',
        required: true,
        unique: true
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
            min: 1,
            default: 1
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
        default: 0
    }
}, {
    timestamps: true
});

// Calculate total amount before saving
CartSchema.pre('save', function (next) {
    const items = this.items as any[];
    this.totalAmount = items.reduce((total: number, item: any) => total + item.subtotal, 0);
    next();
});

export const Cart = mongoose.model<ICart>('Cart', CartSchema);
