import { Request, Response } from 'express';
import { NewsletterSubscription } from '../models/newsletter.model';

export const subscribeToNewsletter = async (req: Request, res: Response) => {
    try {
        const { email } = req.body;

        if (!email) {
            return res.status(400).json({
                success: false,
                message: 'Email is required'
            });
        }

        // Check if email already exists
        const existingSubscription = await NewsletterSubscription.findOne({ email: email.toLowerCase() });

        if (existingSubscription) {
            if (existingSubscription.isActive) {
                return res.status(400).json({
                    success: false,
                    message: 'This email is already subscribed to our newsletter'
                });
            } else {
                // Reactivate subscription
                existingSubscription.isActive = true;
                existingSubscription.subscribedAt = new Date();
                await existingSubscription.save();

                return res.status(200).json({
                    success: true,
                    message: 'Welcome back! Your subscription has been reactivated.'
                });
            }
        }

        // Create new subscription
        const subscription = new NewsletterSubscription({
            email: email.toLowerCase()
        });

        await subscription.save();

        res.status(201).json({
            success: true,
            message: 'Successfully subscribed to newsletter!'
        });
    } catch (error: any) {
        console.error('Newsletter subscription error:', error);

        if (error.code === 11000) {
            return res.status(400).json({
                success: false,
                message: 'This email is already subscribed'
            });
        }

        res.status(500).json({
            success: false,
            message: 'Failed to subscribe. Please try again later.'
        });
    }
};

export const unsubscribeFromNewsletter = async (req: Request, res: Response) => {
    try {
        const { email } = req.body;

        if (!email) {
            return res.status(400).json({
                success: false,
                message: 'Email is required'
            });
        }

        const subscription = await NewsletterSubscription.findOne({
            email: email.toLowerCase()
        });

        if (!subscription) {
            return res.status(404).json({
                success: false,
                message: 'Email not found in our subscription list'
            });
        }

        subscription.isActive = false;
        await subscription.save();

        res.status(200).json({
            success: true,
            message: 'Successfully unsubscribed from newsletter'
        });
    } catch (error) {
        console.error('Newsletter unsubscribe error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to unsubscribe. Please try again later.'
        });
    }
};

export const getAllSubscribers = async (req: Request, res: Response) => {
    try {
        const subscribers = await NewsletterSubscription.find({ isActive: true })
            .select('email subscribedAt')
            .sort({ subscribedAt: -1 });

        res.status(200).json({
            success: true,
            count: subscribers.length,
            subscribers
        });
    } catch (error) {
        console.error('Get subscribers error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to retrieve subscribers'
        });
    }
};
