import { Request, Response } from 'express';
import { User } from '../models/user.model';
import { Order } from '../models/order.model';
import { Product } from '../models/product.model';
import { Subscription } from '../models/subscription.model';

export const getPlatformOverview = async (req: Request, res: Response) => {
    try {
        const totalUsers = await User.countDocuments();
        const adminCount = await User.countDocuments({ role: 'admin' });
        const managerCount = await User.countDocuments({ role: 'manager' });
        const supervisorCount = await User.countDocuments({ role: 'supervisor' });
        const technicianCount = await User.countDocuments({ role: { $in: ['technician', 'mechanic', 'electrician', 'tailor', 'mediator', 'craftsperson', 'builder', 'businessperson'] } });

        const onlineAdmins = await User.countDocuments({ role: 'admin', status: 'online' });
        const onlineManagers = await User.countDocuments({ role: 'manager', status: 'online' });
        const onlineSupervisors = await User.countDocuments({ role: 'supervisor', status: 'online' });
        const clientCount = await User.countDocuments({ role: { $in: ['client', 'Client'] } });
        const pendingVerifications = await User.countDocuments({ status: { $in: ['pending', 'inactive'] } });

        const totalOrders = await Order.countDocuments();
        const revenueData = await Order.aggregate([
            { $match: { status: { $ne: 'Cancelled' } } },
            { $group: { _id: null, total: { $sum: "$totalAmount" } } }
        ]);
        const totalRevenue = revenueData.length > 0 ? revenueData[0].total : 0;

        const roleCountsList = await User.aggregate([
            { $group: { _id: "$role", total: { $sum: 1 } } }
        ]);

        const roleCounts: { [key: string]: number } = {};
        roleCountsList.forEach(item => {
            roleCounts[item._id] = item.total;
        });

        res.json({
            platformStats: {
                totalUsers,
                totalAdmins: adminCount,
                totalManagers: managerCount,
                totalSupervisors: supervisorCount,
                totalProviders: technicianCount,
                totalClients: clientCount,
                onlineAdmins,
                onlineManagers,
                onlineSupervisors,
                pendingVerifications,
                totalOrders,
                totalRevenue,
                activeCategories: 9
            },
            roleCounts,
            recentPlatformEvents: [
                { event: "System Access", details: "Super Admin accessed dashboard", time: new Date().toLocaleTimeString() },
                { event: "Inventory Sync", details: "Marketplace data refreshed", time: "Just now" },
                { event: "Platform Health", details: "All microservices operational", time: "Stable" }
            ]
        });
    } catch (err) {
        console.error('Super admin overview error:', err);
        res.status(500).json({ error: 'Failed to fetch platform metrics' });
    }
};

export const getAllUsers = async (req: Request, res: Response) => {
    try {
        const users = await User.find().select('-password').sort({ createdAt: -1 });
        res.json(users);
    } catch (err) {
        console.error('Fetch all users error:', err);
        res.status(500).json({ error: 'Failed to fetch users' });
    }
};

export const updateUser = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const updates = req.body;

        // Prevent password update through this endpoint for safety
        delete updates.password;

        const user = await User.findByIdAndUpdate(id, updates, { new: true }).select('-password');

        if (!user) {
            return res.status(404).json({ error: 'User not found' });
        }

        res.json(user);
    } catch (err) {
        console.error('Update user error:', err);
        res.status(500).json({ error: 'Failed to update user' });
    }
};

export const deleteUser = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const user = await User.findByIdAndDelete(id);

        if (!user) {
            return res.status(404).json({ error: 'User not found' });
        }

        res.json({ message: 'User deleted successfully' });
    } catch (err) {
        console.error('Delete user error:', err);
        res.status(500).json({ error: 'Failed to delete user' });
    }
};

export const getPerformanceMatrix = async (req: Request, res: Response) => {
    try {
        // Fetch relevant roles
        const admins = await User.find({ role: 'admin' }).select('-password');
        const managers = await User.find({ role: 'manager' }).select('-password');
        const supervisors = await User.find({ role: 'supervisor' }).select('-password');

        // Helper to add mock stats
        const addStats = (user: any) => {
            return {
                ...user.toObject(),
                score: Math.floor(Math.random() * (100 - 70 + 1)) + 70, // 70-100
                tasks: Math.floor(Math.random() * 200) + 20,
                efficiency: Math.floor(Math.random() * (100 - 80 + 1)) + 80,
                teamControlled: Math.floor(Math.random() * 20) + 1
            };
        };

        res.json({
            admins: admins.map(addStats),
            managers: managers.map(addStats),
            supervisors: supervisors.map(addStats)
        });
    } catch (err) {
        console.error('Performance matrix error:', err);
        res.status(500).json({ error: 'Failed to fetch performance data' });
    }
};

export const addReview = async (req: Request, res: Response) => {
    try {
        const { userId, content, rating } = req.body;

        const user = await User.findByIdAndUpdate(userId, {
            $set: {
                performanceReview: {
                    content,
                    rating,
                    timestamp: new Date()
                }
            }
        }, { new: true });

        if (!user) {
            return res.status(404).json({ error: 'User not found' });
        }

        res.json({ message: 'Review added successfully', review: { content, rating } });
    } catch (err) {
        console.error('Add review error:', err);
        res.status(500).json({ error: 'Failed to submit review' });
    }
};

export const getMarketplaceData = async (req: Request, res: Response) => {
    try {
        const products = await Product.find().sort({ createdAt: -1 });
        const mediators = await User.find({ role: 'mediator' }).select('-password');

        const stats = {
            totalListings: await Product.countDocuments(),
            pendingApprovals: await Product.countDocuments({ status: 'Pending' }),
            verifiedSellers: await User.countDocuments({ role: { $in: ['businessperson', 'craftsperson'] }, isVerified: true }),
            platformRevenue: 1250000 // Mock platform revenue for now
        };

        const plans = [
            { id: 1, name: 'Basic', price: 10000, color: 'basic', features: ['5 Listings', 'Standard Support', 'Basic Analytics'] },
            { id: 2, name: 'Standard', price: 25000, color: 'standard', features: ['20 Listings', 'Priority Support', 'Advanced Analytics', 'Featured Badges'] },
            { id: 3, name: 'Premium', price: 50000, color: 'premium', features: ['Unlimited Listings', 'Dedicated Manager', 'API Access', 'Global Reach'] }
        ];

        res.json({
            stats,
            products,
            plans,
            mediators
        });
    } catch (err) {
        console.error('Marketplace data error:', err);
        res.status(500).json({ error: 'Failed to fetch marketplace data' });
    }
};

export const moderateProduct = async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const { action } = req.body; // 'approve', 'reject', 'delete'

        if (action === 'delete') {
            await Product.findByIdAndDelete(id);
            return res.json({ message: 'Product deleted successfully' });
        }

        const status = action === 'approve' ? 'Active' : 'Rejected';
        const product = await Product.findByIdAndUpdate(id, { status }, { new: true });

        if (!product) {
            return res.status(404).json({ error: 'Product not found' });
        }

        res.json({ message: `Product ${status.toLowerCase()}ed successfully`, product });
    } catch (err) {
        console.error('Moderate product error:', err);
        res.status(500).json({ error: 'Failed to moderate product' });
    }
};

export const getRoles = async (req: Request, res: Response) => {
    try {
        const roles = [
            {
                id: 0,
                name: 'Super Admin',
                slug: 'super_admin',
                users_count: 1,
                permissions: ['Full Access', 'System Settings', 'Security Hub'],
                badge: 'System',
                color: '#ef4444',
                description: 'Full system access, including security and global configurations.'
            },
            {
                id: 1,
                name: 'Admin',
                slug: 'admin',
                users_count: await User.countDocuments({ role: 'admin' }),
                permissions: ['View Analytics', 'Manage Users', 'System Settings'],
                badge: 'Management',
                color: '#f59e0b',
                description: 'Manages platform categories, staff assignments, and high-level reports.'
            },
            {
                id: 2,
                name: 'Manager',
                slug: 'manager',
                users_count: await User.countDocuments({ role: 'manager' }),
                permissions: ['Moderate Content', 'Support Chat', 'Basic Reports'],
                badge: 'Ops',
                color: '#3b82f6',
                description: 'Oversees service sectors and manages regional supervisor teams.'
            },
            {
                id: 3,
                name: 'Supervisor',
                slug: 'supervisor',
                users_count: await User.countDocuments({ role: 'supervisor' }),
                permissions: ['View Listings', 'Approve Requests'],
                badge: 'Field',
                color: '#10b981',
                description: 'On-the-ground verification of tasks and quality assurance.'
            },
            {
                id: 4,
                name: 'Provider',
                slug: 'provider',
                users_count: await User.countDocuments({ role: 'provider' }),
                permissions: ['Self Management', 'Manage Services', 'Receive Payouts'],
                badge: 'Partner',
                color: '#8b5cf6',
                description: 'Professional service entities fulfilling platform requests.'
            },
            {
                id: 5,
                name: 'Client',
                slug: 'client',
                users_count: await User.countDocuments({ role: 'client' }),
                permissions: ['Purchase Products', 'View History', 'Chat Providers'],
                badge: 'User',
                color: '#6366f1',
                description: 'End users who request and consume services via the platform.'
            },
            {
                id: 6,
                name: 'Mediator',
                slug: 'mediator',
                users_count: await User.countDocuments({ role: 'mediator' }),
                permissions: ['Referral Network', 'Tier Tracking'],
                badge: 'Incentive',
                color: '#ec4899',
                description: 'Earn rewards by connecting clients to the platform.'
            }
        ];
        res.json(roles);
    } catch (err) {
        console.error('Fetch roles error:', err);
        res.status(500).json({ error: 'Failed to fetch roles' });
    }
};
export const getActiveSubscriptions = async (req: Request, res: Response) => {
    try {
        // Find users who likely have subscriptions (Providers, Businesspersons)
        // In a real app, we'd look up a Subscriptions collection.
        // Here, we simulate it by finding relevant users and attaching plan info.
        const subscribedUsers = await User.find({
            role: { $in: ['provider', 'businessperson', 'mechanic', 'technician'] },
            status: { $in: ['online', 'active', 'verified'] } // Assuming active users
        }).limit(50);

        const plans = ['Basic', 'Standard', 'Premium'];
        const prices = { 'Basic': 10000, 'Standard': 25000, 'Premium': 50000 };

        const subscriptions = subscribedUsers.map(user => {
            // Deterministic random plan based on user ID length or char code to keep it consistent-ish
            const planIndex = (user._id.toString().charCodeAt(0) + user._id.toString().charCodeAt(user._id.toString().length - 1)) % 3;
            const planName = plans[planIndex];

            // Random start date within last 30 days
            const startDate = new Date();
            startDate.setDate(startDate.getDate() - Math.floor(Math.random() * 30));

            // End date is start date + 30 days
            const endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + 30);

            return {
                id: user._id,
                user: {
                    name: user.name || user.username,
                    email: user.email,
                    avatar: user.profilePhoto
                },
                plan: planName,
                price: prices[planName as keyof typeof prices],
                start_date: startDate.toISOString(),
                end_date: endDate.toISOString(),
                status: 'Active'
            };
        });

        res.json(subscriptions);
    } catch (err) {
        console.error('Fetch active subscriptions error:', err);
        res.status(500).json({ error: 'Failed to fetch subscriptions' });
    }
};
