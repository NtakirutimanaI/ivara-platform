// src/routes/foodEventsFashion.routes.ts
import { Router } from 'express';
import {
    getAll as getAllFEF,
    getById as getFEFById,
    create as createFEF,
    update as updateFEF,
    remove as deleteFEF,
} from '../controllers/foodEventsFashion.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

router.get('/', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getAllFEF);
router.get('/:id', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getFEFById);
router.post('/', verifyJwt, authorize(['admin', 'category_admin']), createFEF);
router.put('/:id', verifyJwt, authorize(['admin', 'category_admin']), updateFEF);
router.delete('/:id', verifyJwt, authorize(['admin']), deleteFEF);

export default router;
