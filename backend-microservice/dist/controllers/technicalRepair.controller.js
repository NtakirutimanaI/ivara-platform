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
exports.deleteTechnicalRepair = exports.updateTechnicalRepair = exports.createTechnicalRepair = exports.getTechnicalRepairById = exports.getAllTechnicalRepairs = void 0;
const technicalRepair_model_1 = require("../models/technicalRepair.model");
const getAllTechnicalRepairs = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const items = yield technicalRepair_model_1.TechnicalRepair.find();
        res.json(items);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch technical repairs' });
    }
});
exports.getAllTechnicalRepairs = getAllTechnicalRepairs;
const getTechnicalRepairById = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const item = yield technicalRepair_model_1.TechnicalRepair.findById(req.params.id);
        if (!item)
            return res.status(404).json({ error: 'Not found' });
        res.json(item);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch technical repair' });
    }
});
exports.getTechnicalRepairById = getTechnicalRepairById;
const createTechnicalRepair = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const newItem = new technicalRepair_model_1.TechnicalRepair(req.body);
        yield newItem.save();
        res.status(201).json(newItem);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to create technical repair' });
    }
});
exports.createTechnicalRepair = createTechnicalRepair;
const updateTechnicalRepair = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const updated = yield technicalRepair_model_1.TechnicalRepair.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updated)
            return res.status(404).json({ error: 'Not found' });
        res.json(updated);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to update technical repair' });
    }
});
exports.updateTechnicalRepair = updateTechnicalRepair;
const deleteTechnicalRepair = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const deleted = yield technicalRepair_model_1.TechnicalRepair.findByIdAndDelete(req.params.id);
        if (!deleted)
            return res.status(404).json({ error: 'Not found' });
        res.json({ message: 'Deleted' });
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to delete technical repair' });
    }
});
exports.deleteTechnicalRepair = deleteTechnicalRepair;
