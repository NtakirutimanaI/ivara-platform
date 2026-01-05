"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.CreativeLifestyle = void 0;
// src/models/creativeLifestyle.model.ts
const mongoose_1 = require("mongoose");
const CreativeLifestyleSchema = new mongoose_1.Schema({
    service_type: { type: String, required: true },
    duration: { type: String, required: true },
    location: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});
exports.CreativeLifestyle = (0, mongoose_1.model)('CreativeLifestyle', CreativeLifestyleSchema);
