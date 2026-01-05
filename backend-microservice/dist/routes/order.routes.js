"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const order_controller_1 = require("../controllers/order.controller");
const router = express_1.default.Router();
// Order routes
router.post('/create', order_controller_1.createOrder);
router.get('/buyer/:userId', order_controller_1.getBuyerOrders);
router.get('/seller/:userId', order_controller_1.getSellerOrders);
router.get('/:orderId', order_controller_1.getOrderById);
router.put('/:orderId/status', order_controller_1.updateOrderStatus);
router.put('/:orderId/cancel', order_controller_1.cancelOrder);
router.get('/seller/:userId/stats', order_controller_1.getOrderStats);
exports.default = router;
