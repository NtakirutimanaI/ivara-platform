// src/routes/transportTravel.routes.ts
import { Router } from 'express';
import {
    getAll as getAllTT,
    getById as getTTById,
    create as createTT,
    update as updateTT,
    remove as deleteTT,
} from '../controllers/transportTravel.controller';
import {
    getTaxiDriverDashboard,
    getMotorcycleTaxiDashboard,
    getBusDriverDashboard,
    getTourDriverDashboard,
    getDeliveryDriverDashboard,
    getSpecialTransportDashboard
} from '../controllers/transportDashboard.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// Dashboard Endpoints
router.get('/dashboard/taxi', verifyJwt, authorize(['taxi_driver', 'admin']), getTaxiDriverDashboard);
router.get('/dashboard/moto', verifyJwt, authorize(['motorcycle_taxi', 'admin']), getMotorcycleTaxiDashboard);
router.get('/dashboard/bus', verifyJwt, authorize(['bus_driver', 'admin']), getBusDriverDashboard);
router.get('/dashboard/tour', verifyJwt, authorize(['tour_driver', 'admin']), getTourDriverDashboard);
router.get('/dashboard/delivery', verifyJwt, authorize(['delivery_driver', 'admin']), getDeliveryDriverDashboard);
router.get('/dashboard/special', verifyJwt, authorize(['special_transport', 'admin']), getSpecialTransportDashboard);

router.get('/', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getAllTT);
router.get('/:id', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getTTById);
router.post('/', verifyJwt, authorize(['admin', 'category_admin']), createTT);
router.put('/:id', verifyJwt, authorize(['admin', 'category_admin']), updateTT);
router.delete('/:id', verifyJwt, authorize(['admin']), deleteTT);

export default router;
