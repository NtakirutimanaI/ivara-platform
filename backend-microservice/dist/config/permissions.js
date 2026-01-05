"use strict";
/**
 * IVARA Platform - Permission Matrix
 * Defines what each role can access across the system
 */
Object.defineProperty(exports, "__esModule", { value: true });
exports.PERMISSIONS = void 0;
exports.hasPermission = hasPermission;
exports.getRoleResources = getRoleResources;
exports.PERMISSIONS = {
    // SUPER ADMIN - Full System Access
    super_admin: [
        { resource: '*', actions: ['*'] }, // All resources, all actions
    ],
    // CATEGORY ADMINS - Full access to their category only
    technical_admin: [
        { resource: 'technical-repair', actions: ['*'] },
        { resource: 'technical-repair:services', actions: ['*'] },
        { resource: 'technical-repair:bookings', actions: ['*'] },
        { resource: 'technical-repair:providers', actions: ['*'] },
        { resource: 'technical-repair:products', actions: ['*'] },
        { resource: 'technical-repair:clients', actions: ['*'] },
        { resource: 'technical-repair:reports', actions: ['*'] },
        { resource: 'technical-repair:payments', actions: ['*'] },
        { resource: 'technical-repair:reviews', actions: ['*'] },
        { resource: 'technical-repair:settings', actions: ['*'] },
        { resource: 'users', actions: ['read'] }, // Can view users in their category
        { resource: 'notifications', actions: ['read', 'create'] },
    ],
    transport_admin: [
        { resource: 'transport-travel', actions: ['*'] },
        { resource: 'transport-travel:services', actions: ['*'] },
        { resource: 'transport-travel:bookings', actions: ['*'] },
        { resource: 'transport-travel:providers', actions: ['*'] },
        { resource: 'transport-travel:vehicles', actions: ['*'] },
        { resource: 'transport-travel:clients', actions: ['*'] },
        { resource: 'transport-travel:reports', actions: ['*'] },
        { resource: 'transport-travel:payments', actions: ['*'] },
        { resource: 'transport-travel:reviews', actions: ['*'] },
        { resource: 'transport-travel:settings', actions: ['*'] },
        { resource: 'users', actions: ['read'] },
        { resource: 'notifications', actions: ['read', 'create'] },
    ],
    creative_admin: [
        { resource: 'creative-lifestyle', actions: ['*'] },
        { resource: 'creative-lifestyle:services', actions: ['*'] },
        { resource: 'creative-lifestyle:bookings', actions: ['*'] },
        { resource: 'creative-lifestyle:providers', actions: ['*'] },
        { resource: 'creative-lifestyle:products', actions: ['*'] },
        { resource: 'creative-lifestyle:clients', actions: ['*'] },
        { resource: 'creative-lifestyle:reports', actions: ['*'] },
        { resource: 'creative-lifestyle:payments', actions: ['*'] },
        { resource: 'creative-lifestyle:reviews', actions: ['*'] },
        { resource: 'creative-lifestyle:settings', actions: ['*'] },
        { resource: 'users', actions: ['read'] },
        { resource: 'notifications', actions: ['read', 'create'] },
    ],
    food_admin: [
        { resource: 'food-fashion', actions: ['*'] },
        { resource: 'food-fashion:services', actions: ['*'] },
        { resource: 'food-fashion:bookings', actions: ['*'] },
        { resource: 'food-fashion:providers', actions: ['*'] },
        { resource: 'food-fashion:products', actions: ['*'] },
        { resource: 'food-fashion:clients', actions: ['*'] },
        { resource: 'food-fashion:reports', actions: ['*'] },
        { resource: 'food-fashion:payments', actions: ['*'] },
        { resource: 'food-fashion:reviews', actions: ['*'] },
        { resource: 'food-fashion:settings', actions: ['*'] },
        { resource: 'users', actions: ['read'] },
        { resource: 'notifications', actions: ['read', 'create'] },
    ],
    education_admin: [
        { resource: 'education-knowledge', actions: ['*'] },
        { resource: 'education-knowledge:courses', actions: ['*'] },
        { resource: 'education-knowledge:enrollments', actions: ['*'] },
        { resource: 'education-knowledge:instructors', actions: ['*'] },
        { resource: 'education-knowledge:materials', actions: ['*'] },
        { resource: 'education-knowledge:students', actions: ['*'] },
        { resource: 'education-knowledge:reports', actions: ['*'] },
        { resource: 'education-knowledge:payments', actions: ['*'] },
        { resource: 'education-knowledge:reviews', actions: ['*'] },
        { resource: 'education-knowledge:settings', actions: ['*'] },
        { resource: 'users', actions: ['read'] },
        { resource: 'notifications', actions: ['read', 'create'] },
    ],
    agriculture_admin: [
        { resource: 'agriculture-environment', actions: ['*'] },
        { resource: 'agriculture-environment:services', actions: ['*'] },
        { resource: 'agriculture-environment:bookings', actions: ['*'] },
        { resource: 'agriculture-environment:providers', actions: ['*'] },
        { resource: 'agriculture-environment:products', actions: ['*'] },
        { resource: 'agriculture-environment:clients', actions: ['*'] },
        { resource: 'agriculture-environment:reports', actions: ['*'] },
        { resource: 'agriculture-environment:payments', actions: ['*'] },
        { resource: 'agriculture-environment:reviews', actions: ['*'] },
        { resource: 'agriculture-environment:settings', actions: ['*'] },
        { resource: 'users', actions: ['read'] },
        { resource: 'notifications', actions: ['read', 'create'] },
    ],
    other_admin: [
        { resource: 'other-services', actions: ['*'] },
        { resource: 'other-services:services', actions: ['*'] },
        { resource: 'other-services:bookings', actions: ['*'] },
        { resource: 'other-services:providers', actions: ['*'] },
        { resource: 'other-services:products', actions: ['*'] },
        { resource: 'other-services:clients', actions: ['*'] },
        { resource: 'other-services:reports', actions: ['*'] },
        { resource: 'other-services:payments', actions: ['*'] },
        { resource: 'other-services:reviews', actions: ['*'] },
        { resource: 'other-services:settings', actions: ['*'] },
        { resource: 'users', actions: ['read'] },
        { resource: 'notifications', actions: ['read', 'create'] },
    ],
    // GENERAL ADMIN - Cross-category management
    admin: [
        { resource: 'users', actions: ['read', 'create', 'update'] },
        { resource: 'clients', actions: ['*'] },
        { resource: 'bookings', actions: ['*'] },
        { resource: 'devices', actions: ['*'] },
        { resource: 'meetings', actions: ['*'] },
        { resource: 'products', actions: ['read', 'update'] },
        { resource: 'stock', actions: ['*'] },
        { resource: 'invoices', actions: ['*'] },
        { resource: 'payments', actions: ['*'] },
        { resource: 'notifications', actions: ['*'] },
        { resource: 'reports', actions: ['read'] },
        { resource: 'settings', actions: ['read', 'update'] },
    ],
    // MANAGER - Operational management
    manager: [
        { resource: 'devices', actions: ['*'] },
        { resource: 'clients', actions: ['read', 'update'] },
        { resource: 'bookings', actions: ['*'] },
        { resource: 'meetings', actions: ['*'] },
        { resource: 'products', actions: ['read', 'create', 'update'] },
        { resource: 'stock', actions: ['read', 'update'] },
        { resource: 'notifications', actions: ['read', 'create'] },
        { resource: 'feedback', actions: ['read'] },
    ],
    // SUPERVISOR - Oversight and reporting
    supervisor: [
        { resource: 'tasks', actions: ['*'] },
        { resource: 'clients', actions: ['read'] },
        { resource: 'meetings', actions: ['read', 'create'] },
        { resource: 'stock', actions: ['read'] },
        { resource: 'bookings', actions: ['read'] },
        { resource: 'reports', actions: ['read'] },
        { resource: 'notifications', actions: ['read'] },
    ],
    // TECHNICIAN - Service provider
    technician: [
        { resource: 'jobs', actions: ['read', 'update'] },
        { resource: 'work-orders', actions: ['*'] },
        { resource: 'inventory', actions: ['read'] },
        { resource: 'products', actions: ['read'] },
        { resource: 'bookings', actions: ['read', 'update'] },
        { resource: 'schedule', actions: ['read', 'update'] },
        { resource: 'notifications', actions: ['read'] },
    ],
    // SERVICE PROVIDERS (Various)
    taxi_driver: [
        { resource: 'bookings', actions: ['read', 'update'] },
        { resource: 'vehicle', actions: ['read', 'update'] },
        { resource: 'earnings', actions: ['read'] },
        { resource: 'notifications', actions: ['read'] },
    ],
    gym_trainer: [
        { resource: 'clients', actions: ['read'] },
        { resource: 'progress', actions: ['*'] },
        { resource: 'plans', actions: ['*'] },
        { resource: 'schedule', actions: ['*'] },
        { resource: 'notifications', actions: ['read'] },
    ],
    // DEFAULT - Minimal access
    user: [
        { resource: 'profile', actions: ['read', 'update'] },
        { resource: 'bookings', actions: ['read', 'create'] },
        { resource: 'notifications', actions: ['read'] },
    ],
};
/**
 * Check if a role has permission to perform an action on a resource
 */
function hasPermission(role, resource, action) {
    const rolePermissions = exports.PERMISSIONS[role] || exports.PERMISSIONS.user;
    // Check for wildcard permission (super_admin)
    const wildcardPerm = rolePermissions.find((p) => p.resource === '*');
    if (wildcardPerm && wildcardPerm.actions.includes('*')) {
        return true;
    }
    // Check exact resource match
    const exactMatch = rolePermissions.find((p) => p.resource === resource);
    if (exactMatch) {
        return exactMatch.actions.includes('*') || exactMatch.actions.includes(action);
    }
    // Check parent resource (e.g., 'technical-repair' for 'technical-repair:services')
    if (resource.includes(':')) {
        const parentResource = resource.split(':')[0];
        const parentMatch = rolePermissions.find((p) => p.resource === parentResource);
        if (parentMatch) {
            return parentMatch.actions.includes('*') || parentMatch.actions.includes(action);
        }
    }
    return false;
}
/**
 * Get all resources a role can access
 */
function getRoleResources(role) {
    const rolePermissions = exports.PERMISSIONS[role] || exports.PERMISSIONS.user;
    return rolePermissions.map((p) => p.resource);
}
