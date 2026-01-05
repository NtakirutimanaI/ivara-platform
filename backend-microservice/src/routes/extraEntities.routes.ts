import { Router } from 'express';
import {
    taskController,
    activityController,
    clientController,
    meetingController,
    measurementController,
    projectController,
    deviceController,
    repairController,
    teamController,
    productController,
    notificationController,
    inventoryController,
    vehicleController,
    orderController,
    learningMaterialController,
    logbookController,
    tripController,
    transportOrderController,
    emergencyLogController
} from '../controllers/extraEntities.controller';
import { verifyJwt } from '../middleware/jwt';
import { authorize } from '../middleware/auth';

const router = Router();

// Middleware for all extra routes
router.use(verifyJwt);

// Helper to register standard routes
const registerRoutes = (prefix: string, controller: any) => {
    router.get(`/${prefix}`, controller.getAll);
    router.get(`/${prefix}/:id`, controller.getById);
    router.post(`/${prefix}`, authorize(['admin', 'category_admin']), controller.create);
    router.put(`/${prefix}/:id`, authorize(['admin', 'category_admin']), controller.update);
    router.delete(`/${prefix}/:id`, authorize(['admin']), controller.delete);
};

registerRoutes('tasks', taskController);
registerRoutes('activities', activityController);
registerRoutes('clients', clientController);
registerRoutes('meetings', meetingController);
registerRoutes('measurements', measurementController);
registerRoutes('projects', projectController);
registerRoutes('devices', deviceController);
registerRoutes('repairs', repairController);
registerRoutes('teams', teamController);
registerRoutes('products', productController);
registerRoutes('notifications', notificationController);
registerRoutes('inventory', inventoryController);
registerRoutes('vehicles', vehicleController);
registerRoutes('orders', orderController);
registerRoutes('learning-materials', learningMaterialController);
registerRoutes('logbooks', logbookController);
registerRoutes('trips', tripController);
registerRoutes('transport-orders', transportOrderController);
registerRoutes('emergency-logs', emergencyLogController);

export default router;
