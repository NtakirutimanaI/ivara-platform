import { Router } from 'express';
import { getPlatformOverview, getAllUsers, updateUser, deleteUser } from '../controllers/superAdmin.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// Only super_admin can access platform-wide overview
router.get('/overview', verifyJwt, authorize(['super_admin']), getPlatformOverview);
router.get('/users', verifyJwt, authorize(['super_admin']), getAllUsers);
router.put('/users/:id', verifyJwt, authorize(['super_admin']), updateUser);
router.delete('/users/:id', verifyJwt, authorize(['super_admin']), deleteUser);

export default router;
