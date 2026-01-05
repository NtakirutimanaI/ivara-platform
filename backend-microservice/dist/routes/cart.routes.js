"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const cart_controller_1 = require("../controllers/cart.controller");
const router = express_1.default.Router();
// Cart routes
router.get('/:userId', cart_controller_1.getUserCart);
router.post('/add', cart_controller_1.addToCart);
router.put('/update', cart_controller_1.updateCartItem);
router.delete('/remove/:userId/:itemId', cart_controller_1.removeFromCart);
router.delete('/clear/:userId', cart_controller_1.clearCart);
exports.default = router;
