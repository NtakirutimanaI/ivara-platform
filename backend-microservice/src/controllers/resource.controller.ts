import { Request, Response } from 'express';
import { Resource } from '../models/resource.model';
import { Faq } from '../models/faq.model';

// --- RESOURCES (Blogs, Guides, etc.) ---

export const getResourcesByType = async (req: Request, res: Response) => {
    try {
        const { type } = req.params;
        // Seed if empty
        const count = await Resource.countDocuments({ type });
        if (count === 0 && (type === 'blog' || type === 'guide' || type === 'tutorial' || type === 'update')) {
            await seedResources(); // Helper to seed
        }

        const resources = await Resource.find({ type }).sort({ createdAt: -1 });
        res.json(resources);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch resources' });
    }
};

export const getFeaturedResources = async (req: Request, res: Response) => {
    try {
        // Ensure seeding runs if DB is totally empty
        const total = await Resource.countDocuments();
        if (total === 0) await seedResources();

        // Fetch specifically the 3 requested items for the menu
        const featured = await Resource.find({ isFeatured: true }).limit(3);
        res.json(featured);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch featured resources' });
    }
};

export const getResourceBySlug = async (req: Request, res: Response) => {
    try {
        const { slug } = req.params;
        const resource = await Resource.findOne({ slug });
        if (!resource) return res.status(404).json({ error: 'Resource not found' });

        // Simple view increment
        resource.views += 1;
        await resource.save();

        res.json(resource);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch resource' });
    }
};

// --- FAQs ---

export const getFaqs = async (req: Request, res: Response) => {
    try {
        const count = await Faq.countDocuments();
        if (count === 0) await seedFaqs();

        const faqs = await Faq.find().sort({ order: 1 });
        res.json(faqs);
    } catch (err) {
        res.status(500).json({ error: 'Failed to fetch FAQs' });
    }
};

// --- SEEDING HELPERS ---

async function seedResources() {
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
        const exists = await Resource.findOne({ slug: s.slug });
        if (!exists) await Resource.create(s);
    }
}

async function seedFaqs() {
    const seeds = [
        { question: 'How do I sign up?', answer: 'Click the Get Started button on the top right.', category: 'General', order: 1 },
        { question: 'Is it free?', answer: 'We offer a free Starter plan.', category: 'Pricing', order: 2 },
        { question: 'How do I get paid?', answer: 'Payments are processed securely via Stripe/PayPal.', category: 'Payments', order: 3 },
    ];
    await Faq.insertMany(seeds);
}
