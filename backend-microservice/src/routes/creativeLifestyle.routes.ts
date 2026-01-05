// src/routes/creativeLifestyle.routes.ts
import { Router } from 'express';
import {
    getAll as getAllCL,
    getById as getCLById,
    create as createCL,
    update as updateCL,
    remove as deleteCL,
} from '../controllers/creativeLifestyle.controller';
import {
    getGymTrainerDashboard,
    getYogaTrainerDashboard,
    getGenericCreativeDashboard
} from '../controllers/creativeDashboard.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// Dashboard Endpoints
router.get('/dashboard/gym', verifyJwt, authorize(['gym_trainer', 'admin']), getGymTrainerDashboard);
router.get('/dashboard/yoga', verifyJwt, authorize(['yoga_trainer', 'admin']), getYogaTrainerDashboard);
router.get('/dashboard/generic', verifyJwt, authorize(['fitness_coach', 'aerobics_instructor', 'pilates_instructor', 'martial_arts_trainer', 'sports_academy', 'admin']), getGenericCreativeDashboard);

router.get('/', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getAllCL);
router.get('/:id', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getCLById);
router.post('/', verifyJwt, authorize(['admin', 'category_admin']), createCL);
router.put('/:id', verifyJwt, authorize(['admin', 'category_admin']), updateCL);
router.delete('/:id', verifyJwt, authorize(['admin']), deleteCL);

export default router;
