import mongoose from 'mongoose';
import { Subscription } from '../models/subscription.model';
import { User } from '../models/user.model';
import dotenv from 'dotenv';

dotenv.config();

const seed = async () => {
    try {
        const mongoUri = process.env.MONGODB_URI || 'mongodb://127.0.0.1:27017/ivara';
        await mongoose.connect(mongoUri);
        console.log('Connected to MongoDB');

        await Subscription.deleteMany({});
        console.log('Cleared existing subscriptions');

        const providers = await User.find({
            role: { $in: ['provider', 'businessperson', 'mechanic', 'technician'] },
            status: { $in: ['online', 'active', 'verified'] }
        });

        const plans = [
            { name: 'Basic', price: 10000 },
            { name: 'Standard', price: 25000 },
            { name: 'Premium', price: 50000 }
        ];

        const subs = providers.map(user => {
            const plan = plans[Math.floor(Math.random() * plans.length)];
            const startDate = new Date();
            startDate.setDate(startDate.getDate() - Math.floor(Math.random() * 60));
            const endDate = new Date(startDate);
            endDate.setMonth(endDate.getMonth() + 1);

            return {
                userId: user._id,
                userName: user.name || user.username,
                userEmail: user.email,
                plan: plan.name,
                price: plan.price,
                startDate,
                endDate,
                status: 'active'
            };
        });

        if (subs.length > 0) {
            await Subscription.insertMany(subs);
            console.log(`✅ Seeded ${subs.length} subscriptions`);
        } else {
            console.log('No eligible users found to seed subscriptions');
        }

        process.exit(0);
    } catch (err) {
        console.error(err);
        process.exit(1);
    }
};

seed();
