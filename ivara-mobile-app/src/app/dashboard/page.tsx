'use client';

import React from 'react';
import { motion } from 'framer-motion';
import {
    Bell,
    Settings,
    Search,
    TrendingUp,
    Users,
    Calendar,
    Wallet,
    LayoutGrid,
    MessageSquare,
    BookOpen,
    Package,
    Wrench
} from 'lucide-react';
import { useSettings } from '@/contexts/SettingsContext';
import MobileHeader from '@/components/MobileHeader';
import Link from 'next/link';

export default function MobileDashboard() {
    const role = typeof window !== 'undefined' ? sessionStorage.getItem('active_role') : 'Professional';
    const category = typeof window !== 'undefined' ? sessionStorage.getItem('selected_category') : 'General';
    const { settings } = useSettings();

    // Base actions
    let quickActions: any[] = [
        { icon: Wallet, label: 'Pay', color: '#10b981' },
        { icon: MessageSquare, label: 'Chat', color: '#3b82f6' },
        { icon: Search, label: 'Search', color: '#f59e0b' },
    ];

    if (role === 'technician') {
        quickActions = [
            { icon: LayoutGrid, label: 'Job Queue', color: '#3b82f6', path: '/technician/jobs' },
            { icon: Package, label: 'Inventory', color: '#f59e0b', path: '/technician/inventory' },
            { icon: TrendingUp, label: 'Analytics', color: '#10b981' },
            { icon: Wrench, label: 'Repair', color: '#ec4899', path: '/repairs/new' },
        ];
    } else if (settings?.elearning === 'yes') {
        quickActions.push({ icon: BookOpen, label: 'Learn', color: '#924FC2' });
    } else {
        quickActions.push({ icon: LayoutGrid, label: 'More', color: '#6b7280' });
    }

    return (
        <div className="min-h-screen bg-background pb-24">
            <MobileHeader />

            <div className="px-6 pt-6">
                {/* Role Badge */}
                <div className="inline-flex items-center gap-2 px-3 py-1 glass rounded-full mb-6 border-primary/20 bg-primary/5">
                    <div className="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                    <span className="text-[10px] font-bold uppercase tracking-wider text-primary">{role} Workspace</span>
                </div>

                {/* Hero Card */}
                <div className="glass-card p-6 mb-6 overflow-hidden relative">
                    <div className="relative z-10">
                        <h3 className="text-sm text-muted mb-1">{role === 'technician' ? 'Performance Score' : 'Total Earnings'}</h3>
                        <h1 className="text-3xl font-bold mb-4 text-foreground">
                            {role === 'technician' ? '98.5%' : 'RWF 1,250,000'}
                        </h1>
                        <div className="flex items-center gap-2 text-green-500 text-xs font-bold">
                            <TrendingUp size={14} /> {role === 'technician' ? 'Top 1% Technician' : '+12.5% from last week'}
                        </div>
                    </div>
                    <div className="absolute top-[-20%] right-[-10%] w-40 h-40 bg-primary/20 blur-[60px] rounded-full"></div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-2 gap-4 mb-6">
                    <div className="glass !rounded-[24px] p-5">
                        {role === 'technician' ? <Wrench className="text-blue-500 mb-2" size={24} /> : <Users className="text-blue-500 mb-2" size={24} />}
                        <h4 className="text-2xl font-bold text-foreground">{role === 'technician' ? '8' : '48'}</h4>
                        <p className="text-[10px] text-muted font-bold uppercase">{role === 'technician' ? 'Assigned' : 'Total Clients'}</p>
                    </div>
                    <div className="glass !rounded-[24px] p-5">
                        {role === 'technician' ? <Package className="text-purple-500 mb-2" size={24} /> : <Calendar className="text-purple-500 mb-2" size={24} />}
                        <h4 className="text-2xl font-bold text-foreground">{role === 'technician' ? '14' : '12'}</h4>
                        <p className="text-[10px] text-muted font-bold uppercase">{role === 'technician' ? 'Parts' : 'Upcoming'}</p>
                    </div>
                </div>

                {/* Quick Actions */}
                <h3 className="text-sm font-bold text-muted uppercase tracking-widest mb-4 ml-1">Quick Actions</h3>
                <div className="grid grid-cols-4 gap-4 mb-8">
                    {quickActions.map((item, index) => (
                        <Link
                            key={item.label || index}
                            href={item.path || '#'}
                            className="flex flex-col items-center gap-2 no-underline"
                        >
                            <div className="w-14 h-14 glass !rounded-[18px] flex items-center justify-center active:scale-90 transition-transform">
                                <item.icon size={24} style={{ color: item.color }} />
                            </div>
                            <span className="text-[10px] font-bold text-muted">{item.label}</span>
                        </Link>
                    ))}
                </div>
            </div>

            {/* Bottom Nav */}
            <div className="fixed bottom-6 left-6 right-6 h-18 glass !rounded-[2.5rem] flex items-center justify-around px-4 shadow-2xl z-20">
                <div className="p-3 text-primary"><LayoutGrid size={24} /></div>
                <div className="p-3 text-muted"><Users size={24} /></div>
                <div className="w-14 h-14 bg-primary rounded-full flex items-center justify-center shadow-lg shadow-primary/40 -translate-y-4">
                    <MessageSquare size={24} className="text-white" />
                </div>
                <div className="p-3 text-muted"><Calendar size={24} /></div>
                <div className="p-3 text-muted"><Settings size={24} /></div>
            </div>
        </div>
    );
}
