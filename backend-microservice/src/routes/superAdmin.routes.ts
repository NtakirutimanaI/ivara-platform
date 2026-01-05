import { Router } from 'express';
import { getPlatformOverview } from '../controllers/superAdmin.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// Only super_admin can access platform-wide overview
router.get('/overview', verifyJwt, authorize(['super_admin']), getPlatformOverview);

export default router;
