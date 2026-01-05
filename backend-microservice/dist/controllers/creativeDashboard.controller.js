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
exports.getGenericCreativeDashboard = exports.getYogaTrainerDashboard = exports.getGymTrainerDashboard = void 0;
// Creative, Lifestyle & Wellness Dashboard Controllers
const getGymTrainerDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
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
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getGymTrainerDashboard = getGymTrainerDashboard;
const getYogaTrainerDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        res.status(200).json({
            message: 'Yoga Trainer Dashboard Data',
            stats: {
                classes_today: 3,
                active_members: 45,
                focus_area: 'Vinyasa Flow'
            }
        });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getYogaTrainerDashboard = getYogaTrainerDashboard;
const getGenericCreativeDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        res.status(200).json({
            message: 'Creative & Wellness Workspace',
            note: 'This is a generic workspace for wellness professionals.'
        });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getGenericCreativeDashboard = getGenericCreativeDashboard;
