import express from 'express';
import {
    getNotifications,
    getUnreadCount,
    markAsRead,
    markAllAsRead,
    deleteNotification,
    createNotification,
} from '../controllers/notification.controller';
import { verifyToken, authorize, restrictTo } from '../middleware/authorize';

const router = express.Router();

// All routes require authentication
router.use(verifyToken);

// Get user notifications
router.get('/', getNotifications);

// Get unread count
router.get('/unread-count', getUnreadCount);

// Mark notification as read
router.patch('/:id/read', markAsRead);

// Mark all as read
router.patch('/mark-all-read', markAllAsRead);

// Delete notification
router.delete('/:id', deleteNotification);

// Create notification (Admin only)
router.post('/', restrictTo('super_admin', 'admin'), createNotification);

export default router;
