// src/routes/technicalRepair.routes.ts
import { Router } from 'express';
import {
    getAllTechnicalRepairs,
    getTechnicalRepairById,
    createTechnicalRepair,
    updateTechnicalRepair,
    deleteTechnicalRepair,
} from '../controllers/technicalRepair.controller';
import {
    getBuilderDashboard,
    getElectricianDashboard,
    getTechnicianDashboard,
    getMechanicDashboard
} from '../controllers/technicalDashboard.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// Dashboard Endpoints (Protected by Role)
router.get('/dashboard/builder', verifyJwt, authorize(['builder', 'admin']), getBuilderDashboard);
router.get('/dashboard/electrician', verifyJwt, authorize(['electrician', 'admin']), getElectricianDashboard);
router.get('/dashboard/technician', verifyJwt, authorize(['technician', 'admin']), getTechnicianDashboard);
router.get('/dashboard/mechanic', verifyJwt, authorize(['mechanic', 'admin']), getMechanicDashboard);

// Standard CRUD
router.get('/', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getAllTechnicalRepairs);
router.get('/:id', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getTechnicalRepairById);
router.post('/', verifyJwt, authorize(['admin', 'category_admin']), createTechnicalRepair);
router.put('/:id', verifyJwt, authorize(['admin', 'category_admin']), updateTechnicalRepair);
router.delete('/:id', verifyJwt, authorize(['admin']), deleteTechnicalRepair);

export default router;
