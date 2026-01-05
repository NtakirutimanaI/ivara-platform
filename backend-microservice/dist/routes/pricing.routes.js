"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const pricing_controller_1 = require("../controllers/pricing.controller");
const router = (0, express_1.Router)();
// Public endpoint to get pricing plans
router.get('/', pricing_controller_1.getPricingPlans);
exports.default = router;
