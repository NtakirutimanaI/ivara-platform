"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// src/routes/foodEventsFashion.routes.ts
const express_1 = require("express");
const foodEventsFashion_controller_1 = require("../controllers/foodEventsFashion.controller");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const router = (0, express_1.Router)();
router.get('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), foodEventsFashion_controller_1.getAll);
router.get('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin', 'provider', 'customer']), foodEventsFashion_controller_1.getById);
router.post('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), foodEventsFashion_controller_1.create);
router.put('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin', 'category_admin']), foodEventsFashion_controller_1.update);
router.delete('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), foodEventsFashion_controller_1.remove);
exports.default = router;
