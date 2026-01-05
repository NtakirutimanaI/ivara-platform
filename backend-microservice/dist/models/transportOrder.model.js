"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.TransportOrder = void 0;
const mongoose_1 = require("mongoose");
const TransportOrderSchema = new mongoose_1.Schema({
    driver_id: { type: String, required: true },
    client_id: { type: String, required: true },
    pickup_location: { type: String, required: true },
    delivery_location: { type: String, required: true },
    item_description: { type: String, required: true },
    status: { type: String, enum: ['pending', 'picked_up', 'in_transit', 'delivered', 'cancelled'], default: 'pending' },
    delivery_fee: { type: Number, default: 0 },
    estimated_delivery_time: { type: Date },
}, { timestamps: true });
exports.TransportOrder = (0, mongoose_1.model)('TransportOrder', TransportOrderSchema);
