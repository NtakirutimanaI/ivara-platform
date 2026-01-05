import { Response } from 'express';
import { AuthRequest } from '../middleware/authorize';
import NotificationService from '../services/notification.service';

/**
 * Get user notifications
 */
export const getNotifications = async (req: AuthRequest, res: Response) => {
    try {
        const userId = req.user?.id;
        if (!userId) {
            return res.status(401).json({ message: 'Unauthorized' });
        }

        const { isRead, type, limit, skip } = req.query;

        const notifications = await NotificationService.getUserNotifications(userId, {
            isRead: isRead === 'true' ? true : isRead === 'false' ? false : undefined,
            type: type as string,
            limit: limit ? parseInt(limit as string) : undefined,
            skip: skip ? parseInt(skip as string) : undefined,
        });

        const unreadCount = await NotificationService.getUnreadCount(userId);

        res.status(200).json({
            notifications,
            unreadCount,
            total: notifications.length,
        });
    } catch (error) {
        res.status(500).json({ message: 'Error fetching notifications', error });
    }
};

/**
 * Get unread notification count
 */
export const getUnreadCount = async (req: AuthRequest, res: Response) => {
    try {
        const userId = req.user?.id;
        if (!userId) {
            return res.status(401).json({ message: 'Unauthorized' });
        }

        const count = await NotificationService.getUnreadCount(userId);

        res.status(200).json({ unreadCount: count });
    } catch (error) {
        res.status(500).json({ message: 'Error fetching unread count', error });
    }
};

/**
 * Mark notification as read
 */
export const markAsRead = async (req: AuthRequest, res: Response) => {
    try {
        const { id } = req.params;

        const notification = await NotificationService.markAsRead(id);

        if (!notification) {
            return res.status(404).json({ message: 'Notification not found' });
        }

        res.status(200).json({ message: 'Notification marked as read', notification });
    } catch (error) {
        res.status(500).json({ message: 'Error marking notification as read', error });
    }
};

/**
 * Mark all notifications as read
 */
export const markAllAsRead = async (req: AuthRequest, res: Response) => {
    try {
        const userId = req.user?.id;
        if (!userId) {
            return res.status(401).json({ message: 'Unauthorized' });
        }

        await NotificationService.markAllAsRead(userId);

        res.status(200).json({ message: 'All notifications marked as read' });
    } catch (error) {
        res.status(500).json({ message: 'Error marking all as read', error });
    }
};

/**
 * Delete notification
 */
export const deleteNotification = async (req: AuthRequest, res: Response) => {
    try {
        const { id } = req.params;

        await NotificationService.deleteNotification(id);

        res.status(200).json({ message: 'Notification deleted successfully' });
    } catch (error) {
        res.status(500).json({ message: 'Error deleting notification', error });
    }
};

/**
 * Create notification (Admin only)
 */
export const createNotification = async (req: AuthRequest, res: Response) => {
    try {
        const { userId, title, message, type, priority, relatedEntity } = req.body;

        if (!userId || !title || !message || !type) {
            return res.status(400).json({ message: 'Missing required fields' });
        }

        const notification = await NotificationService.createNotification(userId, {
            title,
            message,
            type,
            priority,
            actionBy: req.user?.id,
            relatedEntity,
        });

        res.status(201).json({ message: 'Notification created', notification });
    } catch (error) {
        res.status(500).json({ message: 'Error creating notification', error });
    }
};
