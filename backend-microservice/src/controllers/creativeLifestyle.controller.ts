// src/controllers/creativeLifestyle.controller.ts
import { Request, Response } from 'express';
import { CreativeLifestyle } from '../models/creativeLifestyle.model';

export const getAll = async (req: Request, res: Response) => {
    try {
        const items = await CreativeLifestyle.find();
        res.json(items);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch records' });
    }
};

export const getById = async (req: Request, res: Response) => {
    try {
        const item = await CreativeLifestyle.findById(req.params.id);
        if (!item) return res.status(404).json({ error: 'Not found' });
        res.json(item);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch record' });
    }
};

export const create = async (req: Request, res: Response) => {
    try {
        const newItem = new CreativeLifestyle(req.body);
        await newItem.save();
        res.status(201).json(newItem);
    } catch (err) {
        res.status(500).json({ error: 'Failed to create record' });
    }
};

export const update = async (req: Request, res: Response) => {
    try {
        const updated = await CreativeLifestyle.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updated) return res.status(404).json({ error: 'Not found' });
        res.json(updated);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update record' });
    }
};

export const remove = async (req: Request, res: Response) => {
    try {
        const deleted = await CreativeLifestyle.findByIdAndDelete(req.params.id);
        if (!deleted) return res.status(404).json({ error: 'Not found' });
        res.json({ message: 'Deleted' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete record' });
    }
};
