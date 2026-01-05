import { Request, Response } from 'express';
import { Order } from '../models/order.model';
import { Cart } from '../models/cart.model';
import { Product } from '../models/product.model';

// Create order from cart
export const createOrder = async (req: Request, res: Response) => {
    try {
        const { userId, shippingAddress, notes } = req.body;

        // Get user's cart
        const cart = await Cart.findOne({ userId }).populate('items.productId');
        if (!cart || cart.items.length === 0) {
            return res.status(400).json({ success: false, message: 'Cart is empty' });
        }

        // Validate stock for all items
        for (const item of cart.items) {
            const product = await Product.findById(item.productId);
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
        const firstProduct = await Product.findById(cart.items[0].productId);
        const sellerId = firstProduct?.seller;

        // Create order
        const order = new Order({
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

        await order.save();

        // Update product stock
        for (const item of cart.items) {
            await Product.findByIdAndUpdate(
                item.productId,
                { $inc: { stockQuantity: -item.quantity } }
            );
        }

        // Clear cart
        cart.items = [];
        cart.totalAmount = 0;
        await cart.save();

        res.status(201).json({
            success: true,
            message: 'Order placed successfully',
            data: order
        });
    } catch (error: any) {
        console.error('Create order error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to create order',
            error: error.message
        });
    }
};

// Get buyer orders
export const getBuyerOrders = async (req: Request, res: Response) => {
    try {
        const { userId } = req.params;
        const { page = 1, limit = 20 } = req.query;

        const skip = (Number(page) - 1) * Number(limit);

        const orders = await Order.find({ buyerId: userId })
            .populate('sellerId', 'name email phone')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit))
            .lean();

        const total = await Order.countDocuments({ buyerId: userId });

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
    } catch (error) {
        console.error('Get buyer orders error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch orders' });
    }
};

// Get seller orders
export const getSellerOrders = async (req: Request, res: Response) => {
    try {
        const { userId } = req.params;
        const { status, page = 1, limit = 20 } = req.query;

        const filter: any = { sellerId: userId };
        if (status) filter.status = status;

        const skip = (Number(page) - 1) * Number(limit);

        const orders = await Order.find(filter)
            .populate('buyerId', 'name email phone')
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(Number(limit))
            .lean();

        const total = await Order.countDocuments(filter);

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
    } catch (error) {
        console.error('Get seller orders error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch orders' });
    }
};

// Get single order
export const getOrderById = async (req: Request, res: Response) => {
    try {
        const { orderId } = req.params;

        const order = await Order.findById(orderId)
            .populate('buyerId', 'name email phone')
            .populate('sellerId', 'name email phone')
            .lean();

        if (!order) {
            return res.status(404).json({ success: false, message: 'Order not found' });
        }

        res.status(200).json({ success: true, data: order });
    } catch (error) {
        console.error('Get order error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch order' });
    }
};

// Update order status (seller only)
export const updateOrderStatus = async (req: Request, res: Response) => {
    try {
        const { orderId } = req.params;
        const { status } = req.body;

        const validStatuses = ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        if (!validStatuses.includes(status)) {
            return res.status(400).json({ success: false, message: 'Invalid status' });
        }

        const order = await Order.findByIdAndUpdate(
            orderId,
            { status },
            { new: true }
        );

        if (!order) {
            return res.status(404).json({ success: false, message: 'Order not found' });
        }

        res.status(200).json({
            success: true,
            message: 'Order status updated successfully',
            data: order
        });
    } catch (error) {
        console.error('Update order status error:', error);
        res.status(500).json({ success: false, message: 'Failed to update order status' });
    }
};

// Cancel order
export const cancelOrder = async (req: Request, res: Response) => {
    try {
        const { orderId } = req.params;

        const order = await Order.findById(orderId);
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
            await Product.findByIdAndUpdate(
                item.productId,
                { $inc: { stockQuantity: item.quantity } }
            );
        }

        order.status = 'Cancelled';
        await order.save();

        res.status(200).json({
            success: true,
            message: 'Order cancelled successfully',
            data: order
        });
    } catch (error) {
        console.error('Cancel order error:', error);
        res.status(500).json({ success: false, message: 'Failed to cancel order' });
    }
};

// Get order statistics (for sellers)
export const getOrderStats = async (req: Request, res: Response) => {
    try {
        const { userId } = req.params;

        const stats = await Order.aggregate([
            { $match: { sellerId: userId } },
            {
                $group: {
                    _id: '$status',
                    count: { $sum: 1 },
                    totalAmount: { $sum: '$totalAmount' }
                }
            }
        ]);

        const totalOrders = await Order.countDocuments({ sellerId: userId });
        const totalRevenue = await Order.aggregate([
            { $match: { sellerId: userId, status: { $in: ['Delivered', 'Processing', 'Shipped'] } } },
            { $group: { _id: null, total: { $sum: '$totalAmount' } } }
        ]);

        res.status(200).json({
            success: true,
            data: {
                totalOrders,
                totalRevenue: totalRevenue[0]?.total || 0,
                byStatus: stats
            }
        });
    } catch (error) {
        console.error('Get order stats error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch statistics' });
    }
};
