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
const product_model_1 = require("../models/product.model");
dotenv_1.default.config();
const sampleProducts = [
    // TECHNICAL & REPAIR CATEGORY
    {
        name: "Laptop Repair Service",
        category: "technical",
        price: 25000,
        stockQuantity: 50,
        description: "Professional laptop repair and maintenance services including hardware upgrades, virus removal, and software installation.",
        images: ["https://via.placeholder.com/400x300?text=Laptop+Repair"],
        variants: [{ name: "Service Type", options: ["Basic Checkup", "Complete Overhaul", "Data Recovery"] }],
        seller: null, // Will be set to admin user
        status: "Active"
    },
    {
        name: "Phone Screen Replacement",
        category: "technical",
        price: 15000,
        stockQuantity: 100,
        description: "High-quality smartphone screen replacement for all major brands. Original and aftermarket screens available.",
        images: ["https://via.placeholder.com/400x300?text=Phone+Screen"],
        variants: [
            { name: "Brand", options: ["iPhone", "Samsung", "Tecno", "Infinix"] },
            { name: "Screen Quality", options: ["Original", "Premium Copy", "Standard Copy"] }
        ],
        seller: null,
        status: "Active"
    },
    // CREATIVE & LIFESTYLE CATEGORY
    {
        name: "Professional Photography Package",
        category: "creative",
        price: 150000,
        stockQuantity: 20,
        description: "Complete event photography package including pre-shoot consultation, 8 hours coverage, photo editing, and digital delivery.",
        images: ["https://via.placeholder.com/400x300?text=Photography"],
        variants: [{ name: "Event Type", options: ["Wedding", "Birthday", "Corporate", "Product Shoot"] }],
        seller: null,
        status: "Active"
    },
    {
        name: "Custom Tailoring Service",
        category: "creative",
        price: 35000,
        stockQuantity: 30,
        description: "Bespoke tailoring services for suits, dresses, and traditional wear. Professional measurements and fittings included.",
        images: ["https://via.placeholder.com/400x300?text=Tailoring"],
        variants: [
            { name: "Garment Type", options: ["Suit", "Dress", "Traditional Wear", "Casual"] },
            { name: "Fabric Included", options: ["Yes", "No"] }
        ],
        seller: null,
        status: "Active"
    },
    // TRANSPORT & TRAVEL CATEGORY
    {
        name: "Airport Transfer Service",
        category: "transport",
        price: 30000,
        stockQuantity: 15,
        description: "Reliable airport pickup and drop-off service with professional drivers and comfortable vehicles.",
        images: ["https://via.placeholder.com/400x300?text=Airport+Transfer"],
        variants: [
            { name: "Vehicle Type", options: ["Sedan", "SUV", "Van"] },
            { name: "Route", options: ["Kigali Airport - City Center", "City Center - Airport", "Round Trip"] }
        ],
        seller: null,
        status: "Active"
    },
    {
        name: "Motorcycle Taxi Service",
        category: "transport",
        price: 2000,
        stockQuantity: 200,
        description: "Quick and affordable motorcycle taxi service for short distance travel within the city.",
        images: ["https://via.placeholder.com/400x300?text=Moto+Taxi"],
        variants: [{ name: "Distance", options: ["0-5km", "5-10km", "10-15km"] }],
        seller: null,
        status: "Active"
    },
    // FOOD & FASHION CATEGORY
    {
        name: "Catering Service - Wedding Package",
        category: "food-fashion",
        price: 500000,
        stockQuantity: 10,
        description: "Complete wedding catering package including appetizers, main course, desserts, and beverages for up to 200 guests.",
        images: ["https://via.placeholder.com/400x300?text=Catering"],
        variants: [
            { name: "Guest Count", options: ["50-100", "100-200", "200-300", "300+"] },
            { name: "Menu Type", options: ["Local", "Continental", "Mixed"] }
        ],
        seller: null,
        status: "Active"
    },
    {
        name: "Designer Handbag",
        category: "food-fashion",
        price: 75000,
        stockQuantity: 25,
        description: "Elegant leather handbag with modern design and multiple compartments. Perfect for both casual and formal occasions.",
        images: ["https://via.placeholder.com/400x300?text=Handbag"],
        variants: [
            { name: "Color", options: ["Black", "Brown", "Beige", "Red"] },
            { name: "Size", options: ["Small", "Medium", "Large"] }
        ],
        seller: null,
        status: "Active"
    },
    // EDUCATION & KNOWLEDGE CATEGORY
    {
        name: "Python Programming Course",
        category: "education",
        price: 180000,
        stockQuantity: 50,
        description: "Comprehensive 12-week Python programming course covering basics to advanced topics with hands-on projects.",
        images: ["https://via.placeholder.com/400x300?text=Python+Course"],
        variants: [
            { name: "Format", options: ["Online", "In-Person", "Hybrid"] },
            { name: "Schedule", options: ["Weekday Evening", "Weekend", "Intensive"] }
        ],
        seller: null,
        status: "Active"
    },
    {
        name: "French Language Tutoring",
        category: "education",
        price: 50000,
        stockQuantity: 30,
        description: "One-on-one French language tutoring sessions with certified native speaker. Perfect for beginners to advanced learners.",
        images: ["https://via.placeholder.com/400x300?text=French+Tutoring"],
        variants: [
            { name: "Level", options: ["Beginner", "Intermediate", "Advanced"] },
            { name: "Duration", options: ["1 Month", "3 Months", "6 Months"] }
        ],
        seller: null,
        status: "Active"
    },
    // AGRICULTURE & ENVIRONMENT CATEGORY
    {
        name: "Organic Fertilizer - 50kg",
        category: "agriculture",
        price: 45000,
        stockQuantity: 200,
        description: "Premium organic fertilizer made from composted materials. Ideal for all crops and kitchen gardens.",
        images: ["https://via.placeholder.com/400x300?text=Fertilizer"],
        variants: [{ name: "Package Size", options: ["10kg", "25kg", "50kg", "100kg"] }],
        seller: null,
        status: "Active"
    },
    {
        name: "Drip Irrigation System",
        category: "agriculture",
        price: 120000,
        stockQuantity: 40,
        description: "Complete drip irrigation system for efficient water management. Includes tubes, emitters, and connectors.",
        images: ["https://via.placeholder.com/400x300?text=Irrigation"],
        variants: [{ name: "Coverage Area", options: ["100sqm", "500sqm", "1000sqm", "Custom"] }],
        seller: null,
        status: "Active"
    },
    // MEDIA & ENTERTAINMENT CATEGORY
    {
        name: "DJ Services - Event Package",
        category: "media",
        price: 200000,
        stockQuantity: 15,
        description: "Professional DJ services with premium sound system and lighting for weddings, parties, and corporate events.",
        images: ["https://via.placeholder.com/400x300?text=DJ+Services"],
        variants: [
            { name: "Duration", options: ["4 hours", "6 hours", "8 hours", "Full Day"] },
            { name: "Equipment", options: ["Basic", "Premium", "VIP"] }
        ],
        seller: null,
        status: "Active"
    },
    {
        name: "Video Production Service",
        category: "media",
        price: 350000,
        stockQuantity: 10,
        description: "Professional video production including filming, editing, color grading, and final delivery in multiple formats.",
        images: ["https://via.placeholder.com/400x300?text=Video+Production"],
        variants: [{ name: "Project Type", options: ["Commercial", "Documentary", "Music Video", "Corporate"] }],
        seller: null,
        status: "Active"
    },
    // LEGAL & PROFESSIONAL CATEGORY
    {
        name: "Legal Consultation Service",
        category: "legal",
        price: 80000,
        stockQuantity: 25,
        description: "Professional legal consultation and advisory services for personal, business, and property matters.",
        images: ["https://via.placeholder.com/400x300?text=Legal+Services"],
        variants: [
            { name: "Consultation Type", options: ["Personal", "Business", "Property", "Family Law"] },
            { name: "Duration", options: ["1 Hour", "2 Hours", "Half Day"] }
        ],
        seller: null,
        status: "Active"
    },
    {
        name: "Accounting & Bookkeeping Service",
        category: "legal",
        price: 150000,
        stockQuantity: 20,
        description: "Monthly accounting and bookkeeping services for small to medium businesses. Includes financial statements and tax preparation.",
        images: ["https://via.placeholder.com/400x300?text=Accounting"],
        variants: [{ name: "Business Size", options: ["Small", "Medium", "Large"] }],
        seller: null,
        status: "Active"
    },
    // OTHER SERVICES CATEGORY
    {
        name: "House Cleaning Service",
        category: "other",
        price: 20000,
        stockQuantity: 100,
        description: "Professional house cleaning service including dusting, mopping, bathroom cleaning, and kitchen sanitization.",
        images: ["https://via.placeholder.com/400x300?text=Cleaning"],
        variants: [
            { name: "Type", options: ["Basic Clean", "Deep Clean", "Move-in/Move-out"] },
            { name: "Frequency", options: ["One-time", "Weekly", "Bi-weekly", "Monthly"] }
        ],
        seller: null,
        status: "Active"
    },
    {
        name: "Plumbing Repair Service",
        category: "other",
        price: 15000,
        stockQuantity: 60,
        description: "Expert plumbing services including leak repairs, pipe installation, faucet replacement, and drain cleaning.",
        images: ["https://via.placeholder.com/400x300?text=Plumbing"],
        variants: [{ name: "Service Type", options: ["Emergency Repair", "Installation", "Maintenance"] }],
        seller: null,
        status: "Active"
    }
];
function seedProducts() {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const mongoUri = process.env.MONGODB_URI || '';
            if (!mongoUri) {
                console.error('❌ MONGODB_URI not defined in .env');
                process.exit(1);
            }
            console.log('🔌 Connecting to MongoDB...');
            yield mongoose_1.default.connect(mongoUri);
            console.log('✅ Connected to MongoDB');
            // Delete existing products
            console.log('🗑️  Clearing existing products...');
            yield product_model_1.Product.deleteMany({});
            // Create a default seller ID (you should replace this with actual user ID)
            const defaultSellerId = new mongoose_1.default.Types.ObjectId();
            // Add seller ID to all products
            const productsWithSeller = sampleProducts.map(product => (Object.assign(Object.assign({}, product), { seller: defaultSellerId })));
            // Insert products
            console.log('📦 Inserting sample products...');
            const inserted = yield product_model_1.Product.insertMany(productsWithSeller);
            console.log(`✅ Successfully seeded ${inserted.length} products!`);
            console.log('\n📊 Products by category:');
            const categories = [
                'technical', 'creative', 'transport', 'food-fashion',
                'education', 'agriculture', 'media', 'legal', 'other'
            ];
            for (const category of categories) {
                const count = inserted.filter(p => p.category === category).length;
                console.log(`   ${category}: ${count} products`);
            }
            console.log('\n🎉 Seed completed successfully!');
            yield mongoose_1.default.connection.close();
            process.exit(0);
        }
        catch (error) {
            console.error('❌ Seed error:', error);
            yield mongoose_1.default.connection.close();
            process.exit(1);
        }
    });
}
// Run the seed function
seedProducts();
