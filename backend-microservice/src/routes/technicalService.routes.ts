import { Router } from 'express';
import {
    getAllServices,
    getServiceById,
    createService,
    updateService,
    deleteService
} from '../controllers/technicalService.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

/**
 * @swagger
 * tags:
 *   name: Technical Services
 *   description: Catalog of services for Technical & Repair category
 */

// router.get('/', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getAllServices);
router.get('/', getAllServices);
router.get('/:id', getServiceById);
router.post('/', createService);
router.put('/:id', updateService);
router.delete('/:id', deleteService);

export default router;
