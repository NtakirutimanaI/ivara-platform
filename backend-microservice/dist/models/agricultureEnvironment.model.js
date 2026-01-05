"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.AgricultureEnvironment = void 0;
// src/models/agricultureEnvironment.model.ts
const mongoose_1 = require("mongoose");
const AgricultureEnvironmentSchema = new mongoose_1.Schema({
    service_type: { type: String, required: true },
    land_size: { type: String, required: true },
    location: { type: String, required: true },
    season: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});
exports.AgricultureEnvironment = (0, mongoose_1.model)('AgricultureEnvironment', AgricultureEnvironmentSchema);
