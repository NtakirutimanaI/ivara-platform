import { Request, Response } from 'express';
import { PricingPlan } from '../models/pricing.model';

export const getPricingPlans = async (req: Request, res: Response) => {
    try {
        // Simple seeding logic if empty (runs on first fetch if DB is empty)
        const count = await PricingPlan.countDocuments();
        if (count === 0) {
            const seedData = [
                {
                    name: "Starter",
                    price: "Free",
                    period: "",
                    isPopular: false,
                    features: [
                        { text: "1 Service Category", included: true },
                        { text: "Basic Dashboard", included: true },
                        { text: "Community Support", included: true }
                    ],
                    buttonText: "Get Started",
                    buttonLink: "/register",
                    buttonStyle: "outline"
                },
                {
                    name: "Professional",
                    price: "$29",
                    period: "/mo",
                    isPopular: true, // POPULAR badge
                    features: [
                        { text: "3 Service Categories", included: true },
                        { text: "Advanced Analytics", included: true },
                        { text: "Priority Support", included: true },
                        { text: "Marketing Tools", included: true }
                    ],
                    buttonText: "Sign Up Now",
                    buttonLink: "/register",
                    buttonStyle: "primary"
                },
                {
                    name: "Enterprise",
                    price: "Custom",
                    period: "",
                    isPopular: false,
                    features: [
                        { text: "Unlimited Categories", included: true },
                        { text: "Dedicated Manager", included: true },
                        { text: "API Access", included: true },
                        { text: "Custom Reporting", included: true }
                    ],
                    buttonText: "Contact Sales",
                    buttonLink: "/register",
                    buttonStyle: "outline"
                }
            ];
            await PricingPlan.insertMany(seedData);
        }

        const plans = await PricingPlan.find();
        res.json(plans);
    } catch (error) {
        res.status(500).json({ message: 'Error fetching pricing plans', error });
    }
};
