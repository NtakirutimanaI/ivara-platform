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
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.deleteClientStat = exports.updateClientStat = exports.createClientStat = exports.getClientStats = void 0;
const clientStat_model_1 = __importDefault(require("../models/clientStat.model"));
/**
 * Get all active client stats
 */
const getClientStats = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const stats = yield clientStat_model_1.default.find({ isActive: true }).sort({ order: 1 });
        res.status(200).json(stats);
    }
    catch (error) {
        res.status(500).json({ message: 'Error fetching client stats', error });
    }
});
exports.getClientStats = getClientStats;
/**
 * Create a new client stat (Admin only)
 */
const createClientStat = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { icon, number, label, color, order } = req.body;
        if (!number || !label) {
            return res.status(400).json({ message: 'Number and label are required' });
        }
        const stat = new clientStat_model_1.default({
            icon: icon || 'fa-chart-line',
            number,
            label,
            color: color || '#3b82f6',
            order: order || 0,
            isActive: true,
        });
        yield stat.save();
        res.status(201).json({ message: 'Client stat created successfully', stat });
    }
    catch (error) {
        res.status(500).json({ message: 'Error creating client stat', error });
    }
});
exports.createClientStat = createClientStat;
/**
 * Update a client stat
 */
const updateClientStat = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const updates = req.body;
        const stat = yield clientStat_model_1.default.findByIdAndUpdate(id, updates, { new: true });
        if (!stat) {
            return res.status(404).json({ message: 'Client stat not found' });
        }
        res.status(200).json({ message: 'Client stat updated successfully', stat });
    }
    catch (error) {
        res.status(500).json({ message: 'Error updating client stat', error });
    }
});
exports.updateClientStat = updateClientStat;
/**
 * Delete a client stat
 */
const deleteClientStat = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { id } = req.params;
        const stat = yield clientStat_model_1.default.findByIdAndDelete(id);
        if (!stat) {
            return res.status(404).json({ message: 'Client stat not found' });
        }
        res.status(200).json({ message: 'Client stat deleted successfully' });
    }
    catch (error) {
        res.status(500).json({ message: 'Error deleting client stat', error });
    }
});
exports.deleteClientStat = deleteClientStat;
