import { Request, Response } from 'express';
import License from '../models/license.model';

export const getAllLicenses = async (req: Request, res: Response) => {
    try {
        const { page = 1, limit = 10, search = '', status = '', category = '' } = req.query;
        const query: any = {};

        if (search) {
            query.$or = [
                { licenseKey: { $regex: search, $options: 'i' } },
                { userName: { $regex: search, $options: 'i' } },
                { userEmail: { $regex: search, $options: 'i' } },
            ];
        }

        if (status) query.status = status;
        if (category && category !== 'all') query.category = category;

        const total = await License.countDocuments(query);
        const licenses = await License.find(query)
            .sort({ createdAt: -1 })
            .limit(Number(limit))
            .skip((Number(page) - 1) * Number(limit));

        res.json({
            licenses,
            pagination: {
                total,
                page: Number(page),
                limit: Number(limit),
                pages: Math.ceil(total / Number(limit))
            }
        });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch licenses' });
    }
};

export const getLicenseStats = async (req: Request, res: Response) => {
    try {
        const total = await License.countDocuments();
        const active = await License.countDocuments({ status: 'active' });
        const expired = await License.countDocuments({ status: 'expired' });
        const pending = await License.countDocuments({ status: 'pending' });

        // Expiring soon (within 30 days)
        const thirtyDaysFromNow = new Date();
        thirtyDaysFromNow.setDate(thirtyDaysFromNow.getDate() + 30);
        const expiringSoon = await License.countDocuments({
            status: 'active',
            endDate: { $lte: thirtyDaysFromNow, $gte: new Date() }
        });

        res.json({ total, active, expired, pending, expiringSoon });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch license stats' });
    }
};

export const createLicense = async (req: Request, res: Response) => {
    try {
        const license = new License(req.body);
        await license.save();
        res.status(201).json(license);
    } catch (err) {
        res.status(500).json({ error: 'Failed to create license' });
    }
};

export const updateLicense = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const license = await License.findByIdAndUpdate(id, req.body, { new: true });
        if (!license) return res.status(404).json({ error: 'License not found' });
        res.json(license);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update license' });
    }
};

export const deleteLicense = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const license = await License.findByIdAndDelete(id);
        if (!license) return res.status(404).json({ error: 'License not found' });
        res.json({ message: 'License deleted successfully' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete license' });
    }
};
