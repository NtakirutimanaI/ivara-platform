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
exports.Product = void 0;
const mongoose_1 = __importStar(require("mongoose"));
const ProductSchema = new mongoose_1.Schema({
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
            if (this.stockQuantity === 0)
                return 'Out of Stock';
            if (this.stockQuantity < 10)
                return 'Low Stock';
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
        type: mongoose_1.Schema.Types.ObjectId,
        ref: 'User',
        required: true
    },
    status: {
        type: String,
        enum: ['Active', 'Inactive'],
        default: 'Active'
    }
}, {
    timestamps: true
});
// Index for faster queries
ProductSchema.index({ category: 1, status: 1 });
ProductSchema.index({ seller: 1 });
ProductSchema.index({ name: 'text', description: 'text' });
exports.Product = mongoose_1.default.model('Product', ProductSchema);
