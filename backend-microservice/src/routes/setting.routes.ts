import { Router } from 'express';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';
import { getSettings, updateSettings } from '../controllers/setting.controller';

const router = Router();

// Public read or protected read? Usually admin settings are protected.
// Assuming mobile app needs to read some config, maybe public/semi-public.
// But writing definitely needs admin.

router.get('/', verifyJwt, getSettings);
router.post('/', verifyJwt, authorize(['admin']), updateSettings);
router.put('/', verifyJwt, authorize(['admin']), updateSettings); // Alias

export default router;
