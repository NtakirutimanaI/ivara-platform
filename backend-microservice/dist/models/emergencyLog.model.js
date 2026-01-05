"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.EmergencyLog = void 0;
const mongoose_1 = require("mongoose");
const EmergencyLogSchema = new mongoose_1.Schema({
    driver_id: { type: String, required: true },
    incident_type: { type: String, required: true },
    location: { type: String, required: true },
    priority: { type: String, enum: ['low', 'medium', 'high', 'critical'], default: 'medium' },
    status: { type: String, enum: ['dispatched', 'at_scene', 'transporting', 'completed'], default: 'dispatched' },
    notes: { type: String },
}, { timestamps: true });
exports.EmergencyLog = (0, mongoose_1.model)('EmergencyLog', EmergencyLogSchema);
