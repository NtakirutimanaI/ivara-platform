import { Request, Response } from 'express';
import { User } from '../models/user.model';
import fs from 'fs';
import path from 'path';
import bcrypt from 'bcryptjs';

export const getProfile = async (req: Request, res: Response) => {
    try {
        const userId = (req as any).user.id;
        const user = await User.findById(userId).select('-password');
        if (!user) return res.status(404).json({ error: 'User not found' });
        res.json(user);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch profile' });
    }
};

export const updateProfile = async (req: Request, res: Response) => {
    try {
        const userId = (req as any).user.id;
        const { name, email, phone, address } = req.body;

        const updateData: any = {};
        if (name) updateData.name = name;
        if (email) updateData.email = email;
        if (phone) updateData.phone = phone;
        if (address) updateData.address = address;

        if (req.file) {
            // Find old user to delete old photo
            const oldUser = await User.findById(userId);
            if (oldUser?.profilePhoto) {
                // Ensure the path is correct relative to process.cwd()
                const oldPath = path.resolve(process.cwd(), oldUser.profilePhoto);
                if (fs.existsSync(oldPath)) {
                    fs.unlinkSync(oldPath);
                }
            }
            // Use only the path from uploads/ filename
            // req.file.path might include 'uploads/'
            updateData.profilePhoto = req.file.path.replace(/\\/g, '/');
        }

        const user = await User.findByIdAndUpdate(userId, updateData, { new: true }).select('-password');
        res.json(user);
    } catch (err) {
        console.error('Update profile error:', err);
        res.status(500).json({ error: 'Failed to update profile' });
    }
};

export const changePassword = async (req: Request, res: Response) => {
    try {
        const userId = (req as any).user.id;
        const { currentPassword, newPassword } = req.body;

        const user = await User.findById(userId);
        if (!user) return res.status(404).json({ error: 'User not found' });

        const isMatch = await bcrypt.compare(currentPassword, user.password);
        if (!isMatch) {
            return res.status(400).json({ error: 'Incorrect current password' });
        }

        user.password = await bcrypt.hash(newPassword, 10);
        await user.save();

        res.json({ message: 'Password updated successfully' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to update password' });
    }
};

export const deleteAccount = async (req: Request, res: Response) => {
    try {
        const userId = (req as any).user.id;
        const { password } = req.body;

        const user = await User.findById(userId);
        if (!user) return res.status(404).json({ error: 'User not found' });

        const isMatch = await bcrypt.compare(password, user.password);
        if (!isMatch) {
            return res.status(400).json({ error: 'Incorrect password' });
        }

        await User.findByIdAndDelete(userId);
        res.json({ message: 'Account deleted successfully' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete account' });
    }
};
