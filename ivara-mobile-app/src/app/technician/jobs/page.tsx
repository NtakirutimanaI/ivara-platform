'use client';

import React, { useEffect, useState } from 'react';
import { motion } from 'framer-motion';
import { LayoutDashboard, CheckCircle2, Clock, AlertTriangle } from 'lucide-react';
import MobileHeader from '@/components/MobileHeader';
import api from '@/lib/api';

export default function TechnicianJobsPage() {
    const [jobs, setJobs] = useState<any[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchJobs = async () => {
            try {
                const response = await api.get('/technician/jobs');
                setJobs(response.data);
            } catch (err) {
                console.error('Failed to fetch jobs', err);
            } finally {
                setLoading(false);
            }
        };
        fetchJobs();
    }, []);

    return (
        <div className="min-h-screen bg-background pb-20">
            <MobileHeader />

            <div className="p-6">
                <header className="mb-8 mt-4">
                    <h1 className="text-3xl font-bold text-foreground">Assigned Jobs</h1>
                    <p className="text-muted">Manage your active technical repairs</p>
                </header>

                <div className="grid grid-cols-2 gap-4 mb-8">
                    <div className="glass-card p-4 !rounded-3xl bg-blue-500/10 border-blue-500/20">
                        <Clock className="text-blue-500 mb-2" size={20} />
                        <h3 className="text-2xl font-bold text-foreground">12</h3>
                        <p className="text-[10px] font-bold text-muted uppercase">Pending</p>
                    </div>
                    <div className="glass-card p-4 !rounded-3xl bg-green-500/10 border-green-500/20">
                        <CheckCircle2 className="text-green-500 mb-2" size={20} />
                        <h3 className="text-2xl font-bold text-foreground">24</h3>
                        <p className="text-[10px] font-bold text-muted uppercase">Completed</p>
                    </div>
                </div>

                <div className="space-y-4">
                    {loading ? (
                        <div className="flex justify-center py-10">
                            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                        </div>
                    ) : jobs.length > 0 ? (
                        jobs.map((job, idx) => (
                            <motion.div
                                key={job._id || idx}
                                initial={{ opacity: 0, y: 10 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ delay: idx * 0.1 }}
                                className="glass-card p-5 !rounded-3xl flex flex-col gap-4"
                            >
                                <div className="flex justify-between items-start">
                                    <div>
                                        <span className="text-[10px] font-bold text-primary uppercase tracking-wider bg-primary/10 px-2 py-0.5 rounded-full mb-2 inline-block">
                                            Job #{job._id?.substring(0, 8).toUpperCase() || 'NEW'}
                                        </span>
                                        <h4 className="font-bold text-foreground text-lg">{job.deviceName || 'Technical Repair'}</h4>
                                        <p className="text-sm text-muted line-clamp-1">{job.problemDescription || 'General technical issue'}</p>
                                    </div>
                                    <div className="status-pill available !bg-yellow-500/10 !text-yellow-600 !border-yellow-500/20">
                                        <span className="text-[10px] font-bold">In Progress</span>
                                    </div>
                                </div>
                                <div className="flex justify-between items-center pt-2 border-t border-white/5">
                                    <span className="text-xs text-muted font-medium">Updated: Just now</span>
                                    <button className="btn-primary !py-2 !px-4 !text-xs !rounded-xl !w-auto">Update Status</button>
                                </div>
                            </motion.div>
                        ))
                    ) : (
                        <div className="text-center py-20 glass-card !rounded-[32px]">
                            <LayoutDashboard size={48} className="mx-auto text-muted/30 mb-4" />
                            <h3 className="text-lg font-bold text-foreground">No active jobs</h3>
                            <p className="text-sm text-muted">You're all caught up!</p>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
