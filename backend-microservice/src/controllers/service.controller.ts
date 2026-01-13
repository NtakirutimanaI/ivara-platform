import { Request, Response } from 'express';
import Service from '../models/service.model';

export const getAllServices = async (req: Request, res: Response) => {
    try {
        const { page = 1, limit = 10, search = '', category = '', status = '' } = req.query;
        const query: any = {};

        if (search) {
            query.name = { $regex: search, $options: 'i' };
        }
        if (category) query.category = category;
        if (status) query.status = status;

        const total = await Service.countDocuments(query);
        const services = await Service.find(query)
            .sort({ createdAt: -1 })
            .limit(Number(limit))
            .skip((Number(page) - 1) * Number(limit));

        res.json({
            services,
            pagination: {
                total,
                page: Number(page),
                limit: Number(limit),
                pages: Math.ceil(total / Number(limit))
            }
        });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch services' });
    }
};

export const getServiceStats = async (req: Request, res: Response) => {
    try {
        const total = await Service.countDocuments();
        const active = await Service.countDocuments({ status: 'active' });
        const review = await Service.countDocuments({ status: 'review' });

        // Average base price
        const avgPriceResult = await Service.aggregate([
            { $group: { _id: null, avgPrice: { $avg: "$basePrice" } } }
        ]);
        const avgPrice = avgPriceResult.length > 0 ? Math.round(avgPriceResult[0].avgPrice) : 0;

        res.json({ total, active, review, avgPrice });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch service stats' });
    }
};

export const createService = async (req: Request, res: Response) => {
    try {
        const service = new Service(req.body);
        await service.save();
        res.status(201).json(service);
    } catch (err) {
        res.status(500).json({ error: 'Failed to create service' });
    }
};

export const updateService = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const service = await Service.findByIdAndUpdate(id, req.body, { new: true });
        if (!service) return res.status(404).json({ error: 'Service not found' });
        res.json(service);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update service' });
    }
};

export const deleteService = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const service = await Service.findByIdAndDelete(id);
        if (!service) return res.status(404).json({ error: 'Service not found' });
        res.json({ message: 'Service deleted successfully' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete service' });
    }
};
