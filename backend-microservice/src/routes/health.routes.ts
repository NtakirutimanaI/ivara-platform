// src/routes/health.routes.ts
import { Router } from 'express';
import mongoose from 'mongoose';

const router = Router();

router.get('/', async (req, res) => {
    const state = mongoose.connection.readyState; // 0=disconnected, 1=connected, 2=connecting, 3=disconnecting
    if (state === 1) {
        return res.json({ status: 'ok', mongo: 'connected' });
    }
    return res.status(500).json({ status: 'error', mongo: 'not connected', state });
});

export default router;
