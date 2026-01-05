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
Object.defineProperty(exports, "__esModule", { value: true });
exports.deleteCategory = exports.updateCategory = exports.createCategory = exports.getCategoryById = exports.getAllCategories = void 0;
const category_model_1 = require("../models/category.model");
const getAllCategories = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const categories = yield category_model_1.Category.find();
        res.json(categories);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch categories' });
    }
});
exports.getAllCategories = getAllCategories;
const getCategoryById = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const category = yield category_model_1.Category.findById(req.params.id);
        if (!category)
            return res.status(404).json({ error: 'Category not found' });
        res.json(category);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch category' });
    }
});
exports.getCategoryById = getCategoryById;
const createCategory = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { name, description } = req.body;
        const newCategory = new category_model_1.Category({ name, description });
        yield newCategory.save();
        res.status(201).json(newCategory);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to create category' });
    }
});
exports.createCategory = createCategory;
const updateCategory = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const updated = yield category_model_1.Category.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updated)
            return res.status(404).json({ error: 'Category not found' });
        res.json(updated);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to update category' });
    }
});
exports.updateCategory = updateCategory;
const deleteCategory = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const deleted = yield category_model_1.Category.findByIdAndDelete(req.params.id);
        if (!deleted)
            return res.status(404).json({ error: 'Category not found' });
        res.json({ message: 'Category deleted' });
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to delete category' });
    }
});
exports.deleteCategory = deleteCategory;
