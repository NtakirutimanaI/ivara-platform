"use strict";
var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    var desc = Object.getOwnPropertyDescriptor(m, k);
    if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
      desc = { enumerable: true, get: function() { return m[k]; } };
    }
    Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __setModuleDefault = (this && this.__setModuleDefault) || (Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
});
var __importStar = (this && this.__importStar) || (function () {
    var ownKeys = function(o) {
        ownKeys = Object.getOwnPropertyNames || function (o) {
            var ar = [];
            for (var k in o) if (Object.prototype.hasOwnProperty.call(o, k)) ar[ar.length] = k;
            return ar;
        };
        return ownKeys(o);
    };
    return function (mod) {
        if (mod && mod.__esModule) return mod;
        var result = {};
        if (mod != null) for (var k = ownKeys(mod), i = 0; i < k.length; i++) if (k[i] !== "default") __createBinding(result, mod, k[i]);
        __setModuleDefault(result, mod);
        return result;
    };
})();
Object.defineProperty(exports, "__esModule", { value: true });
exports.B2BCompany = void 0;
const mongoose_1 = __importStar(require("mongoose"));
const B2BCompanySchema = new mongoose_1.Schema({
    companyId: {
        type: String,
        required: true,
        unique: true,
        default: () => `B2BC${Date.now()}${Math.floor(Math.random() * 1000)}`
    },
    userId: {
        type: mongoose_1.Schema.Types.ObjectId,
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
exports.B2BCompany = mongoose_1.default.model('B2BCompany', B2BCompanySchema);
