'use client';

import React, { useEffect, useState } from 'react';
import { useSearchParams, useRouter } from 'next/navigation';
import { motion } from 'framer-motion';
import { User, CheckCircle, ArrowLeft, Search } from 'lucide-react';

// Sample roles matching the categories for demonstration
const roleMap: Record<string, string[]> = {
    transport_travel: ['Taxi Driver', 'Motorcycle Taxi', 'Bus Driver', 'Tour Driver', 'Delivery Driver', 'Special Transport'],
    technical_repair: ['Technician', 'Mechanic', 'Electrician', 'Builder', 'Tailor', 'Mediator', 'Craftsperson', 'Business', 'Intern'],
    creative_lifestyle: ['Multi Sports Academics', 'Gym Trainer', 'Fitness Coach', 'Yoga Trainer', 'Aerobics Instructor', 'Martial Arts Trainer', 'Pilates Instructor'],
    food_fashion: ['Food Customer', 'Food Vendor', 'Event Organizer', 'Fashion Vendor', 'Food Delivery', 'Food Admin'],
    education_knowledge: ['Student', 'Teacher', 'Tutor', 'Edu Content Creator', 'Institution Admin', 'Edu Admin'],
    agriculture_environment: ['Farmer', 'Agri Manager', 'Input Supplier', 'Extension Officer', 'Produce Buyer', 'Sustainability Officer', 'Agri Admin'],
    media_entertainment: ['Media Consumer', 'Media Creator', 'Media Producer', 'Media Advertiser', 'Media Distributor', 'Media Admin'],
    legal_professional: ['Legal Client', 'Legal Pro', 'Professional Consultant', 'Legal Firm', 'Legal Regulator', 'Legal Admin'],
};

export default function UserSelectionPage() {
    const searchParams = useSearchParams();
    const category = searchParams.get('category') || 'other_services';
    const router = useRouter();
    const [searchTerm, setSearchTerm] = useState('');
    const roles = roleMap[category] || ['General User'];

    const filteredRoles = roles.filter(role =>
        role.toLowerCase().includes(searchTerm.toLowerCase())
    );

    const handleRoleSelect = (role: string) => {
        sessionStorage.setItem('active_role', role);
        router.push('/dashboard');
    };

    return (
        <div className="min-h-screen p-6 bg-background">
            {/* Header */}
            <div className="flex items-center gap-4 mb-8">
                <button
                    onClick={() => router.back()}
                    className="w-10 h-10 glass flex items-center justify-center rounded-xl"
                >
                    <ArrowLeft size={20} className="text-foreground" />
                </button>
                <div>
                    <h1 className="text-2xl font-bold text-foreground">Select <span className="text-primary">Profile</span></h1>
                    <p className="text-xs text-muted uppercase font-semibold">{category.replace('_', ' ')}</p>
                </div>
            </div>

            {/* Search Bar */}
            <div className="relative mb-8">
                <Search className="absolute left-4 top-1/2 -translate-y-1/2 text-muted" size={18} />
                <input
                    type="text"
                    placeholder="Search profiles..."
                    className="input-field pl-12 py-3 text-sm !bg-secondary/50"
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                />
            </div>

            {/* Profile List */}
            <div className="space-y-4">
                {filteredRoles.map((role, index) => (
                    <motion.div
                        key={role}
                        initial={{ opacity: 0, x: 20 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ delay: index * 0.05 }}
                        onClick={() => handleRoleSelect(role)}
                        className="glass !rounded-[24px] p-5 flex items-center justify-between group active:scale-[0.98] transition-all"
                    >
                        <div className="flex items-center gap-4">
                            <div className="w-14 h-14 rounded-[18px] bg-primary flex items-center justify-center text-white text-xl font-bold shadow-lg shadow-primary/20">
                                {role.charAt(0).toUpperCase()}
                            </div>
                            <div>
                                <h3 className="font-bold text-foreground">{role}</h3>
                                <p className="text-xs text-muted capitalize">Active Workspace</p>
                            </div>
                        </div>
                        <CheckCircle size={20} className="text-muted group-hover:text-primary transition-colors" />
                    </motion.div>
                ))}
            </div>

            {filteredRoles.length === 0 && (
                <div className="text-center py-12">
                    <p className="text-muted">No profiles found matching "{searchTerm}"</p>
                </div>
            )}
        </div>
    );
}
