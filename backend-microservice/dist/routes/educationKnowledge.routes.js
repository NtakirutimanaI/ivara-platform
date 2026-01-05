"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// src/routes/technicalRepair.routes.ts
const express_1 = require("express");
const technicalRepair_controller_1 = require("../controllers/technicalRepair.controller");
const technicalDashboard_controller_1 = require("../controllers/technicalDashboard.controller");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const router = (0, express_1.Router)();
// Dashboard Endpoints (Protected by Role)
router.get('/dashboard/builder', jwt_1.verifyJwt, (0, auth_1.authorize)(['builder', 'admin']), technicalDashboard_controller_1.getBuilderDashboard);
router.get('/dashboard/electrician', jwt_1.verifyJwt, (0, auth_1.authorize)(['electrician', 'admin']), technicalDashboard_controller_1.getElectricianDashboard);
router.get('/dashboard/technician', jwt_1.verifyJwt, (0, auth_1.authorize)(['technician', 'admin']), technicalDashboard_controller_1.getTechnicianDashboard);
router.get('/dashboard/mechanic', jwt_1.verifyJwt, (0, auth_1.authorize)(['mechanic', 'admin']), technicalDashboard_controller_1.getMechanicDashboard);
// Standard CRUD
router.get('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), technicalRepair_controller_1.getAllTechnicalRepairs);
router.get('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), technicalRepair_controller_1.getTechnicalRepairById);
router.post('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), technicalRepair_controller_1.createTechnicalRepair);
router.put('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), technicalRepair_controller_1.updateTechnicalRepair);
router.delete('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), technicalRepair_controller_1.deleteTechnicalRepair);
exports.default = router;
