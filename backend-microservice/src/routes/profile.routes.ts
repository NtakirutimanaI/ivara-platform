import { Router } from 'express';
import { verifyJwt } from '../middleware/jwt';
import { upload } from '../middleware/upload';
import { getProfile, updateProfile, changePassword, deleteAccount } from '../controllers/profile.controller';

const router = Router();

// Get profile
router.get('/', verifyJwt, getProfile);

// Update profile (with photo upload)
router.patch('/', verifyJwt, upload.single('profilePhoto'), updateProfile);

// Change password
router.put('/password', verifyJwt, changePassword);

// Delete account
router.delete('/', verifyJwt, deleteAccount);

export default router;
