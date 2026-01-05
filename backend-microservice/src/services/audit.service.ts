import AuditLog from '../models/auditLog.model';
import NotificationService from './notification.service';
import mongoose from 'mongoose';

interface AuditData {
    userId: string;
    action: 'create' | 'read' | 'update' | 'delete' | 'login' | 'logout' | 'approve' | 'reject' | 'assign';
    resource: string;
    resourceId?: string;
    changes?: any;
    ipAddress?: string;
    userAgent?: string;
}

interface NotificationTrigger {
    targetUserId?: string; // Who to notify
    title: string;
    message: string;
    type: 'account_action' | 'booking' | 'payment' | 'system' | 'approval' | 'assignment';
    priority?: 'low' | 'medium' | 'high' | 'urgent';
}

/**
 * Audit Service
 * Logs all user actions and triggers automatic notifications
 */
class AuditService {
    /**
     * Log an action and trigger notifications if needed
     */
    async logAction(data: AuditData): Promise<void> {
        try {
            // Create audit log
            const auditLog = new AuditLog({
                userId: new mongoose.Types.ObjectId(data.userId),
                action: data.action,
                resource: data.resource,
                resourceId: data.resourceId ? new mongoose.Types.ObjectId(data.resourceId) : undefined,
                changes: data.changes,
                ipAddress: data.ipAddress,
                userAgent: data.userAgent,
                timestamp: new Date(),
            });

            await auditLog.save();

            // Trigger automatic notifications based on action
            await this.triggerNotifications(data);
        } catch (error) {
            console.error('Error logging action:', error);
            // Don't throw - audit logging should not break the main flow
        }
    }

    /**
     * Trigger notifications based on the action
     */
    private async triggerNotifications(data: AuditData): Promise<void> {
        const notifications: NotificationTrigger[] = [];

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
                if (data.changes?.providerId) {
                    notifications.push({
                        targetUserId: data.changes.providerId,
                        title: 'New Booking Received',
                        message: `You have a new booking request from ${data.changes?.clientName || 'a client'}.`,
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

            if (data.action === 'update' && data.changes?.status) {
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
                if (data.changes?.clientId) {
                    notifications.push({
                        targetUserId: data.changes.clientId,
                        title: 'Booking Cancelled',
                        message: 'Your booking has been cancelled.',
                        type: 'booking',
                        priority: 'high',
                    });
                }
                if (data.changes?.providerId) {
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
                    message: `Payment of ${data.changes?.amount || 'N/A'} has been received.`,
                    type: 'payment',
                    priority: 'medium',
                });
            }
        }

        // PRODUCT/SERVICE APPROVAL
        if (data.resource === 'product' || data.resource === 'service') {
            if (data.action === 'approve') {
                notifications.push({
                    targetUserId: data.changes?.ownerId || data.userId,
                    title: `${data.resource === 'product' ? 'Product' : 'Service'} Approved`,
                    message: `Your ${data.resource} has been approved and is now live!`,
                    type: 'approval',
                    priority: 'high',
                });
            }

            if (data.action === 'reject') {
                notifications.push({
                    targetUserId: data.changes?.ownerId || data.userId,
                    title: `${data.resource === 'product' ? 'Product' : 'Service'} Rejected`,
                    message: `Your ${data.resource} was not approved. Reason: ${data.changes?.reason || 'N/A'}`,
                    type: 'approval',
                    priority: 'high',
                });
            }
        }

        // ASSIGNMENT ACTIONS
        if (data.action === 'assign') {
            notifications.push({
                targetUserId: data.changes?.assignedTo,
                title: 'New Assignment',
                message: `You have been assigned to: ${data.resource}`,
                type: 'assignment',
                priority: 'high',
            });
        }

        // ROLE/PERMISSION CHANGES
        if (data.resource === 'user' && data.changes?.role) {
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
                await NotificationService.createNotification(notif.targetUserId, {
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
    }

    /**
     * Get audit logs for a user
     */
    async getUserAuditLogs(
        userId: string,
        filters?: {
            action?: string;
            resource?: string;
            limit?: number;
            skip?: number;
        }
    ) {
        try {
            const query: any = { userId: new mongoose.Types.ObjectId(userId) };

            if (filters?.action) {
                query.action = filters.action;
            }

            if (filters?.resource) {
                query.resource = filters.resource;
            }

            return await AuditLog.find(query)
                .sort({ timestamp: -1 })
                .limit(filters?.limit || 50)
                .skip(filters?.skip || 0)
                .exec();
        } catch (error) {
            console.error('Error fetching audit logs:', error);
            throw error;
        }
    }

    /**
     * Get audit logs for a specific resource
     */
    async getResourceAuditLogs(resource: string, resourceId: string) {
        try {
            return await AuditLog.find({
                resource,
                resourceId: new mongoose.Types.ObjectId(resourceId),
            })
                .sort({ timestamp: -1 })
                .populate('userId', 'name email')
                .exec();
        } catch (error) {
            console.error('Error fetching resource audit logs:', error);
            throw error;
        }
    }
}

export default new AuditService();
