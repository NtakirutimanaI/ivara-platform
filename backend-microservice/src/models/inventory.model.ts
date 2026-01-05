import { Schema, model, Document } from 'mongoose';

export interface IInventory extends Document {
    item_name: string;
    description?: string;
    quantity: number;
    unit_price: number;
    category: string;
    supplier?: string;
    last_restocked?: Date;
}

const InventorySchema = new Schema<IInventory>({
    item_name: { type: String, required: true },
    description: { type: String },
    quantity: { type: Number, default: 0 },
    unit_price: { type: Number, default: 0 },
    category: { type: String, required: true },
    supplier: { type: String },
    last_restocked: { type: Date },
}, { timestamps: true });

export const Inventory = model<IInventory>('Inventory', InventorySchema);
