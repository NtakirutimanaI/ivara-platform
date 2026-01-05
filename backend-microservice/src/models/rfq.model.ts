import mongoose, { Schema, Document } from 'mongoose';

export interface IQuotation {
    sellerId: mongoose.Types.ObjectId;
    sellerName: string;
    pricePerUnit: number;
    totalPrice: number;
    leadTime: string;
    paymentTerms: string;
    notes: string;
    attachments: string[];
    submittedAt: Date;
    status: 'Pending' | 'Accepted' | 'Rejected';
}

export interface IRFQ extends Document {
    rfqId: string;
    buyerId: mongoose.Types.ObjectId;
    productName: string;
    category: string;
    description: string;
    quantity: number;
    unit: string;
    targetPrice: number;
    currency: string;
    deadline: Date;
    deliveryLocation: string;
    requiredCertifications: string[];
    attachments: string[];
    status: 'Open' | 'Closed' | 'Awarded' | 'Cancelled';
    quotations: IQuotation[];
    awardedTo?: mongoose.Types.ObjectId;
    views: number;
    createdAt: Date;
    updatedAt: Date;
}

const RFQSchema: Schema = new Schema({
    rfqId: {
        type: String,
        required: true,
        unique: true,
        default: () => `RFQ${Date.now()}${Math.floor(Math.random() * 1000)}`
    },
    buyerId: {
        type: Schema.Types.ObjectId,
        ref: 'B2BCompany',
        required: true
    },
    productName: {
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
    quantity: {
        type: Number,
        required: true,
        min: 1
    },
    unit: {
        type: String,
        default: 'pieces'
    },
    targetPrice: {
        type: Number,
        min: 0
    },
    currency: {
        type: String,
        default: 'FRW'
    },
    deadline: {
        type: Date,
        required: true
    },
    deliveryLocation: {
        type: String,
        required: true
    },
    requiredCertifications: [{
        type: String
    }],
    attachments: [{
        type: String
    }],
    status: {
        type: String,
        enum: ['Open', 'Closed', 'Awarded', 'Cancelled'],
        default: 'Open'
    },
    quotations: [{
        sellerId: {
            type: Schema.Types.ObjectId,
            ref: 'B2BCompany',
            required: true
        },
        sellerName: {
            type: String,
            required: true
        },
        pricePerUnit: {
            type: Number,
            required: true,
            min: 0
        },
        totalPrice: {
            type: Number,
            required: true,
            min: 0
        },
        leadTime: {
            type: String,
            required: true
        },
        paymentTerms: {
            type: String,
            required: true
        },
        notes: {
            type: String,
            maxlength: 500
        },
        attachments: [{
            type: String
        }],
        submittedAt: {
            type: Date,
            default: Date.now
        },
        status: {
            type: String,
            enum: ['Pending', 'Accepted', 'Rejected'],
            default: 'Pending'
        }
    }],
    awardedTo: {
        type: Schema.Types.ObjectId,
        ref: 'B2BCompany'
    },
    views: {
        type: Number,
        default: 0
    }
}, {
    timestamps: true
});

// Indexes
RFQSchema.index({ rfqId: 1 });
RFQSchema.index({ buyerId: 1 });
RFQSchema.index({ category: 1 });
RFQSchema.index({ status: 1 });
RFQSchema.index({ deadline: 1 });
RFQSchema.index({ productName: 'text', description: 'text' });

export const RFQ = mongoose.model<IRFQ>('RFQ', RFQSchema);
