
import { Router } from 'express';
import { createActivity, getActivities } from '../controllers/activity.controller';
import { verifyJwt } from '../middleware/jwt';

const router = Router();

router.get('/', verifyJwt, getActivities);
router.post('/', verifyJwt, createActivity);

export default router;
