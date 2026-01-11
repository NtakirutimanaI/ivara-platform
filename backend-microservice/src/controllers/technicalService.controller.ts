import { Request, Response } from 'express';
import { TechnicalService } from '../models/technicalService.model';

export const getAllServices = async (req: Request, res: Response) => {
    try {
        const { search, status, category, limit, page } = req.query;
        const query: any = { category: category || 'technical-repair' };

        if (status) query.status = status;
        if (search) {
            query.$or = [
                { name: { $regex: search, $options: 'i' } },
                { description: { $regex: search, $options: 'i' } }
            ];
        }

        const pageSize = parseInt(limit as string) || 10;
        const currentPage = parseInt(page as string) || 1;
        const skip = (currentPage - 1) * pageSize;

        const total = await TechnicalService.countDocuments(query);
        const services = await TechnicalService.find(query)
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(pageSize)
            .lean();

        res.json({
            data: services,
            pagination: {
                total,
                page: currentPage,
                limit: pageSize,
                totalPages: Math.ceil(total / pageSize)
            }
        });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch services' });
    }
};

export const getServiceById = async (req: Request, res: Response) => {
    try {
        const service = await TechnicalService.findById(req.params.id);
        if (!service) return res.status(404).json({ error: 'Service not found' });
        res.json(service);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch service' });
    }
};

export const createService = async (req: Request, res: Response) => {
    try {
        const newService = new TechnicalService(req.body);
        await newService.save();
        res.status(201).json(newService);
    } catch (err) {
        res.status(500).json({ error: 'Failed to create service' });
    }
};

export const updateService = async (req: Request, res: Response) => {
    try {
        const updated = await TechnicalService.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updated) return res.status(404).json({ error: 'Service not found' });
        res.json(updated);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update service' });
    }
};

export const deleteService = async (req: Request, res: Response) => {
    try {
        const deleted = await TechnicalService.findByIdAndDelete(req.params.id);
        if (!deleted) return res.status(404).json({ error: 'Service not found' });
        res.json({ message: 'Service deleted successfully' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete service' });
    }
};
