import express from 'express';
import {
    getAllProducts,
    getProductsByCategory,
    getProductById,
    createProduct,
    updateProduct,
    deleteProduct,
    getSellerProducts
} from '../controllers/product.controller';

const router = express.Router();

// Public routes - IMPORTANT: Specific routes BEFORE generic /:id
router.get('/', getAllProducts);
router.get('/category/:category', getProductsByCategory);
router.get('/seller/:sellerId', getSellerProducts);
router.get('/:id', getProductById);  // This must be LAST among GET routes

// Seller routes (add auth middleware in production)
router.post('/', createProduct);
router.put('/:id', updateProduct);
router.delete('/:id', deleteProduct);

export default router;
