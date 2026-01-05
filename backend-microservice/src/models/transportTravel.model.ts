// src/models/transportTravel.model.ts
import { Schema, model, Document } from 'mongoose';

export interface ITransportTravel extends Document {
    service_type: string;
    origin: string;
    destination: string;
    schedule: string;
    price: number;
    provider_id: string;
}

const TransportTravelSchema = new Schema<ITransportTravel>({
    service_type: { type: String, required: true },
    origin: { type: String, required: true },
    destination: { type: String, required: true },
    schedule: { type: String, required: true },
    price: { type: Number, required: true },
    provider_id: { type: String, required: true },
});

export const TransportTravel = model<ITransportTravel>('TransportTravel', TransportTravelSchema);
