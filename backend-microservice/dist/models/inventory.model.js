"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Inventory = void 0;
const mongoose_1 = require("mongoose");
const InventorySchema = new mongoose_1.Schema({
    item_name: { type: String, required: true },
    description: { type: String },
    quantity: { type: Number, default: 0 },
    unit_price: { type: Number, default: 0 },
    category: { type: String, required: true },
    supplier: { type: String },
    last_restocked: { type: Date },
}, { timestamps: true });
exports.Inventory = (0, mongoose_1.model)('Inventory', InventorySchema);
