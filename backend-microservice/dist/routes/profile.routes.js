"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const jwt_1 = require("../middleware/jwt");
const upload_1 = require("../middleware/upload");
const profile_controller_1 = require("../controllers/profile.controller");
const router = (0, express_1.Router)();
// Get profile
router.get('/', jwt_1.verifyJwt, profile_controller_1.getProfile);
// Update profile (with photo upload)
router.patch('/', jwt_1.verifyJwt, upload_1.upload.single('profilePhoto'), profile_controller_1.updateProfile);
// Change password
router.put('/password', jwt_1.verifyJwt, profile_controller_1.changePassword);
// Delete account
router.delete('/', jwt_1.verifyJwt, profile_controller_1.deleteAccount);
exports.default = router;
