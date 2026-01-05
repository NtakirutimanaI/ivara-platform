import express from 'express';
import {
    getUserCart,
    addToCart,
    updateCartItem,
    removeFromCart,
    clearCart
} from '../controllers/cart.controller';

const router = express.Router();

// Cart routes
router.get('/:userId', getUserCart);
router.post('/add', addToCart);
router.put('/update', updateCartItem);
router.delete('/remove/:userId/:itemId', removeFromCart);
router.delete('/clear/:userId', clearCart);

export default router;
