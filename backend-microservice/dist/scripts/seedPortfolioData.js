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
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const mongoose_1 = __importDefault(require("mongoose"));
const dotenv_1 = __importDefault(require("dotenv"));
const testimonial_model_1 = __importDefault(require("../models/testimonial.model"));
const clientStat_model_1 = __importDefault(require("../models/clientStat.model"));
dotenv_1.default.config();
const seedData = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const mongoUri = process.env.MONGODB_URI || '';
        yield mongoose_1.default.connect(mongoUri);
        console.log('Connected to MongoDB');
        // Clear existing data
        yield testimonial_model_1.default.deleteMany({});
        yield clientStat_model_1.default.deleteMany({});
        // Seed Testimonials
        const testimonials = [
            {
                name: 'Chinasa U',
                role: 'CEO and Founder',
                company: 'TechStart Inc.',
                rating: 5,
                text: 'Everything they said they would do they did and delivered on time. I can relax knowing that my startup is setting off on a good solid foundation.',
                avatar: 'https://ui-avatars.com/api/?name=Chinasa+U&background=3b82f6&color=fff',
                isActive: true,
            },
            {
                name: 'Michael Johnson',
                role: 'Product Manager',
                company: 'InnovateCo',
                rating: 5,
                text: 'IVARA transformed our vision into reality. Their expertise in both design and development is unmatched. Highly recommended!',
                avatar: 'https://ui-avatars.com/api/?name=Michael+Johnson&background=10b981&color=fff',
                isActive: true,
            },
            {
                name: 'Sarah Williams',
                role: 'Founder',
                company: 'EcoSolutions',
                rating: 5,
                text: 'Professional, responsive, and incredibly talented. They took our complex requirements and delivered a solution that exceeded our expectations.',
                avatar: 'https://ui-avatars.com/api/?name=Sarah+Williams&background=f59e0b&color=fff',
                isActive: true,
            },
        ];
        yield testimonial_model_1.default.insertMany(testimonials);
        console.log('✅ Testimonials seeded successfully');
        // Seed Client Stats
        const clientStats = [
            {
                icon: 'fa-globe',
                number: '5000+',
                label: 'Projects Delivered',
                color: '#3b82f6',
                order: 1,
                isActive: true,
            },
            {
                icon: 'fa-users',
                number: '2500+',
                label: 'Happy Clients',
                color: '#10b981',
                order: 2,
                isActive: true,
            },
            {
                icon: 'fa-award',
                number: '98%',
                label: 'Success Rate',
                color: '#f59e0b',
                order: 3,
                isActive: true,
            },
            {
                icon: 'fa-clock',
                number: '24/7',
                label: 'Support Available',
                color: '#ef4444',
                order: 4,
                isActive: true,
            },
        ];
        yield clientStat_model_1.default.insertMany(clientStats);
        console.log('✅ Client Stats seeded successfully');
        console.log('🎉 All data seeded successfully!');
        process.exit(0);
    }
    catch (error) {
        console.error('Error seeding data:', error);
        process.exit(1);
    }
});
seedData();
