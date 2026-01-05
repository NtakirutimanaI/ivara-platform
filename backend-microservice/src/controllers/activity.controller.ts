
import { Request, Response } from 'express';
import { Activity } from '../models/activity.model';

export const createActivity = async (req: Request, res: Response) => {
    try {
        const { message, icon, type } = req.body;
        // User ID comes fro middleware if authenticated
        const userId = (req as any).user?.userId || 'system';

        const activity = new Activity({
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

        await activity.save();
        res.status(201).json(activity);
    } catch (err: any) {
        console.error('Create activity error:', err);
        res.status(500).json({ error: 'Failed to create activity' });
    }
};

export const getActivities = async (req: Request, res: Response) => {
    try {
        const activities = await Activity.find().sort({ createdAt: -1 }).limit(20);
        res.json(activities);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch activities' });
    }
};
