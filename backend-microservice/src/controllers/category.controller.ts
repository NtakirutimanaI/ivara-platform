// src/controllers/category.controller.ts
import { Request, Response } from 'express';
import { Category } from '../models/category.model';

export const getAllCategories = async (req: Request, res: Response) => {
    try {
        const categories = await Category.find();
        res.json(categories);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch categories' });
    }
};

export const getCategoryById = async (req: Request, res: Response) => {
    try {
        const category = await Category.findById(req.params.id);
        if (!category) return res.status(404).json({ error: 'Category not found' });
        res.json(category);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch category' });
    }
};

export const createCategory = async (req: Request, res: Response) => {
    try {
        const { name, description } = req.body;
        const newCategory = new Category({ name, description });
        await newCategory.save();
        res.status(201).json(newCategory);
    } catch (err) {
        res.status(500).json({ error: 'Failed to create category' });
    }
};

export const updateCategory = async (req: Request, res: Response) => {
    try {
        const updated = await Category.findByIdAndUpdate(
            req.params.id,
            req.body,
            { new: true }
        );
        if (!updated) return res.status(404).json({ error: 'Category not found' });
        res.json(updated);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update category' });
    }
};

export const deleteCategory = async (req: Request, res: Response) => {
    try {
        const deleted = await Category.findByIdAndDelete(req.params.id);
        if (!deleted) return res.status(404).json({ error: 'Category not found' });
        res.json({ message: 'Category deleted' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete category' });
    }
};
