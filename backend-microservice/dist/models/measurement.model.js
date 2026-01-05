"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Measurement = void 0;
const mongoose_1 = require("mongoose");
const MeasurementSchema = new mongoose_1.Schema({
    client_id: { type: String, required: true },
    tailor_id: { type: String, required: true },
    item_type: { type: String, required: true },
    details: { type: mongoose_1.Schema.Types.Mixed, required: true },
    notes: { type: String },
}, { timestamps: true });
exports.Measurement = (0, mongoose_1.model)('Measurement', MeasurementSchema);
