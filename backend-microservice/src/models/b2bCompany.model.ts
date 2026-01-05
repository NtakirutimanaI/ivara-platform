import mongoose, { Schema, Document } from 'mongoose';

export interface IB2BCompany extends Document {
    companyId: string;
    userId: mongoose.Types.ObjectId;
    companyName: string;
    businessType: 'Manufacturer' | 'Distributor' | 'Wholesaler' | 'Retailer';
    registrationNumber: string;
    taxId: string;
    industry: string;
    address: {
        street: string;
        city: string;
        state: string;
        country: string;
        zipCode: string;
    };
    contactPerson: {
        name: string;
        email: string;
        phone: string;
    };
    description: string;
    logo: string;
    website: string;
    verificationStatus: 'Pending' | 'Verified' | 'Rejected';
    verificationDocuments: string[];
    creditLimit: number;
    paymentTerms: string[];
    rating: number;
    totalOrders: number;
    yearsInBusiness: number;
    isActive: boolean;
    createdAt: Date;
    updatedAt: Date;
}

const B2BCompanySchema: Schema = new Schema({
    companyId: {
        type: String,
        required: true,
        unique: true,
        default: () => `B2BC${Date.now()}${Math.floor(Math.random() * 1000)}`
    },
    userId: {
        type: Schema.Types.ObjectId,
        ref: 'User',
        required: false
    },
    companyName: {
        type: String,
        required: true,
        trim: true
    },
    businessType: {
        type: String,
        enum: ['Manufacturer', 'Distributor', 'Wholesaler', 'Retailer'],
        required: true
    },
    registrationNumber: {
        type: String,
        trim: true
    },
    taxId: {
        type: String,
        trim: true
    },
    industry: {
        type: String,
        required: true
    },
    address: {
        street: String,
        city: String,
        state: String,
        country: { type: String, default: 'Rwanda' },
        zipCode: String
    },
    contactPerson: {
        name: { type: String, required: true },
        email: { type: String, required: true },
        phone: { type: String, required: true }
    },
    description: {
        type: String,
        maxlength: 1000
    },
    logo: {
        type: String,
        default: ''
    },
    website: {
        type: String
    },
    verificationStatus: {
        type: String,
        enum: ['Pending', 'Verified', 'Rejected'],
        default: 'Pending'
    },
    verificationDocuments: [{
        type: String
    }],
    creditLimit: {
        type: Number,
        default: 0
    },
    paymentTerms: [{
        type: String,
        enum: ['Cash', 'NET 7', 'NET 15', 'NET 30', 'NET 60', 'NET 90']
    }],
    rating: {
        type: Number,
        default: 0,
        min: 0,
        max: 5
    },
    totalOrders: {
        type: Number,
        default: 0
    },
    yearsInBusiness: {
        type: Number,
        default: 0
    },
    isActive: {
        type: Boolean,
        default: true
    }
}, {
    timestamps: true
});

// Indexes
B2BCompanySchema.index({ companyId: 1 });
B2BCompanySchema.index({ businessType: 1 });
B2BCompanySchema.index({ industry: 1 });
B2BCompanySchema.index({ verificationStatus: 1 });
B2BCompanySchema.index({ 'contactPerson.email': 1 });

export const B2BCompany = mongoose.model<IB2BCompany>('B2BCompany', B2BCompanySchema);
