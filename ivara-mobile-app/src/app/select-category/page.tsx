'use client';

import React from 'react';
import { useRouter } from 'next/navigation';
import { motion } from 'framer-motion';
import {
    Wrench,
    Palette,
    Car,
    Utensils,
    BookOpen,
    Leaf,
    PlayCircle,
    Scale,
    Grid
} from 'lucide-react';

const categories = [
    { id: 'technical_repair', name: 'Technical & Repair', icon: Wrench, color: '#f82d2d' },
    { id: 'creative_lifestyle', name: 'Creative & Lifestyle', icon: Palette, color: '#3b82f6' },
    { id: 'transport_travel', name: 'Driving & Transport', icon: Car, color: '#10b981' },
    { id: 'food_fashion', name: 'Food & Fashion', icon: Utensils, color: '#f59e0b' },
    { id: 'education_knowledge', name: 'Education & Knowledge', icon: BookOpen, color: '#8b5cf6' },
    { id: 'agriculture_environment', name: 'Agriculture & Eco', icon: Leaf, color: '#16a34a' },
    { id: 'media_entertainment', name: 'Media & Ent.', icon: PlayCircle, color: '#dc2626' },
    { id: 'legal_professional', name: 'Legal & Prof.', icon: Scale, color: '#2563eb' },
    { id: 'other_services', name: 'Other Services', icon: Grid, color: '#6b7280' },
];

export default function CategorySelectionPage() {
    const router = useRouter();

    const handleSelect = (categoryId: string) => {
        sessionStorage.setItem('selected_category', categoryId);
        router.push(`/select-user?category=${categoryId}`);
    };

    return (
        <div className="min-h-screen p-6 bg-background">
            <motion.div
                initial={{ opacity: 0, x: -20 }}
                animate={{ opacity: 1, x: 0 }}
                className="mb-8"
            >
                <h1 className="text-3xl font-bold mb-2 text-foreground">Service <span className="text-primary">Categories</span></h1>
                <p className="text-muted">Choose your workspace to begin.</p>
            </motion.div>

            <div className="grid grid-cols-2 gap-4">
                {categories.map((cat, index) => (
                    <motion.div
                        key={cat.id}
                        initial={{ opacity: 0, scale: 0.9 }}
                        animate={{ opacity: 1, scale: 1 }}
                        transition={{ delay: index * 0.05 }}
                        onClick={() => handleSelect(cat.id)}
                        className="glass !rounded-[24px] p-6 flex flex-col items-center justify-center text-center aspect-square transition-all active:scale-95 active:bg-white/10"
                    >
                        <div
                            className="w-16 h-16 rounded-[20px] flex items-center justify-center mb-4 shadow-lg shadow-primary/10 transition-transform group-active:scale-90"
                            style={{ backgroundColor: 'var(--primary)', color: 'white' }}
                        >
                            <cat.icon size={30} />
                        </div>
                        <span className="text-sm font-bold text-foreground">{cat.name}</span>
                    </motion.div>
                ))}
            </div>

            <div className="mt-12 p-6 glass-card rounded-3xl bg-primary/5 border-primary/20">
                <h3 className="font-bold mb-2 text-foreground">Need help?</h3>
                <p className="text-sm text-muted mb-4">Our support team is available 24/7 to assist you with your professional journey.</p>
                <button className="btn-secondary py-3 text-sm">Contact Support</button>
            </div>
        </div>
    );
}
