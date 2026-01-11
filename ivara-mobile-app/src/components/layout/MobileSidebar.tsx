"use client";

import React, { useState } from 'react';
import Link from 'next/link';
import { motion, AnimatePresence } from 'framer-motion';
import {
    X, ChevronDown, ChevronRight, Home, Info,
    Wrench, Truck, Leaf, Shirt, Palette, GraduationCap,
    Video, Scale, MoreHorizontal, ShoppingBag,
    Briefcase, MessageCircle, HelpCircle, LogIn, LayoutDashboard, LogOut
} from 'lucide-react';
import { usePathname, useRouter } from 'next/navigation';

interface MobileSidebarProps {
    isOpen: boolean;
    onClose: () => void;
    isLoggedIn: boolean;
    onOpenMarketplace: () => void;
    user?: any; // strict prop if I wanted to check role, but not strictly needed if I just show for all
}

export default function MobileSidebar({ isOpen, onClose, isLoggedIn, onOpenMarketplace }: MobileSidebarProps) {
    const router = useRouter();
    // Accordion States
    const [expandedSection, setExpandedSection] = useState<string | null>(null);

    const toggleSection = (section: string) => {
        setExpandedSection(expandedSection === section ? null : section);
    };

    const handleLogout = () => {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        sessionStorage.clear();
        router.push('/login');
    };

    const menuVariants = {
        hidden: { x: '-100%' },
        visible: { x: 0 },
        exit: { x: '-100%' }
    };

    const pathname = usePathname();

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
                        className="fixed top-0 left-0 h-full w-[85%] max-w-[320px] bg-[var(--primary-navy)] text-white z-[5001] shadow-2xl overflow-y-auto"
                    >
                        {/* Header */}
                        <div className="p-6 flex justify-between items-center border-b border-white/10">
                            <div className="flex items-center gap-3">
                                {/* Note: Assuming logo exists, else fallback or use text */}
                                <div className="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center font-bold text-[var(--accent-gold)]">I</div>
                                <span className="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                                    IVARA
                                </span>
                            </div>
                            <button onClick={onClose} className="p-2 bg-white/10 rounded-full hover:bg-white/20 transition-colors">
                                <X size={20} />
                            </button>
                        </div>

                        {/* Menu Items */}
                        <div className="p-4 space-y-1">

                            {/* Home */}
                            <Link href="/" onClick={onClose} className={`flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${pathname === '/' ? 'bg-[var(--accent-gold)] text-[var(--primary-navy)] font-bold' : 'hover:bg-white/5'}`}>
                                <Home size={18} /> Home
                            </Link>

                            {/* Solutions (Accordion) */}
                            <div>
                                <button
                                    onClick={() => toggleSection('solutions')}
                                    className={`w-full flex justify-between items-center px-4 py-3 rounded-xl hover:bg-white/5 transition-colors ${expandedSection === 'solutions' ? 'bg-white/5' : ''}`}
                                >
                                    <span className="flex items-center gap-3"><Wrench size={18} /> Solutions</span>
                                    {expandedSection === 'solutions' ? <ChevronDown size={16} /> : <ChevronRight size={16} />}
                                </button>
                                <AnimatePresence>
                                    {expandedSection === 'solutions' && (
                                        <motion.div
                                            initial={{ height: 0, opacity: 0 }}
                                            animate={{ height: 'auto', opacity: 1 }}
                                            exit={{ height: 0, opacity: 0 }}
                                            className="overflow-hidden bg-black/20 rounded-xl mt-1"
                                        >
                                            <div className="p-2 space-y-1">
                                                <div className="text-[10px] font-bold text-gray-400 uppercase px-3 pt-2 pb-1">Essential Services</div>
                                                <Link href="/category/technical" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><Wrench size={14} /> Technical & Repair</Link>
                                                <Link href="/category/transport" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><Truck size={14} /> Transport & Travel</Link>
                                                <Link href="/category/agriculture" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><Leaf size={14} /> Agriculture</Link>

                                                <div className="text-[10px] font-bold text-gray-400 uppercase px-3 pt-2 pb-1">Lifestyle</div>
                                                <Link href="/category/fashion" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><Shirt size={14} /> Food & Fashion</Link>
                                                <Link href="/category/creative" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><Palette size={14} /> Creative</Link>
                                                <Link href="/category/education" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><GraduationCap size={14} /> Education</Link>

                                                <div className="text-[10px] font-bold text-gray-400 uppercase px-3 pt-2 pb-1">Professional</div>
                                                <Link href="/category/media" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><Video size={14} /> Media</Link>
                                                <Link href="/category/legal" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><Scale size={14} /> Legal</Link>
                                                <Link href="/category/other" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg flex gap-2"><MoreHorizontal size={14} /> Other</Link>
                                            </div>
                                        </motion.div>
                                    )}
                                </AnimatePresence>
                            </div>

                            {/* Why IVARA */}
                            <Link href="/#why" onClick={onClose} className="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors">
                                <Info size={18} /> Why IVARA
                            </Link>

                            {/* Marketplace (Popup Trigger) */}
                            <button
                                onClick={onOpenMarketplace}
                                className="w-full flex justify-between items-center px-4 py-3 rounded-xl hover:bg-white/5 transition-colors"
                            >
                                <span className="flex items-center gap-3"><ShoppingBag size={18} /> Marketplace <span className="bg-[var(--accent-gold)] text-[var(--primary-navy)] text-[9px] font-bold px-1.5 py-0.5 rounded ml-2">NEW</span></span>
                                <ChevronRight size={16} />
                            </button>

                            {/* Portfolio */}
                            <div>
                                <button
                                    onClick={() => toggleSection('portfolio')}
                                    className={`w-full flex justify-between items-center px-4 py-3 rounded-xl hover:bg-white/5 transition-colors ${expandedSection === 'portfolio' ? 'bg-white/5' : ''}`}
                                >
                                    <span className="flex items-center gap-3"><Briefcase size={18} /> Portfolio</span>
                                    {expandedSection === 'portfolio' ? <ChevronDown size={16} /> : <ChevronRight size={16} />}
                                </button>
                                <AnimatePresence>
                                    {expandedSection === 'portfolio' && (
                                        <motion.div
                                            initial={{ height: 0, opacity: 0 }}
                                            animate={{ height: 'auto', opacity: 1 }}
                                            exit={{ height: 0, opacity: 0 }}
                                            className="overflow-hidden bg-black/20 rounded-xl mt-1"
                                        >
                                            <div className="p-2 space-y-1">
                                                <Link href="/portfolio/clients" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg">Our Clients</Link>
                                                <Link href="/portfolio/success-stories" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg">Success Stories</Link>
                                                <Link href="/portfolio/testimonials" onClick={onClose} className="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg">Testimonials</Link>
                                            </div>
                                        </motion.div>
                                    )}
                                </AnimatePresence>
                            </div>

                            {/* Contact/Support */}
                            <Link href="/contact" onClick={onClose} className="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-colors">
                                <MessageCircle size={18} /> Contact Support
                            </Link>

                        </div>

                        {/* Footer Actions */}
                        <div className="p-6 border-t border-white/10 mt-4">
                            {isLoggedIn ? (
                                <div>
                                    <Link
                                        href="/dashboard"
                                        onClick={onClose}
                                        className="w-full py-4 bg-[var(--accent-gold)] text-[var(--primary-navy)] font-bold rounded-xl flex items-center justify-center gap-2"
                                    >
                                        <LayoutDashboard size={18} /> Go to Dashboard
                                    </Link>
                                    <button
                                        onClick={handleLogout}
                                        className="w-full mt-3 py-4 bg-red-500/10 text-red-500 font-bold rounded-xl flex items-center justify-center gap-2 border border-red-500/10 hover:bg-red-500/20 transition-colors"
                                    >
                                        <LogOut size={18} /> Sign Out
                                    </button>
                                </div>
                            ) : (
                                <div className="space-y-3">
                                    <Link
                                        href="/login"
                                        onClick={onClose}
                                        className="w-full py-4 bg-white/10 text-white font-bold rounded-xl flex items-center justify-center gap-2 border border-white/10 hover:bg-white/20 transition-colors"
                                    >
                                        <LogIn size={18} /> Sign In
                                    </Link>
                                    <Link
                                        href="/register"
                                        onClick={onClose}
                                        className="w-full py-4 bg-[var(--accent-gold)] text-[var(--primary-navy)] font-bold rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-yellow-500/20"
                                    >
                                        Get Started
                                    </Link>
                                </div>
                            )}
                        </div>

                    </motion.aside>
                </>
            )}
        </AnimatePresence>
    );
}
