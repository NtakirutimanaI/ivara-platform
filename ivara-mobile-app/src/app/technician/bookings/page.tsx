'use client';

import React, { useEffect, useState } from 'react';
import { motion } from 'framer-motion';
import { Calendar, User, Clock, MapPin, ChevronRight } from 'lucide-react';
import MobileHeader from '@/components/MobileHeader';
import api from '@/lib/api';

export default function TechnicianBookingsPage() {
    const [bookings, setBookings] = useState<any[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchBookings = async () => {
            try {
                const response = await api.get('/technician/bookings');
                setBookings(response.data);
            } catch (err) {
                console.error('Failed to fetch bookings', err);
            } finally {
                setLoading(false);
            }
        };
        fetchBookings();
    }, []);

    const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    const currentDay = 2; // Wed

    return (
        <div className="min-h-screen bg-background pb-20">
            <MobileHeader />

            <div className="p-6">
                <header className="mb-8 mt-4">
                    <h1 className="text-3xl font-bold text-foreground">Bookings</h1>
                    <p className="text-muted">Direct client consultations</p>
                </header>

                <div className="flex justify-between items-center mb-8 bg-secondary/30 p-2 rounded-3xl">
                    {days.map((day, idx) => (
                        <div key={day} className={`flex flex-col items-center p-3 rounded-2xl w-11 ${idx === currentDay ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'text-muted'}`}>
                            <span className="text-[10px] font-bold uppercase">{day}</span>
                            <span className="text-base font-bold">{25 + idx}</span>
                        </div>
                    ))}
                </div>

                <div className="space-y-6">
                    <h3 className="text-xs font-bold text-muted uppercase tracking-widest px-1">Upcoming Appointments</h3>

                    {loading ? (
                        <div className="flex justify-center py-10">
                            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                        </div>
                    ) : (
                        <div className="space-y-4">
                            {[1, 2].map((_, idx) => (
                                <motion.div
                                    key={idx}
                                    initial={{ opacity: 0, x: -20 }}
                                    animate={{ opacity: 1, x: 0 }}
                                    transition={{ delay: idx * 0.1 }}
                                    className="glass-card p-5 !rounded-[32px] relative overflow-hidden"
                                >
                                    <div className="flex gap-4">
                                        <div className="flex flex-col items-center justify-center p-3 bg-secondary/50 rounded-2xl min-w-[64px]">
                                            <span className="text-sm font-bold text-foreground">09:00</span>
                                            <span className="text-[10px] font-bold text-muted uppercase">AM</span>
                                        </div>
                                        <div className="flex-1">
                                            <div className="flex justify-between items-start mb-1">
                                                <h4 className="font-bold text-foreground">Michael Smith</h4>
                                                <span className="status-pill available !bg-blue-500/10 !text-blue-500 !border-blue-500/20 !px-2 !py-0.5 !text-[10px]">Site Visit</span>
                                            </div>
                                            <p className="text-sm text-foreground/80 font-medium italic">"Water damage diagnostic"</p>
                                            <div className="flex items-center gap-4 mt-3 text-muted">
                                                <div className="flex items-center gap-1">
                                                    <Clock size={12} />
                                                    <span className="text-[11px] font-medium">45 mins</span>
                                                </div>
                                                <div className="flex items-center gap-1">
                                                    <MapPin size={12} />
                                                    <span className="text-[11px] font-medium tracking-tight">Kigali, Sector 4</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button className="absolute right-4 bottom-5 w-10 h-10 glass flex items-center justify-center rounded-xl text-primary active:scale-95 transition-all">
                                        <ChevronRight size={20} />
                                    </button>
                                </motion.div>
                            ))}
                        </div>
                    )}
                </div>

                <motion.button
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    className="w-full mt-12 py-4 btn-primary !rounded-2xl shadow-xl shadow-primary/30 font-bold"
                >
                    View Full Schedule
                </motion.button>
            </div>
        </div>
    );
}
