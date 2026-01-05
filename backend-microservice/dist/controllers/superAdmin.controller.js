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
exports.getPlatformOverview = void 0;
const user_model_1 = require("../models/user.model");
const order_model_1 = require("../models/order.model");
const getPlatformOverview = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const totalUsers = yield user_model_1.User.countDocuments();
        const adminCount = yield user_model_1.User.countDocuments({ role: 'admin' });
        const managerCount = yield user_model_1.User.countDocuments({ role: 'manager' });
        const supervisorCount = yield user_model_1.User.countDocuments({ role: 'supervisor' });
        const technicianCount = yield user_model_1.User.countDocuments({ role: { $in: ['technician', 'mechanic', 'electrician', 'tailor', 'mediator', 'craftsperson', 'builder', 'businessperson'] } });
        const totalOrders = yield order_model_1.Order.countDocuments();
        const revenueData = yield order_model_1.Order.aggregate([
            { $match: { status: { $ne: 'Cancelled' } } },
            { $group: { _id: null, total: { $sum: "$totalAmount" } } }
        ]);
        const totalRevenue = revenueData.length > 0 ? revenueData[0].total : 0;
        const roleCountsList = yield user_model_1.User.aggregate([
            { $group: { _id: "$role", total: { $sum: 1 } } }
        ]);
        const roleCounts = {};
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
    }
    catch (err) {
        console.error('Super admin overview error:', err);
        res.status(500).json({ error: 'Failed to fetch platform metrics' });
    }
});
exports.getPlatformOverview = getPlatformOverview;
