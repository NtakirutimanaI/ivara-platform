"use strict";
// Example: How to structure MongoDB documents for multilingual content
// This shows how to update existing models to support translations
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.createProduct = exports.getProducts = void 0;
// BEFORE (Single language)
const productBefore = {
    name: "Laptop Repair",
    description: "Professional laptop repair services",
    price: 50000,
    category: "technical-repair"
};
// AFTER (Multilingual)
const productAfter = {
    name: {
        en: "Laptop Repair",
        rw: "Gusana Mudasobwa",
        sw: "Ukarabati wa Kompyuta",
        fr: "Réparation d'Ordinateur Portable"
    },
    description: {
        en: "Professional laptop repair services",
        rw: "Serivisi zo gusana mudasobwa z'umwuga",
        sw: "Huduma za ukarabati wa kompyuta za kitaalamu",
        fr: "Services professionnels de réparation d'ordinateurs portables"
    },
    price: 50000, // Numbers don't need translation
    category: "technical-repair" // IDs/slugs don't need translation
};
// ============================================
// MONGOOSE SCHEMA EXAMPLE
// ============================================
const mongoose_1 = require("mongoose");
// Product Schema
const ProductSchema = new mongoose_1.Schema({
    name: {
        en: { type: String, required: true },
        rw: { type: String },
        sw: { type: String },
        fr: { type: String }
    },
    description: {
        en: { type: String, required: true },
        rw: { type: String },
        sw: { type: String },
        fr: { type: String }
    },
    price: { type: Number, required: true },
    category: { type: String, required: true },
    images: [{ type: String }],
    seller: { type: mongoose_1.Schema.Types.ObjectId, ref: 'User', required: true },
    stock: { type: Number, default: 0 }
}, {
    timestamps: true
});
const Product_1 = __importDefault(require("../models/Product"));
const getProducts = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // Get locale from request (set by translation middleware)
        const locale = req.locale || 'en';
        // Fetch products from database
        const products = yield Product_1.default.find({ stock: { $gt: 0 } });
        // The translation middleware will automatically translate the response
        // But you can also manually translate if needed:
        // const translatedProducts = translationService.translateArray(products, locale);
        res.json({
            success: true,
            data: products, // Will be auto-translated by middleware
            pagination: {
                total: products.length,
                page: 1,
                limit: 20
            }
        });
    }
    catch (error) {
        res.status(500).json({
            success: false,
            error: 'error.server',
            message: 'Failed to fetch products'
        });
    }
});
exports.getProducts = getProducts;
const createProduct = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { name, description, price, category, images, stock } = req.body;
        // Validate that at least English is provided
        if (!(name === null || name === void 0 ? void 0 : name.en) || !(description === null || description === void 0 ? void 0 : description.en)) {
            return res.status(400).json({
                success: false,
                error: 'error.validation',
                message: 'English name and description are required'
            });
        }
        // Create product with multilingual fields
        const product = new Product_1.default({
            name: {
                en: name.en,
                rw: name.rw || name.en, // Fallback to English if not provided
                sw: name.sw || name.en,
                fr: name.fr || name.en
            },
            description: {
                en: description.en,
                rw: description.rw || description.en,
                sw: description.sw || description.en,
                fr: description.fr || description.en
            },
            price,
            category,
            images: images || [],
            seller: req.user._id,
            stock: stock || 0
        });
        yield product.save();
        res.status(201).json({
            success: true,
            message: 'success.created',
            data: product
        });
    }
    catch (error) {
        res.status(500).json({
            success: false,
            error: 'error.server',
            message: 'Failed to create product'
        });
    }
});
exports.createProduct = createProduct;
// ============================================
// FRONTEND API CALL EXAMPLE
// ============================================
// In Laravel Controller or JavaScript
function fetchProducts() {
    return __awaiter(this, void 0, void 0, function* () {
        // Get current locale from session
        const locale = app() -  > getLocale(); // Laravel
        // or
        const locale = localStorage.getItem('locale') || 'en'; // JavaScript
        // Make API call with locale parameter
        const response = yield fetch(`http://localhost:5001/api/products?locale=${locale}`);
        const data = yield response.json();
        // Products will already be translated
        console.log(data.data); // [{name: "Gusana Mudasobwa", ...}] if locale=rw
    });
}
// ============================================
// MIGRATION SCRIPT EXAMPLE
// ============================================
// Script to migrate existing single-language data to multilingual format
function migrateProductsToMultilingual() {
    return __awaiter(this, void 0, void 0, function* () {
        const products = yield Product_1.default.find({});
        for (const product of products) {
            // Check if already migrated
            if (typeof product.name === 'object' && product.name.en) {
                continue; // Already migrated
            }
            // Convert single language to multilingual
            const oldName = product.name;
            const oldDescription = product.description;
            product.name = {
                en: oldName,
                rw: oldName, // Initially same as English
                sw: oldName,
                fr: oldName
            };
            product.description = {
                en: oldDescription,
                rw: oldDescription,
                sw: oldDescription,
                fr: oldDescription
            };
            yield product.save();
            console.log(`Migrated product: ${oldName}`);
        }
        console.log('Migration completed!');
    });
}
