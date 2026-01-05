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
exports.getPricingPlans = void 0;
const pricing_model_1 = require("../models/pricing.model");
const getPricingPlans = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // Simple seeding logic if empty (runs on first fetch if DB is empty)
        const count = yield pricing_model_1.PricingPlan.countDocuments();
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
            yield pricing_model_1.PricingPlan.insertMany(seedData);
        }
        const plans = yield pricing_model_1.PricingPlan.find();
        res.json(plans);
    }
    catch (error) {
        res.status(500).json({ message: 'Error fetching pricing plans', error });
    }
});
exports.getPricingPlans = getPricingPlans;
