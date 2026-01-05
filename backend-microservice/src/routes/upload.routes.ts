import express from 'express';
import { upload } from '../middleware/upload';
import { uploadFile } from '../controllers/upload.controller';

const router = express.Router();

// Generic upload endpoint
// Frontend should append file with key 'file'
router.post('/', upload.single('file'), uploadFile);

export default router;
