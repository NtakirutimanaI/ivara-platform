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
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.deleteAccount = exports.changePassword = exports.updateProfile = exports.getProfile = void 0;
const user_model_1 = require("../models/user.model");
const fs_1 = __importDefault(require("fs"));
const path_1 = __importDefault(require("path"));
const bcryptjs_1 = __importDefault(require("bcryptjs"));
const getProfile = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const userId = req.user.id;
        const user = yield user_model_1.User.findById(userId).select('-password');
        if (!user)
            return res.status(404).json({ error: 'User not found' });
        res.json(user);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch profile' });
    }
});
exports.getProfile = getProfile;
const updateProfile = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const userId = req.user.id;
        const { name, email, phone, address } = req.body;
        const updateData = {};
        if (name)
            updateData.name = name;
        if (email)
            updateData.email = email;
        if (phone)
            updateData.phone = phone;
        if (address)
            updateData.address = address;
        if (req.file) {
            // Find old user to delete old photo
            const oldUser = yield user_model_1.User.findById(userId);
            if (oldUser === null || oldUser === void 0 ? void 0 : oldUser.profilePhoto) {
                // Ensure the path is correct relative to process.cwd()
                const oldPath = path_1.default.resolve(process.cwd(), oldUser.profilePhoto);
                if (fs_1.default.existsSync(oldPath)) {
                    fs_1.default.unlinkSync(oldPath);
                }
            }
            // Use only the path from uploads/ filename
            // req.file.path might include 'uploads/'
            updateData.profilePhoto = req.file.path.replace(/\\/g, '/');
        }
        const user = yield user_model_1.User.findByIdAndUpdate(userId, updateData, { new: true }).select('-password');
        res.json(user);
    }
    catch (err) {
        console.error('Update profile error:', err);
        res.status(500).json({ error: 'Failed to update profile' });
    }
});
exports.updateProfile = updateProfile;
const changePassword = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const userId = req.user.id;
        const { currentPassword, newPassword } = req.body;
        const user = yield user_model_1.User.findById(userId);
        if (!user)
            return res.status(404).json({ error: 'User not found' });
        const isMatch = yield bcryptjs_1.default.compare(currentPassword, user.password);
        if (!isMatch) {
            return res.status(400).json({ error: 'Incorrect current password' });
        }
        user.password = yield bcryptjs_1.default.hash(newPassword, 10);
        yield user.save();
        res.json({ message: 'Password updated successfully' });
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to update password' });
    }
});
exports.changePassword = changePassword;
const deleteAccount = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const userId = req.user.id;
        const { password } = req.body;
        const user = yield user_model_1.User.findById(userId);
        if (!user)
            return res.status(404).json({ error: 'User not found' });
        const isMatch = yield bcryptjs_1.default.compare(password, user.password);
        if (!isMatch) {
            return res.status(400).json({ error: 'Incorrect password' });
        }
        yield user_model_1.User.findByIdAndDelete(userId);
        res.json({ message: 'Account deleted successfully' });
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to delete account' });
    }
});
exports.deleteAccount = deleteAccount;
