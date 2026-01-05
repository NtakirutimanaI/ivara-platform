'use client';

import React from 'react';
import { useRouter } from 'next/navigation';
import { motion } from 'framer-motion';
import { User, Mail, Shield, ArrowLeft, Camera, LogOut } from 'lucide-react';
import MobileHeader from '@/components/MobileHeader';
import { useEffect, useState } from 'react';

export default function ProfilePage() {
    const router = useRouter();
    const [user, setUser] = useState<any>(null);

    useEffect(() => {
        const storedUser = localStorage.getItem('user');
        if (storedUser) {
            setUser(JSON.parse(storedUser));
        }
    }, []);

    const handleLogout = () => {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        router.push('/login');
    };

    const getInitials = (name: string) => {
        if (!name) return 'U';
        return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
    };

    const getProfilePhotoUrl = (photo: any) => {
        if (!photo) return null;
        if (typeof photo === 'string' && (photo.startsWith('http') || photo.startsWith('data:'))) {
            return photo;
        }

        // Remove 'uploads/' from the beginning if it exists
        const cleanPath = typeof photo === 'string' ? photo.replace(/^uploads\//, '') : photo;

        // Backend serves 'uploads' folder at http://localhost:5001/uploads/
        return `http://localhost:5001/uploads/${cleanPath}`;
    };

    return (
        <div className="min-h-screen bg-background pb-24">
            <MobileHeader />

            <div className="p-6">
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    className="flex flex-col items-center mt-8 mb-12"
                >
                    <div className="relative group">
                        <div className="w-32 h-32 rounded-[24px] bg-primary flex items-center justify-center border-4 border-background overflow-hidden text-white text-4xl font-bold shadow-2xl shadow-primary/20">
                            {getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto) ? (
                                <img src={getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto)!} alt="Profile" className="w-full h-full object-cover" />
                            ) : (
                                <span>{getInitials(user?.name)}</span>
                            )}
                        </div>
                        <button className="absolute -bottom-2 -right-2 w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg border-4 border-background active:scale-90 transition-transform">
                            <Camera size={18} className="text-white" />
                        </button>
                    </div>

                    <h1 className="text-2xl font-bold mt-6 text-foreground">{user?.name || 'Super Admin'}</h1>
                    <p className="text-primary font-semibold text-sm uppercase tracking-wider">{user?.role || 'User'}</p>
                </motion.div>

                <div className="space-y-4">
                    <motion.div
                        initial={{ opacity: 0, x: -20 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ delay: 0.1 }}
                        className="glass !rounded-[24px] p-5 flex items-center gap-4"
                    >
                        <div className="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                            <Mail size={22} />
                        </div>
                        <div>
                            <p className="text-xs text-muted">Email Address</p>
                            <p className="font-semibold text-foreground">{user?.email || 'N/A'}</p>
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, x: -20 }}
                        animate={{ opacity: 1, x: 0 }}
                        transition={{ delay: 0.2 }}
                        className="glass !rounded-[24px] p-5 flex items-center gap-4"
                    >
                        <div className="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-500">
                            <Shield size={22} />
                        </div>
                        <div>
                            <p className="text-xs text-muted">Account Role</p>
                            <p className="font-semibold text-foreground">{user?.role || 'User'}</p>
                        </div>
                    </motion.div>
                </div>

                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.3 }}
                    className="mt-12 space-y-4"
                >
                    <button
                        onClick={() => router.push('/profile')}
                        className="w-full btn-secondary py-4 rounded-2xl font-bold"
                    >
                        Edit Profile
                    </button>

                    <button
                        onClick={handleLogout}
                        className="w-full py-4 rounded-2xl font-bold text-red-500 bg-red-500/10 border border-red-500/20 active:scale-95 transition-all flex items-center justify-center gap-2"
                    >
                        <LogOut size={20} />
                        Log Out
                    </button>
                </motion.div>

                {/* Intelligent Back Button */}
                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ delay: 0.5 }}
                    className="mt-12 flex justify-center"
                >
                    <button
                        onClick={() => router.back()}
                        className="flex items-center gap-2 px-8 py-3 rounded-full glass border-white/5 text-muted font-semibold active:scale-95 transition-all"
                    >
                        <ArrowLeft size={18} />
                        Back
                    </button>
                </motion.div>
            </div>
        </div>
    );
}
