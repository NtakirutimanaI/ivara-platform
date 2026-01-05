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
const auditLog_model_1 = __importDefault(require("../models/auditLog.model"));
const notification_service_1 = __importDefault(require("./notification.service"));
const mongoose_1 = __importDefault(require("mongoose"));
/**
 * Audit Service
 * Logs all user actions and triggers automatic notifications
 */
class AuditService {
    /**
     * Log an action and trigger notifications if needed
     */
    logAction(data) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                // Create audit log
                const auditLog = new auditLog_model_1.default({
                    userId: new mongoose_1.default.Types.ObjectId(data.userId),
                    action: data.action,
                    resource: data.resource,
                    resourceId: data.resourceId ? new mongoose_1.default.Types.ObjectId(data.resourceId) : undefined,
                    changes: data.changes,
                    ipAddress: data.ipAddress,
                    userAgent: data.userAgent,
                    timestamp: new Date(),
                });
                yield auditLog.save();
                // Trigger automatic notifications based on action
                yield this.triggerNotifications(data);
            }
            catch (error) {
                console.error('Error logging action:', error);
                // Don't throw - audit logging should not break the main flow
            }
        });
    }
    /**
     * Trigger notifications based on the action
     */
    triggerNotifications(data) {
        return __awaiter(this, void 0, void 0, function* () {
            var _a, _b, _c, _d, _e, _f, _g, _h, _j, _k, _l;
            const notifications = [];
            // USER ACCOUNT ACTIONS
            if (data.resource === 'user') {
                if (data.action === 'create') {
                    notifications.push({
                        targetUserId: data.resourceId,
                        title: 'Welcome to IVARA!',
                        message: 'Your account has been created successfully. Start exploring our services!',
                        type: 'account_action',
                        priority: 'medium',
                    });
                }
                if (data.action === 'update' && data.resourceId) {
                    notifications.push({
                        targetUserId: data.resourceId,
                        title: 'Account Updated',
                        message: 'Your account information has been updated.',
                        type: 'account_action',
                        priority: 'low',
                    });
                }
                if (data.action === 'delete' && data.resourceId) {
                    notifications.push({
                        targetUserId: data.resourceId,
                        title: 'Account Deletion',
                        message: 'Your account has been scheduled for deletion.',
                        type: 'account_action',
                        priority: 'urgent',
                    });
                }
            }
            // BOOKING ACTIONS
            if (data.resource === 'booking') {
                if (data.action === 'create') {
                    // Notify service provider
                    if ((_a = data.changes) === null || _a === void 0 ? void 0 : _a.providerId) {
                        notifications.push({
                            targetUserId: data.changes.providerId,
                            title: 'New Booking Received',
                            message: `You have a new booking request from ${((_b = data.changes) === null || _b === void 0 ? void 0 : _b.clientName) || 'a client'}.`,
                            type: 'booking',
                            priority: 'high',
                        });
                    }
                    // Notify client
                    notifications.push({
                        targetUserId: data.userId,
                        title: 'Booking Confirmed',
                        message: 'Your booking has been created successfully.',
                        type: 'booking',
                        priority: 'medium',
                    });
                }
                if (data.action === 'update' && ((_c = data.changes) === null || _c === void 0 ? void 0 : _c.status)) {
                    // Notify client of status change
                    if (data.changes.clientId) {
                        notifications.push({
                            targetUserId: data.changes.clientId,
                            title: 'Booking Status Updated',
                            message: `Your booking status has been changed to: ${data.changes.status}`,
                            type: 'booking',
                            priority: 'high',
                        });
                    }
                }
                if (data.action === 'delete') {
                    // Notify both parties
                    if ((_d = data.changes) === null || _d === void 0 ? void 0 : _d.clientId) {
                        notifications.push({
                            targetUserId: data.changes.clientId,
                            title: 'Booking Cancelled',
                            message: 'Your booking has been cancelled.',
                            type: 'booking',
                            priority: 'high',
                        });
                    }
                    if ((_e = data.changes) === null || _e === void 0 ? void 0 : _e.providerId) {
                        notifications.push({
                            targetUserId: data.changes.providerId,
                            title: 'Booking Cancelled',
                            message: 'A booking has been cancelled.',
                            type: 'booking',
                            priority: 'medium',
                        });
                    }
                }
            }
            // PAYMENT ACTIONS
            if (data.resource === 'payment') {
                if (data.action === 'create') {
                    notifications.push({
                        targetUserId: data.userId,
                        title: 'Payment Received',
                        message: `Payment of ${((_f = data.changes) === null || _f === void 0 ? void 0 : _f.amount) || 'N/A'} has been received.`,
                        type: 'payment',
                        priority: 'medium',
                    });
                }
            }
            // PRODUCT/SERVICE APPROVAL
            if (data.resource === 'product' || data.resource === 'service') {
                if (data.action === 'approve') {
                    notifications.push({
                        targetUserId: ((_g = data.changes) === null || _g === void 0 ? void 0 : _g.ownerId) || data.userId,
                        title: `${data.resource === 'product' ? 'Product' : 'Service'} Approved`,
                        message: `Your ${data.resource} has been approved and is now live!`,
                        type: 'approval',
                        priority: 'high',
                    });
                }
                if (data.action === 'reject') {
                    notifications.push({
                        targetUserId: ((_h = data.changes) === null || _h === void 0 ? void 0 : _h.ownerId) || data.userId,
                        title: `${data.resource === 'product' ? 'Product' : 'Service'} Rejected`,
                        message: `Your ${data.resource} was not approved. Reason: ${((_j = data.changes) === null || _j === void 0 ? void 0 : _j.reason) || 'N/A'}`,
                        type: 'approval',
                        priority: 'high',
                    });
                }
            }
            // ASSIGNMENT ACTIONS
            if (data.action === 'assign') {
                notifications.push({
                    targetUserId: (_k = data.changes) === null || _k === void 0 ? void 0 : _k.assignedTo,
                    title: 'New Assignment',
                    message: `You have been assigned to: ${data.resource}`,
                    type: 'assignment',
                    priority: 'high',
                });
            }
            // ROLE/PERMISSION CHANGES
            if (data.resource === 'user' && ((_l = data.changes) === null || _l === void 0 ? void 0 : _l.role)) {
                notifications.push({
                    targetUserId: data.resourceId,
                    title: 'Role Updated',
                    message: `Your role has been changed to: ${data.changes.role}`,
                    type: 'account_action',
                    priority: 'urgent',
                });
            }
            // Send all notifications
            for (const notif of notifications) {
                if (notif.targetUserId) {
                    yield notification_service_1.default.createNotification(notif.targetUserId, {
                        title: notif.title,
                        message: notif.message,
                        type: notif.type,
                        priority: notif.priority,
                        actionBy: data.userId,
                        relatedEntity: data.resourceId
                            ? {
                                type: data.resource,
                                id: data.resourceId,
                            }
                            : undefined,
                    });
                }
            }
        });
    }
    /**
     * Get audit logs for a user
     */
    getUserAuditLogs(userId, filters) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const query = { userId: new mongoose_1.default.Types.ObjectId(userId) };
                if (filters === null || filters === void 0 ? void 0 : filters.action) {
                    query.action = filters.action;
                }
                if (filters === null || filters === void 0 ? void 0 : filters.resource) {
                    query.resource = filters.resource;
                }
                return yield auditLog_model_1.default.find(query)
                    .sort({ timestamp: -1 })
                    .limit((filters === null || filters === void 0 ? void 0 : filters.limit) || 50)
                    .skip((filters === null || filters === void 0 ? void 0 : filters.skip) || 0)
                    .exec();
            }
            catch (error) {
                console.error('Error fetching audit logs:', error);
                throw error;
            }
        });
    }
    /**
     * Get audit logs for a specific resource
     */
    getResourceAuditLogs(resource, resourceId) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                return yield auditLog_model_1.default.find({
                    resource,
                    resourceId: new mongoose_1.default.Types.ObjectId(resourceId),
                })
                    .sort({ timestamp: -1 })
                    .populate('userId', 'name email')
                    .exec();
            }
            catch (error) {
                console.error('Error fetching resource audit logs:', error);
                throw error;
            }
        });
    }
}
exports.default = new AuditService();
