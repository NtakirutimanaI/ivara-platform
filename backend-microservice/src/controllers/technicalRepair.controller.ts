// src/controllers/technicalRepair.controller.ts
import { Request, Response } from 'express';
import { TechnicalRepair } from '../models/technicalRepair.model';

export const getAllTechnicalRepairs = async (req: Request, res: Response) => {
    try {
        const items = await TechnicalRepair.find();
        res.json(items);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch technical repairs' });
    }
};

export const getTechnicalRepairById = async (req: Request, res: Response) => {
    try {
        const item = await TechnicalRepair.findById(req.params.id);
        if (!item) return res.status(404).json({ error: 'Not found' });
        res.json(item);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch technical repair' });
    }
};

export const createTechnicalRepair = async (req: Request, res: Response) => {
    try {
        const newItem = new TechnicalRepair(req.body);
        await newItem.save();
        res.status(201).json(newItem);
    } catch (err) {
        res.status(500).json({ error: 'Failed to create technical repair' });
    }
};

export const updateTechnicalRepair = async (req: Request, res: Response) => {
    try {
        const updated = await TechnicalRepair.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updated) return res.status(404).json({ error: 'Not found' });
        res.json(updated);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update technical repair' });
    }
};

export const deleteTechnicalRepair = async (req: Request, res: Response) => {
    try {
        const deleted = await TechnicalRepair.findByIdAndDelete(req.params.id);
        if (!deleted) return res.status(404).json({ error: 'Not found' });
        res.json({ message: 'Deleted' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete technical repair' });
    }
};
