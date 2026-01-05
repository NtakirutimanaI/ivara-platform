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
exports.getOrderStats = exports.cancelOrder = exports.updateOrderStatus = exports.getOrderById = exports.getSellerOrders = exports.getBuyerOrders = exports.createOrder = void 0;
const order_model_1 = require("../models/order.model");
const cart_model_1 = require("../models/cart.model");
const product_model_1 = require("../models/product.model");
// Create order from cart
const createOrder = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId, shippingAddress, notes } = req.body;
        // Get user's cart
        const cart = yield cart_model_1.Cart.findOne({ userId }).populate('items.productId');
        if (!cart || cart.items.length === 0) {
            return res.status(400).json({ success: false, message: 'Cart is empty' });
        }
        // Validate stock for all items
        for (const item of cart.items) {
            const product = yield product_model_1.Product.findById(item.productId);
            if (!product) {
                return res.status(400).json({
                    success: false,
                    message: `Product ${item.productName} no longer exists`
                });
            }
            if (product.stockQuantity < item.quantity) {
                return res.status(400).json({
                    success: false,
                    message: `Insufficient stock for ${product.name}. Only ${product.stockQuantity} available`
                });
            }
        }
        // Get seller ID from first product
        const firstProduct = yield product_model_1.Product.findById(cart.items[0].productId);
        const sellerId = firstProduct === null || firstProduct === void 0 ? void 0 : firstProduct.seller;
        // Create order
        const order = new order_model_1.Order({
            buyerId: userId,
            sellerId,
            items: cart.items,
            totalAmount: cart.totalAmount,
            currency: 'FRW',
            shippingAddress,
            notes,
            status: 'Pending',
            paymentStatus: 'Pending'
        });
        yield order.save();
        // Update product stock
        for (const item of cart.items) {
            yield product_model_1.Product.findByIdAndUpdate(item.productId, { $inc: { stockQuantity: -item.quantity } });
        }
        // Clear cart
        cart.items = [];
        cart.totalAmount = 0;
        yield cart.save();
        res.status(201).json({
            success: true,
            message: 'Order placed successfully',
            data: order
        });
    }
    catch (error) {
        console.error('Create order error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to create order',
            error: error.message
        });
    }
});
exports.createOrder = createOrder;
// Get buyer orders
const getBuyerOrders = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId } = req.params;
        const { page = 1, limit = 20 } = req.query;
        const skip = (Number(page) - 1) * Number(limit);
        const orders = yield order_model_1.Order.find({ buyerId: userId })
            .populate('sellerId', 'name email phone')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit));
        const total = yield order_model_1.Order.countDocuments({ buyerId: userId });
        res.status(200).json({
            success: true,
            data: orders,
            pagination: {
                total,
                page: Number(page),
                limit: Number(limit),
                pages: Math.ceil(total / Number(limit))
            }
        });
    }
    catch (error) {
        console.error('Get buyer orders error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch orders' });
    }
});
exports.getBuyerOrders = getBuyerOrders;
// Get seller orders
const getSellerOrders = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { userId } = req.params;
        const { status, page = 1, limit = 20 } = req.query;
        const filter = { sellerId: userId };
        if (status)
            filter.status = status;
        const skip = (Number(page) - 1) * Number(limit);
        const orders = yield order_model_1.Order.find(filter)
            .populate('buyerId', 'name email phone')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit));
        const total = yield order_model_1.Order.countDocuments(filter);
        res.status(200).json({
            success: true,
            data: orders,
            pagination: {
                total,
                page: Number(page),
                limit: Number(limit),
                pages: Math.ceil(total / Number(limit))
            }
        });
    }
    catch (error) {
        console.error('Get seller orders error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch orders' });
    }
});
exports.getSellerOrders = getSellerOrders;
// Get single order
const getOrderById = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { orderId } = req.params;
        const order = yield order_model_1.Order.findById(orderId)
            .populate('buyerId', 'name email phone')
            .populate('sellerId', 'name email phone');
        if (!order) {
            return res.status(404).json({ success: false, message: 'Order not found' });
        }
        res.status(200).json({ success: true, data: order });
    }
    catch (error) {
        console.error('Get order error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch order' });
    }
});
exports.getOrderById = getOrderById;
// Update order status (seller only)
const updateOrderStatus = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { orderId } = req.params;
        const { status } = req.body;
        const validStatuses = ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        if (!validStatuses.includes(status)) {
            return res.status(400).json({ success: false, message: 'Invalid status' });
        }
        const order = yield order_model_1.Order.findByIdAndUpdate(orderId, { status }, { new: true });
        if (!order) {
            return res.status(404).json({ success: false, message: 'Order not found' });
        }
        res.status(200).json({
            success: true,
            message: 'Order status updated successfully',
            data: order
        });
    }
    catch (error) {
        console.error('Update order status error:', error);
        res.status(500).json({ success: false, message: 'Failed to update order status' });
    }
});
exports.updateOrderStatus = updateOrderStatus;
// Cancel order
const cancelOrder = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { orderId } = req.params;
        const order = yield order_model_1.Order.findById(orderId);
        if (!order) {
            return res.status(404).json({ success: false, message: 'Order not found' });
        }
        if (order.status !== 'Pending') {
            return res.status(400).json({
                success: false,
                message: 'Only pending orders can be cancelled'
            });
        }
        // Restore stock
        for (const item of order.items) {
            yield product_model_1.Product.findByIdAndUpdate(item.productId, { $inc: { stockQuantity: item.quantity } });
        }
        order.status = 'Cancelled';
        yield order.save();
        res.status(200).json({
            success: true,
            message: 'Order cancelled successfully',
            data: order
        });
    }
    catch (error) {
        console.error('Cancel order error:', error);
        res.status(500).json({ success: false, message: 'Failed to cancel order' });
    }
});
exports.cancelOrder = cancelOrder;
// Get order statistics (for sellers)
const getOrderStats = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        const { userId } = req.params;
        const stats = yield order_model_1.Order.aggregate([
            { $match: { sellerId: userId } },
            {
                $group: {
                    _id: '$status',
                    count: { $sum: 1 },
                    totalAmount: { $sum: '$totalAmount' }
                }
            }
        ]);
        const totalOrders = yield order_model_1.Order.countDocuments({ sellerId: userId });
        const totalRevenue = yield order_model_1.Order.aggregate([
            { $match: { sellerId: userId, status: { $in: ['Delivered', 'Processing', 'Shipped'] } } },
            { $group: { _id: null, total: { $sum: '$totalAmount' } } }
        ]);
        res.status(200).json({
            success: true,
            data: {
                totalOrders,
                totalRevenue: ((_a = totalRevenue[0]) === null || _a === void 0 ? void 0 : _a.total) || 0,
                byStatus: stats
            }
        });
    }
    catch (error) {
        console.error('Get order stats error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch statistics' });
    }
});
exports.getOrderStats = getOrderStats;
