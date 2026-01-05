"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.Team = void 0;
const mongoose_1 = require("mongoose");
const TeamSchema = new mongoose_1.Schema({
    full_name: { type: String, required: true },
    position: { type: String, required: true },
    contact: { type: String },
    email: { type: String },
    image: { type: String },
    social_links: {
        facebook: { type: String },
        twitter: { type: String },
        linkedin: { type: String },
        instagram: { type: String },
    },
    status: { type: String, default: 'active' },
}, { timestamps: true });
exports.Team = (0, mongoose_1.model)('Team', TeamSchema);
