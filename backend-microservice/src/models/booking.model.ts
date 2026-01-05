import mongoose, { Schema, Document } from 'mongoose';

export interface IBooking extends Document {
    name: string;
    email: string;
    phone: string;
    budget: string;
    details: string;
    createdAt: Date;
}

const BookingSchema: Schema = new Schema({
    name: { type: String, required: true },
    email: { type: String, required: true },
    phone: { type: String, required: true },
    budget: { type: String, required: true },
    details: { type: String },
}, { timestamps: true });

export default mongoose.model<IBooking>('Booking', BookingSchema);
