import Notification, { INotification } from '../models/notification.model';
import mongoose from 'mongoose';

export interface NotificationData {
    title: string;
    message: string;
    type: 'account_action' | 'booking' | 'payment' | 'system' | 'approval' | 'assignment';
    priority?: 'low' | 'medium' | 'high' | 'urgent';
    actionBy?: string;
    relatedEntity?: {
        type: string;
        id: string;
    };
}

/**
 * Notification Service
 * Handles creation and management of user notifications
 */
class NotificationService {
    /**
     * Create a notification for a single user
     */
    async createNotification(
        userId: string,
        data: NotificationData
    ): Promise<INotification> {
        try {
            const notification = new Notification({
                userId: new mongoose.Types.ObjectId(userId),
                type: data.type,
                title: data.title,
                message: data.message,
                priority: data.priority || 'medium',
                actionBy: data.actionBy ? new mongoose.Types.ObjectId(data.actionBy) : undefined,
                relatedEntity: data.relatedEntity
                    ? {
                        type: data.relatedEntity.type,
                        id: new mongoose.Types.ObjectId(data.relatedEntity.id),
                    }
                    : undefined,
                isRead: false,
            });

            await notification.save();
            return notification;
        } catch (error) {
            console.error('Error creating notification:', error);
            throw error;
        }
    }

    /**
     * Create notifications for multiple users
     */
    async createBulkNotifications(
        userIds: string[],
        data: NotificationData
    ): Promise<INotification[]> {
        try {
            const notifications = userIds.map(
                (userId) =>
                    new Notification({
                        userId: new mongoose.Types.ObjectId(userId),
                        type: data.type,
                        title: data.title,
                        message: data.message,
                        priority: data.priority || 'medium',
                        actionBy: data.actionBy ? new mongoose.Types.ObjectId(data.actionBy) : undefined,
                        relatedEntity: data.relatedEntity
                            ? {
                                type: data.relatedEntity.type,
                                id: new mongoose.Types.ObjectId(data.relatedEntity.id),
                            }
                            : undefined,
                        isRead: false,
                    })
            );

            return await Notification.insertMany(notifications);
        } catch (error) {
            console.error('Error creating bulk notifications:', error);
            throw error;
        }
    }

    /**
     * Notify all users with a specific role
     */
    async notifyRoleUsers(role: string, data: NotificationData): Promise<void> {
        try {
            // This requires a User model with role field
            // For now, we'll leave this as a placeholder
            // In production, you'd query User model: const users = await User.find({ role });
            console.log(`Notifying all users with role: ${role}`);
            // await this.createBulkNotifications(users.map(u => u._id.toString()), data);
        } catch (error) {
            console.error('Error notifying role users:', error);
            throw error;
        }
    }

    /**
     * Notify all admins of a specific category
     */
    async notifyCategoryAdmins(category: string, data: NotificationData): Promise<void> {
        try {
            // Query users with category admin role
            // const admins = await User.find({ role: `${category}_admin` });
            console.log(`Notifying ${category} admins`);
            // await this.createBulkNotifications(admins.map(a => a._id.toString()), data);
        } catch (error) {
            console.error('Error notifying category admins:', error);
            throw error;
        }
    }

    /**
     * Get user notifications with filters
     */
    async getUserNotifications(
        userId: string,
        filters?: {
            isRead?: boolean;
            type?: string;
            limit?: number;
            skip?: number;
        }
    ): Promise<INotification[]> {
        try {
            const query: any = { userId: new mongoose.Types.ObjectId(userId) };

            if (filters?.isRead !== undefined) {
                query.isRead = filters.isRead;
            }

            if (filters?.type) {
                query.type = filters.type;
            }

            return await Notification.find(query)
                .sort({ createdAt: -1 })
                .limit(filters?.limit || 50)
                .skip(filters?.skip || 0)
                .populate('actionBy', 'name email')
                .exec();
        } catch (error) {
            console.error('Error fetching user notifications:', error);
            throw error;
        }
    }

    /**
     * Get unread notification count for a user
     */
    async getUnreadCount(userId: string): Promise<number> {
        try {
            return await Notification.countDocuments({
                userId: new mongoose.Types.ObjectId(userId),
                isRead: false,
            });
        } catch (error) {
            console.error('Error getting unread count:', error);
            throw error;
        }
    }

    /**
     * Mark notification as read
     */
    async markAsRead(notificationId: string): Promise<INotification | null> {
        try {
            return await Notification.findByIdAndUpdate(
                notificationId,
                { isRead: true, readAt: new Date() },
                { new: true }
            );
        } catch (error) {
            console.error('Error marking notification as read:', error);
            throw error;
        }
    }

    /**
     * Mark all user notifications as read
     */
    async markAllAsRead(userId: string): Promise<void> {
        try {
            await Notification.updateMany(
                { userId: new mongoose.Types.ObjectId(userId), isRead: false },
                { isRead: true, readAt: new Date() }
            );
        } catch (error) {
            console.error('Error marking all as read:', error);
            throw error;
        }
    }

    /**
     * Delete a notification
     */
    async deleteNotification(notificationId: string): Promise<void> {
        try {
            await Notification.findByIdAndDelete(notificationId);
        } catch (error) {
            console.error('Error deleting notification:', error);
            throw error;
        }
    }

    /**
     * Delete old read notifications (cleanup)
     */
    async cleanupOldNotifications(daysOld: number = 30): Promise<void> {
        try {
            const cutoffDate = new Date();
            cutoffDate.setDate(cutoffDate.getDate() - daysOld);

            await Notification.deleteMany({
                isRead: true,
                readAt: { $lt: cutoffDate },
            });
        } catch (error) {
            console.error('Error cleaning up old notifications:', error);
            throw error;
        }
    }
}

export default new NotificationService();
