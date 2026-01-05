"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.TechnicalRepair = void 0;
// src/models/technicalRepair.model.ts
const mongoose_1 = require("mongoose");
const TechnicalRepairSchema = new mongoose_1.Schema({
    service_type: { type: String, required: true },
    device_type: { type: String, required: true },
    issue_description: { type: String, required: true },
    status: { type: String, required: true },
    price: { type: Number, required: true },
    technician_id: { type: String, required: true },
});
exports.TechnicalRepair = (0, mongoose_1.model)('TechnicalRepair', TechnicalRepairSchema);
