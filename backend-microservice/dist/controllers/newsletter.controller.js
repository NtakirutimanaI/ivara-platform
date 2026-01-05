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
exports.getAllSubscribers = exports.unsubscribeFromNewsletter = exports.subscribeToNewsletter = void 0;
const newsletter_model_1 = require("../models/newsletter.model");
const subscribeToNewsletter = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { email } = req.body;
        if (!email) {
            return res.status(400).json({
                success: false,
                message: 'Email is required'
            });
        }
        // Check if email already exists
        const existingSubscription = yield newsletter_model_1.NewsletterSubscription.findOne({ email: email.toLowerCase() });
        if (existingSubscription) {
            if (existingSubscription.isActive) {
                return res.status(400).json({
                    success: false,
                    message: 'This email is already subscribed to our newsletter'
                });
            }
            else {
                // Reactivate subscription
                existingSubscription.isActive = true;
                existingSubscription.subscribedAt = new Date();
                yield existingSubscription.save();
                return res.status(200).json({
                    success: true,
                    message: 'Welcome back! Your subscription has been reactivated.'
                });
            }
        }
        // Create new subscription
        const subscription = new newsletter_model_1.NewsletterSubscription({
            email: email.toLowerCase()
        });
        yield subscription.save();
        res.status(201).json({
            success: true,
            message: 'Successfully subscribed to newsletter!'
        });
    }
    catch (error) {
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
});
exports.subscribeToNewsletter = subscribeToNewsletter;
const unsubscribeFromNewsletter = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { email } = req.body;
        if (!email) {
            return res.status(400).json({
                success: false,
                message: 'Email is required'
            });
        }
        const subscription = yield newsletter_model_1.NewsletterSubscription.findOne({
            email: email.toLowerCase()
        });
        if (!subscription) {
            return res.status(404).json({
                success: false,
                message: 'Email not found in our subscription list'
            });
        }
        subscription.isActive = false;
        yield subscription.save();
        res.status(200).json({
            success: true,
            message: 'Successfully unsubscribed from newsletter'
        });
    }
    catch (error) {
        console.error('Newsletter unsubscribe error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to unsubscribe. Please try again later.'
        });
    }
});
exports.unsubscribeFromNewsletter = unsubscribeFromNewsletter;
const getAllSubscribers = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const subscribers = yield newsletter_model_1.NewsletterSubscription.find({ isActive: true })
            .select('email subscribedAt')
            .sort({ subscribedAt: -1 });
        res.status(200).json({
            success: true,
            count: subscribers.length,
            subscribers
        });
    }
    catch (error) {
        console.error('Get subscribers error:', error);
        res.status(500).json({
            success: false,
            message: 'Failed to retrieve subscribers'
        });
    }
});
exports.getAllSubscribers = getAllSubscribers;
