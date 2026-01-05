import { Router } from 'express';
import { createContact, getAllContacts, getContactById, deleteContact } from '../controllers/contact.controller';

const router = Router();

// Public route to submit contact
router.post('/', createContact);

// Protected routes (add verifyJwt/authorize if needed later)
router.get('/', getAllContacts);
router.get('/:id', getContactById);
router.delete('/:id', deleteContact);

export default router;
