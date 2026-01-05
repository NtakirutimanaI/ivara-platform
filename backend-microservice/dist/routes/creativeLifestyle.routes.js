"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// src/routes/creativeLifestyle.routes.ts
const express_1 = require("express");
const creativeLifestyle_controller_1 = require("../controllers/creativeLifestyle.controller");
const creativeDashboard_controller_1 = require("../controllers/creativeDashboard.controller");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const router = (0, express_1.Router)();
// Dashboard Endpoints
router.get('/dashboard/gym', jwt_1.verifyJwt, (0, auth_1.authorize)(['gym_trainer', 'admin']), creativeDashboard_controller_1.getGymTrainerDashboard);
router.get('/dashboard/yoga', jwt_1.verifyJwt, (0, auth_1.authorize)(['yoga_trainer', 'admin']), creativeDashboard_controller_1.getYogaTrainerDashboard);
router.get('/dashboard/generic', jwt_1.verifyJwt, (0, auth_1.authorize)(['fitness_coach', 'aerobics_instructor', 'pilates_instructor', 'martial_arts_trainer', 'sports_academy', 'admin']), creativeDashboard_controller_1.getGenericCreativeDashboard);
router.get('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), creativeLifestyle_controller_1.getAll);
router.get('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), creativeLifestyle_controller_1.getById);
router.post('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), creativeLifestyle_controller_1.create);
router.put('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), creativeLifestyle_controller_1.update);
router.delete('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), creativeLifestyle_controller_1.remove);
exports.default = router;
