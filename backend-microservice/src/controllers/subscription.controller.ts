import { Request, Response } from 'express';
import { Subscription } from '../models/subscription.model';
import { User } from '../models/user.model';

export const getAllSubscriptions = async (req: Request, res: Response) => {
    try {
        const page = parseInt(req.query.page as string) || 1;
        const limit = parseInt(req.query.limit as string) || 10;
        const search = req.query.search as string || '';
        const skip = (page - 1) * limit;

        const query: any = {};
        if (search) {
            query.$or = [
                { userName: { $regex: search, $options: 'i' } },
                { userEmail: { $regex: search, $options: 'i' } },
                { plan: { $regex: search, $options: 'i' } }
            ];
        }

        const total = await Subscription.countDocuments(query);
        const subscriptions = await Subscription.find(query)
            .sort({ createdAt: -1 })
            .skip(skip)
            .limit(limit);

        res.json({
            subscriptions,
            pagination: {
                total,
                page,
                limit,
                pages: Math.ceil(total / limit)
            }
        });
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch subscriptions' });
    }
};

export const createSubscription = async (req: Request, res: Response) => {
    try {
        const { userEmail, plan, price, startDate, endDate, status } = req.body;

        // Find user by email to link
        const user = await User.findOne({ email: userEmail });
        if (!user) {
            return res.status(404).json({ error: 'User not found with this email' });
        }

        const newSub = new Subscription({
            userId: user._id,
            userName: user.name || user.username,
            userEmail: user.email,
            plan,
            price,
            startDate: startDate || new Date(),
            endDate,
            status: status || 'active'
        });

        await newSub.save();
        res.status(201).json(newSub);
    } catch (err) {
        res.status(500).json({ error: 'Failed to create subscription' });
    }
};

export const updateSubscriptionStatus = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const { status } = req.body;

        const sub = await Subscription.findByIdAndUpdate(id, { status }, { new: true });
        if (!sub) return res.status(404).json({ error: 'Subscription not found' });

        res.json(sub);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update status' });
    }
};

export const deleteSubscription = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        await Subscription.findByIdAndDelete(id);
        res.json({ message: 'Subscription deleted' });
    } catch (err) {
        res.status(500).json({ error: 'Failed to delete subscription' });
    }
};

export const updateSubscription = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const updates = req.body;
        const sub = await Subscription.findByIdAndUpdate(id, updates, { new: true });
        res.json(sub);
    } catch (err) {
        res.status(500).json({ error: 'Failed to update subscription' });
    }
};
