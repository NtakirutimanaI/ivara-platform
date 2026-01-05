import express from 'express';
import {
    registerDevice,
    getUserDevices,
    updateDeviceStatus,
    getDeviceBySerial
} from '../controllers/device.controller';

const router = express.Router();

router.post('/register', registerDevice);
router.get('/user/:userId', getUserDevices);
router.patch('/:id/status', updateDeviceStatus);
router.get('/lookup/:serial', getDeviceBySerial);

export default router;
