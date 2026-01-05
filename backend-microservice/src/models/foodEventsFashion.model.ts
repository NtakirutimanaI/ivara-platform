// src/models/foodEventsFashion.model.ts
import { Schema, model, Document } from 'mongoose';

export interface IFoodEventsFashion extends Document {
    service_type: string;
    event_date: string;
    location: string;
    price: number;
    vendor_id: string;
}

const FoodEventsFashionSchema = new Schema<IFoodEventsFashion>({
    service_type: { type: String, required: true },
    event_date: { type: String, required: true },
    location: { type: String, required: true },
    price: { type: Number, required: true },
    vendor_id: { type: String, required: true },
});

export const FoodEventsFashion = model<IFoodEventsFashion>('FoodEventsFashion', FoodEventsFashionSchema);
