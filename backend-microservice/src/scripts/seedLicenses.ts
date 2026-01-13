import mongoose from 'mongoose';
import dotenv from 'dotenv';
import License from '../models/license.model';
import { User } from '../models/user.model';

dotenv.config();

const seedLicenses = async () => {
    try {
        await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/ivara_platform');

        console.log('Clearing existing licenses...');
        await License.deleteMany({});

        const users = await User.find({ role: { $in: ['provider', 'businessperson'] } }).limit(10);

        if (users.length === 0) {
            console.log('No eligible users found. Run seedUsers first.');
            return;
        }

        const licenses = [];
        const categories = ['technical-repair', 'creative-lifestyle', 'transport-travel', 'all'];
        const types = ['Individual', 'Business', 'Enterprise'];
        const statuses = ['active', 'active', 'active', 'expired', 'revoked', 'pending'];

        for (let i = 0; i < 20; i++) {
            const user = users[i % users.length];
            const startDate = new Date(Date.now() - Math.floor(Math.random() * 6 * 30 * 24 * 60 * 60 * 1000));
            const endDate = new Date(startDate);
            endDate.setFullYear(startDate.getFullYear() + 1);

            licenses.push({
                licenseKey: `LIC-${Math.random().toString(36).substr(2, 10).toUpperCase()}`,
                userId: user._id,
                userName: user.name || user.username,
                userEmail: user.email,
                category: categories[i % categories.length],
                type: types[i % types.length] as any,
                status: statuses[i % statuses.length] as any,
                startDate: startDate,
                endDate: endDate,
                lastVerified: new Date(),
                createdAt: startDate
            });
        }

        await License.insertMany(licenses);
        console.log('Successfully seeded 20 licenses!');

        process.exit();
    } catch (err) {
        console.error('Error seeding licenses:', err);
        process.exit(1);
    }
};

seedLicenses();
