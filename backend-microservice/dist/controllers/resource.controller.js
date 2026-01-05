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
exports.getFaqs = exports.getResourceBySlug = exports.getFeaturedResources = exports.getResourcesByType = void 0;
const resource_model_1 = require("../models/resource.model");
const faq_model_1 = require("../models/faq.model");
// --- RESOURCES (Blogs, Guides, etc.) ---
const getResourcesByType = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { type } = req.params;
        // Seed if empty
        const count = yield resource_model_1.Resource.countDocuments({ type });
        if (count === 0 && (type === 'blog' || type === 'guide' || type === 'tutorial' || type === 'update')) {
            yield seedResources(); // Helper to seed
        }
        const resources = yield resource_model_1.Resource.find({ type }).sort({ createdAt: -1 });
        res.json(resources);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch resources' });
    }
});
exports.getResourcesByType = getResourcesByType;
const getFeaturedResources = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // Ensure seeding runs if DB is totally empty
        const total = yield resource_model_1.Resource.countDocuments();
        if (total === 0)
            yield seedResources();
        // Fetch specifically the 3 requested items for the menu
        const featured = yield resource_model_1.Resource.find({ isFeatured: true }).limit(3);
        res.json(featured);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch featured resources' });
    }
});
exports.getFeaturedResources = getFeaturedResources;
const getResourceBySlug = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const { slug } = req.params;
        const resource = yield resource_model_1.Resource.findOne({ slug });
        if (!resource)
            return res.status(404).json({ error: 'Resource not found' });
        // Simple view increment
        resource.views += 1;
        yield resource.save();
        res.json(resource);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch resource' });
    }
});
exports.getResourceBySlug = getResourceBySlug;
// --- FAQs ---
const getFaqs = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const count = yield faq_model_1.Faq.countDocuments();
        if (count === 0)
            yield seedFaqs();
        const faqs = yield faq_model_1.Faq.find().sort({ order: 1 });
        res.json(faqs);
    }
    catch (err) {
        res.status(500).json({ error: 'Failed to fetch FAQs' });
    }
});
exports.getFaqs = getFaqs;
// --- SEEDING HELPERS ---
function seedResources() {
    return __awaiter(this, void 0, void 0, function* () {
        const seeds = [
            // 1. Blog: B2B vs B2C (Requested)
            {
                type: 'blog',
                title: 'B2B vs B2C Marketplaces: What is the Difference?',
                slug: 'b2b-vs-b2c-marketplaces',
                summary: 'Understanding the core differences between Business-to-Business and Business-to-Consumer platforms is crucial for success.',
                content: '<p>Deep dive into the structural, monetary, and operational differences...</p>',
                coverImage: 'https://placehold.co/600x400/0A1128/FFF?text=B2B+vs+B2C',
                isFeatured: true
            },
            // 2. Guide: Create an Online Marketplace (Requested)
            {
                type: 'guide',
                title: 'How to Create an Online Marketplace',
                slug: 'create-online-marketplace-guide',
                summary: 'A step-by-step guide to building your dream platform from scratch using IVARA.',
                content: '<p>Step 1: Define your niche. Step 2: Choose your tech stack...</p>',
                coverImage: 'https://placehold.co/600x400/ffb700/000?text=Marketplace+Guide',
                isFeatured: true
            },
            // 3. Tutorial: Get Started with IVARA (Requested)
            {
                type: 'tutorial',
                title: 'Get Started with IVARA',
                slug: 'get-started-with-ivara',
                summary: 'Watch how to set up your account and post your first service in under 5 minutes.',
                content: '<p>Video placeholder or textual walkthrough...</p>',
                coverImage: 'https://placehold.co/600x400/162447/FFF?text=IVARA+Tutorial',
                isFeatured: true
            },
            // Extra Update
            {
                type: 'update',
                title: 'IVARA v2.0 Released',
                slug: 'ivara-v2-released',
                summary: 'Introducing the new dashboard and advanced analytics tools.',
                content: '<p>We have completely overhauled the user interface...</p>',
                coverImage: '',
                isFeatured: false
            }
        ];
        for (const s of seeds) {
            const exists = yield resource_model_1.Resource.findOne({ slug: s.slug });
            if (!exists)
                yield resource_model_1.Resource.create(s);
        }
    });
}
function seedFaqs() {
    return __awaiter(this, void 0, void 0, function* () {
        const seeds = [
            { question: 'How do I sign up?', answer: 'Click the Get Started button on the top right.', category: 'General', order: 1 },
            { question: 'Is it free?', answer: 'We offer a free Starter plan.', category: 'Pricing', order: 2 },
            { question: 'How do I get paid?', answer: 'Payments are processed securely via Stripe/PayPal.', category: 'Payments', order: 3 },
        ];
        yield faq_model_1.Faq.insertMany(seeds);
    });
}
