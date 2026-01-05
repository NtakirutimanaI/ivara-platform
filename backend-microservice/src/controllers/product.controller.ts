import { Request, Response } from 'express';
import { Product } from '../models/product.model';

// Get all products with filters
export const getAllProducts = async (req: Request, res: Response) => {
    try {
        const { category, status, search, page = 1, limit = 20 } = req.query;

        const filter: any = {};

        if (category) filter.category = category;
        if (status) filter.status = status;
        else filter.status = 'Active'; // Default to active products

        if (search) {
            filter.$text = { $search: search as string };
        }

        const skip = (Number(page) - 1) * Number(limit);

        const products = await Product.find(filter)
            .populate('seller', 'name email')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit))
            .lean(); // Convert to plain JavaScript objects

        const total = await Product.countDocuments(filter);

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
    } catch (error) {
        console.error('Get products error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch products' });
    }
};

// Get products by category
export const getProductsByCategory = async (req: Request, res: Response) => {
    try {
        const { category } = req.params;
        const { page = 1, limit = 20 } = req.query;

        const skip = (Number(page) - 1) * Number(limit);

        const products = await Product.find({ category, status: 'Active' })
            .populate('seller', 'name email')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit))
            .lean();

        const total = await Product.countDocuments({ category, status: 'Active' });

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
    } catch (error) {
        console.error('Get products by category error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch products' });
    }
};

// Get single product
export const getProductById = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;

        const product = await Product.findById(id)
            .populate('seller', 'name email phone')
            .lean();

        if (!product) {
            return res.status(404).json({ success: false, message: 'Product not found' });
        }

        res.status(200).json({ success: true, data: product });
    } catch (error) {
        console.error('Get product error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch product' });
    }
};

// Create product (seller only)
export const createProduct = async (req: Request, res: Response) => {
    try {
        const productData = req.body;

        // Auto-determine stock status
        if (productData.stockQuantity === 0) {
            productData.stockStatus = 'Out of Stock';
        } else if (productData.stockQuantity < 10) {
            productData.stockStatus = 'Low Stock';
        } else {
            productData.stockStatus = 'In Stock';
        }

        const product = new Product(productData);
        await product.save();

        res.status(201).json({
            success: true,
            message: 'Product created successfully',
            data: product
        });
    } catch (error: any) {
        console.error('Create product error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to create product',
            error: error.message
        });
    }
};

// Update product
export const updateProduct = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const updates = req.body;

        // Auto-update stock status if quantity changed
        if (updates.stockQuantity !== undefined) {
            if (updates.stockQuantity === 0) {
                updates.stockStatus = 'Out of Stock';
            } else if (updates.stockQuantity < 10) {
                updates.stockStatus = 'Low Stock';
            } else {
                updates.stockStatus = 'In Stock';
            }
        }

        const product = await Product.findByIdAndUpdate(
            id,
            { $set: updates },
            { new: true, runValidators: true }
        );

        if (!product) {
            return res.status(404).json({ success: false, message: 'Product not found' });
        }

        res.status(200).json({
            success: true,
            message: 'Product updated successfully',
            data: product
        });
    } catch (error) {
        console.error('Update product error:', error);
        res.status(500).json({ success: false, message: 'Failed to update product' });
    }
};

// Delete product
export const deleteProduct = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;

        const product = await Product.findByIdAndDelete(id);

        if (!product) {
            return res.status(404).json({ success: false, message: 'Product not found' });
        }

        res.status(200).json({
            success: true,
            message: 'Product deleted successfully'
        });
    } catch (error) {
        console.error('Delete product error:', error);
        res.status(500).json({ success: false, message: 'Failed to delete product' });
    }
};

// Get seller's products
export const getSellerProducts = async (req: Request, res: Response) => {
    try {
        const { sellerId } = req.params;
        const { page = 1, limit = 20 } = req.query;

        const skip = (Number(page) - 1) * Number(limit);

        const products = await Product.find({ seller: sellerId })
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit))
            .lean();

        const total = await Product.countDocuments({ seller: sellerId });

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
    } catch (error) {
        console.error('Get seller products error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch seller products' });
    }
};
