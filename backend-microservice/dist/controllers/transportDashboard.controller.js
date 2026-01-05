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
exports.getSpecialTransportDashboard = exports.getDeliveryDriverDashboard = exports.getTourDriverDashboard = exports.getBusDriverDashboard = exports.getMotorcycleTaxiDashboard = exports.getTaxiDriverDashboard = void 0;
// Transport Dashboard Controllers
const getTaxiDriverDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // Mock data for now, similar to technicalDashboard
        res.status(200).json({
            message: 'Taxi Driver Dashboard Data',
            stats: {
                completed_trips: 12,
                daily_earnings: 45000,
                rating: 4.9,
                fuel_level: '75%'
            },
            recent_trips: [
                { id: 1, type: 'Airport Pickup', client: 'Jean Pierre', status: 'Pending' },
                { id: 2, type: 'Downtown Drop-off', client: 'Alice Umutoni', status: 'Completed' }
            ]
        });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getTaxiDriverDashboard = getTaxiDriverDashboard;
const getMotorcycleTaxiDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        res.status(200).json({
            message: 'Motorcycle Taxi Dashboard Data',
            stats: {
                rides_today: 18,
                earnings: 12500,
                rating: 4.8
            }
        });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getMotorcycleTaxiDashboard = getMotorcycleTaxiDashboard;
const getBusDriverDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        res.status(200).json({ message: 'Bus Driver Dashboard Data' });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getBusDriverDashboard = getBusDriverDashboard;
const getTourDriverDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        res.status(200).json({ message: 'Tour Driver Dashboard Data' });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getTourDriverDashboard = getTourDriverDashboard;
const getDeliveryDriverDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        res.status(200).json({ message: 'Delivery Driver Dashboard Data' });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getDeliveryDriverDashboard = getDeliveryDriverDashboard;
const getSpecialTransportDashboard = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        res.status(200).json({ message: 'Special Transport Dashboard Data' });
    }
    catch (error) {
        res.status(500).json({ message: error.message });
    }
});
exports.getSpecialTransportDashboard = getSpecialTransportDashboard;
