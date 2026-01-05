"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// src/routes/auth.routes.ts
const express_1 = require("express");
const auth_controller_1 = require("../controllers/auth.controller");
const router = (0, express_1.Router)();
router.post('/register', auth_controller_1.register);
router.post('/login', auth_controller_1.login);
router.get('/users-by-roles', auth_controller_1.getUsersByRoles);
router.get('/users-by-category', auth_controller_1.getUsersByCategory);
router.get('/user/:id', auth_controller_1.getUserById);
exports.default = router;
