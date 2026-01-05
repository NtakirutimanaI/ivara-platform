import { Request, Response } from 'express';
import Portfolio from '../models/portfolio.model';

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

export const getPortfolios = async (req: Request, res: Response) => {
    try {
        // Auto-seed if empty
        const count = await Portfolio.countDocuments();
        if (count === 0) {
            await Portfolio.insertMany(seedData);
        }

        const portfolios = await Portfolio.find().sort({ createdAt: -1 });
        res.status(200).json(portfolios);
    } catch (error) {
        res.status(500).json({ message: "Error fetching portfolios", error });
    }
};

export const getPortfolioBySlug = async (req: Request, res: Response) => {
    try {
        const portfolio = await Portfolio.findOne({ slug: req.params.slug });
        if (!portfolio) {
            return res.status(404).json({ message: "Project not found" });
        }
        res.status(200).json(portfolio);
    } catch (error) {
        res.status(500).json({ message: "Error fetching project", error });
    }
};
