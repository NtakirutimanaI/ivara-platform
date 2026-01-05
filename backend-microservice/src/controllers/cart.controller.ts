import { Request, Response } from 'express';
import { Cart } from '../models/cart.model';
import { Product } from '../models/product.model';

// Get user cart
export const getUserCart = async (req: Request, res: Response) => {
    try {
        const { userId } = req.params;
        console.log('Fetching cart for userId:', userId);

        let cart = await Cart.findOne({ userId }).populate('items.productId', 'name images price stockQuantity').lean();

        if (!cart) {
            console.log('No cart found for userId:', userId, '- Creating empty cart');
            // Create empty cart if doesn't exist
            const newCart = new Cart({ userId, items: [], totalAmount: 0 });
            await newCart.save();
            cart = newCart.toObject() as any;
        }

        res.status(200).json({ success: true, data: cart });
    } catch (error) {
        console.error('Get cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to fetch cart' });
    }
};

// Add item to cart
export const addToCart = async (req: Request, res: Response) => {
    try {
        const { userId, productId, quantity = 1, variant = {} } = req.body;
        console.log('Adding to cart - userId:', userId, 'productId:', productId);

        // Check product exists and is available
        const product = await Product.findById(productId);
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

        let cart = await Cart.findOne({ userId });

        if (!cart) {
            cart = new Cart({ userId, items: [] });
        }

        // Check if item already exists in cart
        const existingItemIndex = cart.items.findIndex(
            item => item.productId.toString() === productId &&
                JSON.stringify(item.variant) === JSON.stringify(variant)
        );

        if (existingItemIndex > -1) {
            // Update quantity
            cart.items[existingItemIndex].quantity += quantity;
            cart.items[existingItemIndex].subtotal =
                cart.items[existingItemIndex].quantity * product.price;
        } else {
            // Add new item
            cart.items.push({
                productId: product._id,
                productName: product.name,
                productImage: product.images[0] || '',
                quantity,
                variant,
                price: product.price,
                subtotal: product.price * quantity
            } as any);
        }

        await cart.save();

        res.status(200).json({
            success: true,
            message: 'Item added to cart successfully',
            data: cart
        });
    } catch (error: any) {
        console.error('Add to cart error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to add item to cart',
            error: error.message
        });
    }
};

// Update cart item quantity
export const updateCartItem = async (req: Request, res: Response) => {
    try {
        const { userId, itemId, quantity } = req.body;

        if (quantity < 1) {
            return res.status(400).json({ success: false, message: 'Quantity must be at least 1' });
        }

        const cart = await Cart.findOne({ userId });
        if (!cart) {
            return res.status(404).json({ success: false, message: 'Cart not found' });
        }

        const itemIndex = cart.items.findIndex((item: any) => item._id && item._id.toString() === itemId);
        if (itemIndex === -1) {
            return res.status(404).json({ success: false, message: 'Item not found in cart' });
        }

        // Check stock availability
        const product = await Product.findById(cart.items[itemIndex].productId);
        if (product && product.stockQuantity < quantity) {
            return res.status(400).json({
                success: false,
                message: `Only ${product.stockQuantity} items available in stock`
            });
        }

        cart.items[itemIndex].quantity = quantity;
        cart.items[itemIndex].subtotal = cart.items[itemIndex].price * quantity;

        await cart.save();

        res.status(200).json({
            success: true,
            message: 'Cart updated successfully',
            data: cart
        });
    } catch (error) {
        console.error('Update cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to update cart' });
    }
};

// Remove item from cart
export const removeFromCart = async (req: Request, res: Response) => {
    try {
        const { userId, itemId } = req.params;

        const cart = await Cart.findOne({ userId });
        if (!cart) {
            return res.status(404).json({ success: false, message: 'Cart not found' });
        }

        cart.items = cart.items.filter((item: any) => !item._id || item._id.toString() !== itemId);
        await cart.save();

        res.status(200).json({
            success: true,
            message: 'Item removed from cart',
            data: cart
        });
    } catch (error) {
        console.error('Remove from cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to remove item' });
    }
};

// Clear cart
export const clearCart = async (req: Request, res: Response) => {
    try {
        const { userId } = req.params;

        const cart = await Cart.findOne({ userId });
        if (!cart) {
            return res.status(404).json({ success: false, message: 'Cart not found' });
        }

        cart.items = [];
        cart.totalAmount = 0;
        await cart.save();

        res.status(200).json({
            success: true,
            message: 'Cart cleared successfully',
            data: cart
        });
    } catch (error) {
        console.error('Clear cart error:', error);
        res.status(500).json({ success: false, message: 'Failed to clear cart' });
    }
};
