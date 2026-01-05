import { Router } from 'express';
import { verifyJwt } from '../middleware/jwt';
import { requireRole, rateLimit, securityLogger } from '../middleware/roleGuard';
import {
    getTechnicianDashboard,
    getTechnicianJobs,
    getTechnicianWorkOrders,
    getTechnicianInventory,
    getTechnicianBookings,
    getTechnicianSchedule
} from '../controllers/technician.controller';

const router = Router();

// Apply security middleware to all technician routes
// 1. Rate limiting (100 requests per minute)
// 2. JWT verification (must be logged in)
// 3. Role check (must be technician, admin, or super-admin)
// 4. Security logging

const technicianMiddleware = [
    rateLimit(100, 60000),
    verifyJwt,
    requireRole('technician', 'admin', 'super-admin', 'manager', 'supervisor'),
    securityLogger
];

// Dashboard - main endpoint with all data
router.get('/dashboard', ...technicianMiddleware, getTechnicianDashboard);

// Individual endpoints - all protected
router.get('/jobs', ...technicianMiddleware, getTechnicianJobs);
router.get('/work-orders', ...technicianMiddleware, getTechnicianWorkOrders);
router.get('/inventory', ...technicianMiddleware, getTechnicianInventory);
router.get('/bookings', ...technicianMiddleware, getTechnicianBookings);
router.get('/schedule', ...technicianMiddleware, getTechnicianSchedule);

export default router;
