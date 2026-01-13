import { Router } from 'express';
import * as paymentController from '../controllers/payment.controller';

const router = Router();

router.get('/', paymentController.getAllPayments);
router.get('/stats', paymentController.getPaymentStats);
router.get('/export', paymentController.exportPayments);
router.patch('/:id/status', paymentController.updatePaymentStatus);
router.delete('/:id', paymentController.deletePayment);

export default router;
