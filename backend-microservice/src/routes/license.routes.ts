import express from 'express';
import * as licenseController from '../controllers/license.controller';

const router = express.Router();

router.get('/', licenseController.getAllLicenses);
router.get('/stats', licenseController.getLicenseStats);
router.post('/', licenseController.createLicense);
router.put('/:id', licenseController.updateLicense);
router.delete('/:id', licenseController.deleteLicense);

export default router;
