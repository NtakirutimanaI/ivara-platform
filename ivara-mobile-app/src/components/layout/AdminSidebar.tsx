"use client";

import React, { useState } from 'react';
import Link from 'next/link';
import { motion, AnimatePresence } from 'framer-motion';
import {
    X, Home, LayoutDashboard, Users, Shield, FileText, Map,
    Wrench, Box, CreditCard, Activity, LogOut, Settings
} from 'lucide-react';
import { usePathname } from 'next/navigation';

interface AdminSidebarProps {
    isOpen: boolean;
    onClose: () => void;
    user: any;
}

export default function AdminSidebar({ isOpen, onClose, user }: AdminSidebarProps) {
    const pathname = usePathname();
    const menuVariants = {
        hidden: { x: '-100%' },
        visible: { x: 0 },
        exit: { x: '-100%' }
    };

    const handleLogout = () => {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        window.location.href = '/login';
    };

    return (
        <AnimatePresence>
            {isOpen && (
                <>
                    {/* Backdrop */}
                    <motion.div
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        exit={{ opacity: 0 }}
                        onClick={onClose}
                        className="fixed inset-0 bg-black/60 backdrop-blur-sm z-[5000]"
                    />

                    {/* Sidebar Drawer */}
                    <motion.aside
                        variants={menuVariants}
                        initial="hidden"
                        animate="visible"
                        exit="exit"
                        transition={{ type: "spring", damping: 25, stiffness: 200 }}
                        className="fixed top-0 left-0 h-full w-[85%] max-w-[320px] bg-[#0A1128] text-white z-[5001] shadow-2xl overflow-y-auto border-r border-white/5"
                    >
                        {/* Header */}
                        <div className="p-6 flex justify-between items-center border-b border-white/10 bg-[#162447]">
                            <div className="flex items-center gap-3">
                                <div className="w-10 h-10 rounded-xl bg-[var(--accent-gold)] flex items-center justify-center font-bold text-[var(--primary-navy)] text-xl shadow-lg shadow-yellow-500/20">
                                    I
                                </div>
                                <div>
                                    <h2 className="text-lg font-bold">Admin Panel</h2>
                                    <p className="text-xs text-gray-400">Super Admin Access</p>
                                </div>
                            </div>
                            <button onClick={onClose} className="p-2 bg-white/5 rounded-full hover:bg-white/10 transition-colors">
                                <X size={20} />
                            </button>
                        </div>

                        {/* User Info */}
                        <div className="p-6 border-b border-white/5">
                            <div className="flex items-center gap-3">
                                <div className="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-500/30">
                                    <span className="font-bold text-blue-400">{user?.name?.[0] || 'A'}</span>
                                </div>
                                <div>
                                    <p className="font-bold">{user?.name || 'Administrator'}</p>
                                    <p className="text-xs text-gray-500">{user?.email || 'admin@ivara.com'}</p>
                                </div>
                            </div>
                        </div>

                        {/* Menu Items */}
                        <div className="p-4 space-y-1">
                            <Link href="/superadmin/dashboard" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname === '/superadmin/dashboard' ? 'bg-[var(--accent-gold)] text-[var(--primary-navy)] font-bold' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <LayoutDashboard size={18} /> Dashboard
                            </Link>

                            <div className="py-2 px-4 uppercase text-[10px] font-bold text-gray-500 tracking-wider">Management</div>

                            <Link href="/superadmin/users" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/users') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <Users size={18} /> User Control
                            </Link>

                            <Link href="/superadmin/permissions" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/permissions') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <Shield size={18} /> Permissions
                            </Link>

                            <Link href="/superadmin/reports" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/reports') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <FileText size={18} /> Reports
                            </Link>

                            <Link href="/superadmin/map" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/map') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <Map size={18} /> Live Map
                            </Link>

                            <div className="py-2 px-4 uppercase text-[10px] font-bold text-gray-500 tracking-wider">Operations</div>

                            <Link href="/superadmin/repairs" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/repairs') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <Wrench size={18} /> Repairs
                            </Link>

                            <Link href="/superadmin/inventory" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/inventory') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <Box size={18} /> Inventory
                            </Link>

                            <Link href="/superadmin/finance" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/finance') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <CreditCard size={18} /> Finance
                            </Link>

                            <Link href="/superadmin/logs" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname.startsWith('/superadmin/logs') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-gray-300 hover:text-white'}`}>
                                <Activity size={18} /> System Logs
                            </Link>
                        </div>

                        {/* Footer */}
                        <div className="p-6 border-t border-white/10 mt-4 space-y-2">
                            <Link href="/profile" onClick={onClose} className="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-gray-300 hover:text-white transition-colors">
                                <Settings size={18} /> Settings
                            </Link>
                            <button onClick={handleLogout} className="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500/10 text-red-400 hover:text-red-300 transition-colors">
                                <LogOut size={18} /> Sign Out
                            </button>
                        </div>
                    </motion.aside>
                </>
            )}
        </AnimatePresence>
    );
}
