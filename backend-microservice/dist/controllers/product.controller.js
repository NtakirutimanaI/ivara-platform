"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.getSellerProducts = exports.deleteProduct = exports.updateProduct = exports.createProduct = exports.getProductById = exports.getProductsByCategory = exports.getAllProducts = void 0;
const product_model_1 = require("../models/product.model");
// Get all products with filters
const getAllProducts = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { category, status, search, page = 1, limit = 20 } = req.query;
        const filter = {};
        if (category)
            filter.category = category;
        if (status)
            filter.status = status;
        else
            filter.status = 'Active'; // Default to active products
        if (search) {
            filter.$text = { $search: search };
        }
        const skip = (Number(page) - 1) * Number(limit);
        const products = yield product_model_1.Product.find(filter)
            .populate('seller', 'name email')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit));
        const total = yield product_model_1.Product.countDocuments(filter);
        res.status(200).json({
            success: true,
            data: products,
            pagination: {
                total,
                page: Number(page),
                limit: Number(limit),
                pages: Math.ceil(total / Number(limit))
            }
        });
    }
    catch (error) {
        console.error('Get products error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch products' });
    }
});
exports.getAllProducts = getAllProducts;
// Get products by category
const getProductsByCategory = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { category } = req.params;
        const { page = 1, limit = 20 } = req.query;
        const skip = (Number(page) - 1) * Number(limit);
        const products = yield product_model_1.Product.find({ category, status: 'Active' })
            .populate('seller', 'name email')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit));
        const total = yield product_model_1.Product.countDocuments({ category, status: 'Active' });
        res.status(200).json({
            success: true,
            category,
            data: products,
            pagination: {
                total,
                page: Number(page),
                limit: Number(limit),
                pages: Math.ceil(total / Number(limit))
            }
        });
    }
    catch (error) {
        console.error('Get products by category error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch products' });
    }
});
exports.getProductsByCategory = getProductsByCategory;
// Get single product
const getProductById = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const product = yield product_model_1.Product.findById(id).populate('seller', 'name email phone');
        if (!product) {
            return res.status(404).json({ success: false, message: 'Product not found' });
        }
        res.status(200).json({ success: true, data: product });
    }
    catch (error) {
        console.error('Get product error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch product' });
    }
});
exports.getProductById = getProductById;
// Create product (seller only)
const createProduct = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const productData = req.body;
        // Auto-determine stock status
        if (productData.stockQuantity === 0) {
            productData.stockStatus = 'Out of Stock';
        }
        else if (productData.stockQuantity < 10) {
            productData.stockStatus = 'Low Stock';
        }
        else {
            productData.stockStatus = 'In Stock';
        }
        const product = new product_model_1.Product(productData);
        yield product.save();
        res.status(201).json({
            success: true,
            message: 'Product created successfully',
            data: product
        });
    }
    catch (error) {
        console.error('Create product error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to create product',
            error: error.message
        });
    }
});
exports.createProduct = createProduct;
// Update product
const updateProduct = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const updates = req.body;
        // Auto-update stock status if quantity changed
        if (updates.stockQuantity !== undefined) {
            if (updates.stockQuantity === 0) {
                updates.stockStatus = 'Out of Stock';
            }
            else if (updates.stockQuantity < 10) {
                updates.stockStatus = 'Low Stock';
            }
            else {
                updates.stockStatus = 'In Stock';
            }
        }
        const product = yield product_model_1.Product.findByIdAndUpdate(id, { $set: updates }, { new: true, runValidators: true });
        if (!product) {
            return res.status(404).json({ success: false, message: 'Product not found' });
        }
        res.status(200).json({
            success: true,
            message: 'Product updated successfully',
            data: product
        });
    }
    catch (error) {
        console.error('Update product error:', error);
        res.status(500).json({ success: false, message: 'Failed to update product' });
    }
});
exports.updateProduct = updateProduct;
// Delete product
const deleteProduct = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const product = yield product_model_1.Product.findByIdAndDelete(id);
        if (!product) {
            return res.status(404).json({ success: false, message: 'Product not found' });
        }
        res.status(200).json({
            success: true,
            message: 'Product deleted successfully'
        });
    }
    catch (error) {
        console.error('Delete product error:', error);
        res.status(500).json({ success: false, message: 'Failed to delete product' });
    }
});
exports.deleteProduct = deleteProduct;
// Get seller's products
const getSellerProducts = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { sellerId } = req.params;
        const { page = 1, limit = 20 } = req.query;
        const skip = (Number(page) - 1) * Number(limit);
        const products = yield product_model_1.Product.find({ seller: sellerId })
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit));
        const total = yield product_model_1.Product.countDocuments({ seller: sellerId });
        res.status(200).json({
            success: true,
            data: products,
            pagination: {
                total,
                page: Number(page),
                limit: Number(limit),
                pages: Math.ceil(total / Number(limit))
            }
        });
    }
    catch (error) {
        console.error('Get seller products error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch seller products' });
    }
});
exports.getSellerProducts = getSellerProducts;
