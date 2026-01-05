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
exports.getMechanicDashboard = exports.getTechnicianDashboard = exports.getElectricianDashboard = exports.getBuilderDashboard = void 0;
const getBuilderDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    // Mock data matching the frontend design
    res.json({
        stats: {
            active_projects: 2,
            drafts_pending: 5,
            safety_score: 98,
            team_members: 14
        },
        projects: [
            { name: "Villa Renovation", status: "Active", progress: 45, phase: "Framing" },
            { name: "Commercial Block B", status: "Delayed", progress: 15, phase: "Foundation" }
        ],
        recent_activity: [
            { time: "09:00 AM", action: "Site Visit Logged", user: "John Doe" }
        ]
    });
});
exports.getBuilderDashboard = getBuilderDashboard;
const getElectricianDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    res.json({
        stats: {
            active_jobs: 4,
            week_earnings: 850,
            client_rating: 4.9,
            completed_month: 12
        },
        schedule: [
            { time: "09:00 AM", task: "Wiring Inspection", location: "123 Main St" },
            { time: "02:00 PM", task: "Panel Upgrade", location: "45 Office Park" }
        ]
    });
});
exports.getElectricianDashboard = getElectricianDashboard;
const getTechnicianDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    res.json({
        stats: {
            assigned_repairs: 8,
            avg_repair_time: "2h",
            first_fix_rate: 95,
            parts_requested: 14
        },
        repair_queue: [
            { ticket: "#4922", device: "iPhone 14", issue: "Screen", priority: "Urgent" },
            { ticket: "#4910", device: "Samsung S23", issue: "Battery", priority: "Wait" }
        ]
    });
});
exports.getTechnicianDashboard = getTechnicianDashboard;
const getMechanicDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    res.json({
        stats: {
            vehicles_in_bay: 3,
            pending_service: 5,
            daily_revenue: 1250,
            bookings_tomorrow: 8
        },
        bay_status: [
            { vehicle: "Toyota RAV4", service: "Oil Change", status: "In Progress" },
            { vehicle: "Ford Ranger", service: "Brake Pads", status: "Waiting Parts" }
        ]
    });
});
exports.getMechanicDashboard = getMechanicDashboard;
