"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const jwt_1 = require("../middleware/jwt");
const roleGuard_1 = require("../middleware/roleGuard");
const technician_controller_1 = require("../controllers/technician.controller");
const router = (0, express_1.Router)();
// Apply security middleware to all technician routes
// 1. Rate limiting (100 requests per minute)
// 2. JWT verification (must be logged in)
// 3. Role check (must be technician, admin, or super-admin)
// 4. Security logging
const technicianMiddleware = [
    (0, roleGuard_1.rateLimit)(100, 60000),
    jwt_1.verifyJwt,
    (0, roleGuard_1.requireRole)('technician', 'admin', 'super-admin', 'manager', 'supervisor'),
    roleGuard_1.securityLogger
];
// Dashboard - main endpoint with all data
router.get('/dashboard', ...technicianMiddleware, technician_controller_1.getTechnicianDashboard);
// Individual endpoints - all protected
router.get('/jobs', ...technicianMiddleware, technician_controller_1.getTechnicianJobs);
router.get('/work-orders', ...technicianMiddleware, technician_controller_1.getTechnicianWorkOrders);
router.get('/inventory', ...technicianMiddleware, technician_controller_1.getTechnicianInventory);
router.get('/bookings', ...technicianMiddleware, technician_controller_1.getTechnicianBookings);
router.get('/schedule', ...technicianMiddleware, technician_controller_1.getTechnicianSchedule);
exports.default = router;
