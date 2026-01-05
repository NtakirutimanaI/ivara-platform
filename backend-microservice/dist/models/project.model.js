"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Project = void 0;
const mongoose_1 = require("mongoose");
const ProjectSchema = new mongoose_1.Schema({
    name: { type: String, required: true },
    description: { type: String },
    client_id: { type: String, required: true },
    provider_id: { type: String, required: true },
    status: { type: String, enum: ['planned', 'in_progress', 'completed', 'on_hold'], default: 'planned' },
    start_date: { type: Date },
    end_date: { type: Date },
    budget: { type: Number, default: 0 },
}, { timestamps: true });
exports.Project = (0, mongoose_1.model)('Project', ProjectSchema);
