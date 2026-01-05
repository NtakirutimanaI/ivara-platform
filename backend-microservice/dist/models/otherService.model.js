"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.OtherService = void 0;
// src/models/otherService.model.ts
const mongoose_1 = require("mongoose");
const OtherServiceSchema = new mongoose_1.Schema({
    service_type: { type: String, required: true },
    description: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});
exports.OtherService = (0, mongoose_1.model)('OtherService', OtherServiceSchema);
