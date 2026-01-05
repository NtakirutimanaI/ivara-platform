"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Vehicle = void 0;
const mongoose_1 = require("mongoose");
const VehicleSchema = new mongoose_1.Schema({
    user_id: { type: String, required: true },
    make: { type: String, required: true },
    vehicle_model: { type: String, required: true },
    year: { type: Number, required: true },
    license_plate: { type: String, required: true, unique: true },
    vin: { type: String },
    color: { type: String },
    mileage: { type: Number },
    owner_name: { type: String, required: true },
    contact_number: { type: String, required: true },
    status: { type: String, default: 'active' },
}, { timestamps: true });
exports.Vehicle = (0, mongoose_1.model)('Vehicle', VehicleSchema);
