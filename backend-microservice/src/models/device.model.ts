import { Schema, model, Document } from 'mongoose';

export interface IDevice extends Document {
    user_id: string; // The user who registered it (could be technician or client)
    owner_id?: string; // If registered for a specific client account

    // Identity
    serial_number: string;
    device_type: string; // Phone, Computer, Fridge, etc.
    brand: string;
    device_model: string;
    color?: string;
    images: string[];

    // Repair Info (Optional if just registering ownership)
    problem_description?: string;
    repair_history: Array<{
        date: Date;
        technician_id: string;
        problem: string;
        solution: string;
        cost: number;
    }>;

    // Status & Security
    status: 'Active' | 'Under Repair' | 'Stolen' | 'Lost' | 'Sold';
    is_stolen: boolean;
    last_known_location?: {
        lat: number;
        lng: number;
        address?: string;
        timestamp: Date;
    };

    // Contact
    owner_name: string;
    contact_phone: string;

    // Meta
    purchase_date?: Date;
    warranty_expiry?: Date;
}

const DeviceSchema = new Schema<IDevice>({
    user_id: { type: String, required: true },
    owner_id: { type: String },

    serial_number: { type: String, required: true, unique: true, index: true },
    device_type: { type: String, required: true },
    brand: { type: String, required: true },
    device_model: { type: String, required: true },
    color: { type: String },
    images: [{ type: String }],

    problem_description: { type: String }, // Backward compatibility for simple repair
    repair_history: [{
        date: { type: Date, default: Date.now },
        technician_id: String,
        problem: String,
        solution: String,
        cost: Number
    }],

    status: {
        type: String,
        enum: ['Active', 'Under Repair', 'Stolen', 'Lost', 'Sold'],
        default: 'Active'
    },
    is_stolen: { type: Boolean, default: false },
    last_known_location: {
        lat: Number,
        lng: Number,
        address: String,
        timestamp: Date
    },

    owner_name: { type: String, required: true },
    contact_phone: { type: String, required: true },

    purchase_date: { type: Date },
    warranty_expiry: { type: Date }
}, { timestamps: true });

export const Device = model<IDevice>('Device', DeviceSchema);
