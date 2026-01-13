import { Router } from 'express';
import {
    getAllSubscriptions,
    createSubscription,
    updateSubscriptionStatus,
    deleteSubscription,
    updateSubscription
} from '../controllers/subscription.controller';

const router = Router();

router.get('/', getAllSubscriptions);
router.post('/', createSubscription);
router.put('/:id', updateSubscription);
router.patch('/:id/status', updateSubscriptionStatus);
router.delete('/:id', deleteSubscription);

export default router;
