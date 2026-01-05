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
exports.getTechnicianSchedule = exports.getTechnicianBookings = exports.getTechnicianInventory = exports.getTechnicianWorkOrders = exports.getTechnicianJobs = exports.getTechnicianDashboard = void 0;
const technicalRepair_model_1 = require("../models/technicalRepair.model");
const inventory_model_1 = require("../models/inventory.model");
const meeting_model_1 = require("../models/meeting.model");
const task_model_1 = require("../models/task.model");
// Full dashboard data endpoint
const getTechnicianDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    var _a, _b, _c, _d, _e, _f;
    try {
        // Count repairs
        const repairsCount = (yield technicalRepair_model_1.TechnicalRepair.countDocuments({})) || 0;
        // Get inventory stats
        const inventoryStats = yield inventory_model_1.Inventory.aggregate([
            {
                $group: {
                    _id: null,
                    total: { $sum: 1 },
                    lowStock: { $sum: { $cond: [{ $lte: ['$quantity', 5] }, 1, 0] } },
                    outOfStock: { $sum: { $cond: [{ $eq: ['$quantity', 0] }, 1, 0] } }
                }
            }
        ]);
        // Get repair queue (latest 5)
        const repairQueue = yield technicalRepair_model_1.TechnicalRepair.find()
            .sort({ createdAt: -1 })
            .limit(5)
            .lean();
        // Get today's schedule (meetings)
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        const schedule = yield meeting_model_1.Meeting.find({
            date: { $gte: today, $lt: tomorrow }
        }).sort({ date: 1 }).limit(4).lean();
        // Mock data for demo (replace with real calculations)
        const stats = {
            repairs: repairsCount || 8,
            avg_time: '2.4h',
            first_fix: '96%',
            parts_requested: ((_a = inventoryStats[0]) === null || _a === void 0 ? void 0 : _a.lowStock) || 14,
            rating: '4.9',
            repairs_trend: 12,
            time_trend: -8,
            fix_trend: 3
        };
        const repair_queue = repairQueue.length > 0 ? repairQueue.map((r) => ({
            id: r._id,
            device: r.deviceName || 'Device',
            issue: r.problemDescription || 'Issue',
            client: r.clientName || 'Client',
            priority: r.priority || 'Normal',
            time_ago: getTimeAgo(r.createdAt)
        })) : [
            { id: '1', device: 'iPhone 14 Pro', issue: 'Screen Replacement', client: 'John Doe', priority: 'Urgent', time_ago: '45 min ago' },
            { id: '2', device: 'Samsung S23 Ultra', issue: 'Battery Swap', client: 'Alice Kim', priority: 'High', time_ago: '2h ago' },
            { id: '3', device: 'MacBook Pro 16"', issue: 'Thermal Repaste', client: 'Mark Chen', priority: 'Normal', time_ago: 'Yesterday' },
            { id: '4', device: 'iPad Air', issue: 'Screen Crack', client: 'Sarah Lee', priority: 'Normal', time_ago: '2 days ago' }
        ];
        const scheduleData = schedule.length > 0 ? schedule.map((s, i) => ({
            time: new Date(s.date).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false }),
            meridiem: new Date(s.date).getHours() >= 12 ? 'PM' : 'AM',
            type: s.type || 'Meeting',
            title: s.title || s.subject || 'Scheduled Task',
            location: s.location || 'Shop'
        })) : [
            { time: '09:00', meridiem: 'AM', type: 'Site Visit', title: 'Corporate Office Maintenance', location: 'Kigali Heights' },
            { time: '11:30', meridiem: 'AM', type: 'Remote', title: 'VPN Router Config', location: 'Video Call' },
            { time: '14:00', meridiem: 'PM', type: 'In-Shop', title: 'Laptop Screen Replacement', location: 'Workshop' }
        ];
        const recent_payments = [
            { client: 'Sarah Johnson', service: 'Screen Repair', amount: 45000 },
            { client: 'Tech Solutions Ltd', service: 'Bulk Maintenance', amount: 180000 },
            { client: 'Paul Mugabo', service: 'Battery Replacement', amount: 35000 }
        ];
        const chart_data = {
            weekly_repairs: [
                { label: 'Mon', value: 5 },
                { label: 'Tue', value: 8 },
                { label: 'Wed', value: 6 },
                { label: 'Thu', value: 9 },
                { label: 'Fri', value: 7 },
                { label: 'Sat', value: 4 },
                { label: 'Sun', value: 3 }
            ],
            parts_status: {
                in_stock: ((_b = inventoryStats[0]) === null || _b === void 0 ? void 0 : _b.total) - ((_c = inventoryStats[0]) === null || _c === void 0 ? void 0 : _c.lowStock) || 20,
                low_stock: ((_d = inventoryStats[0]) === null || _d === void 0 ? void 0 : _d.lowStock) - ((_e = inventoryStats[0]) === null || _e === void 0 ? void 0 : _e.outOfStock) || 8,
                out_of_stock: ((_f = inventoryStats[0]) === null || _f === void 0 ? void 0 : _f.outOfStock) || 3
            },
            performance: [
                { label: 'Mon', value: 4 },
                { label: 'Tue', value: 6 },
                { label: 'Wed', value: 5 },
                { label: 'Thu', value: 8 },
                { label: 'Fri', value: 7 }
            ]
        };
        res.json({
            stats,
            repair_queue,
            schedule: scheduleData,
            recent_payments,
            learning_progress: 65,
            community_count: 1240,
            chart_data
        });
    }
    catch (err) {
        console.error('Dashboard error:', err);
        res.status(500).json({ error: 'Failed to load dashboard data' });
    }
});
exports.getTechnicianDashboard = getTechnicianDashboard;
// Helper function
function getTimeAgo(date) {
    if (!date)
        return 'Just now';
    const now = new Date();
    const diff = now.getTime() - new Date(date).getTime();
    const mins = Math.floor(diff / 60000);
    if (mins < 60)
        return `${mins} min ago`;
    const hours = Math.floor(mins / 60);
    if (hours < 24)
        return `${hours}h ago`;
    const days = Math.floor(hours / 24);
    if (days === 1)
        return 'Yesterday';
    return `${days} days ago`;
}
// Jobs endpoint
const getTechnicianJobs = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const jobs = yield technicalRepair_model_1.TechnicalRepair.find()
            .sort({ createdAt: -1 })
            .limit(20)
            .lean();
        if (jobs.length === 0) {
            // Return seed data if no jobs exist
            return res.json([
                { _id: '1', deviceName: 'iPhone 14 Pro', problemDescription: 'Screen cracked', priority: 'Urgent', status: 'In Progress' },
                { _id: '2', deviceName: 'Samsung S23', problemDescription: 'Battery draining', priority: 'High', status: 'Pending' },
                { _id: '3', deviceName: 'MacBook Pro', problemDescription: 'Overheating', priority: 'Normal', status: 'Queued' }
            ]);
        }
        res.json(jobs);
    }
    catch (err) {
        console.error(err);
        res.status(500).json({ error: 'Failed to fetch jobs' });
    }
});
exports.getTechnicianJobs = getTechnicianJobs;
// Work orders endpoint
const getTechnicianWorkOrders = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const workOrders = yield task_model_1.Task.find({ type: 'work_order' }).sort({ createdAt: -1 }).limit(20).lean();
        if (workOrders.length === 0) {
            return res.json([
                { _id: '1', title: 'WO-001 Screen Replacement', client: 'John Doe', status: 'Open', progress: 30 },
                { _id: '2', title: 'WO-002 Battery Swap', client: 'Alice Kim', status: 'In Progress', progress: 60 },
                { _id: '3', title: 'WO-003 Motherboard Repair', client: 'Tech Corp', status: 'Completed', progress: 100 }
            ]);
        }
        res.json(workOrders);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch work orders' });
    }
});
exports.getTechnicianWorkOrders = getTechnicianWorkOrders;
// Inventory endpoint
const getTechnicianInventory = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const inventory = yield inventory_model_1.Inventory.find().sort({ quantity: 1 }).limit(30).lean();
        if (inventory.length === 0) {
            return res.json([
                { _id: '1', name: 'iPhone 14 Pro OLED Screen', sku: 'IP14P-OLED', quantity: 2, category: 'Screens' },
                { _id: '2', name: 'Samsung S23 Battery', sku: 'SS23-BAT', quantity: 8, category: 'Batteries' },
                { _id: '3', name: 'Thermal Paste Arctic MX-5', sku: 'TP-AMX5', quantity: 15, category: 'Supplies' },
                { _id: '4', name: 'USB-C Charging Port', sku: 'USBC-PORT', quantity: 25, category: 'Parts' }
            ]);
        }
        res.json(inventory);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch inventory' });
    }
});
exports.getTechnicianInventory = getTechnicianInventory;
// Bookings endpoint
const getTechnicianBookings = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const bookings = yield meeting_model_1.Meeting.find().sort({ date: 1 }).limit(10).lean();
        if (bookings.length === 0) {
            return res.json([
                { _id: '1', client: 'Michael Smith', date: new Date(), type: 'Site Visit', notes: 'Water damage diagnostic' },
                { _id: '2', client: 'Emma Wilson', date: new Date(Date.now() + 3600000), type: 'Remote', notes: 'Software troubleshooting' },
                { _id: '3', client: 'James Brown', date: new Date(Date.now() + 7200000), type: 'In-Shop', notes: 'Device pickup' }
            ]);
        }
        res.json(bookings);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch bookings' });
    }
});
exports.getTechnicianBookings = getTechnicianBookings;
// Schedule endpoint
const getTechnicianSchedule = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const endOfWeek = new Date(today);
        endOfWeek.setDate(endOfWeek.getDate() + 7);
        const schedule = yield meeting_model_1.Meeting.find({
            date: { $gte: today, $lt: endOfWeek }
        }).sort({ date: 1 }).lean();
        if (schedule.length === 0) {
            return res.json([
                { _id: '1', title: 'Corporate Office Maintenance', date: new Date(), type: 'Site Visit', location: 'Kigali Heights' },
                { _id: '2', title: 'VPN Router Configuration', date: new Date(Date.now() + 9000000), type: 'Remote', location: 'Video Call' },
                { _id: '3', title: 'Laptop Screen Replacement', date: new Date(Date.now() + 18000000), type: 'In-Shop', location: 'Workshop' }
            ]);
        }
        res.json(schedule);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch schedule' });
    }
});
exports.getTechnicianSchedule = getTechnicianSchedule;
