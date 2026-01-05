"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.FoodEventsFashion = void 0;
// src/models/foodEventsFashion.model.ts
const mongoose_1 = require("mongoose");
const FoodEventsFashionSchema = new mongoose_1.Schema({
    service_type: { type: String, required: true },
    event_date: { type: String, required: true },
    location: { type: String, required: true },
    price: { type: Number, required: true },
    vendor_id: { type: String, required: true },
});
exports.FoodEventsFashion = (0, mongoose_1.model)('FoodEventsFashion', FoodEventsFashionSchema);
