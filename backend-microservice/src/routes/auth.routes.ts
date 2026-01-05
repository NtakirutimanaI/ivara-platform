// src/routes/auth.routes.ts
import { Router } from 'express';
import { register, login, getUsersByRoles, getUserById, getUsersByCategory } from '../controllers/auth.controller';

const router = Router();

router.post('/register', register);
router.post('/login', login);
router.get('/users-by-roles', getUsersByRoles);
router.get('/users-by-category', getUsersByCategory);
router.get('/user/:id', getUserById);

export default router;
