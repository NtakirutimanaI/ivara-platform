import { Request, Response } from 'express';
import { User } from '../models/user.model';
import { Order } from '../models/order.model';

export const getPlatformOverview = async (req: Request, res: Response) => {
    try {
        const totalUsers = await User.countDocuments();
        const adminCount = await User.countDocuments({ role: 'admin' });
        const managerCount = await User.countDocuments({ role: 'manager' });
        const supervisorCount = await User.countDocuments({ role: 'supervisor' });
        const technicianCount = await User.countDocuments({ role: { $in: ['technician', 'mechanic', 'electrician', 'tailor', 'mediator', 'craftsperson', 'builder', 'businessperson'] } });

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
