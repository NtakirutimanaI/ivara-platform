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
exports.deleteContact = exports.getContactById = exports.getAllContacts = exports.createContact = void 0;
const contact_model_1 = require("../models/contact.model");
const createContact = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { name, email, subject, message, phone, country_code } = req.body;
        const newContact = yield contact_model_1.ContactModel.create({
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
    }
    catch (error) {
        console.error('Error creating contact:', error);
        res.status(500).json({ success: false, message: 'Server error' });
    }
});
exports.createContact = createContact;
const getAllContacts = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const contacts = yield contact_model_1.ContactModel.find().sort({ createdAt: -1 });
        res.json({ success: true, data: contacts });
    }
    catch (error) {
        res.status(500).json({ success: false, message: 'Server error' });
    }
});
exports.getAllContacts = getAllContacts;
const getContactById = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const contact = yield contact_model_1.ContactModel.findById(req.params.id);
        if (!contact) {
            return res.status(404).json({ success: false, message: 'Contact not found' });
        }
        res.json({ success: true, data: contact });
    }
    catch (error) {
        res.status(500).json({ success: false, message: 'Server error' });
    }
});
exports.getContactById = getContactById;
const deleteContact = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        yield contact_model_1.ContactModel.findByIdAndDelete(req.params.id);
        res.json({ success: true, message: 'Contact deleted successfully' });
    }
    catch (error) {
        res.status(500).json({ success: false, message: 'Server error' });
    }
});
exports.deleteContact = deleteContact;
