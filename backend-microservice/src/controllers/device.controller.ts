import { Request, Response } from 'express';
import { Device } from '../models/device.model';

// Register a new device (Asset Registration)
export const registerDevice = async (req: Request, res: Response) => {
    try {
        const {
            user_id, owner_id, owner_name, contact_phone,
            serial_number, device_type, brand, device_model, color,
            problem_description, images
        } = req.body;

        // Check if device with Serial Number exists
        const existingDevice = await Device.findOne({ serial_number });
        if (existingDevice) {
            return res.status(400).json({ success: false, message: 'Device with this Serial Number already registered' });
        }

        const newDevice = new Device({
            user_id,
            owner_id: owner_id || user_id, // Default to registrant if owner not specified
            serial_number,
            device_type,
            brand,
            device_model,
            color,
            images: images || [],
            problem_description,
            owner_name,
            contact_phone,
            status: 'Active',
            is_stolen: false
        });

        await newDevice.save();

        res.status(201).json({ success: true, message: 'Device registered successfully', data: newDevice });
    } catch (error: any) {
        console.error('Register Device Error:', error);
        res.status(500).json({ success: false, message: 'Failed to register device', error: error.message });
    }
};

// Get devices for a specific user (My Devices)
export const getUserDevices = async (req: Request, res: Response) => {
    try {
        const { userId } = req.params;
        // Find devices where user is the registrant OR the owner
        const devices = await Device.find({
            $or: [{ user_id: userId }, { owner_id: userId }]
        }).sort({ createdAt: -1 });

        res.json({ success: true, data: devices });
    } catch (error) {
        res.status(500).json({ success: false, message: 'Failed to fetch devices' });
    }
};

// Update Device Status (e.g., Report Stolen)
export const updateDeviceStatus = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const { status, is_stolen, location } = req.body;

        const device = await Device.findById(id);
        if (!device) {
            return res.status(404).json({ success: false, message: 'Device not found' });
        }

        // Update fields if provided
        if (status) device.status = status;
        if (typeof is_stolen === 'boolean') device.is_stolen = is_stolen;

        if (location) {
            device.last_known_location = {
                lat: location.lat,
                lng: location.lng,
                address: location.address,
                timestamp: new Date()
            };
        }

        await device.save();

        res.json({ success: true, message: 'Device status updated', data: device });
    } catch (error) {
        res.status(500).json({ success: false, message: 'Failed to update status' });
    }
};

// Get Device by Serial Number (for Tracking/Lookup)
export const getDeviceBySerial = async (req: Request, res: Response) => {
    try {
        const { serial } = req.params;
        const device = await Device.findOne({ serial_number: serial });

        if (!device) {
            return res.status(404).json({ success: false, message: 'Device not found' });
        }

        res.json({ success: true, data: device });
    } catch (error) {
        res.status(500).json({ success: false, message: 'Failed to look up device' });
    }
};
