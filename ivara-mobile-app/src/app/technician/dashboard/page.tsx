'use client';

import React, { useEffect, useState } from 'react';
import { motion } from 'framer-motion';
import {
    Cpu, Clock, CheckCircle2, Package, Star,
    ChevronRight, Calendar, Briefcase, Wrench,
    BarChart3, Users, GraduationCap, Headphones
} from 'lucide-react';
// MobileHeader import removed
import AuthGuard from '@/components/AuthGuard';
import api from '@/lib/api';
import Link from 'next/link';

interface DashboardData {
    stats: {
        repairs: number;
        avg_time: string;
        first_fix: string;
        parts_requested: number;
        rating: string;
        repairs_trend: number;
        time_trend: number;
        fix_trend: number;
    };
    repair_queue: Array<{
        id: string;
        device: string;
        issue: string;
        client: string;
        priority: string;
        time_ago: string;
    }>;
    schedule: Array<{
        time: string;
        meridiem: string;
        type: string;
        title: string;
        location: string;
    }>;
    recent_payments: Array<{
        client: string;
        service: string;
        amount: number;
    }>;
    learning_progress: number;
    community_count: number;
}

export default function TechnicianDashboardPage() {
    const [data, setData] = useState<DashboardData | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchDashboard = async () => {
            try {
                const response = await api.get('/technician/dashboard');
                setData(response.data);
            } catch (err) {
                console.error('Failed to fetch dashboard', err);
                // Use fallback data
                setData({
                    stats: {
                        repairs: 8,
                        avg_time: '2.4h',
                        first_fix: '96%',
                        parts_requested: 14,
                        rating: '4.9',
                        repairs_trend: 12,
                        time_trend: -8,
                        fix_trend: 3
                    },
                    repair_queue: [
                        { id: '1', device: 'iPhone 14 Pro', issue: 'Screen Replacement', client: 'John Doe', priority: 'Urgent', time_ago: '45 min ago' },
                        { id: '2', device: 'Samsung S23', issue: 'Battery Swap', client: 'Alice Kim', priority: 'High', time_ago: '2h ago' }
                    ],
                    schedule: [
                        { time: '09:00', meridiem: 'AM', type: 'Site Visit', title: 'Corporate Maintenance', location: 'Kigali Heights' },
                        { time: '14:00', meridiem: 'PM', type: 'In-Shop', title: 'Laptop Repair', location: 'Workshop' }
                    ],
                    recent_payments: [
                        { client: 'Sarah Johnson', service: 'Screen Repair', amount: 45000 },
                        { client: 'Tech Solutions', service: 'Maintenance', amount: 180000 }
                    ],
                    learning_progress: 65,
                    community_count: 1240
                });
            } finally {
                setLoading(false);
            }
        };
        fetchDashboard();
    }, []);

    if (loading) {
        return (
            <div className="min-h-screen bg-background flex items-center justify-center">
                <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
            </div>
        );
    }

    return (
        <AuthGuard allowedRoles={['technician', 'admin', 'super-admin', 'manager', 'supervisor']}>
            <div className="min-h-screen bg-background pb-24">

                <div className="px-4 pt-4">
                    {/* Header */}
                    <motion.div
                        initial={{ opacity: 0, y: -10 }}
                        animate={{ opacity: 1, y: 0 }}
                        className="mb-4"
                    >
                        <div className="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 rounded-full mb-2">
                            <span className="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span className="text-[10px] font-bold text-primary uppercase tracking-wider">Senior Technician</span>
                        </div>
                        <h1 className="text-2xl font-bold text-foreground">Technician Console</h1>
                        <p className="text-sm text-muted">Diagnostics • Repairs • Parts</p>
                    </motion.div>

                    {/* Mini Metrics */}
                    <div className="flex gap-2 overflow-x-auto pb-2 mb-4 scrollbar-hide">
                        <MetricPill icon={<Cpu size={14} />} value={data?.stats.repairs || 0} label="Active" trend={`+${data?.stats.repairs_trend || 0}%`} color="blue" />
                        <MetricPill icon={<Clock size={14} />} value={data?.stats.avg_time || '0h'} label="Avg Time" trend={`${data?.stats.time_trend || 0}%`} color="amber" />
                        <MetricPill icon={<CheckCircle2 size={14} />} value={data?.stats.first_fix || '0%'} label="Fix Rate" trend={`+${data?.stats.fix_trend || 0}%`} color="green" />
                        <MetricPill icon={<Package size={14} />} value={data?.stats.parts_requested || 0} label="Parts" color="cyan" />
                        <MetricPill icon={<Star size={14} />} value={data?.stats.rating || '0.0'} label="Rating" color="purple" badge="Top 5%" />
                    </div>

                    {/* Quick Actions */}
                    <div className="grid grid-cols-4 gap-2 mb-4">
                        <QuickAction href="/technician/jobs" icon={<Briefcase size={20} />} label="Jobs" />
                        <QuickAction href="/technician/inventory" icon={<Package size={20} />} label="Inventory" />
                        <QuickAction href="/technician/bookings" icon={<Calendar size={20} />} label="Bookings" />
                        <QuickAction href="/technician/schedule" icon={<Clock size={20} />} label="Schedule" />
                    </div>

                    {/* Repair Queue */}
                    <motion.div
                        initial={{ opacity: 0, y: 10 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.1 }}
                        className="glass-card p-4 !rounded-3xl mb-4"
                    >
                        <div className="flex justify-between items-center mb-3">
                            <h3 className="font-bold text-foreground flex items-center gap-2">
                                <Wrench size={16} className="text-primary" /> Repair Queue
                            </h3>
                            <Link href="/technician/jobs" className="text-xs text-primary font-semibold flex items-center gap-1">
                                View All <ChevronRight size={14} />
                            </Link>
                        </div>
                        <div className="space-y-2">
                            {data?.repair_queue.slice(0, 3).map((job, idx) => (
                                <div
                                    key={job.id}
                                    className={`p-3 rounded-2xl bg-secondary/30 border-l-3 ${job.priority === 'Urgent' ? 'border-l-red-500' :
                                        job.priority === 'High' ? 'border-l-amber-500' : 'border-l-primary'
                                        }`}
                                >
                                    <div className="flex justify-between items-start">
                                        <div className="flex-1">
                                            <span className={`text-[9px] font-bold px-2 py-0.5 rounded ${job.priority === 'Urgent' ? 'bg-red-500/10 text-red-500' :
                                                job.priority === 'High' ? 'bg-amber-500/10 text-amber-600' : 'bg-primary/10 text-primary'
                                                }`}>{job.priority}</span>
                                            <h4 className="font-semibold text-foreground text-sm mt-1">{job.device}</h4>
                                            <p className="text-xs text-muted">{job.issue}</p>
                                            <div className="flex gap-3 mt-1 text-[10px] text-muted">
                                                <span>{job.client}</span>
                                                <span>{job.time_ago}</span>
                                            </div>
                                        </div>
                                        <button className="px-3 py-1.5 bg-primary text-white text-[10px] font-bold rounded-xl">
                                            View
                                        </button>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </motion.div>

                    {/* Today's Schedule */}
                    <motion.div
                        initial={{ opacity: 0, y: 10 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.2 }}
                        className="glass-card p-4 !rounded-3xl mb-4"
                    >
                        <div className="flex justify-between items-center mb-3">
                            <h3 className="font-bold text-foreground flex items-center gap-2">
                                <Calendar size={16} className="text-primary" /> Today's Schedule
                            </h3>
                            <Link href="/technician/schedule" className="text-xs text-primary font-semibold flex items-center gap-1">
                                Full Schedule <ChevronRight size={14} />
                            </Link>
                        </div>
                        <div className="space-y-2">
                            {data?.schedule.slice(0, 3).map((item, idx) => (
                                <div key={idx} className={`flex gap-3 p-3 rounded-2xl ${idx === 0 ? 'bg-primary/10 border border-primary/20' : 'bg-secondary/30'}`}>
                                    <div className="text-center min-w-[45px]">
                                        <span className="block font-bold text-foreground">{item.time}</span>
                                        <span className="text-[10px] text-muted">{item.meridiem}</span>
                                    </div>
                                    <div className="w-0.5 bg-primary/20 relative">
                                        <span className={`absolute top-0 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full ${idx === 0 ? 'bg-primary' : 'bg-muted'}`}></span>
                                    </div>
                                    <div className="flex-1">
                                        <span className="text-[9px] font-bold text-primary uppercase">{item.type}</span>
                                        <h5 className="font-semibold text-foreground text-sm">{item.title}</h5>
                                        <p className="text-[10px] text-muted">{item.location}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </motion.div>

                    {/* Stats Overview */}
                    <div className="grid grid-cols-2 gap-3 mb-4">
                        {/* Mini Bar Chart Placeholder */}
                        <motion.div
                            initial={{ opacity: 0, scale: 0.95 }}
                            animate={{ opacity: 1, scale: 1 }}
                            transition={{ delay: 0.3 }}
                            className="glass-card p-4 !rounded-3xl"
                        >
                            <h4 className="text-xs font-bold text-muted mb-2 flex items-center gap-1">
                                <BarChart3 size={12} /> Weekly Performance
                            </h4>
                            <div className="flex items-end gap-1 h-16">
                                {[4, 6, 5, 8, 7].map((v, i) => (
                                    <div
                                        key={i}
                                        className="flex-1 bg-primary/20 rounded-t"
                                        style={{ height: `${(v / 8) * 100}%` }}
                                    >
                                        <div
                                            className="w-full bg-primary rounded-t transition-all"
                                            style={{ height: '100%' }}
                                        ></div>
                                    </div>
                                ))}
                            </div>
                            <div className="flex justify-between mt-1 text-[8px] text-muted">
                                <span>M</span><span>T</span><span>W</span><span>T</span><span>F</span>
                            </div>
                        </motion.div>

                        {/* Parts Status */}
                        <motion.div
                            initial={{ opacity: 0, scale: 0.95 }}
                            animate={{ opacity: 1, scale: 1 }}
                            transition={{ delay: 0.35 }}
                            className="glass-card p-4 !rounded-3xl"
                        >
                            <h4 className="text-xs font-bold text-muted mb-2 flex items-center gap-1">
                                <Package size={12} /> Parts Status
                            </h4>
                            <div className="flex items-center justify-center h-16">
                                <div className="relative w-14 h-14">
                                    <svg className="w-full h-full -rotate-90">
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" strokeWidth="4" className="text-secondary" />
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" strokeWidth="4" className="text-green-500" strokeDasharray="150.8" strokeDashoffset="45" />
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" strokeWidth="4" className="text-amber-500" strokeDasharray="150.8" strokeDashoffset="120" />
                                    </svg>
                                    <div className="absolute inset-0 flex items-center justify-center">
                                        <span className="text-xs font-bold text-foreground">31</span>
                                    </div>
                                </div>
                            </div>
                            <div className="flex justify-center gap-3 mt-1 text-[8px]">
                                <span className="flex items-center gap-1"><span className="w-2 h-2 rounded-full bg-green-500"></span> OK</span>
                                <span className="flex items-center gap-1"><span className="w-2 h-2 rounded-full bg-amber-500"></span> Low</span>
                                <span className="flex items-center gap-1"><span className="w-2 h-2 rounded-full bg-red-500"></span> Out</span>
                            </div>
                        </motion.div>
                    </div>

                    {/* Learning & Community */}
                    <motion.div
                        initial={{ opacity: 0, y: 10 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.4 }}
                        className="glass-card p-4 !rounded-3xl"
                    >
                        <h3 className="font-bold text-foreground flex items-center gap-2 mb-3">
                            <GraduationCap size={16} className="text-primary" /> Learning & Community
                        </h3>
                        <Link href="/learning" className="flex items-center gap-3 p-3 bg-secondary/30 rounded-2xl mb-2">
                            <div className="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center">
                                <GraduationCap size={18} className="text-purple-500" />
                            </div>
                            <div className="flex-1">
                                <h5 className="font-semibold text-foreground text-sm">Micro-Soldering Basics</h5>
                                <div className="h-1.5 bg-secondary rounded-full mt-1 overflow-hidden">
                                    <div className="h-full bg-purple-500 rounded-full" style={{ width: `${data?.learning_progress || 0}%` }}></div>
                                </div>
                                <span className="text-[10px] text-muted">{data?.learning_progress || 0}% Complete</span>
                            </div>
                        </Link>
                        <Link href="/community" className="flex items-center gap-3 p-3 bg-primary/10 rounded-2xl">
                            <div className="w-10 h-10 rounded-xl bg-primary flex items-center justify-center">
                                <Users size={18} className="text-white" />
                            </div>
                            <div className="flex-1">
                                <h5 className="font-semibold text-foreground text-sm">Technician Network</h5>
                                <span className="text-xs text-muted">Connect with {data?.community_count || 0}+ peers</span>
                            </div>
                        </Link>
                    </motion.div>
                </div>
            </div>
        </AuthGuard>
    );
}

// Metric Pill Component
function MetricPill({ icon, value, label, trend, color, badge }: {
    icon: React.ReactNode;
    value: string | number;
    label: string;
    trend?: string;
    color: string;
    badge?: string;
}) {
    const colorClasses: Record<string, string> = {
        blue: 'bg-blue-500/10 text-blue-500',
        amber: 'bg-amber-500/10 text-amber-500',
        green: 'bg-green-500/10 text-green-500',
        cyan: 'bg-cyan-500/10 text-cyan-500',
        purple: 'bg-purple-500/10 text-purple-500',
    };

    return (
        <div className="flex-shrink-0 flex items-center gap-2 px-3 py-2 bg-secondary/50 rounded-2xl min-w-[100px] relative">
            <div className={`w-7 h-7 rounded-lg flex items-center justify-center ${colorClasses[color]}`}>
                {icon}
            </div>
            <div>
                <span className="block font-bold text-foreground text-sm">{value}</span>
                <span className="text-[8px] text-muted uppercase font-semibold">{label}</span>
            </div>
            {trend && (
                <span className={`absolute top-1 right-1 text-[8px] font-bold px-1.5 py-0.5 rounded ${trend.startsWith('+') || !trend.startsWith('-') ? 'bg-green-500/10 text-green-600' : 'bg-red-500/10 text-red-500'}`}>
                    {trend}
                </span>
            )}
            {badge && (
                <span className="absolute top-1 right-1 text-[8px] font-bold px-1.5 py-0.5 rounded bg-gradient-to-r from-amber-400 to-amber-500 text-white">
                    {badge}
                </span>
            )}
        </div>
    );
}

// Quick Action Component
function QuickAction({ href, icon, label }: { href: string; icon: React.ReactNode; label: string }) {
    return (
        <Link href={href} className="flex flex-col items-center gap-1 p-3 bg-secondary/30 rounded-2xl active:scale-95 transition-transform">
            <span className="text-primary">{icon}</span>
            <span className="text-[10px] font-semibold text-muted">{label}</span>
        </Link>
    );
}
