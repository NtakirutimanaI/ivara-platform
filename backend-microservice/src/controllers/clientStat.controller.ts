import { Request, Response } from 'express';
import ClientStat from '../models/clientStat.model';

/**
 * Get all active client stats
 */
export const getClientStats = async (req: Request, res: Response) => {
    try {
        const stats = await ClientStat.find({ isActive: true }).sort({ order: 1 });

        res.status(200).json(stats);
    } catch (error) {
        res.status(500).json({ message: 'Error fetching client stats', error });
    }
};

/**
 * Create a new client stat (Admin only)
 */
export const createClientStat = async (req: Request, res: Response) => {
    try {
        const { icon, number, label, color, order } = req.body;

        if (!number || !label) {
            return res.status(400).json({ message: 'Number and label are required' });
        }

        const stat = new ClientStat({
            icon: icon || 'fa-chart-line',
            number,
            label,
            color: color || '#3b82f6',
            order: order || 0,
            isActive: true,
        });

        await stat.save();

        res.status(201).json({ message: 'Client stat created successfully', stat });
    } catch (error) {
        res.status(500).json({ message: 'Error creating client stat', error });
    }
};

/**
 * Update a client stat
 */
export const updateClientStat = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const updates = req.body;

        const stat = await ClientStat.findByIdAndUpdate(id, updates, { new: true });

        if (!stat) {
            return res.status(404).json({ message: 'Client stat not found' });
        }

        res.status(200).json({ message: 'Client stat updated successfully', stat });
    } catch (error) {
        res.status(500).json({ message: 'Error updating client stat', error });
    }
};

/**
 * Delete a client stat
 */
export const deleteClientStat = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;

        const stat = await ClientStat.findByIdAndDelete(id);

        if (!stat) {
            return res.status(404).json({ message: 'Client stat not found' });
        }

        res.status(200).json({ message: 'Client stat deleted successfully' });
    } catch (error) {
        res.status(500).json({ message: 'Error deleting client stat', error });
    }
};
