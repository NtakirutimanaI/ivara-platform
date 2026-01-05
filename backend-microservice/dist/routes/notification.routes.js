"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const notification_controller_1 = require("../controllers/notification.controller");
const authorize_1 = require("../middleware/authorize");
const router = express_1.default.Router();
// All routes require authentication
router.use(authorize_1.verifyToken);
// Get user notifications
router.get('/', notification_controller_1.getNotifications);
// Get unread count
router.get('/unread-count', notification_controller_1.getUnreadCount);
// Mark notification as read
router.patch('/:id/read', notification_controller_1.markAsRead);
// Mark all as read
router.patch('/mark-all-read', notification_controller_1.markAllAsRead);
// Delete notification
router.delete('/:id', notification_controller_1.deleteNotification);
// Create notification (Admin only)
router.post('/', (0, authorize_1.restrictTo)('super_admin', 'admin'), notification_controller_1.createNotification);
exports.default = router;
