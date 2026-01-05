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
exports.updateSettings = exports.getSettings = void 0;
const setting_model_1 = require("../models/setting.model");
// Get all settings as a key-value object
const getSettings = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const settings = yield setting_model_1.Setting.find();
        const settingsMap = {};
        settings.forEach(s => {
            settingsMap[s.key] = s.value;
        });
        res.json(settingsMap);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch settings' });
    }
});
exports.getSettings = getSettings;
// Update or create settings
const updateSettings = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const updates = req.body; // Expecting { key: value, key2: value2 }
        const promises = Object.keys(updates).map((key) => __awaiter(void 0, void 0, void 0, function* () {
            return setting_model_1.Setting.findOneAndUpdate({ key }, { key, value: updates[key] }, { upsert: true, new: true });
        }));
        yield Promise.all(promises);
        res.json({ message: 'Settings updated successfully' });
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to update settings' });
    }
});
exports.updateSettings = updateSettings;
