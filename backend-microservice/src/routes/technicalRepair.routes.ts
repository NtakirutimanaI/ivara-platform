// src/routes/technicalRepair.routes.ts
import { Router } from 'express';
import {
    getAllTechnicalRepairs,
    getTechnicalRepairById,
    createTechnicalRepair,
    updateTechnicalRepair,
    deleteTechnicalRepair,
} from '../controllers/technicalRepair.controller';
import {
    getBuilderDashboard,
    getElectricianDashboard,
    getTechnicianDashboard,
    getMechanicDashboard
} from '../controllers/technicalDashboard.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

/**
 * @swagger
 * tags:
 *   name: Technical Repair
 *   description: Technical Repair and Dashboard operations
 */

/**
 * @swagger
 * /api/technical-repair/dashboard/builder:
 *   get:
 *     summary: Get Builder Dashboard
 *     tags: [Technical Repair]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: Dashboard data
 */
router.get('/dashboard/builder', verifyJwt, authorize(['builder', 'admin']), getBuilderDashboard);

/**
 * @swagger
 * /api/technical-repair/dashboard/electrician:
 *   get:
 *     summary: Get Electrician Dashboard
 *     tags: [Technical Repair]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: Dashboard data
 */
router.get('/dashboard/electrician', verifyJwt, authorize(['electrician', 'admin']), getElectricianDashboard);

/**
 * @swagger
 * /api/technical-repair/dashboard/technician:
 *   get:
 *     summary: Get Technician Dashboard
 *     tags: [Technical Repair]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: Dashboard data
 */
router.get('/dashboard/technician', verifyJwt, authorize(['technician', 'admin']), getTechnicianDashboard);

/**
 * @swagger
 * /api/technical-repair/dashboard/mechanic:
 *   get:
 *     summary: Get Mechanic Dashboard
 *     tags: [Technical Repair]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: Dashboard data
 */
router.get('/dashboard/mechanic', verifyJwt, authorize(['mechanic', 'admin']), getMechanicDashboard);

/**
 * @swagger
 * /api/technical-repair:
 *   get:
 *     summary: Get all technical repairs
 *     tags: [Technical Repair]
 *     security:
 *       - bearerAuth: []
 *     responses:
 *       200:
 *         description: List of repairs
 */
router.get('/', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getAllTechnicalRepairs);

/**
 * @swagger
 * /api/technical-repair/{id}:
 *   get:
 *     summary: Get technical repair by ID
 *     tags: [Technical Repair]
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
 *         description: Repair details
 */
router.get('/:id', verifyJwt, authorize(['admin', 'category_admin', 'provider', 'customer']), getTechnicalRepairById);

/**
 * @swagger
 * /api/technical-repair:
 *   post:
 *     summary: Create technical repair
 *     tags: [Technical Repair]
 *     security:
 *       - bearerAuth: []
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - title
 *               - description
 *             properties:
 *               title:
 *                 type: string
 *               description:
 *                 type: string
 *     responses:
 *       201:
 *         description: Repair created
 */
router.post('/', verifyJwt, authorize(['admin', 'category_admin']), createTechnicalRepair);

/**
 * @swagger
 * /api/technical-repair/{id}:
 *   put:
 *     summary: Update technical repair
 *     tags: [Technical Repair]
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
 *     responses:
 *       200:
 *         description: Repair updated
 */
router.put('/:id', verifyJwt, authorize(['admin', 'category_admin']), updateTechnicalRepair);

/**
 * @swagger
 * /api/technical-repair/{id}:
 *   delete:
 *     summary: Delete technical repair
 *     tags: [Technical Repair]
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
 *         description: Repair deleted
 */
router.delete('/:id', verifyJwt, authorize(['admin']), deleteTechnicalRepair);

export default router;
