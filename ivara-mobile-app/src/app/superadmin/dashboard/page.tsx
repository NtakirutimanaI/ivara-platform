"use client";

import { motion, AnimatePresence } from 'framer-motion';
import {
    Users, Shield, FileText, Activity, Map, Wrench,
    Box, CreditCard, Bell, Settings, LogOut, TrendingUp,
    Server, AlertTriangle, Database, Globe, RefreshCw,
    Search, X, CheckCircle, Clock
} from 'lucide-react';
import React, { useEffect, useState } from 'react';

export default function SuperAdminDashboard() {
    const [isLoading, setIsLoading] = useState(true);
    const [lastUpdated, setLastUpdated] = useState<Date | null>(null);
    const [searchQuery, setSearchQuery] = useState('');

    // Dynamic Data States
    const [stats, setStats] = useState([
        { id: 1, title: "Total Users", value: "0", rawValue: 0, trend: "---", color: "text-blue-400", bg: "bg-blue-500/10", icon: Users },
        { id: 2, title: "Active Techs", value: "0", rawValue: 0, trend: "---", color: "text-green-400", bg: "bg-green-500/10", icon: Wrench },
        { id: 3, title: "Revenue", value: "$0", rawValue: 0, trend: "---", color: "text-[var(--accent-gold)]", bg: "bg-yellow-500/10", icon: CreditCard },
        { id: 4, title: "Sys Health", value: "100%", rawValue: 100, trend: "Stable", color: "text-purple-400", bg: "bg-purple-500/10", icon: Activity },
    ]);

    const [alerts, setAlerts] = useState<any[]>([]);

    const allModules = [
        { id: 'users', label: "User Control", icon: Users, color: "from-blue-500 to-blue-600", path: "/superadmin/users" },
        { id: 'perms', label: "Permissions", icon: Shield, color: "from-red-500 to-red-600", path: "/superadmin/permissions" },
        { id: 'fin', label: "Financials", icon: CreditCard, color: "from-purple-500 to-purple-600", path: "/superadmin/finance" },
        { id: 'logs', label: "System Logs", icon: Database, color: "from-gray-600 to-gray-700", path: "/superadmin/logs" },
        { id: 'map', label: "Global Map", icon: Globe, color: "from-green-500 to-green-600", path: "/superadmin/map" },
        { id: 'inv', label: "Inventory", icon: Box, color: "from-orange-500 to-orange-600", path: "/superadmin/inventory" },
        { id: 'reports', label: "Reports", icon: FileText, color: "from-emerald-500 to-emerald-600", path: "/superadmin/reports" },
        { id: 'settings', label: "Settings", icon: Settings, color: "from-pink-500 to-pink-600", path: "/superadmin/settings" },
    ];

    const [filteredModules, setFilteredModules] = useState(allModules);

    // Simulate Data Fetching / Seeding
    const refreshData = () => {
        setIsLoading(true);
        // Simulate network delay
        setTimeout(() => {
            const now = new Date();
            setLastUpdated(now);

            // Seed Random Stats to look "Live"
            const randomUsers = 24000 + Math.floor(Math.random() * 1000);
            const randomTechs = 1800 + Math.floor(Math.random() * 100);
            const randomRev = 128000 + Math.floor(Math.random() * 5000);
            const health = 98 + Math.random() * 2;

            setStats([
                {
                    id: 1, title: "Total Users",
                    value: randomUsers.toLocaleString(),
                    rawValue: randomUsers,
                    trend: `+${(Math.random() * 15).toFixed(1)}%`,
                    color: "text-blue-400", bg: "bg-blue-500/10", icon: Users
                },
                {
                    id: 2, title: "Active Techs",
                    value: randomTechs.toLocaleString(),
                    rawValue: randomTechs,
                    trend: `+${(Math.random() * 8).toFixed(1)}%`,
                    color: "text-green-400", bg: "bg-green-500/10", icon: Wrench
                },
                {
                    id: 3, title: "Revenue",
                    value: `$${(randomRev / 1000).toFixed(1)}k`,
                    rawValue: randomRev,
                    trend: `+${(Math.random() * 25).toFixed(1)}%`,
                    color: "text-[var(--accent-gold)]", bg: "bg-yellow-500/10", icon: CreditCard
                },
                {
                    id: 4, title: "Sys Health",
                    value: `${health.toFixed(1)}%`,
                    rawValue: health,
                    trend: health > 99 ? "Excellent" : "Stable",
                    color: health > 99 ? "text-purple-400" : "text-yellow-400",
                    bg: "bg-purple-500/10", icon: Activity
                },
            ]);

            // Seed Random Alerts
            const possibleAlerts = [
                { id: 1, type: 'critical', title: "High Latency Detected", desc: "Server response > 500ms in region: East Africa.", time: "2m ago" },
                { id: 2, type: 'warning', title: "Storage Warning", desc: "S3 Bucket usage at 85% capacity.", time: "15m ago" },
                { id: 3, type: 'info', title: "New Node Added", desc: "Kigali-North node successfully online.", time: "1h ago" },
                { id: 4, type: 'critical', title: "Payment API Timeout", desc: "Mobile Money gateway intermittent failures.", time: "5m ago" },
            ];

            // Pick 1-2 random alerts
            const shuffled = possibleAlerts.sort(() => 0.5 - Math.random());
            setAlerts(shuffled.slice(0, Math.floor(Math.random() * 2) + 1));

            setIsLoading(false);
        }, 1200);
    };

    useEffect(() => {
        refreshData();
        // Optional: Auto-refresh every 30s
        const interval = setInterval(refreshData, 30000);
        return () => clearInterval(interval);
    }, []);

    // Filter Modules
    useEffect(() => {
        if (!searchQuery) {
            setFilteredModules(allModules);
        } else {
            const lower = searchQuery.toLowerCase();
            setFilteredModules(allModules.filter(m =>
                m.label.toLowerCase().includes(lower) ||
                m.id.includes(lower)
            ));
        }
    }, [searchQuery]);

    const dismissedAlert = (id: number) => {
        setAlerts(prev => prev.filter(a => a.id !== id));
    };

    return (
        <div className="min-h-screen bg-gray-50 dark:bg-[#050B14] pb-24">

            {/* Premium Header */}
            <header className="relative bg-[var(--primary-navy)] pt-8 pb-32 px-6 rounded-b-[3rem] overflow-hidden shadow-2xl shadow-blue-900/40 transition-all duration-500">
                <div className="absolute top-0 right-0 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl -mr-20 -mt-20"></div>
                <div className="absolute bottom-0 left-0 w-48 h-48 bg-purple-600/20 rounded-full blur-3xl -ml-16 -mb-16"></div>

                <div className="relative z-10 flex justify-between items-start mb-8">
                    <div>
                        <motion.div
                            initial={{ opacity: 0, y: 10 }}
                            animate={{ opacity: 1, y: 0 }}
                            className="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-md rounded-full mb-3 border border-white/10"
                        >
                            <span className={`w-2 h-2 rounded-full ${isLoading ? 'bg-yellow-400' : 'bg-green-400'} ${isLoading ? 'animate-none' : 'animate-pulse'}`}></span>
                            <span className="text-[10px] uppercase font-bold text-white tracking-widest">
                                {isLoading ? 'Syncing...' : 'System Online'}
                            </span>
                        </motion.div>
                        <h1 className="text-3xl font-extrabold text-white leading-tight">Super Admin<br /><span className="text-[var(--accent-gold)]">Control Center</span></h1>
                        {lastUpdated && (
                            <p className="text-white/40 text-[10px] uppercase font-bold mt-2">
                                Last Updated: {lastUpdated.toLocaleTimeString()}
                            </p>
                        )}
                    </div>
                    <button
                        onClick={refreshData}
                        className={`w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/10 shadow-lg active:scale-95 transition-all ${isLoading ? 'opacity-50' : 'hover:bg-white/20'}`}
                    >
                        <RefreshCw className={`text-white w-6 h-6 ${isLoading ? 'animate-spin' : ''}`} />
                    </button>
                </div>

                {/* Dashboard Search */}
                <div className="relative z-10 bg-white/10 backdrop-blur-xl border border-white/20 p-1 rounded-2xl flex items-center gap-3 shadow-lg pl-4 pr-1">
                    <Search size={20} className="text-white/60" />
                    <input
                        type="text"
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                        placeholder="Search modules, logs, tools..."
                        className="bg-transparent border-none outline-none text-white text-sm w-full placeholder-white/50 py-3"
                    />
                    {searchQuery && (
                        <button
                            onClick={() => setSearchQuery('')}
                            className="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white/80 hover:bg-white/20"
                        >
                            <X size={16} />
                        </button>
                    )}
                </div>
            </header>

            {/* Stats Cards - Floating */}
            <div className="px-6 -mt-20 relative z-20 grid grid-cols-2 gap-4">
                <AnimatePresence mode="wait">
                    {stats.map((stat, i) => (
                        <motion.div
                            key={stat.id}
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ delay: i * 0.1 }}
                            className="glass-card bg-white dark:bg-[#111827] p-4 rounded-3xl shadow-xl border border-gray-100 dark:border-white/5"
                        >
                            <div className="flex justify-between items-start mb-3">
                                <div className={`w-10 h-10 rounded-2xl ${stat.bg} flex items-center justify-center`}>
                                    <stat.icon size={20} className={stat.color} />
                                </div>
                                <span className={`text-[10px] font-bold px-2 py-1 rounded-lg ${stat.trend.includes('+') || stat.trend === 'Stable' || stat.trend === 'Excellent' ? 'bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400'}`}>
                                    {stat.trend}
                                </span>
                            </div>
                            <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-1 transition-all">
                                {isLoading ? (
                                    <span className="block w-16 h-8 bg-gray-200 dark:bg-white/10 rounded animate-pulse"></span>
                                ) : (
                                    stat.value
                                )}
                            </h3>
                            <p className="text-xs text-gray-500 font-medium uppercase tracking-wide">{stat.title}</p>
                        </motion.div>
                    ))}
                </AnimatePresence>
            </div>

            {/* Management Modules */}
            <div className="px-6 pt-10 pb-6">
                <div className="flex justify-between items-end mb-6">
                    <h2 className="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        Core Modules
                        <span className="text-[10px] font-bold px-2 py-0.5 bg-gray-100 dark:bg-white/10 rounded-full text-gray-500">
                            {filteredModules.length}
                        </span>
                    </h2>
                    <button className="text-[var(--accent-gold)] text-xs font-bold uppercase tracking-wide">
                        View All
                    </button>
                </div>

                {filteredModules.length > 0 ? (
                    <div className="grid grid-cols-3 gap-4">
                        <AnimatePresence>
                            {filteredModules.map((item, i) => (
                                <motion.button
                                    key={item.id}
                                    layout
                                    initial={{ opacity: 0, scale: 0.9 }}
                                    animate={{ opacity: 1, scale: 1 }}
                                    exit={{ opacity: 0, scale: 0.9 }}
                                    whileTap={{ scale: 0.95 }}
                                    className="flex flex-col items-center gap-3 p-4 rounded-[24px] bg-white dark:bg-[#111827] border border-gray-100 dark:border-white/5 shadow-sm hover:shadow-md transition-all h-full"
                                >
                                    <div className={`w-14 h-14 rounded-2xl bg-gradient-to-br ${item.color} flex items-center justify-center text-white shadow-lg`}>
                                        <item.icon size={24} />
                                    </div>
                                    <span className="text-[11px] font-bold text-gray-600 dark:text-gray-300 text-center leading-tight">{item.label}</span>
                                </motion.button>
                            ))}
                        </AnimatePresence>
                    </div>
                ) : (
                    <div className="py-10 text-center text-gray-400">
                        <Search size={32} className="mx-auto mb-4 opacity-50" />
                        <p className="text-sm">No modules found matching "{searchQuery}"</p>
                    </div>
                )}
            </div>

            {/* Live Alerts Area */}
            <div className="px-6 pb-6">
                <h2 className="text-xl font-bold text-gray-900 dark:text-white mb-4">Live System Alerts</h2>
                <div className="space-y-4">
                    <AnimatePresence>
                        {alerts.length > 0 ? (
                            alerts.map((alert) => (
                                <motion.div
                                    key={alert.id}
                                    initial={{ opacity: 0, x: 20 }}
                                    animate={{ opacity: 1, x: 0 }}
                                    exit={{ opacity: 0, x: -20 }}
                                    className={`relative border p-5 rounded-3xl flex items-start gap-4 ${alert.type === 'critical' ? 'bg-red-500/5 border-red-500/10' :
                                        alert.type === 'warning' ? 'bg-orange-500/5 border-orange-500/10' :
                                            'bg-blue-500/5 border-blue-500/10'
                                        }`}
                                >
                                    <div className={`w-10 h-10 rounded-full flex items-center justify-center shrink-0 ${alert.type === 'critical' ? 'bg-red-500/10 text-red-500' :
                                        alert.type === 'warning' ? 'bg-orange-500/10 text-orange-500' :
                                            'bg-blue-500/10 text-blue-500'
                                        }`}>
                                        <AlertTriangle size={20} />
                                    </div>
                                    <div className="flex-1">
                                        <h4 className="font-bold text-gray-900 dark:text-white text-sm">{alert.title}</h4>
                                        <p className="text-xs text-gray-500 mt-1 leading-relaxed">{alert.desc}</p>
                                        <span className={`text-[10px] font-bold mt-2 block uppercase ${alert.type === 'critical' ? 'text-red-400' :
                                            alert.type === 'warning' ? 'text-orange-400' :
                                                'text-blue-400'
                                            }`}>{alert.type} • {alert.time}</span>
                                    </div>
                                    <button
                                        onClick={() => dismissedAlert(alert.id)}
                                        className="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                                    >
                                        <X size={16} />
                                    </button>
                                </motion.div>
                            ))
                        ) : (
                            <motion.div
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                className="p-6 rounded-3xl bg-green-500/5 border border-green-500/10 flex flex-col items-center text-center gap-3"
                            >
                                <CheckCircle size={32} className="text-green-500" />
                                <h4 className="font-bold text-gray-900 dark:text-white">All Systems Nominal</h4>
                                <p className="text-xs text-gray-500">No active alerts at this time.</p>
                            </motion.div>
                        )}
                    </AnimatePresence>
                </div>
            </div>

        </div>
    );
}
