"use client";

import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import {
    Search,
    Plus,
    Moon,
    Sun,
    User,
    Smartphone,
    X,
    LayoutDashboard,
    MessageSquare,
    Bell,
    Settings,
    LogOut,
    Package,
    Users,
    Wrench,
    ArrowLeft,
    Camera,
    Key,
    Check,
    AlertCircle,
    Eye,
    EyeOff,
    Menu
} from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';
import { useTheme } from '@/contexts/ThemeContext';
import { useRouter, usePathname } from 'next/navigation';
import api from '@/lib/api';
import MobileSidebar from '@/components/layout/MobileSidebar';
import AdminSidebar from '@/components/layout/AdminSidebar';
import { useSearch } from '@/contexts/SearchContext';

export default function MobileHeader() {
    const { theme, toggleTheme } = useTheme();
    const router = useRouter();
    const pathname = usePathname();
    const { searchQuery, setSearchQuery } = useSearch();

    const [isSearchOpen, setIsSearchOpen] = useState(false);
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);
    const [isQuickAddOpen, setIsQuickAddOpen] = useState(false);
    const [isProfileDrawerOpen, setIsProfileDrawerOpen] = useState(false);
    const [isEditModalOpen, setIsEditModalOpen] = useState(false);
    const [isChangingPassword, setIsChangingPassword] = useState(false);
    const [statusMessage, setStatusMessage] = useState<{ type: 'success' | 'error', text: string } | null>(null);
    const [user, setUser] = useState<any>(null);
    const [isMarketplaceOpen, setIsMarketplaceOpen] = useState(false);

    // Form States
    const [editForm, setEditForm] = useState({ name: '', email: '' });
    const [passwordForm, setPasswordForm] = useState({ current: '', new: '', confirm: '' });
    const [showPasswords, setShowPasswords] = useState({ current: false, new: false, confirm: false });
    const [selectedFile, setSelectedFile] = useState<File | null>(null);
    const [uploadPreview, setUploadPreview] = useState<string | null>(null);
    const [isSubmitting, setIsSubmitting] = useState(false);

    const isLandingPage = pathname === '/';
    const isDashboardPage = pathname === '/dashboard' || pathname === '/select-category';
    const isRootPage = isLandingPage || isDashboardPage;
    const [isLoggedIn, setIsLoggedIn] = useState(false);

    // Determine Logic for Admin
    const isAdmin = user?.role === 'admin' || user?.role === 'super_admin' || user?.role === 'Super Admin';

    useEffect(() => {
        const token = localStorage.getItem('token');
        const storedUser = localStorage.getItem('user');
        setIsLoggedIn(!!token);
        if (storedUser) {
            const parsed = JSON.parse(storedUser);
            setUser(parsed);
            setEditForm({ name: parsed.name || '', email: parsed.email || '' });
        }
    }, [pathname]);

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            setSelectedFile(file);
            const reader = new FileReader();
            reader.onloadend = () => {
                setUploadPreview(reader.result as string);
            };
            reader.readAsDataURL(file);
        }
    };

    const handleProfileUpdate = async () => {
        if (!editForm.name || !editForm.email) {
            setStatusMessage({ type: 'error', text: 'Please fill in all fields.' });
            return;
        }

        setIsSubmitting(true);
        try {
            const formData = new FormData();
            formData.append('name', editForm.name);
            formData.append('email', editForm.email);
            if (selectedFile) {
                formData.append('profilePhoto', selectedFile);
            }

            const response = await api.patch('/profile', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });

            const updatedUser = response.data;
            localStorage.setItem('user', JSON.stringify(updatedUser));
            setUser(updatedUser);
            setStatusMessage({ type: 'success', text: 'Profile updated successfully!' });
            setSelectedFile(null);
            setUploadPreview(null);
            setTimeout(() => setStatusMessage(null), 3000);
        } catch (err: any) {
            setStatusMessage({ type: 'error', text: err.response?.data?.error || 'Failed to update profile.' });
        } finally {
            setIsSubmitting(false);
        }
    };

    const handlePasswordUpdate = async () => {
        if (!passwordForm.current || !passwordForm.new || !passwordForm.confirm) {
            setStatusMessage({ type: 'error', text: 'All password fields are required.' });
            return;
        }

        if (passwordForm.new !== passwordForm.confirm) {
            setStatusMessage({ type: 'error', text: 'New passwords do not match.' });
            return;
        }

        setIsSubmitting(true);
        try {
            await api.put('/profile/password', {
                currentPassword: passwordForm.current,
                newPassword: passwordForm.new
            });

            setStatusMessage({ type: 'success', text: 'Password changed successfully!' });
            setPasswordForm({ current: '', new: '', confirm: '' });
            setTimeout(() => {
                setStatusMessage(null);
                setIsChangingPassword(false);
            }, 2000);
        } catch (err: any) {
            setStatusMessage({ type: 'error', text: err.response?.data?.error || 'Failed to change password.' });
        } finally {
            setIsSubmitting(false);
        }
    };

    const toggleSearch = () => {
        setIsSearchOpen(!isSearchOpen);
        if (isSearchOpen) setSearchQuery('');
    };
    const toggleQuickAdd = () => setIsQuickAddOpen(!isQuickAddOpen);
    const toggleProfileDrawer = () => setIsProfileDrawerOpen(!isProfileDrawerOpen);

    const handleLogout = () => {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        sessionStorage.clear();
        setIsProfileDrawerOpen(false);
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
        <>
            {isAdmin ? (
                <AdminSidebar
                    isOpen={isSidebarOpen}
                    onClose={() => setIsSidebarOpen(false)}
                    user={user}
                />
            ) : (
                <MobileSidebar
                    isOpen={isSidebarOpen}
                    onClose={() => setIsSidebarOpen(false)}
                    isLoggedIn={isLoggedIn}
                    onOpenMarketplace={() => {
                        setIsSidebarOpen(false);
                        setTimeout(() => setIsMarketplaceOpen(true), 200);
                    }}
                />
            )}

            {/* Marketplace Modal */}
            <AnimatePresence>

                {isMarketplaceOpen && (
                    <>
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            exit={{ opacity: 0 }}
                            onClick={() => setIsMarketplaceOpen(false)}
                            className="fixed inset-0 bg-black/60 backdrop-blur-md z-[6000]"
                        />
                        <div className="fixed inset-0 z-[6001] flex items-center justify-center p-4 pointer-events-none">
                            <motion.div
                                initial={{ opacity: 0, scale: 0.8, y: 100 }}
                                animate={{
                                    opacity: 1,
                                    scale: 1,
                                    y: 0,
                                    transition: {
                                        type: "spring",
                                        damping: 15,
                                        stiffness: 200,
                                        mass: 0.8
                                    }
                                }}
                                exit={{ opacity: 0, scale: 0.8, y: 100 }}
                                className="w-full max-w-sm glass-card !rounded-[32px] p-6 shadow-2xl border border-white/10 pointer-events-auto"
                            >
                                <div className="flex justify-between items-center mb-6">
                                    <h2 className="text-2xl font-bold text-foreground">Marketplace</h2>
                                    <button
                                        onClick={() => setIsMarketplaceOpen(false)}
                                        className="w-10 h-10 rounded-full bg-secondary/50 flex items-center justify-center text-muted hover:bg-secondary transition-colors"
                                    >
                                        <X size={20} />
                                    </button>
                                </div>

                                <div className="grid gap-4">
                                    <Link
                                        href="/marketplace"
                                        onClick={() => setIsMarketplaceOpen(false)}
                                        className="group relative overflow-hidden rounded-2xl bg-[var(--primary-navy)] p-6 transition-transform active:scale-95"
                                    >
                                        <div className="relative z-10 flex items-center gap-4">
                                            <div className="w-12 h-12 rounded-xl bg-[var(--accent-gold)] flex items-center justify-center text-[var(--primary-navy)] shadow-lg shadow-yellow-500/20">
                                                <Package size={24} />
                                            </div>
                                            <div>
                                                <h3 className="text-lg font-bold text-white group-hover:text-[var(--accent-gold)] transition-colors">Public Market</h3>
                                                <p className="text-sm text-gray-400">Browse items & services</p>
                                            </div>
                                        </div>
                                        <div className="absolute -right-4 -bottom-4 w-24 h-24 bg-white/5 rounded-full blur-2xl group-hover:bg-[var(--accent-gold)]/10 transition-colors"></div>
                                    </Link>

                                    <Link
                                        href="/b2b"
                                        onClick={() => setIsMarketplaceOpen(false)}
                                        className="group relative overflow-hidden rounded-2xl bg-white dark:bg-white/5 border border-gray-100 dark:border-white/10 p-6 transition-transform active:scale-95"
                                    >
                                        <div className="relative z-10 flex items-center gap-4">
                                            <div className="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-500">
                                                <Users size={24} />
                                            </div>
                                            <div>
                                                <h3 className="text-lg font-bold text-foreground">B2B Wholesale</h3>
                                                <p className="text-sm text-muted">Business bulk buying</p>
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                            </motion.div>
                        </div>
                    </>
                )}
            </AnimatePresence>

            {/* Main Dashboard Header */}
            <header className="mobile-header-premium">
                {/* Left: Hamburger & Logo */}
                <div className="flex items-center gap-3">
                    <button onClick={() => setIsSidebarOpen(true)} className="header-icon-btn !bg-transparent !shadow-none -ml-2">
                        <Menu size={24} className="text-foreground" />
                    </button>

                    <Link href={isLoggedIn ? "/dashboard" : "/"} className="header-logo-container flex items-center gap-2">
                        <div className="relative w-32 h-10">
                            <Image
                                src="/images/IVARAlogo.jpg"
                                alt="IVARA"
                                fill
                                className="object-contain"
                                priority
                            />
                        </div>
                    </Link>
                </div>

                {/* Right: Actions */}
                <div className="flex items-center gap-1">
                    <button className="header-icon-btn" onClick={toggleSearch}>
                        <Search size={20} />
                    </button>

                    {isLoggedIn && !isLandingPage && (
                        <div className="relative">
                            <button className={`header-icon-btn ${isQuickAddOpen ? 'active' : ''}`} onClick={toggleQuickAdd}>
                                <Plus size={22} className={isQuickAddOpen ? 'rotate-45 transition-transform' : 'transition-transform'} />
                            </button>

                            <AnimatePresence>
                                {isQuickAddOpen && (
                                    <>
                                        <div
                                            className="fixed inset-0 z-[1000] bg-transparent"
                                            onClick={() => setIsQuickAddOpen(false)}
                                        />
                                        <motion.div
                                            initial={{ opacity: 0, y: 10, scale: 0.95 }}
                                            animate={{ opacity: 1, y: 0, scale: 1 }}
                                            exit={{ opacity: 0, y: 10, scale: 0.95 }}
                                            className="dropdown-menu-mobile !z-[1001]"
                                        >
                                            <Link href="/products/new" onClick={() => setIsQuickAddOpen(false)}>
                                                <Package size={18} /> New Product
                                            </Link>
                                            <Link href="/clients/new" onClick={() => setIsQuickAddOpen(false)}>
                                                <Users size={18} /> New Client
                                            </Link>
                                            <Link href="/repairs/new" onClick={() => setIsQuickAddOpen(false)}>
                                                <Wrench size={18} /> New Repair
                                            </Link>
                                        </motion.div>
                                    </>
                                )}
                            </AnimatePresence>
                        </div>
                    )}

                    <button className="header-icon-btn" onClick={toggleTheme}>
                        {theme === 'dark' ? <Sun size={20} /> : <Moon size={20} />}
                    </button>

                    {isLoggedIn && user && (
                        <button className="profile-trigger-mobile" onClick={toggleProfileDrawer}>
                            <div className="header-avatar-circle overflow-hidden">
                                {getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto) ? (
                                    <img src={getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto)!} alt="Profile" className="w-full h-full object-cover" />
                                ) : (
                                    <span className="text-[10px] font-bold">{getInitials(user?.name)}</span>
                                )}
                            </div>
                        </button>
                    )}
                </div>
            </header>

            {/* Profile Drawer */}
            <AnimatePresence>
                {isProfileDrawerOpen && (
                    <>
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            exit={{ opacity: 0 }}
                            onClick={toggleProfileDrawer}
                            className="fixed inset-0 bg-black/40 backdrop-blur-sm z-[5000]"
                        />
                        <motion.aside
                            initial={{ x: '100%' }}
                            animate={{ x: 0 }}
                            exit={{ x: '100%' }}
                            transition={{ type: 'spring', damping: 25, stiffness: 200 }}
                            className="fixed top-0 right-0 h-full w-[85%] max-w-[320px] bg-secondary border-l border-white/5 z-[5001] shadow-2xl"
                        >
                            <div className="p-6 flex flex-col h-full">
                                <div className="flex justify-between items-center mb-10">
                                    <span className="text-xs uppercase tracking-widest text-muted font-bold">Profile Menu</span>
                                    <button onClick={toggleProfileDrawer} className="w-10 h-10 glass flex items-center justify-center rounded-xl text-muted">
                                        <X size={20} />
                                    </button>
                                </div>

                                <div className="flex items-center gap-4 mb-10">
                                    <div className="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-primary border border-primary/20 overflow-hidden">
                                        {getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto) ? (
                                            <img src={getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto)!} alt="Profile" className="w-full h-full object-cover" />
                                        ) : (
                                            <span className="text-xl font-bold">{getInitials(user?.name)}</span>
                                        )}
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-bold text-foreground">{user?.name || 'Super Admin'}</h3>
                                        <p className="text-sm text-muted">{user?.email || 'superadmin@ivara.com'}</p>
                                    </div>
                                </div>

                                <nav className="flex-1 space-y-2">
                                    <button
                                        onClick={() => {
                                            setIsProfileDrawerOpen(false);
                                            setIsEditModalOpen(true);
                                        }}
                                        className="drawer-link w-full text-left bg-transparent border-none"
                                    >
                                        <User size={20} /> <span className="text-foreground">Edit Profile</span>
                                    </button>

                                    {user?.role === 'technician' && (
                                        <div className="pt-4 pb-2 space-y-1">
                                            <div className="px-4 py-2 text-[10px] font-bold text-muted uppercase tracking-widest border-b border-white/5 mb-2">Technician Tools</div>
                                            <Link href="/technician/jobs" onClick={toggleProfileDrawer} className="drawer-link">
                                                <LayoutDashboard size={20} /> <span className="text-foreground">Assigned Jobs</span>
                                            </Link>
                                            <Link href="/technician/inventory" onClick={toggleProfileDrawer} className="drawer-link">
                                                <Package size={20} /> <span className="text-foreground">Inventory</span>
                                            </Link>
                                            <Link href="/technician/bookings" onClick={toggleProfileDrawer} className="drawer-link">
                                                <Bell size={20} /> <span className="text-foreground">Bookings</span>
                                            </Link>
                                        </div>
                                    )}

                                    <Link href="/messages" onClick={toggleProfileDrawer} className="drawer-link">
                                        <MessageSquare size={20} /> <span className="text-foreground">Messages</span>
                                    </Link>
                                    <Link href="/notifications" onClick={toggleProfileDrawer} className="drawer-link">
                                        <Bell size={20} /> <span className="text-foreground">Notifications</span>
                                    </Link>
                                    <Link href="/profile" onClick={toggleProfileDrawer} className="drawer-link">
                                        <Settings size={20} /> <span className="text-foreground">Settings</span>
                                    </Link>
                                </nav>

                                <div className="mt-auto pt-6 border-top border-white/5">
                                    <button onClick={handleLogout} className="drawer-link logout-text w-full text-left bg-transparent border-none">
                                        <LogOut size={20} /> <span>Log out</span>
                                    </button>
                                </div>
                            </div>
                        </motion.aside>
                    </>
                )}
            </AnimatePresence>

            {/* Search Overlay */}
            <AnimatePresence>
                {isSearchOpen && (
                    <motion.div
                        initial={{ opacity: 0, y: -20 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: -20 }}
                        className="fixed inset-x-0 top-0 h-16 bg-secondary/95 backdrop-blur-xl z-[6000] flex items-center px-4 gap-4"
                    >
                        <Search size={20} className="text-muted" />
                        <input
                            autoFocus
                            placeholder="Search everything..."
                            className="flex-1 bg-transparent border-none outline-none text-foreground placeholder:text-muted"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            onKeyDown={(e) => {
                                if (e.key === 'Enter') {
                                    console.log('Searching for:', searchQuery);
                                    setIsSearchOpen(false);
                                }
                            }}
                        />
                        <button onClick={toggleSearch} className="text-muted">
                            <X size={20} />
                        </button>
                    </motion.div>
                )}
            </AnimatePresence>

            {/* Edit Profile Modal */}
            <AnimatePresence>
                {isEditModalOpen && (
                    <>
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            exit={{ opacity: 0 }}
                            onClick={() => {
                                setIsEditModalOpen(false);
                                setIsChangingPassword(false);
                                setStatusMessage(null);
                            }}
                            className="fixed inset-0 bg-black/60 backdrop-blur-md z-[7000]"
                        />
                        <motion.div
                            initial={{ opacity: 0, scale: 0.9, x: "-50%", y: "-45%" }}
                            animate={{ opacity: 1, scale: 1, x: "-50%", y: "-50%" }}
                            exit={{ opacity: 0, scale: 0.9, x: "-50%", y: "-45%" }}
                            className="fixed top-1/2 left-1/2 w-[90%] max-w-[400px] glass-card !rounded-[32px] p-8 z-[7001] shadow-2xl"
                        >
                            <button
                                onClick={() => {
                                    setIsEditModalOpen(false);
                                    setIsChangingPassword(false);
                                    setStatusMessage(null);
                                }}
                                className="absolute top-6 right-6 w-10 h-10 glass flex items-center justify-center rounded-xl text-muted active:scale-90 transition-transform"
                            >
                                <X size={20} />
                            </button>

                            {!isChangingPassword ? (
                                <div className="space-y-6">
                                    <div className="text-center">
                                        <div className="relative inline-block">
                                            <div className="w-24 h-24 rounded-[28px] bg-primary flex items-center justify-center border-4 border-background overflow-hidden text-white text-3xl font-bold shadow-xl shadow-primary/20">
                                                {uploadPreview ? (
                                                    <img src={uploadPreview} alt="Preview" className="w-full h-full object-cover" />
                                                ) : getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto) ? (
                                                    <img src={getProfilePhotoUrl(user?.profile_photo_url || user?.profilePhoto)!} alt="Profile" className="w-full h-full object-cover" />
                                                ) : (
                                                    <span>{getInitials(user?.name)}</span>
                                                )}
                                            </div>
                                            <label className="absolute -bottom-2 -right-2 w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-lg border-4 border-background active:scale-90 transition-transform cursor-pointer">
                                                <Camera size={16} className="text-white" />
                                                <input type="file" className="hidden" accept="image/*" onChange={handleFileChange} />
                                            </label>
                                        </div>
                                        <h3 className="text-xl font-bold mt-4 text-foreground">Account Holder</h3>
                                        <p className="text-xs text-muted font-bold uppercase tracking-wider">{user?.role || 'Professional'}</p>
                                    </div>

                                    <div className="space-y-4">
                                        <div className="space-y-1.5">
                                            <label className="text-[10px] font-bold text-muted uppercase ml-1">Full Name</label>
                                            <input
                                                type="text"
                                                className="input-field !bg-secondary/40 !py-3 !px-4"
                                                value={editForm.name}
                                                onChange={(e) => setEditForm(prev => ({ ...prev, name: e.target.value }))}
                                            />
                                        </div>
                                        <div className="space-y-1.5">
                                            <label className="text-[10px] font-bold text-muted uppercase ml-1">Email Address</label>
                                            <input
                                                type="email"
                                                className="input-field !bg-secondary/40 !py-3 !px-4"
                                                value={editForm.email}
                                                onChange={(e) => setEditForm(prev => ({ ...prev, email: e.target.value }))}
                                            />
                                        </div>
                                    </div>

                                    <div className="pt-4 space-y-3">
                                        <button
                                            onClick={() => setIsChangingPassword(true)}
                                            className="w-full py-4 glass rounded-2xl flex items-center justify-center gap-3 text-sm font-bold text-foreground active:scale-95 transition-all"
                                        >
                                            <Key size={18} className="text-primary" /> Change Password
                                        </button>
                                        <button
                                            onClick={handleProfileUpdate}
                                            disabled={isSubmitting}
                                            className="btn-primary !rounded-2xl py-4 shadow-lg shadow-primary/30 disabled:opacity-50"
                                        >
                                            {isSubmitting ? 'Updating...' : 'Save Changes'}
                                        </button>
                                    </div>
                                </div>
                            ) : (
                                <div className="animate-fade-in">
                                    <div className="flex items-center gap-3 mb-8">
                                        <button
                                            onClick={() => setIsChangingPassword(false)}
                                            className="w-8 h-8 flex items-center justify-center rounded-lg bg-primary/10 text-primary"
                                        >
                                            <ArrowLeft size={16} />
                                        </button>
                                        <h3 className="text-lg font-bold text-foreground">Security Settings</h3>
                                    </div>

                                    <div className="space-y-4">
                                        <div className="space-y-1.5">
                                            <label className="text-[10px] font-bold text-muted uppercase ml-1">Current Password</label>
                                            <div className="relative">
                                                <input
                                                    type={showPasswords.current ? "text" : "password"}
                                                    className="input-field !bg-secondary/40 !py-3 !px-4 pr-12"
                                                    placeholder="••••••••"
                                                    value={passwordForm.current}
                                                    onChange={(e) => setPasswordForm(prev => ({ ...prev, current: e.target.value }))}
                                                />
                                                <button
                                                    className="absolute right-4 top-1/2 -translate-y-1/2 text-muted"
                                                    onClick={() => setShowPasswords(prev => ({ ...prev, current: !prev.current }))}
                                                >
                                                    {showPasswords.current ? <EyeOff size={18} /> : <Eye size={18} />}
                                                </button>
                                            </div>
                                        </div>
                                        <div className="space-y-1.5">
                                            <label className="text-[10px] font-bold text-muted uppercase ml-1">New Password</label>
                                            <div className="relative">
                                                <input
                                                    type={showPasswords.new ? "text" : "password"}
                                                    className="input-field !bg-secondary/40 !py-3 !px-4 pr-12"
                                                    placeholder="••••••••"
                                                    value={passwordForm.new}
                                                    onChange={(e) => setPasswordForm(prev => ({ ...prev, new: e.target.value }))}
                                                />
                                                <button
                                                    className="absolute right-4 top-1/2 -translate-y-1/2 text-muted"
                                                    onClick={() => setShowPasswords(prev => ({ ...prev, new: !prev.new }))}
                                                >
                                                    {showPasswords.new ? <EyeOff size={18} /> : <Eye size={18} />}
                                                </button>
                                            </div>
                                        </div>
                                        <div className="space-y-1.5">
                                            <label className="text-[10px] font-bold text-muted uppercase ml-1">Confirm New Password</label>
                                            <div className="relative">
                                                <input
                                                    type={showPasswords.confirm ? "text" : "password"}
                                                    className="input-field !bg-secondary/40 !py-3 !px-4 pr-12"
                                                    placeholder="••••••••"
                                                    value={passwordForm.confirm}
                                                    onChange={(e) => setPasswordForm(prev => ({ ...prev, confirm: e.target.value }))}
                                                />
                                                <button
                                                    className="absolute right-4 top-1/2 -translate-y-1/2 text-muted"
                                                    onClick={() => setShowPasswords(prev => ({ ...prev, confirm: !prev.confirm }))}
                                                >
                                                    {showPasswords.confirm ? <EyeOff size={18} /> : <Eye size={18} />}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <button
                                        onClick={handlePasswordUpdate}
                                        disabled={isSubmitting}
                                        className="btn-primary !rounded-2xl py-4 mt-8 shadow-lg shadow-primary/30 disabled:opacity-50"
                                    >
                                        {isSubmitting ? 'Updating...' : 'Update Password'}
                                    </button>
                                </div>
                            )}

                            {/* Status Message */}
                            <AnimatePresence>
                                {statusMessage && (
                                    <motion.div
                                        initial={{ opacity: 0, y: 10 }}
                                        animate={{ opacity: 1, y: 0 }}
                                        exit={{ opacity: 0, y: 10 }}
                                        className={`mt-4 p-4 rounded-xl flex items-center gap-3 text-xs font-bold ${statusMessage.type === 'success' ? 'bg-green-500/10 text-green-500 border border-green-500/20' : 'bg-red-500/10 text-red-500 border border-red-500/20'
                                            }`}
                                    >
                                        {statusMessage.type === 'success' ? <Check size={16} /> : <AlertCircle size={16} />}
                                        {statusMessage.text}
                                    </motion.div>
                                )}
                            </AnimatePresence>
                        </motion.div>
                    </>
                )}
            </AnimatePresence>
        </>
    );
}
