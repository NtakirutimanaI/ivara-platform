import express from 'express';
import * as serviceController from '../controllers/service.controller';

const router = express.Router();

router.get('/', serviceController.getAllServices);
router.get('/stats', serviceController.getServiceStats);
router.post('/', serviceController.createService);
router.put('/:id', serviceController.updateService);
router.delete('/:id', serviceController.deleteService);

export default router;
