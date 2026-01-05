"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Task = void 0;
const mongoose_1 = require("mongoose");
const TaskSchema = new mongoose_1.Schema({
    title: { type: String, required: true },
    description: { type: String },
    status: { type: String, enum: ['pending', 'in_progress', 'completed'], default: 'pending' },
    user_id: { type: String },
    agent_id: { type: String },
    due_date: { type: Date },
    completed_at: { type: Date },
}, { timestamps: true });
exports.Task = (0, mongoose_1.model)('Task', TaskSchema);
