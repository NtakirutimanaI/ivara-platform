"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.TransportTravel = void 0;
// src/models/transportTravel.model.ts
const mongoose_1 = require("mongoose");
const TransportTravelSchema = new mongoose_1.Schema({
    service_type: { type: String, required: true },
    origin: { type: String, required: true },
    destination: { type: String, required: true },
    schedule: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});
exports.TransportTravel = (0, mongoose_1.model)('TransportTravel', TransportTravelSchema);
