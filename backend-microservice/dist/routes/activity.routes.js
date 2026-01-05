"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const activity_controller_1 = require("../controllers/activity.controller");
const jwt_1 = require("../middleware/jwt");
const router = (0, express_1.Router)();
router.get('/', jwt_1.verifyJwt, activity_controller_1.getActivities);
router.post('/', jwt_1.verifyJwt, activity_controller_1.createActivity);
exports.default = router;
