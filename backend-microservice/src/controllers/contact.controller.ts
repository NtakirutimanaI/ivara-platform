import { Request, Response } from 'express';
import { ContactModel } from '../models/contact.model';

export const createContact = async (req: Request, res: Response) => {
    try {
        const { name, email, subject, message, phone, country_code } = req.body;

        const newContact = await ContactModel.create({
            name,
            email,
            subject,
            message,
            phone,
            country_code
        });

        res.status(201).json({
            success: true,
            message: 'Contact message received successfully',
            data: newContact
        });
    } catch (error) {
        console.error('Error creating contact:', error);
        res.status(500).json({ success: false, message: 'Server error' });
    }
};

export const getAllContacts = async (req: Request, res: Response) => {
    try {
        const contacts = await ContactModel.find().sort({ createdAt: -1 });
        res.json({ success: true, data: contacts });
    } catch (error) {
        res.status(500).json({ success: false, message: 'Server error' });
    }
};

export const getContactById = async (req: Request, res: Response) => {
    try {
        const contact = await ContactModel.findById(req.params.id);
        if (!contact) {
            return res.status(404).json({ success: false, message: 'Contact not found' });
        }
        res.json({ success: true, data: contact });
    } catch (error) {
        res.status(500).json({ success: false, message: 'Server error' });
    }
};

export const deleteContact = async (req: Request, res: Response) => {
    try {
        await ContactModel.findByIdAndDelete(req.params.id);
        res.json({ success: true, message: 'Contact deleted successfully' });
    } catch (error) {
        res.status(500).json({ success: false, message: 'Server error' });
    }
};
