"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const newsletter_controller_1 = require("../controllers/newsletter.controller");
const router = express_1.default.Router();
// Subscribe to newsletter
router.post('/subscribe', newsletter_controller_1.subscribeToNewsletter);
// Unsubscribe from newsletter
router.post('/unsubscribe', newsletter_controller_1.unsubscribeFromNewsletter);
// Get all active subscribers (admin only - add auth middleware if needed)
router.get('/subscribers', newsletter_controller_1.getAllSubscribers);
exports.default = router;
