import { Schema, model, Document } from 'mongoose';

export interface IVehicle extends Document {
    user_id: string;
    make: string;
    vehicle_model: string;
    year: number;
    license_plate: string;
    vin?: string;
    color?: string;
    mileage?: number;
    owner_name: string;
    contact_number: string;
    status: string;
}

const VehicleSchema = new Schema<IVehicle>({
    user_id: { type: String, required: true },
    make: { type: String, required: true },
    vehicle_model: { type: String, required: true },
    year: { type: Number, required: true },
    license_plate: { type: String, required: true, unique: true },
    vin: { type: String },
    color: { type: String },
    mileage: { type: Number },
    owner_name: { type: String, required: true },
    contact_number: { type: String, required: true },
    status: { type: String, default: 'active' },
}, { timestamps: true });

export const Vehicle = model<IVehicle>('Vehicle', VehicleSchema);
