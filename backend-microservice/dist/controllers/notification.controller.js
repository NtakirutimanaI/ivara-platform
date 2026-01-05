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
exports.createNotification = exports.deleteNotification = exports.markAllAsRead = exports.markAsRead = exports.getUnreadCount = exports.getNotifications = void 0;
const notification_service_1 = __importDefault(require("../services/notification.service"));
/**
 * Get user notifications
 */
const getNotifications = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        const userId = (_a = req.user) === null || _a === void 0 ? void 0 : _a.id;
        if (!userId) {
            return res.status(401).json({ message: 'Unauthorized' });
        }
        const { isRead, type, limit, skip } = req.query;
        const notifications = yield notification_service_1.default.getUserNotifications(userId, {
            isRead: isRead === 'true' ? true : isRead === 'false' ? false : undefined,
            type: type,
            limit: limit ? parseInt(limit) : undefined,
            skip: skip ? parseInt(skip) : undefined,
        });
        const unreadCount = yield notification_service_1.default.getUnreadCount(userId);
        res.status(200).json({
            notifications,
            unreadCount,
            total: notifications.length,
        });
    }
    catch (error) {
        res.status(500).json({ message: 'Error fetching notifications', error });
    }
});
exports.getNotifications = getNotifications;
/**
 * Get unread notification count
 */
const getUnreadCount = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        const userId = (_a = req.user) === null || _a === void 0 ? void 0 : _a.id;
        if (!userId) {
            return res.status(401).json({ message: 'Unauthorized' });
        }
        const count = yield notification_service_1.default.getUnreadCount(userId);
        res.status(200).json({ unreadCount: count });
    }
    catch (error) {
        res.status(500).json({ message: 'Error fetching unread count', error });
    }
});
exports.getUnreadCount = getUnreadCount;
/**
 * Mark notification as read
 */
const markAsRead = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const notification = yield notification_service_1.default.markAsRead(id);
        if (!notification) {
            return res.status(404).json({ message: 'Notification not found' });
        }
        res.status(200).json({ message: 'Notification marked as read', notification });
    }
    catch (error) {
        res.status(500).json({ message: 'Error marking notification as read', error });
    }
});
exports.markAsRead = markAsRead;
/**
 * Mark all notifications as read
 */
const markAllAsRead = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        const userId = (_a = req.user) === null || _a === void 0 ? void 0 : _a.id;
        if (!userId) {
            return res.status(401).json({ message: 'Unauthorized' });
        }
        yield notification_service_1.default.markAllAsRead(userId);
        res.status(200).json({ message: 'All notifications marked as read' });
    }
    catch (error) {
        res.status(500).json({ message: 'Error marking all as read', error });
    }
});
exports.markAllAsRead = markAllAsRead;
/**
 * Delete notification
 */
const deleteNotification = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        yield notification_service_1.default.deleteNotification(id);
        res.status(200).json({ message: 'Notification deleted successfully' });
    }
    catch (error) {
        res.status(500).json({ message: 'Error deleting notification', error });
    }
});
exports.deleteNotification = deleteNotification;
/**
 * Create notification (Admin only)
 */
const createNotification = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        const { userId, title, message, type, priority, relatedEntity } = req.body;
        if (!userId || !title || !message || !type) {
            return res.status(400).json({ message: 'Missing required fields' });
        }
        const notification = yield notification_service_1.default.createNotification(userId, {
            title,
            message,
            type,
            priority,
            actionBy: (_a = req.user) === null || _a === void 0 ? void 0 : _a.id,
            relatedEntity,
        });
        res.status(201).json({ message: 'Notification created', notification });
    }
    catch (error) {
        res.status(500).json({ message: 'Error creating notification', error });
    }
});
exports.createNotification = createNotification;
