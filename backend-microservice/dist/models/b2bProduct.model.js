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
exports.B2BProduct = void 0;
const mongoose_1 = __importStar(require("mongoose"));
const B2BProductSchema = new mongoose_1.Schema({
    productId: {
        type: String,
        required: true,
        unique: true,
        default: () => `B2BP${Date.now()}${Math.floor(Math.random() * 1000)}`
    },
    sellerId: {
        type: mongoose_1.Schema.Types.ObjectId,
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
exports.B2BProduct = mongoose_1.default.model('B2BProduct', B2BProductSchema);
