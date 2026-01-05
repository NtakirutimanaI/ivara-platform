import { Request, Response } from 'express';
import Booking from '../models/booking.model';

export const createBooking = async (req: Request, res: Response) => {
    try {
        const { name, email, phone, budget, details } = req.body;

        // Basic backend validation
        if (!name || !email || !phone) {
            return res.status(400).json({ message: "Name, Email, and Phone are required." });
        }

        const newBooking = new Booking({
            name, email, phone, budget, details
        });

        await newBooking.save();

        res.status(201).json({ message: "Booking received successfully! We will contact you soon." });
    } catch (error) {
        res.status(500).json({ message: "Server Error", error });
    }
};
