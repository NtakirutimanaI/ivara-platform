"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.getActivities = exports.createActivity = void 0;
const activity_model_1 = require("../models/activity.model");
const createActivity = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        const { message, icon, type } = req.body;
        // User ID comes fro middleware if authenticated
        const userId = ((_a = req.user) === null || _a === void 0 ? void 0 : _a.userId) || 'system';
        const activity = new activity_model_1.Activity({
            title: message, // Mapping 'message' to 'title' as per schema? Or schema has 'description'?
            // Schema has: title, description, user_id, status
            // Request usually sends: message, icon
            // Let's adapt.
            description: message,
            user_id: userId,
            status: 'active'
        });
        // If we want to store icon, the schema needs update. 
        // For now, ignoring icon or storing in description/title?
        // Let's actually update the schema if needed, but for now I'll just save what fits.
        // Wait, schema has 'title' required.
        activity.title = type || 'Activity';
        yield activity.save();
        res.status(201).json(activity);
    }
    catch (err) {
        console.error('Create activity error:', err);
        res.status(500).json({ error: 'Failed to create activity' });
    }
});
exports.createActivity = createActivity;
const getActivities = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const activities = yield activity_model_1.Activity.find().sort({ createdAt: -1 }).limit(20);
        res.json(activities);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch activities' });
    }
});
exports.getActivities = getActivities;
