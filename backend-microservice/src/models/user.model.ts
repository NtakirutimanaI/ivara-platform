// src/models/user.model.ts
import { Schema, model, Document } from 'mongoose';

export interface IUser extends Document {
    username: string;
    password: string;
    role: string;
    name?: string;
    email?: string;
    phone?: string;
    address?: string;
    profilePhoto?: string;
    category?: string;
}

const UserSchema = new Schema<IUser>({
    username: { type: String, required: true, unique: true },
    password: { type: String, required: true },
    role: { type: String, required: true }, // Relaxed enum for easier migration
    name: { type: String },
    email: { type: String, sparse: true, unique: true }, // sparse allows multiple nulls if email not provided initially
    phone: { type: String },
    address: { type: String },
    profilePhoto: { type: String },
    category: { type: String },
});

export const User = model<IUser>('User', UserSchema);
