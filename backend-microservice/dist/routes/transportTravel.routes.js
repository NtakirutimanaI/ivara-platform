"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// src/routes/transportTravel.routes.ts
const express_1 = require("express");
const transportTravel_controller_1 = require("../controllers/transportTravel.controller");
const transportDashboard_controller_1 = require("../controllers/transportDashboard.controller");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const router = (0, express_1.Router)();
// Dashboard Endpoints
router.get('/dashboard/taxi', jwt_1.verifyJwt, (0, auth_1.authorize)(['taxi_driver', 'admin']), transportDashboard_controller_1.getTaxiDriverDashboard);
router.get('/dashboard/moto', jwt_1.verifyJwt, (0, auth_1.authorize)(['motorcycle_taxi', 'admin']), transportDashboard_controller_1.getMotorcycleTaxiDashboard);
router.get('/dashboard/bus', jwt_1.verifyJwt, (0, auth_1.authorize)(['bus_driver', 'admin']), transportDashboard_controller_1.getBusDriverDashboard);
router.get('/dashboard/tour', jwt_1.verifyJwt, (0, auth_1.authorize)(['tour_driver', 'admin']), transportDashboard_controller_1.getTourDriverDashboard);
router.get('/dashboard/delivery', jwt_1.verifyJwt, (0, auth_1.authorize)(['delivery_driver', 'admin']), transportDashboard_controller_1.getDeliveryDriverDashboard);
router.get('/dashboard/special', jwt_1.verifyJwt, (0, auth_1.authorize)(['special_transport', 'admin']), transportDashboard_controller_1.getSpecialTransportDashboard);
router.get('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), transportTravel_controller_1.getAll);
router.get('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), transportTravel_controller_1.getById);
router.post('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), transportTravel_controller_1.create);
router.put('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), transportTravel_controller_1.update);
router.delete('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), transportTravel_controller_1.remove);
exports.default = router;
