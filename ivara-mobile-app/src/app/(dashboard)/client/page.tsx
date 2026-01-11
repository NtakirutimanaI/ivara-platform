"use client";

import { motion } from 'framer-motion';
import { Plus, Smartphone, Clock, ChevronRight } from 'lucide-react';
import Link from 'next/link';

export default function ClientDashboard() {
    return (
        <div className="min-h-screen bg-gray-50 dark:bg-[#0A1128] pb-24">
            {/* Header */}
            <header className="bg-[var(--primary-navy)] p-6 pt-12 pb-20 rounded-b-[40px] relative overflow-hidden">
                <div className="absolute top-0 right-0 w-48 h-48 bg-[var(--accent-gold)]/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                <div className="relative z-10 flex justify-between items-center text-white mb-4">
                    <div>
                        <h1 className="text-2xl font-bold">My Devices</h1>
                        <p className="text-white/70 text-sm">Manage your registered assets</p>
                    </div>
                    <Link href="/add-device" className="w-10 h-10 bg-[var(--accent-gold)] rounded-full flex items-center justify-center text-[var(--primary-navy)] shadow-lg hover:scale-105 transition-transform">
                        <Plus className="w-6 h-6" />
                    </Link>
                </div>
            </header>

            {/* Stats / Overview - Floating Card */}
            <div className="px-6 -mt-12 mb-8 relative z-20">
                <div className="bg-white dark:bg-[#162447] p-5 rounded-2xl shadow-xl border border-gray-100 dark:border-white/5 flex justify-between items-center">
                    <div className="text-center">
                        <span className="block text-2xl font-extrabold text-[var(--primary-navy)] dark:text-white">3</span>
                        <span className="text-xs text-gray-500 font-medium uppercase">Devices</span>
                    </div>
                    <div className="w-px h-10 bg-gray-200 dark:bg-white/10"></div>
                    <div className="text-center">
                        <span className="block text-2xl font-extrabold text-blue-600">1</span>
                        <span className="text-xs text-gray-500 font-medium uppercase">In Repair</span>
                    </div>
                    <div className="w-px h-10 bg-gray-200 dark:bg-white/10"></div>
                    <div className="text-center">
                        <span className="block text-2xl font-extrabold text-green-600">2</span>
                        <span className="text-xs text-gray-500 font-medium uppercase">Active</span>
                    </div>
                </div>
            </div>

            {/* Active Repairs */}
            <div className="px-6 mb-6">
                <h3 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white mb-4">Active Repairs</h3>
                <div className="bg-white dark:bg-[#162447] p-5 rounded-2xl shadow-sm border border-blue-100 dark:border-blue-900/30">
                    <div className="flex justify-between items-start mb-4">
                        <div className="flex items-center gap-3">
                            <div className="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                <Smartphone className="w-5 h-5" />
                            </div>
                            <div>
                                <h4 className="font-bold text-sm dark:text-white">iPhone 13 Pro</h4>
                                <p className="text-xs text-gray-500">Screen Replacement</p>
                            </div>
                        </div>
                        <span className="px-2 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-md uppercase">Diagnosing</span>
                    </div>

                    {/* Progress Bar */}
                    <div className="w-full h-1.5 bg-gray-100 dark:bg-white/10 rounded-full mb-3 overflow-hidden">
                        <div className="w-1/3 h-full bg-blue-600 rounded-full"></div>
                    </div>
                    <div className="flex justify-between text-[10px] text-gray-500 font-medium uppercase">
                        <span>Received</span>
                        <span className="text-blue-600">Diagnosing</span>
                        <span>Repairing</span>
                        <span>Ready</span>
                    </div>
                </div>
            </div>

            {/* Recent Devices List */}
            <div className="px-6">
                <h3 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white mb-4">My Assets</h3>
                <div className="space-y-3">
                    {[
                        { name: "MacBook Pro M1", type: "Laptop", status: "Active", icon: Smartphone, color: "bg-gray-100 text-gray-600" },
                        { name: "Samsung Fridge", type: "Home Appliance", status: "Warranty", icon: Clock, color: "bg-green-100 text-green-600" },
                    ].map((device, i) => (
                        <div key={i} className="flex items-center gap-4 bg-white dark:bg-[#162447] p-4 rounded-xl border border-gray-100 dark:border-white/5">
                            <div className={`w-12 h-12 rounded-xl flex items-center justify-center ${device.color}`}>
                                <device.icon className="w-5 h-5" />
                            </div>
                            <div className="flex-1">
                                <h4 className="font-bold text-sm dark:text-white">{device.name}</h4>
                                <p className="text-xs text-gray-500">{device.type} • <span className="text-green-600">{device.status}</span></p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>

        </div>
    );
}
