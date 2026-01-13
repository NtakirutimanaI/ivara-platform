import mongoose from 'mongoose';
import dotenv from 'dotenv';
import Service from '../models/service.model';

dotenv.config();

const seedServices = async () => {
    try {
        await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/ivara_platform');

        console.log('Clearing existing services...');
        await Service.deleteMany({});

        const services = [
            {
                name: 'Smartphone Screen Repair',
                category: 'technical-repair',
                basePrice: 25000,
                icon: 'fas fa-mobile-alt',
                providerCount: 45,
                imageUrl: 'https://images.unsplash.com/photo-1597740985671-2a8a3b80502e?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Professional Photography',
                category: 'creative-lifestyle',
                basePrice: 150000,
                icon: 'fas fa-camera',
                providerCount: 12,
                imageUrl: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Airport Shuttle Transfer',
                category: 'transport-travel',
                basePrice: 20000,
                icon: 'fas fa-shuttle-van',
                providerCount: 28,
                imageUrl: 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Custom Wedding Dress',
                category: 'food-fashion',
                basePrice: 450000,
                icon: 'fas fa-female',
                providerCount: 5,
                imageUrl: 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Legal Contract Review',
                category: 'legal-professional',
                basePrice: 85000,
                icon: 'fas fa-file-signature',
                providerCount: 18,
                imageUrl: 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Advanced Excel Training',
                category: 'education-knowledge',
                basePrice: 55000,
                icon: 'fas fa-file-excel',
                providerCount: 32,
                imageUrl: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'House Painting Services',
                category: 'construction-maintenance',
                basePrice: 350000,
                icon: 'fas fa-paint-roller',
                providerCount: 15,
                imageUrl: 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Full Stack Web Development',
                category: 'digital-technology',
                basePrice: 1200000,
                icon: 'fas fa-code',
                providerCount: 22,
                imageUrl: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Deep Tissue Massage',
                category: 'health-wellness',
                basePrice: 35000,
                icon: 'fas fa-spa',
                providerCount: 40,
                imageUrl: 'https://images.unsplash.com/photo-1544161515-4ae6ce6075c1?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Home Electrical Wiring',
                category: 'technical-repair',
                basePrice: 120000,
                icon: 'fas fa-bolt',
                providerCount: 15,
                imageUrl: 'https://images.unsplash.com/photo-1621905252507-b354bcadcabc?auto=format&fit=crop&q=80&w=800'
            },
            {
                name: 'Interior Space Design',
                category: 'creative-lifestyle',
                basePrice: 200000,
                icon: 'fas fa-couch',
                providerCount: 9,
                imageUrl: 'https://images.unsplash.com/photo-1616489953149-805c872d8293?auto=format&fit=crop&q=80&w=800'
            }
        ];

        const statuses = ['active', 'active', 'active', 'inactive', 'review'];

        const finalServices = services.map((s, i) => ({
            ...s,
            description: `High-quality ${s.name} provided by verified platform professionals.`,
            status: statuses[i % statuses.length],
            featured: i % 4 === 0
        }));

        await Service.insertMany(finalServices);
        console.log('Successfully seeded 11 services across 9 categories!');

        process.exit();
    } catch (err) {
        console.error('Error seeding services:', err);
        process.exit(1);
    }
};

seedServices();
