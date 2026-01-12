import mongoose from 'mongoose';
import dotenv from 'dotenv';
import { User } from '../models/user.model';
import { Product } from '../models/product.model';
import { Order } from '../models/order.model';

dotenv.config();

const ROLES = ['admin', 'manager', 'supervisor', 'mediator', 'client', 'businessperson'];
const CATEGORIES = ['technical', 'creative', 'transport', 'food-fashion', 'education', 'agriculture', 'media', 'legal', 'other'];

const seedSuperAdminData = async () => {
    try {
        const mongoUri = process.env.MONGODB_URI || 'mongodb://localhost:27017/ivara';
        await mongoose.connect(mongoUri);
        console.log('✅ Connected to MongoDB for Super Admin seeding');

        // 1. Seed Users (14 for each mgmt tier as required by frontend)
        console.log('👥 Seeding Users...');
        await User.deleteMany({ role: { $in: ['admin', 'manager', 'supervisor', 'mediator'] } });

        const users: any[] = [];

        // Add one main super_admin
        users.push({
            username: 'superadmin',
            password: 'password123',
            role: 'super_admin',
            name: 'System Controller',
            email: 'admin@ivara.com',
            status: 'online'
        });

        // Add 14 Admins, 14 Managers, 14 Supervisors
        ['admin', 'manager', 'supervisor'].forEach(role => {
            for (let i = 1; i <= 14; i++) {
                users.push({
                    username: `${role}${i}`,
                    password: 'password123',
                    role,
                    name: `${role.charAt(0).toUpperCase() + role.slice(1)} User ${i}`,
                    email: `${role}${i}@ivara.com`,
                    category: CATEGORIES[i % CATEGORIES.length],
                    status: i % 3 === 0 ? 'offline' : 'online',
                    phone: `078${Math.floor(Math.random() * 9000000 + 1000000)}`
                });
            }
        });

        // Add some mediators
        const mediators = [
            { name: 'Jean de Dieu', level: 1, earnings: 120000, clientsProvided: 8 },
            { name: 'Marie Claire', level: 2, earnings: 450000, clientsProvided: 32 },
            { name: 'Innocent K.', level: 3, earnings: 1250000, clientsProvided: 85 }
        ];

        mediators.forEach((m, i) => {
            users.push({
                username: `mediator${i + 1}`,
                password: 'password123',
                role: 'mediator',
                name: m.name,
                email: `mediator${i + 1}@ivara.com`,
                status: 'online',
                level: m.level,
                earnings: m.earnings,
                clientsProvided: m.clientsProvided,
                nextMilestone: m.level === 1 ? 20 : (m.level === 2 ? 50 : 100)
            });
        });

        const createdUsers = await User.insertMany(users);
        console.log(`✅ Seeded ${createdUsers.length} users`);

        // 2. Seed Products for Marketplace
        console.log('📦 Seeding Products...');
        await Product.deleteMany({});

        const products: any[] = [];
        const seller = createdUsers.find(u => u.role === 'admin')?._id;

        CATEGORIES.forEach((cat, idx) => {
            // Mix of statuses
            const statuses: ('Active' | 'Pending' | 'Rejected')[] = ['Active', 'Pending', 'Active', 'Rejected', 'Active'];
            const tiers: ('Basic' | 'Standard' | 'Premium')[] = ['Basic', 'Standard', 'Premium'];

            for (let i = 1; i <= 3; i++) {
                products.push({
                    name: `${cat.charAt(0).toUpperCase() + cat.slice(1)} Pro Pack ${i}`,
                    description: `High quality ${cat} services for professional needs. Trusted by thousands.`,
                    price: Math.floor(Math.random() * 50000 + 5000),
                    category: cat,
                    seller,
                    sellerName: 'Ivara Official',
                    status: statuses[Math.floor(Math.random() * statuses.length)],
                    tier: tiers[Math.floor(Math.random() * tiers.length)],
                    stockQuantity: Math.floor(Math.random() * 50),
                    images: [`https://placehold.co/400x300/4F46E5/FFF?text=${cat}+${i}`]
                });
            }
        });

        await Product.insertMany(products);
        console.log(`✅ Seeded ${products.length} products`);

        // 3. Seed some sample Orders for revenue stats
        console.log('💰 Seeding Orders...');
        await Order.deleteMany({});
        const sampleOrders = [];
        const client = createdUsers.find(u => u.role === 'client')?._id || createdUsers[0]._id;
        const sellerId = createdUsers.find(u => u.role === 'admin')?._id || createdUsers[0]._id;

        for (let i = 0; i < 20; i++) {
            sampleOrders.push({
                orderId: `ORD-${Date.now()}-${i}`,
                buyerId: client,
                sellerId: sellerId,
                items: [{
                    productId: new mongoose.Types.ObjectId(), // Virtual for seed
                    productName: 'Sample Product',
                    quantity: 1,
                    price: 15000,
                    subtotal: 15000
                }],
                totalAmount: Math.floor(Math.random() * 100000 + 10000),
                status: i % 5 === 0 ? 'Cancelled' : 'Delivered',
                paymentStatus: 'Paid',
                shippingAddress: {
                    fullName: 'Kizito Manzi',
                    phone: '0788111222',
                    addressLine1: 'KN 45 St, Kigali',
                    city: 'Kigali',
                    province: 'Kigali City',
                    country: 'Rwanda'
                }
            });
        }
        await Order.insertMany(sampleOrders);
        console.log(`✅ Seeded ${sampleOrders.length} orders`);

        console.log('🚀 Super Admin platform data synchronization complete!');
        process.exit(0);
    } catch (err) {
        console.error('❌ Data sync failed:', err);
        process.exit(1);
    }
};

seedSuperAdminData();
