import mongoose from 'mongoose';
import dotenv from 'dotenv';
import { Payment } from '../models/payment.model';
import { User } from '../models/user.model';
import { Subscription } from '../models/subscription.model';

dotenv.config();

const seedPayments = async () => {
    try {
        await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/ivara_platform');

        console.log('Clearing existing payments...');
        await Payment.deleteMany({});

        const users = await User.find({ role: { $in: ['provider', 'businessperson', 'customer'] } }).limit(10);
        const subscriptions = await Subscription.find().limit(5);

        if (users.length === 0) {
            console.log('No users found to seed payments. Run seedUsers first.');
            return;
        }

        const payments = [];
        const methods = ['Mobile Money', 'Bank Transfer', 'Credit Card'];
        const statuses = ['completed', 'completed', 'completed', 'failed', 'pending'];

        for (let i = 0; i < 20; i++) {
            const user = users[i % users.length];
            const amount = [10000, 25000, 50000][i % 3];
            const status = statuses[i % statuses.length] as any;
            const sub = subscriptions[i % subscriptions.length];

            payments.push({
                userId: user._id,
                userName: user.name || user.username,
                userEmail: user.email,
                amount: amount,
                paymentMethod: methods[i % methods.length],
                transactionId: `TRX-${Math.random().toString(36).substr(2, 9).toUpperCase()}`,
                status: status,
                subscriptionId: sub ? sub._id : undefined,
                accountType: user.role === 'businessperson' ? 'business' : 'individual',
                createdAt: new Date(Date.now() - Math.floor(Math.random() * 30 * 24 * 60 * 60 * 1000))
            });
        }

        await Payment.insertMany(payments);
        console.log('Successfully seeded 20 payments!');

        process.exit();
    } catch (err) {
        console.error('Error seeding payments:', err);
        process.exit(1);
    }
};

seedPayments();
