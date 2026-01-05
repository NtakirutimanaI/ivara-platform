import { Request, Response } from 'express';

// Creative, Lifestyle & Wellness Dashboard Controllers
export const getGymTrainerDashboard = async (req: Request, res: Response) => {
    try {
        res.status(200).json({
            message: 'Gym Trainer Dashboard Data',
            stats: {
                active_clients: 24,
                sessions_today: 8,
                revenue_month: 250000,
                avg_rating: 4.9
            },
            schedule: [
                { time: '08:00', client: 'Mike Ross', focus: 'Strength Training' },
                { time: '10:00', client: 'Sarah J.', focus: 'Weight Loss' }
            ]
        });
    } catch (error: any) {
        res.status(500).json({ message: error.message });
    }
};

export const getYogaTrainerDashboard = async (req: Request, res: Response) => {
    try {
        res.status(200).json({
            message: 'Yoga Trainer Dashboard Data',
            stats: {
                classes_today: 3,
                active_members: 45,
                focus_area: 'Vinyasa Flow'
            }
        });
    } catch (error: any) {
        res.status(500).json({ message: error.message });
    }
};

export const getGenericCreativeDashboard = async (req: Request, res: Response) => {
    try {
        res.status(200).json({
            message: 'Creative & Wellness Workspace',
            note: 'This is a generic workspace for wellness professionals.'
        });
    } catch (error: any) {
        res.status(500).json({ message: error.message });
    }
};
