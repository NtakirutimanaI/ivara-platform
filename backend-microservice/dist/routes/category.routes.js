"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// src/routes/category.routes.ts
const express_1 = require("express");
const category_controller_1 = require("../controllers/category.controller");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const router = (0, express_1.Router)();
// Public Routes (View Categories)
router.get('/', category_controller_1.getAllCategories);
router.get('/:id', category_controller_1.getCategoryById);
// Protected Routes (Admin Only)
router.post('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), category_controller_1.createCategory);
router.put('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), category_controller_1.updateCategory);
router.delete('/:id', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), category_controller_1.deleteCategory);
exports.default = router;
