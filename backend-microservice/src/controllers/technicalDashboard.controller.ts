import { Request, Response } from 'express';

export const getBuilderDashboard = async (req: Request, res: Response) => {
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
};

export const getElectricianDashboard = async (req: Request, res: Response) => {
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
};

export const getTechnicianDashboard = async (req: Request, res: Response) => {
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
};

export const getMechanicDashboard = async (req: Request, res: Response) => {
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
};
