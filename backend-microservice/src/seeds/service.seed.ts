import mongoose from 'mongoose';
import dotenv from 'dotenv';
import { TechnicalService } from '../models/technicalService.model';

dotenv.config();

const services = [
    {
        name: 'Smartphone Screen Replacement',
        description: 'Professional replacement of cracked or non-functional smartphone screens using high-quality parts.',
        price: 45000,
        status: 'active',
        category: 'technical-repair'
    },
    {
        name: 'Laptop Motherboard Repair',
        description: 'Advanced component-level repair for laptop motherboards, fixing power issues and liquid damage.',
        price: 85000,
        status: 'active',
        category: 'technical-repair'
    },
    {
        name: 'Home Electrical Wiring Audit',
        description: 'Comprehensive inspection and safety audit of residential electrical systems with detailed reporting.',
        price: 120000,
        status: 'active',
        category: 'technical-repair'
    },
    {
        name: 'Industrial Generator Maintenance',
        description: 'Scheduled maintenance and performance optimization for heavy-duty industrial diesel generators.',
        price: 250000,
        status: 'active',
        category: 'technical-repair'
    },
    {
        name: 'Custom Tailored Suit (Executive)',
        description: 'Bespoke suit tailoring with premium fabric selection, hand-stitched detailing and perfect fit guarantee.',
        price: 180000,
        status: 'active',
        category: 'technical-repair'
    },
    {
        name: 'Smart Home Security Installation',
        description: 'Full installation of interconnected cameras, sensors, and central control hubs for modern security.',
        price: 320000,
        status: 'inactive',
        category: 'technical-repair'
    }
];

const seedServices = async () => {
    try {
        const mongoUri = process.env.MONGODB_URI || 'mongodb://localhost:27017/ivara';
        await mongoose.connect(mongoUri);
        console.log('✅ Connected to MongoDB for seeding');

        // Optional: Clear existing services
        // await TechnicalService.deleteMany({ category: 'technical-repair' });
        // console.log('🗑️  Cleared existing services');

        for (const service of services) {
            await TechnicalService.findOneAndUpdate(
                { name: service.name },
                service,
                { upsert: true, new: true }
            );
        }

        console.log('🚀 Successfully seeded 6 Technical & Repair services!');
        process.exit(0);
    } catch (err) {
        console.error('❌ Seeding failed:', err);
        process.exit(1);
    }
};

seedServices();
