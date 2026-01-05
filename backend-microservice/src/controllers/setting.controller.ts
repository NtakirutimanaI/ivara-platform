import { Request, Response } from 'express';
import { Setting } from '../models/setting.model';

// Get all settings as a key-value object
export const getSettings = async (req: Request, res: Response) => {
    try {
        const settings = await Setting.find();
        const settingsMap: Record<string, any> = {};

        settings.forEach(s => {
            settingsMap[s.key] = s.value;
        });

        res.json(settingsMap);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch settings' });
    }
};

// Update or create settings
export const updateSettings = async (req: Request, res: Response) => {
    try {
        const updates = req.body; // Expecting { key: value, key2: value2 }

        const promises = Object.keys(updates).map(async (key) => {
            return Setting.findOneAndUpdate(
                { key },
                { key, value: updates[key] },
                { upsert: true, new: true }
            );
        });

        await Promise.all(promises);

        res.json({ message: 'Settings updated successfully' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to update settings' });
    }
};
