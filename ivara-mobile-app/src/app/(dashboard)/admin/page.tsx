"use client";

import { motion } from 'framer-motion';
import {
    Users, Shield, FileText, Activity, Map, Wrench,
    Box, CreditCard, Bell, Settings, LogOut
} from 'lucide-react';

export default function AdminDashboard() {
    const stats = [
        { title: "Total Users", value: "12,450", color: "text-blue-600", bg: "bg-blue-100" },
        { title: "Active Repairs", value: "85", color: "text-orange-600", bg: "bg-orange-100" },
        { title: "Revenue", value: "$45.2k", color: "text-green-600", bg: "bg-green-100" },
        { title: "Pending", value: "12", color: "text-red-600", bg: "bg-red-100" },
    ];

    const menuItems = [
        { label: "User Control", icon: Users, color: "bg-indigo-500" },
        { label: "Permissions", icon: Shield, color: "bg-rose-500" },
        { label: "Reports", icon: FileText, color: "bg-emerald-500" },
        { label: "Live Map", icon: Map, color: "bg-blue-500" },
        { label: "Repairs", icon: Wrench, color: "bg-orange-500" },
        { label: "Inventory", icon: Box, color: "bg-teal-500" },
        { label: "Finance", icon: CreditCard, color: "bg-violet-500" },
        { label: "Logs", icon: Activity, color: "bg-gray-500" },
    ];

    return (
        <div className="min-h-screen bg-gray-50 dark:bg-[#0A1128] pb-24">
            {/* Header */}
            <header className="bg-[var(--primary-navy)] p-6 pt-12 pb-8 rounded-b-3xl">
                <div className="flex justify-between items-center text-white mb-6">
                    <div>
                        <h1 className="text-2xl font-bold">Admin Panel</h1>
                        <p className="text-white/70 text-sm">System Overview</p>
                    </div>
                    <div className="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <Settings className="w-5 h-5 text-white" />
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-2 gap-4">
                    {stats.map((stat, i) => (
                        <div key={i} className="bg-white/10 backdrop-blur-md border border-white/10 p-4 rounded-xl">
                            <p className="text-white/60 text-xs uppercase font-bold mb-1">{stat.title}</p>
                            <h3 className="text-white text-xl font-bold">{stat.value}</h3>
                        </div>
                    ))}
                </div>
            </header>

            {/* Quick Actions Grid */}
            <div className="p-6">
                <h2 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white mb-4">Management Modules</h2>
                <div className="grid grid-cols-4 gap-4">
                    {menuItems.map((item, i) => (
                        <motion.div
                            key={i}
                            whileTap={{ scale: 0.95 }}
                            className="flex flex-col items-center gap-2"
                        >
                            <div className={`w-14 h-14 rounded-2xl ${item.color} flex items-center justify-center shadow-lg shadow-gray-200 dark:shadow-none text-white`}>
                                <item.icon className="w-6 h-6" />
                            </div>
                            <span className="text-[10px] font-bold text-gray-600 dark:text-gray-300 text-center leading-tight">{item.label}</span>
                        </motion.div>
                    ))}
                </div>
            </div>

            {/* Recent Alerts */}
            <div className="px-6">
                <h2 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white mb-4">System Alerts</h2>
                <div className="space-y-3">
                    {[1, 2, 3].map((_, i) => (
                        <div key={i} className="bg-white dark:bg-[#162447] p-4 rounded-xl border border-gray-100 dark:border-white/5 flex gap-4 items-center shadow-sm">
                            <div className="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                <Bell className="w-5 h-5" />
                            </div>
                            <div>
                                <h4 className="text-sm font-bold text-gray-800 dark:text-white">High Server Load</h4>
                                <p className="text-xs text-gray-400">Detected 2 mins ago</p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>

        </div>
    );
}
