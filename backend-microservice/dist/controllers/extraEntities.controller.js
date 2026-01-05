"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.emergencyLogController = exports.transportOrderController = exports.tripController = exports.logbookController = exports.learningMaterialController = exports.orderController = exports.vehicleController = exports.inventoryController = exports.notificationController = exports.productController = exports.teamController = exports.repairController = exports.deviceController = exports.projectController = exports.measurementController = exports.meetingController = exports.clientController = exports.activityController = exports.taskController = void 0;
const task_model_1 = require("../models/task.model");
const activity_model_1 = require("../models/activity.model");
const client_model_1 = require("../models/client.model");
const meeting_model_1 = require("../models/meeting.model");
const measurement_model_1 = require("../models/measurement.model");
const project_model_1 = require("../models/project.model");
const device_model_1 = require("../models/device.model");
const repair_model_1 = require("../models/repair.model");
const team_model_1 = require("../models/team.model");
const product_model_1 = require("../models/product.model");
const notification_model_1 = __importDefault(require("../models/notification.model"));
const inventory_model_1 = require("../models/inventory.model");
const vehicle_model_1 = require("../models/vehicle.model");
const order_model_1 = require("../models/order.model");
const learningMaterial_model_1 = require("../models/learningMaterial.model");
const logbook_model_1 = require("../models/logbook.model");
const trip_model_1 = require("../models/trip.model");
const transportOrder_model_1 = require("../models/transportOrder.model");
const emergencyLog_model_1 = require("../models/emergencyLog.model");
// Helper controller for CRUD operations
const genericCRUD = (Model) => ({
    getAll: (req, res) => __awaiter(void 0, void 0, void 0, function* () {
        try {
            const data = yield Model.find();
            res.status(200).json(data);
        }
        catch (error) {
            res.status(500).json({ message: error.message });
        }
    }),
    getById: (req, res) => __awaiter(void 0, void 0, void 0, function* () {
        try {
            const data = yield Model.findById(req.params.id);
            if (!data)
                return res.status(404).json({ message: 'Not found' });
            res.status(200).json(data);
        }
        catch (error) {
            res.status(500).json({ message: error.message });
        }
    }),
    create: (req, res) => __awaiter(void 0, void 0, void 0, function* () {
        try {
            const data = new Model(req.body);
            yield data.save();
            res.status(201).json(data);
        }
        catch (error) {
            res.status(400).json({ message: error.message });
        }
    }),
    update: (req, res) => __awaiter(void 0, void 0, void 0, function* () {
        try {
            const data = yield Model.findByIdAndUpdate(req.params.id, req.body, { new: true });
            if (!data)
                return res.status(404).json({ message: 'Not found' });
            res.status(200).json(data);
        }
        catch (error) {
            res.status(400).json({ message: error.message });
        }
    }),
    delete: (req, res) => __awaiter(void 0, void 0, void 0, function* () {
        try {
            const data = yield Model.findByIdAndDelete(req.params.id);
            if (!data)
                return res.status(404).json({ message: 'Not found' });
            res.status(200).json({ message: 'Deleted successfully' });
        }
        catch (error) {
            res.status(500).json({ message: error.message });
        }
    })
});
// Exporting specific controllers
exports.taskController = genericCRUD(task_model_1.Task);
exports.activityController = genericCRUD(activity_model_1.Activity);
exports.clientController = genericCRUD(client_model_1.Client);
exports.meetingController = genericCRUD(meeting_model_1.Meeting);
exports.measurementController = genericCRUD(measurement_model_1.Measurement);
exports.projectController = genericCRUD(project_model_1.Project);
exports.deviceController = genericCRUD(device_model_1.Device);
exports.repairController = genericCRUD(repair_model_1.Repair);
exports.teamController = genericCRUD(team_model_1.Team);
exports.productController = genericCRUD(product_model_1.Product);
exports.notificationController = genericCRUD(notification_model_1.default);
exports.inventoryController = genericCRUD(inventory_model_1.Inventory);
exports.vehicleController = genericCRUD(vehicle_model_1.Vehicle);
exports.orderController = genericCRUD(order_model_1.Order);
exports.learningMaterialController = genericCRUD(learningMaterial_model_1.LearningMaterial);
exports.logbookController = genericCRUD(logbook_model_1.Logbook);
exports.tripController = genericCRUD(trip_model_1.Trip);
exports.transportOrderController = genericCRUD(transportOrder_model_1.TransportOrder);
exports.emergencyLogController = genericCRUD(emergencyLog_model_1.EmergencyLog);
