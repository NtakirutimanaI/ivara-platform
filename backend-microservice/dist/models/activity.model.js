"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Activity = void 0;
const mongoose_1 = require("mongoose");
const ActivitySchema = new mongoose_1.Schema({
    title: { type: String, required: true },
    description: { type: String, required: true },
    user_id: { type: String, required: true },
    status: { type: String, default: 'active' },
}, { timestamps: true });
exports.Activity = (0, mongoose_1.model)('Activity', ActivitySchema);
