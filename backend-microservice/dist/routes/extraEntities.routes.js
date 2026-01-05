"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const extraEntities_controller_1 = require("../controllers/extraEntities.controller");
const jwt_1 = require("../middleware/jwt");
const auth_1 = require("../middleware/auth");
const router = (0, express_1.Router)();
// Middleware for all extra routes
router.use(jwt_1.verifyJwt);
// Helper to register standard routes
const registerRoutes = (prefix, controller) => {
    router.get(`/${prefix}`, controller.getAll);
    router.get(`/${prefix}/:id`, controller.getById);
    router.post(`/${prefix}`, (0, auth_1.authorize)(['admin', 'category_admin']), controller.create);
    router.put(`/${prefix}/:id`, (0, auth_1.authorize)(['admin', 'category_admin']), controller.update);
    router.delete(`/${prefix}/:id`, (0, auth_1.authorize)(['admin']), controller.delete);
};
registerRoutes('tasks', extraEntities_controller_1.taskController);
registerRoutes('activities', extraEntities_controller_1.activityController);
registerRoutes('clients', extraEntities_controller_1.clientController);
registerRoutes('meetings', extraEntities_controller_1.meetingController);
registerRoutes('measurements', extraEntities_controller_1.measurementController);
registerRoutes('projects', extraEntities_controller_1.projectController);
registerRoutes('devices', extraEntities_controller_1.deviceController);
registerRoutes('repairs', extraEntities_controller_1.repairController);
registerRoutes('teams', extraEntities_controller_1.teamController);
registerRoutes('products', extraEntities_controller_1.productController);
registerRoutes('notifications', extraEntities_controller_1.notificationController);
registerRoutes('inventory', extraEntities_controller_1.inventoryController);
registerRoutes('vehicles', extraEntities_controller_1.vehicleController);
registerRoutes('orders', extraEntities_controller_1.orderController);
registerRoutes('learning-materials', extraEntities_controller_1.learningMaterialController);
registerRoutes('logbooks', extraEntities_controller_1.logbookController);
registerRoutes('trips', extraEntities_controller_1.tripController);
registerRoutes('transport-orders', extraEntities_controller_1.transportOrderController);
registerRoutes('emergency-logs', extraEntities_controller_1.emergencyLogController);
exports.default = router;
