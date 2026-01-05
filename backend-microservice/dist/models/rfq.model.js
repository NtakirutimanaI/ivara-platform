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
exports.RFQ = void 0;
const mongoose_1 = __importStar(require("mongoose"));
const RFQSchema = new mongoose_1.Schema({
    rfqId: {
        type: String,
        required: true,
        unique: true,
        default: () => `RFQ${Date.now()}${Math.floor(Math.random() * 1000)}`
    },
    buyerId: {
        type: mongoose_1.Schema.Types.ObjectId,
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
                type: mongoose_1.Schema.Types.ObjectId,
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
        type: mongoose_1.Schema.Types.ObjectId,
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
exports.RFQ = mongoose_1.default.model('RFQ', RFQSchema);
