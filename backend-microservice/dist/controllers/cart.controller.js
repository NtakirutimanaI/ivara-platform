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
exports.clearCart = exports.removeFromCart = exports.updateCartItem = exports.addToCart = exports.getUserCart = void 0;
const cart_model_1 = require("../models/cart.model");
const product_model_1 = require("../models/product.model");
// Get user cart
const getUserCart = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId } = req.params;
        let cart = yield cart_model_1.Cart.findOne({ userId }).populate('items.productId', 'name images price stockQuantity');
        if (!cart) {
            // Create empty cart if doesn't exist
            cart = new cart_model_1.Cart({ userId, items: [], totalAmount: 0 });
            yield cart.save();
        }
        res.status(200).json({ success: true, data: cart });
    }
    catch (error) {
        console.error('Get cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch cart' });
    }
});
exports.getUserCart = getUserCart;
// Add item to cart
const addToCart = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId, productId, quantity = 1, variant = {} } = req.body;
        // Check product exists and is available
        const product = yield product_model_1.Product.findById(productId);
        if (!product) {
            return res.status(404).json({ success: false, message: 'Product not found' });
        }
        if (product.status !== 'Active') {
            return res.status(400).json({ success: false, message: 'Product is not available' });
        }
        if (product.stockQuantity < quantity) {
            return res.status(400).json({
                success: false,
                message: `Only ${product.stockQuantity} items available in stock`
            });
        }
        let cart = yield cart_model_1.Cart.findOne({ userId });
        if (!cart) {
            cart = new cart_model_1.Cart({ userId, items: [] });
        }
        // Check if item already exists in cart
        const existingItemIndex = cart.items.findIndex(item => item.productId.toString() === productId &&
            JSON.stringify(item.variant) === JSON.stringify(variant));
        if (existingItemIndex > -1) {
            // Update quantity
            cart.items[existingItemIndex].quantity += quantity;
            cart.items[existingItemIndex].subtotal =
                cart.items[existingItemIndex].quantity * product.price;
        }
        else {
            // Add new item
            cart.items.push({
                productId: product._id,
                productName: product.name,
                productImage: product.images[0] || '',
                quantity,
                variant,
                price: product.price,
                subtotal: product.price * quantity
            });
        }
        yield cart.save();
        res.status(200).json({
            success: true,
            message: 'Item added to cart successfully',
            data: cart
        });
    }
    catch (error) {
        console.error('Add to cart error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to add item to cart',
            error: error.message
        });
    }
});
exports.addToCart = addToCart;
// Update cart item quantity
const updateCartItem = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId, itemId, quantity } = req.body;
        if (quantity < 1) {
            return res.status(400).json({ success: false, message: 'Quantity must be at least 1' });
        }
        const cart = yield cart_model_1.Cart.findOne({ userId });
        if (!cart) {
            return res.status(404).json({ success: false, message: 'Cart not found' });
        }
        const itemIndex = cart.items.findIndex((item) => item._id && item._id.toString() === itemId);
        if (itemIndex === -1) {
            return res.status(404).json({ success: false, message: 'Item not found in cart' });
        }
        // Check stock availability
        const product = yield product_model_1.Product.findById(cart.items[itemIndex].productId);
        if (product && product.stockQuantity < quantity) {
            return res.status(400).json({
                success: false,
                message: `Only ${product.stockQuantity} items available in stock`
            });
        }
        cart.items[itemIndex].quantity = quantity;
        cart.items[itemIndex].subtotal = cart.items[itemIndex].price * quantity;
        yield cart.save();
        res.status(200).json({
            success: true,
            message: 'Cart updated successfully',
            data: cart
        });
    }
    catch (error) {
        console.error('Update cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to update cart' });
    }
});
exports.updateCartItem = updateCartItem;
// Remove item from cart
const removeFromCart = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId, itemId } = req.params;
        const cart = yield cart_model_1.Cart.findOne({ userId });
        if (!cart) {
            return res.status(404).json({ success: false, message: 'Cart not found' });
        }
        cart.items = cart.items.filter((item) => !item._id || item._id.toString() !== itemId);
        yield cart.save();
        res.status(200).json({
            success: true,
            message: 'Item removed from cart',
            data: cart
        });
    }
    catch (error) {
        console.error('Remove from cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to remove item' });
    }
});
exports.removeFromCart = removeFromCart;
// Clear cart
const clearCart = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId } = req.params;
        const cart = yield cart_model_1.Cart.findOne({ userId });
        if (!cart) {
            return res.status(404).json({ success: false, message: 'Cart not found' });
        }
        cart.items = [];
        cart.totalAmount = 0;
        yield cart.save();
        res.status(200).json({
            success: true,
            message: 'Cart cleared successfully',
            data: cart
        });
    }
    catch (error) {
        console.error('Clear cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to clear cart' });
    }
});
exports.clearCart = clearCart;
