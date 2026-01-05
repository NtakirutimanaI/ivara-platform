"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Device = void 0;
const mongoose_1 = require("mongoose");
const DeviceSchema = new mongoose_1.Schema({
    user_id: { type: String, required: true },
    device_type: { type: String, required: true },
    device_name: { type: String, required: true },
    serial_number: { type: String, required: true, unique: true },
    brand: { type: String, required: true },
    device_model: { type: String, required: true },
    operating_system: { type: String },
    device_owner: { type: String, required: true },
    contact_number: { type: String, required: true },
    received_date: { type: Date, default: Date.now },
    warranty_status: { type: String },
    problem_description: { type: String, required: true },
    solved_problems: { type: String },
    recommendations: { type: String },
    technician: { type: String },
    estimated_cost: { type: Number, default: 0 },
    repair_status: { type: String, default: 'Pending' },
    assigned_technician_id: { type: String },
}, { timestamps: true });
exports.Device = (0, mongoose_1.model)('Device', DeviceSchema);
