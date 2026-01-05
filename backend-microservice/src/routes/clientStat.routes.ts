import express from 'express';
import {
    getClientStats,
    createClientStat,
    updateClientStat,
    deleteClientStat,
} from '../controllers/clientStat.controller';

const router = express.Router();

// Public routes
router.get('/', getClientStats);

// Admin routes (add authentication middleware later)
router.post('/', createClientStat);
router.put('/:id', updateClientStat);
router.delete('/:id', deleteClientStat);

export default router;
