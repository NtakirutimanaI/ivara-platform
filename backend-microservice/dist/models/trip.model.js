"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Trip = void 0;
const mongoose_1 = require("mongoose");
const TripSchema = new mongoose_1.Schema({
    driver_id: { type: String, required: true },
    client_id: { type: String },
    vehicle_id: { type: String },
    start_location: { type: String, required: true },
    end_location: { type: String, required: true },
    start_time: { type: Date, default: Date.now },
    end_time: { type: Date },
    distance: { type: Number },
    fare: { type: Number, default: 0 },
    status: { type: String, enum: ['pending', 'active', 'completed', 'cancelled'], default: 'pending' },
    trip_type: { type: String, enum: ['taxi', 'moto', 'bus', 'tour'], required: true },
}, { timestamps: true });
exports.Trip = (0, mongoose_1.model)('Trip', TripSchema);
