"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Logbook = void 0;
const mongoose_1 = require("mongoose");
const LogbookSchema = new mongoose_1.Schema({
    user_id: { type: String, required: true },
    date: { type: Date, required: true, default: Date.now },
    activity_details: { type: String, required: true },
    hours_spent: { type: Number, required: true },
    supervisor_feedback: { type: String },
    status: { type: String, enum: ['pending', 'approved', 'rejected'], default: 'pending' },
}, { timestamps: true });
exports.Logbook = (0, mongoose_1.model)('Logbook', LogbookSchema);
