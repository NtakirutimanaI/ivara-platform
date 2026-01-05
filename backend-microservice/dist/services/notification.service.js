"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const notification_model_1 = __importDefault(require("../models/notification.model"));
const mongoose_1 = __importDefault(require("mongoose"));
/**
 * Notification Service
 * Handles creation and management of user notifications
 */
class NotificationService {
    /**
     * Create a notification for a single user
     */
    createNotification(userId, data) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const notification = new notification_model_1.default({
                    userId: new mongoose_1.default.Types.ObjectId(userId),
                    type: data.type,
                    title: data.title,
                    message: data.message,
                    priority: data.priority || 'medium',
                    actionBy: data.actionBy ? new mongoose_1.default.Types.ObjectId(data.actionBy) : undefined,
                    relatedEntity: data.relatedEntity
                        ? {
                            type: data.relatedEntity.type,
                            id: new mongoose_1.default.Types.ObjectId(data.relatedEntity.id),
                        }
                        : undefined,
                    isRead: false,
                });
                yield notification.save();
                return notification;
            }
            catch (error) {
                console.error('Error creating notification:', error);
                throw error;
            }
        });
    }
    /**
     * Create notifications for multiple users
     */
    createBulkNotifications(userIds, data) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const notifications = userIds.map((userId) => new notification_model_1.default({
                    userId: new mongoose_1.default.Types.ObjectId(userId),
                    type: data.type,
                    title: data.title,
                    message: data.message,
                    priority: data.priority || 'medium',
                    actionBy: data.actionBy ? new mongoose_1.default.Types.ObjectId(data.actionBy) : undefined,
                    relatedEntity: data.relatedEntity
                        ? {
                            type: data.relatedEntity.type,
                            id: new mongoose_1.default.Types.ObjectId(data.relatedEntity.id),
                        }
                        : undefined,
                    isRead: false,
                }));
                return yield notification_model_1.default.insertMany(notifications);
            }
            catch (error) {
                console.error('Error creating bulk notifications:', error);
                throw error;
            }
        });
    }
    /**
     * Notify all users with a specific role
     */
    notifyRoleUsers(role, data) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                // This requires a User model with role field
                // For now, we'll leave this as a placeholder
                // In production, you'd query User model: const users = await User.find({ role });
                console.log(`Notifying all users with role: ${role}`);
                // await this.createBulkNotifications(users.map(u => u._id.toString()), data);
            }
            catch (error) {
                console.error('Error notifying role users:', error);
                throw error;
            }
        });
    }
    /**
     * Notify all admins of a specific category
     */
    notifyCategoryAdmins(category, data) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                // Query users with category admin role
                // const admins = await User.find({ role: `${category}_admin` });
                console.log(`Notifying ${category} admins`);
                // await this.createBulkNotifications(admins.map(a => a._id.toString()), data);
            }
            catch (error) {
                console.error('Error notifying category admins:', error);
                throw error;
            }
        });
    }
    /**
     * Get user notifications with filters
     */
    getUserNotifications(userId, filters) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const query = { userId: new mongoose_1.default.Types.ObjectId(userId) };
                if ((filters === null || filters === void 0 ? void 0 : filters.isRead) !== undefined) {
                    query.isRead = filters.isRead;
                }
                if (filters === null || filters === void 0 ? void 0 : filters.type) {
                    query.type = filters.type;
                }
                return yield notification_model_1.default.find(query)
                    .sort({ createdAt: -1 })
                    .limit((filters === null || filters === void 0 ? void 0 : filters.limit) || 50)
                    .skip((filters === null || filters === void 0 ? void 0 : filters.skip) || 0)
                    .populate('actionBy', 'name email')
                    .exec();
            }
            catch (error) {
                console.error('Error fetching user notifications:', error);
                throw error;
            }
        });
    }
    /**
     * Get unread notification count for a user
     */
    getUnreadCount(userId) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                return yield notification_model_1.default.countDocuments({
                    userId: new mongoose_1.default.Types.ObjectId(userId),
                    isRead: false,
                });
            }
            catch (error) {
                console.error('Error getting unread count:', error);
                throw error;
            }
        });
    }
    /**
     * Mark notification as read
     */
    markAsRead(notificationId) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                return yield notification_model_1.default.findByIdAndUpdate(notificationId, { isRead: true, readAt: new Date() }, { new: true });
            }
            catch (error) {
                console.error('Error marking notification as read:', error);
                throw error;
            }
        });
    }
    /**
     * Mark all user notifications as read
     */
    markAllAsRead(userId) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                yield notification_model_1.default.updateMany({ userId: new mongoose_1.default.Types.ObjectId(userId), isRead: false }, { isRead: true, readAt: new Date() });
            }
            catch (error) {
                console.error('Error marking all as read:', error);
                throw error;
            }
        });
    }
    /**
     * Delete a notification
     */
    deleteNotification(notificationId) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                yield notification_model_1.default.findByIdAndDelete(notificationId);
            }
            catch (error) {
                console.error('Error deleting notification:', error);
                throw error;
            }
        });
    }
    /**
     * Delete old read notifications (cleanup)
     */
    cleanupOldNotifications() {
        return __awaiter(this, arguments, void 0, function* (daysOld = 30) {
            try {
                const cutoffDate = new Date();
                cutoffDate.setDate(cutoffDate.getDate() - daysOld);
                yield notification_model_1.default.deleteMany({
                    isRead: true,
                    readAt: { $lt: cutoffDate },
                });
            }
            catch (error) {
                console.error('Error cleaning up old notifications:', error);
                throw error;
            }
        });
    }
}
exports.default = new NotificationService();
