"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const setting_controller_1 = require("../controllers/setting.controller");
const router = (0, express_1.Router)();
// Public read or protected read? Usually admin settings are protected.
// Assuming mobile app needs to read some config, maybe public/semi-public.
// But writing definitely needs admin.
router.get('/', jwt_1.verifyJwt, setting_controller_1.getSettings);
router.post('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), setting_controller_1.updateSettings);
router.put('/', jwt_1.verifyJwt, (0, auth_1.authorize)(['admin']), setting_controller_1.updateSettings); // Alias
exports.default = router;
