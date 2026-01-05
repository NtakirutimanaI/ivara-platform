"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Client = void 0;
const mongoose_1 = require("mongoose");
const ClientSchema = new mongoose_1.Schema({
    name: { type: String, required: true },
    email: { type: String, unique: true, sparse: true },
    phone: { type: String },
    address: { type: String },
    mediator_id: { type: String },
    status: { type: String, enum: ['active', 'inactive'], default: 'active' },
}, { timestamps: true });
exports.Client = (0, mongoose_1.model)('Client', ClientSchema);
