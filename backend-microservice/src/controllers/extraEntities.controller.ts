import { Request, Response } from 'express';
import { Task } from '../models/task.model';
import { Activity } from '../models/activity.model';
import { Client } from '../models/client.model';
import { Meeting } from '../models/meeting.model';
import { Measurement } from '../models/measurement.model';
import { Project } from '../models/project.model';
import { Device } from '../models/device.model';
import { Repair } from '../models/repair.model';
import { Team } from '../models/team.model';
import { Product } from '../models/product.model';
import Notification from '../models/notification.model';
import { Inventory } from '../models/inventory.model';
import { Vehicle } from '../models/vehicle.model';
import { Order } from '../models/order.model';
import { LearningMaterial } from '../models/learningMaterial.model';
import { Logbook } from '../models/logbook.model';
import { Trip } from '../models/trip.model';
import { TransportOrder } from '../models/transportOrder.model';
import { EmergencyLog } from '../models/emergencyLog.model';

// Helper controller for CRUD operations
const genericCRUD = (Model: any) => ({
    getAll: async (req: Request, res: Response) => {
        try {
            const data = await Model.find();
            res.status(200).json(data);
        } catch (error: any) {
            res.status(500).json({ message: error.message });
        }
    },
    getById: async (req: Request, res: Response) => {
        try {
            const data = await Model.findById(req.params.id);
            if (!data) return res.status(404).json({ message: 'Not found' });
            res.status(200).json(data);
        } catch (error: any) {
            res.status(500).json({ message: error.message });
        }
    },
    create: async (req: Request, res: Response) => {
        try {
            const data = new Model(req.body);
            await data.save();
            res.status(201).json(data);
        } catch (error: any) {
            res.status(400).json({ message: error.message });
        }
    },
    update: async (req: Request, res: Response) => {
        try {
            const data = await Model.findByIdAndUpdate(req.params.id, req.body, { new: true });
            if (!data) return res.status(404).json({ message: 'Not found' });
            res.status(200).json(data);
        } catch (error: any) {
            res.status(400).json({ message: error.message });
        }
    },
    delete: async (req: Request, res: Response) => {
        try {
            const data = await Model.findByIdAndDelete(req.params.id);
            if (!data) return res.status(404).json({ message: 'Not found' });
            res.status(200).json({ message: 'Deleted successfully' });
        } catch (error: any) {
            res.status(500).json({ message: error.message });
        }
    }
});

// Exporting specific controllers
export const taskController = genericCRUD(Task);
export const activityController = genericCRUD(Activity);
export const clientController = genericCRUD(Client);
export const meetingController = genericCRUD(Meeting);
export const measurementController = genericCRUD(Measurement);
export const projectController = genericCRUD(Project);
export const deviceController = genericCRUD(Device);
export const repairController = genericCRUD(Repair);
export const teamController = genericCRUD(Team);
export const productController = genericCRUD(Product);
export const notificationController = genericCRUD(Notification);
export const inventoryController = genericCRUD(Inventory);
export const vehicleController = genericCRUD(Vehicle);
export const orderController = genericCRUD(Order);
export const learningMaterialController = genericCRUD(LearningMaterial);
export const logbookController = genericCRUD(Logbook);
export const tripController = genericCRUD(Trip);
export const transportOrderController = genericCRUD(TransportOrder);
export const emergencyLogController = genericCRUD(EmergencyLog);
