"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Meeting = void 0;
const mongoose_1 = require("mongoose");
const MeetingSchema = new mongoose_1.Schema({
    title: { type: String, required: true },
    description: { type: String },
    date: { type: Date, required: true },
    host_id: { type: String, required: true },
    attendees: [{ type: String }],
    location: { type: String },
    status: { type: String, enum: ['scheduled', 'cancelled', 'completed'], default: 'scheduled' },
}, { timestamps: true });
exports.Meeting = (0, mongoose_1.model)('Meeting', MeetingSchema);
