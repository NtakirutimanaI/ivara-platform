import express from 'express';
import {
    createOrder,
    getBuyerOrders,
    getSellerOrders,
    getOrderById,
    updateOrderStatus,
    cancelOrder,
    getOrderStats
} from '../controllers/order.controller';

const router = express.Router();

// Order routes
router.post('/create', createOrder);
router.get('/buyer/:userId', getBuyerOrders);
router.get('/seller/:userId', getSellerOrders);
router.get('/:orderId', getOrderById);
router.patch('/:orderId/status', updateOrderStatus);
router.put('/:orderId/cancel', cancelOrder);
router.get('/seller/:userId/stats', getOrderStats);

export default router;
