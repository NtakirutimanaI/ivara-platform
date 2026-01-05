import mongoose, { Schema, Document } from 'mongoose';

export interface IPricingFeature extends Document {
    text: string;
    included: boolean;
}

export interface IPricingPlan extends Document {
    name: string;
    price: string; // e.g., "Free", "29,000 FRW", "Custom"
    period: string; // e.g., "/mo", or empty
    isPopular: boolean;
    features: IPricingFeature[];
    buttonText: string;
    buttonLink: string;
    buttonStyle: string; // 'outline', 'primary'
}

const PricingFeatureSchema: Schema = new Schema({
    text: { type: String, required: true },
    included: { type: Boolean, default: true }
});

const PricingPlanSchema: Schema = new Schema({
    name: { type: String, required: true },
    price: { type: String, required: true },
    period: { type: String, default: '' },
    isPopular: { type: Boolean, default: false },
    features: [PricingFeatureSchema],
    buttonText: { type: String, required: true },
    buttonLink: { type: String, required: true },
    buttonStyle: { type: String, default: 'outline' }
}, { timestamps: true });

export const PricingPlan = mongoose.model<IPricingPlan>('PricingPlan', PricingPlanSchema);
