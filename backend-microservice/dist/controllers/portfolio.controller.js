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
exports.getPortfolioBySlug = exports.getPortfolios = void 0;
const portfolio_model_1 = __importDefault(require("../models/portfolio.model"));
// Seed Data
const seedData = [
    {
        title: "E-Commerce Super App",
        slug: "ecommerce-super-app",
        category: "Mobile App",
        description: "A comprehensive multi-vendor marketplace app with real-time tracking, payment integration, and AI-driven recommendations.",
        client: "Global Retail Inc.",
        image: "https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?auto=format&fit=crop&q=80&w=800",
        gallery: [],
        technologies: ["Flutter", "Node.js", "MongoDB", "Stripe"],
        link: "#",
        isFeatured: true
    },
    {
        title: "Fintech Dashboard",
        slug: "fintech-dashboard",
        category: "Web Application",
        description: "An advanced financial analytics dashboard for tracking investments, crypto assets, and banking transactions in one place.",
        client: "FinOne Solutions",
        image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800",
        gallery: [],
        technologies: ["React", "D3.js", "Python", "AWS"],
        link: "#",
        isFeatured: true
    },
    {
        title: "Eco-Lodge Branding",
        slug: "eco-lodge-branding",
        category: "Branding",
        description: "Complete visual identity overhaul for a luxury eco-tourism lodge, including logo design, stationery, and architectural signage.",
        client: "GreenEscape Resorts",
        image: "https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&q=80&w=800",
        gallery: [],
        technologies: ["Adobe Illustrator", "Figma", "Blender"],
        link: "#",
        isFeatured: true
    },
    {
        title: "Smart Logistics System",
        slug: "smart-logistics",
        category: "Enterprise System",
        description: "AI-powered logistics management system for optimizing fleet routes, managing warehouses, and predicting supply chain disruptions.",
        client: "LogiTech",
        image: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=800",
        gallery: [],
        technologies: ["Vue.js", "Java Spring Boot", "PostgreSQL"],
        link: "#",
        isFeatured: true
    },
    {
        title: "Virtual Reality Tour",
        slug: "vr-real-estate",
        category: "AR/VR",
        description: "Immersive VR experience for real estate showcases, allowing potential buyers to walk through properties remotely.",
        client: "Prime Estates",
        image: "https://images.unsplash.com/photo-1622979135228-b3d901614e5a?auto=format&fit=crop&q=80&w=800",
        gallery: [],
        technologies: ["Unity", "C#", "Oculus SDK"],
        link: "#",
        isFeatured: true
    }
];
const getPortfolios = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // Auto-seed if empty
        const count = yield portfolio_model_1.default.countDocuments();
        if (count === 0) {
            yield portfolio_model_1.default.insertMany(seedData);
        }
        const portfolios = yield portfolio_model_1.default.find().sort({ createdAt: -1 });
        res.status(200).json(portfolios);
    }
    catch (error) {
        res.status(500).json({ message: "Error fetching portfolios", error });
    }
});
exports.getPortfolios = getPortfolios;
const getPortfolioBySlug = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const portfolio = yield portfolio_model_1.default.findOne({ slug: req.params.slug });
        if (!portfolio) {
            return res.status(404).json({ message: "Project not found" });
        }
        res.status(200).json(portfolio);
    }
    catch (error) {
        res.status(500).json({ message: "Error fetching project", error });
    }
});
exports.getPortfolioBySlug = getPortfolioBySlug;
