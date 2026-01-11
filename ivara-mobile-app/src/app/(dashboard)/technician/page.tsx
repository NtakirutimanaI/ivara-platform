"use client";

import { motion } from 'framer-motion';
import { Wrench, MapPin, Calendar, CheckCircle, DollarSign, Clock, ChevronRight } from 'lucide-react';
import { useState } from 'react';

export default function TechnicianDashboard() {
    const [isOnline, setIsOnline] = useState(true);

    return (
        <div className="min-h-screen bg-gray-50 dark:bg-[#0A1128] pb-24">
            {/* Header */}
            <header className="bg-[var(--primary-navy)] p-6 pt-12 rounded-b-3xl">
                <div className="flex justify-between items-start mb-6">
                    <div>
                        <p className="text-white/70 text-sm">Hello, Master Tech</p>
                        <h1 className="text-2xl font-bold text-white">Alex Johnson</h1>
                    </div>
                    <div className="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full backdrop-blur-sm" onClick={() => setIsOnline(!isOnline)}>
                        <div className={`w-2.5 h-2.5 rounded-full ${isOnline ? 'bg-green-400 animate-pulse' : 'bg-gray-400'}`}></div>
                        <span className="text-xs font-bold text-white">{isOnline ? 'Online' : 'Offline'}</span>
                    </div>
                </div>

                {/* Earnings Card */}
                <div className="bg-[var(--accent-gold)] rounded-2xl p-5 text-[var(--primary-navy)] shadow-lg shadow-yellow-500/20">
                    <div className="flex justify-between items-center mb-2">
                        <span className="text-sm font-bold opacity-80">Today's Earnings</span>
                        <DollarSign className="w-5 h-5 opacity-80" />
                    </div>
                    <h2 className="text-3xl font-extrabold mb-4">45,000 RWF</h2>
                    <div className="flex gap-4">
                        <div>
                            <span className="text-xs opacity-70 block">Jobs Done</span>
                            <span className="font-bold">3</span>
                        </div>
                        <div>
                            <span className="text-xs opacity-70 block">Time</span>
                            <span className="font-bold">4h 20m</span>
                        </div>
                    </div>
                </div>
            </header>

            {/* Quick Actions */}
            <div className="p-6 grid grid-cols-2 gap-4 -mt-4">
                {[
                    { label: "My Jobs", icon: Wrench, color: "bg-blue-100 text-blue-600" },
                    { label: "Map View", icon: MapPin, color: "bg-purple-100 text-purple-600" },
                    { label: "Schedule", icon: Calendar, color: "bg-orange-100 text-orange-600" },
                    { label: "History", icon: Clock, color: "bg-green-100 text-green-600" },
                ].map((item, i) => (
                    <motion.div
                        key={i}
                        whileTap={{ scale: 0.98 }}
                        className="bg-white dark:bg-[#162447] p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 flex items-center gap-3"
                    >
                        <div className={`w-10 h-10 rounded-xl ${item.color} flex items-center justify-center`}>
                            <item.icon className="w-5 h-5" />
                        </div>
                        <span className="font-bold text-sm text-[var(--primary-navy)] dark:text-white">{item.label}</span>
                    </motion.div>
                ))}
            </div>

            {/* Active Job */}
            <div className="px-6 mb-6">
                <h3 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white mb-4">Active Job</h3>
                <div className="bg-white dark:bg-[#162447] p-5 rounded-2xl shadow-lg border-l-4 border-l-[var(--accent-gold)] relative overflow-hidden">
                    <div className="flex justify-between items-start mb-4">
                        <div>
                            <h4 className="font-bold text-lg dark:text-white">Fridge Repair</h4>
                            <p className="text-sm text-gray-500">Samsung RF28 (Cooling Issue)</p>
                        </div>
                        <span className="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase rounded-md">In Progress</span>
                    </div>

                    <div className="flex items-center gap-3 mb-4">
                        <div className="w-8 h-8 rounded-full bg-gray-200"></div>
                        <div>
                            <p className="text-xs font-bold dark:text-gray-300">Client: Sarah K.</p>
                            <p className="text-[10px] text-gray-400">+250 788 123 456</p>
                        </div>
                    </div>

                    <div className="flex gap-2">
                        <button className="flex-1 py-2 rounded-lg bg-[var(--primary-navy)] text-white text-xs font-bold">Directions</button>
                        <button className="flex-1 py-2 rounded-lg border border-[var(--primary-navy)] text-[var(--primary-navy)] dark:border-white dark:text-white text-xs font-bold">Details</button>
                    </div>
                </div>
            </div>

            {/* Upcoming */}
            <div className="px-6">
                <h3 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white mb-4">Upcoming</h3>
                <div className="space-y-3">
                    {[1, 2].map((_, i) => (
                        <div key={i} className="flex items-center gap-4 bg-white dark:bg-[#162447] p-4 rounded-xl border border-gray-100 dark:border-white/5">
                            <div className="flex flex-col items-center justify-center w-12 h-12 bg-gray-50 dark:bg-white/5 rounded-xl text-[var(--primary-navy)] dark:text-white font-bold">
                                <span className="text-xs uppercase opacity-60">Today</span>
                                <span className="text-lg">14:00</span>
                            </div>
                            <div className="flex-1">
                                <h4 className="font-bold text-sm dark:text-white">Washing Machine Check</h4>
                                <p className="text-xs text-gray-500">Kicukiro, Niboye</p>
                            </div>
                            <ChevronRight className="w-5 h-5 text-gray-400" />
                        </div>
                    ))}
                </div>
            </div>

        </div>
    );
}
