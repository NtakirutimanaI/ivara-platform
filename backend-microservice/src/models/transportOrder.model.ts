import { Schema, model, Document } from 'mongoose';

export interface ITransportOrder extends Document {
    driver_id: string;
    client_id: string;
    pickup_location: string;
    delivery_location: string;
    item_description: string;
    status: 'pending' | 'picked_up' | 'in_transit' | 'delivered' | 'cancelled';
    delivery_fee: number;
    estimated_delivery_time?: Date;
}

const TransportOrderSchema = new Schema<ITransportOrder>({
    driver_id: { type: String, required: true },
    client_id: { type: String, required: true },
    pickup_location: { type: String, required: true },
    delivery_location: { type: String, required: true },
    item_description: { type: String, required: true },
    status: { type: String, enum: ['pending', 'picked_up', 'in_transit', 'delivered', 'cancelled'], default: 'pending' },
    delivery_fee: { type: Number, default: 0 },
    estimated_delivery_time: { type: Date },
}, { timestamps: true });

export const TransportOrder = model<ITransportOrder>('TransportOrder', TransportOrderSchema);
