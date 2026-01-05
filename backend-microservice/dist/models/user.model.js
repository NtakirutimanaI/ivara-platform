"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.User = void 0;
// src/models/user.model.ts
const mongoose_1 = require("mongoose");
const UserSchema = new mongoose_1.Schema({
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
exports.User = (0, mongoose_1.model)('User', UserSchema);
