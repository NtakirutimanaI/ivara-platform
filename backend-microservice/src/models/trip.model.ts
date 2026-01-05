import { Schema, model, Document } from 'mongoose';

export interface ITrip extends Document {
    driver_id: string;
    client_id?: string;
    vehicle_id?: string;
    start_location: string;
    end_location: string;
    start_time: Date;
    end_time?: Date;
    distance?: number;
    fare: number;
    status: 'pending' | 'active' | 'completed' | 'cancelled';
    trip_type: 'taxi' | 'moto' | 'bus' | 'tour';
}

const TripSchema = new Schema<ITrip>({
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

export const Trip = model<ITrip>('Trip', TripSchema);
