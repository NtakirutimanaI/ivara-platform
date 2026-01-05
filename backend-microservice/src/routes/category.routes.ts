// src/routes/category.routes.ts
import { Router } from 'express';
import {
    getAllCategories,
    getCategoryById,
    createCategory,
    updateCategory,
    deleteCategory,
} from '../controllers/category.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// Public Routes (View Categories)
router.get('/', getAllCategories);
router.get('/:id', getCategoryById);

// Protected Routes (Admin Only)
router.post('/', verifyJwt, authorize(['admin']), createCategory);
router.put('/:id', verifyJwt, authorize(['admin']), updateCategory);
router.delete('/:id', verifyJwt, authorize(['admin']), deleteCategory);

export default router;
