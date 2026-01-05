"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const superAdmin_controller_1 = require("../controllers/superAdmin.controller");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const router = (0, express_1.Router)();
// Only super_admin can access platform-wide overview
router.get('/overview', jwt_1.verifyJwt, (0, auth_1.authorize)(['super_admin']), superAdmin_controller_1.getPlatformOverview);
exports.default = router;
