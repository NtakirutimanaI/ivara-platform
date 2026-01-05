"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Repair = void 0;
const mongoose_1 = require("mongoose");
const RepairSchema = new mongoose_1.Schema({
    device_id: { type: String, required: true },
    device_name: { type: String, required: true },
    problem_description: { type: String, required: true },
    repair_status: { type: String, default: 'Pending' },
    technician_id: { type: String },
    received_date: { type: Date, default: Date.now },
    completed_date: { type: Date },
    cost: { type: Number, default: 0 },
}, { timestamps: true });
exports.Repair = (0, mongoose_1.model)('Repair', RepairSchema);
