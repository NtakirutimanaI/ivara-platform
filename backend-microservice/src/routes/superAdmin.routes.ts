import { Router } from 'express';
import {
    getPlatformOverview,
    getAllUsers,
    updateUser,
    deleteUser,
    getPerformanceMatrix,
    addReview,
    getMarketplaceData,
    moderateProduct,
    getRoles,
    getActiveSubscriptions
} from '../controllers/superAdmin.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// ... (existing routes)

/**
 * @swagger
 * /api/super-admin/subscriptions/active:
 *   get:
 *     summary: Get active subscriptions list
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: List of active subscriptions
 */
router.get('/subscriptions/active', getActiveSubscriptions);
/**
 * @swagger
 * tags:
 *   name: Super Admin
 *   description: Administrative platform oversight
 */

/**
 * @swagger
 * /api/super-admin/overview:
 *   get:
 *     summary: Get platform-wide overview metrics
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: Platform metrics and events
 */
router.get('/overview', verifyJwt, authorize(['super_admin']), getPlatformOverview);

/**
 * @swagger
 * /api/super-admin/users:
 *   get:
 *     summary: Get all platform users
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: List of all registered accounts
 */
router.get('/users', verifyJwt, authorize(['super_admin']), getAllUsers);

/**
 * @swagger
 * /api/super-admin/roles:
 *   get:
 *     summary: Get system role registry
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: List of roles and their permissions
 */
router.get('/roles', verifyJwt, authorize(['super_admin']), getRoles);

/**
 * @swagger
 * /api/super-admin/marketplace:
 *   get:
 *     summary: Get marketplace intelligence data
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: Marketplace stats, products, and mediator data
 */
router.get('/marketplace', verifyJwt, authorize(['super_admin']), getMarketplaceData);

/**
 * @swagger
 * /api/super-admin/marketplace/product/{id}:
 *   post:
 *     summary: Moderate a marketplace listing
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - action
 *             properties:
 *               action:
 *                 type: string
 *                 enum: [approve, reject, delete]
 *     responses:
 *       200:
 *         description: Listing status updated
 */
router.post('/marketplace/product/:id', verifyJwt, authorize(['super_admin']), moderateProduct);

/**
 * @swagger
 * /api/super-admin/performance:
 *   get:
 *     summary: Get administrative performance matrix
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: User scores and efficiency data
 */
router.get('/performance', verifyJwt, authorize(['super_admin']), getPerformanceMatrix);

/**
 * @swagger
 * /api/super-admin/performance/review:
 *   post:
 *     summary: Add evaluation review for an administrator
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - userId
 *               - content
 *               - rating
 *     responses:
 *       200:
 *         description: Review submitted
 */
router.post('/performance/review', verifyJwt, authorize(['super_admin']), addReview);

/**
 * @swagger
 * /api/super-admin/users/{id}:
 *   put:
 *     summary: Update a user account
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: User updated
 */
router.put('/users/:id', verifyJwt, authorize(['super_admin']), updateUser);

/**
 * @swagger
 * /api/super-admin/users/{id}:
 *   delete:
 *     summary: Remove a user account
 *     tags: [Super Admin]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: User deleted
 */
router.delete('/users/:id', verifyJwt, authorize(['super_admin']), deleteUser);

export default router;
