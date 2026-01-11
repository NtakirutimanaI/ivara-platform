"use client";

import React from 'react';
import { motion } from 'framer-motion';
import { Phone, Mail, MapPin, MessageSquare, ArrowLeft, Send } from 'lucide-react';
import Link from 'next/link';
import Image from 'next/image';

export default function ContactPage() {
    return (
        <div className="min-h-screen bg-gray-50 dark:bg-[#0A1128] pb-24">
            {/* Header Image Area */}
            <div className="relative h-[280px] w-full overflow-hidden bg-[var(--primary-navy)]">
                <div className="absolute inset-0 bg-black/40 z-10"></div>
                <Image
                    src="/images/support_bg.png"
                    alt="Support Background"
                    fill
                    className="object-cover opacity-60"
                    priority
                />

                <div className="absolute top-6 left-4 z-20">
                    <Link href="/" className="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-white/30 transition-colors">
                        <ArrowLeft size={20} />
                    </Link>
                </div>

                <div className="absolute bottom-0 left-0 right-0 p-6 z-20 text-white">
                    <motion.h1
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        className="text-3xl font-bold mb-2"
                    >
                        Get in Touch
                    </motion.h1>
                    <motion.p
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.1 }}
                        className="text-gray-200 text-sm"
                    >
                        We're here to help you with anything you need.
                    </motion.p>
                </div>
            </div>

            <div className="px-6 -mt-6 relative z-30">
                {/* Contact Info Card */}
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.2 }}
                    className="bg-white dark:bg-[#162447] rounded-3xl p-6 shadow-xl border border-gray-100 dark:border-white/5 space-y-6"
                >
                    <div className="flex items-center gap-4">
                        <div className="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                            <Phone size={24} />
                        </div>
                        <div>
                            <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider">Phone Support</h3>
                            <p className="font-semibold text-[var(--primary-navy)] dark:text-white mt-0.5">+250 788 446 936</p>
                        </div>
                    </div>

                    <div className="w-full h-px bg-gray-100 dark:bg-white/5"></div>

                    <div className="flex items-center gap-4">
                        <div className="w-12 h-12 rounded-2xl bg-[var(--accent-gold)]/10 flex items-center justify-center text-[var(--accent-gold)]">
                            <Mail size={24} />
                        </div>
                        <div>
                            <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider">Email Address</h3>
                            <p className="font-semibold text-[var(--primary-navy)] dark:text-white mt-0.5">support@ivara.com</p>
                        </div>
                    </div>

                    <div className="w-full h-px bg-gray-100 dark:bg-white/5"></div>

                    <div className="flex items-center gap-4">
                        <div className="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600 dark:text-purple-400">
                            <MapPin size={24} />
                        </div>
                        <div>
                            <h3 className="text-xs font-bold text-gray-500 uppercase tracking-wider">Location</h3>
                            <p className="font-semibold text-[var(--primary-navy)] dark:text-white mt-0.5">Kigali, Rwanda</p>
                        </div>
                    </div>
                </motion.div>

                {/* Support Visual */}
                <motion.div
                    initial={{ opacity: 0, scale: 0.95 }}
                    animate={{ opacity: 1, scale: 1 }}
                    transition={{ delay: 0.3 }}
                    className="mt-8 relative w-full aspect-[4/3] rounded-3xl overflow-hidden shadow-lg"
                >
                    <Image
                        src="/images/support.png"
                        alt="Ivara Support Team"
                        fill
                        className="object-cover"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-[var(--primary-navy)] via-transparent to-transparent opacity-60"></div>
                    <div className="absolute bottom-4 left-4 right-4">
                        <p className="text-white text-xs font-medium bg-black/30 backdrop-blur-md p-3 rounded-xl border border-white/10">
                            "Our dedicated team is available 24/7 to assist you with any inquiries."
                        </p>
                    </div>
                </motion.div>

                {/* Quick Message Form */}
                <div className="mt-8 mb-4">
                    <h3 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white mb-4 flex items-center gap-2">
                        <MessageSquare size={20} className="text-[var(--accent-gold)]" /> Send a Message
                    </h3>

                    <form className="space-y-4">
                        <div className="space-y-1.5">
                            <label className="text-xs font-bold text-gray-500 uppercase ml-2">Subject</label>
                            <input type="text" placeholder="How can we help?" className="w-full h-12 bg-white dark:bg-[#162447] rounded-xl px-4 border border-gray-200 dark:border-white/10 focus:border-[var(--accent-gold)] outline-none transition-colors dark:text-white" />
                        </div>

                        <div className="space-y-1.5">
                            <label className="text-xs font-bold text-gray-500 uppercase ml-2">Message</label>
                            <textarea rows={4} placeholder="Type your message here..." className="w-full bg-white dark:bg-[#162447] rounded-xl p-4 border border-gray-200 dark:border-white/10 focus:border-[var(--accent-gold)] outline-none transition-colors resize-none dark:text-white"></textarea>
                        </div>

                        <button type="button" className="w-full py-4 bg-[var(--primary-navy)] text-white font-bold rounded-2xl shadow-lg shadow-blue-900/20 active:scale-95 transition-all flex items-center justify-center gap-2">
                            <Send size={18} /> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    );
}
