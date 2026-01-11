"use client";

import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import {
    Search, Filter, MoreVertical, Trash2, Edit2,
    CheckCircle, XCircle, Shield, Briefcase, User,
    Mail, Calendar, ArrowLeft, RefreshCw, Save, X
} from 'lucide-react';
import { useRouter } from 'next/navigation';
import api from '@/lib/api';

export default function UserManagementPage() {
    const router = useRouter();
    const [isLoading, setIsLoading] = useState(true);
    const [searchQuery, setSearchQuery] = useState('');
    const [activeTab, setActiveTab] = useState('all');
    const [users, setUsers] = useState<any[]>([]);

    // Edit Modal State
    const [editingUser, setEditingUser] = useState<any>(null);
    const [isSaving, setIsSaving] = useState(false);

    // Advanced Filter State
    const [showFilterModal, setShowFilterModal] = useState(false);
    const [statusFilter, setStatusFilter] = useState('all'); // 'all', 'active', 'suspended'

    // Dropdown Menu State
    const [activeMenuId, setActiveMenuId] = useState<string | null>(null);

    const fetchUsers = async () => {
        setIsLoading(true);
        try {
            const response = await api.get('/super-admin/users');
            const realUsers = Array.isArray(response.data) ? response.data : [];
            const formattedUsers = realUsers.map((u: any) => ({
                ...u,
                id: u._id,
                joinDate: u.createdAt ? new Date(u.createdAt).toLocaleDateString() : 'N/A',
                status: u.status || 'active',
                category: u.category || (['admin', 'super_admin'].includes(u.role) ? 'System Control' : 'General')
            }));
            setUsers(formattedUsers);
        } catch (error) {
            console.error('Failed to fetch users:', error);
            setUsers([]);
        } finally {
            setIsLoading(false);
        }
    };

    useEffect(() => {
        fetchUsers();
    }, []);

    const handleUpdateUser = async (e: React.FormEvent) => {
        e.preventDefault();
        if (!editingUser) return;

        setIsSaving(true);
        try {
            const { id, name, email, role, category, status } = editingUser;
            await api.put(`/super-admin/users/${id}`, { name, email, role, category, status });

            // Update local state
            setUsers(prev => prev.map(u => u.id === id ? { ...editingUser } : u));
            setEditingUser(null); // Close modal
        } catch (error) {
            console.error('Failed to update user:', error);
            alert('Failed to update user. Please try again.');
        } finally {
            setIsSaving(false);
        }
    };

    const handleDelete = async (id: string, name: string) => {
        if (confirm(`Are you sure you want to permanently delete user "${name}"?`)) {
            try {
                await api.delete(`/super-admin/users/${id}`);
                setUsers(prev => prev.filter(u => u.id !== id));
            } catch (error) {
                console.error('Delete failed:', error);
                alert('Failed to delete user.');
            }
        }
        setActiveMenuId(null);
    };

    const toggleStatus = async (id: string) => {
        const user = users.find(u => u.id === id);
        if (!user) return;

        // Optimistic update
        const newStatus = user.status === 'active' ? 'suspended' : 'active';
        setUsers(prev => prev.map(u => u.id === id ? { ...u, status: newStatus } : u));

        try {
            await api.put(`/super-admin/users/${id}`, { status: newStatus });
        } catch (error) {
            console.error('Status toggle failed:', error);
            // Revert on error
            setUsers(prev => prev.map(u => u.id === id ? { ...u, status: user.status } : u));
        }
        setActiveMenuId(null);
    };

    const filteredUsers = users.filter(user => {
        const matchesSearch = (user.name?.toLowerCase() || '').includes(searchQuery.toLowerCase()) ||
            (user.email?.toLowerCase() || '').includes(searchQuery.toLowerCase()) ||
            (user.category?.toLowerCase() || '').includes(searchQuery.toLowerCase());

        const matchesTab = activeTab === 'all' ? true :
            activeTab === 'providers' ? (['technician', 'mechanic', 'electrician', 'tailor', 'mediator', 'craftsperson', 'builder', 'businessperson'].includes(user.role)) :
                user.role === activeTab;

        const matchesStatus = statusFilter === 'all' ? true : user.status === statusFilter;

        return matchesSearch && matchesTab && matchesStatus;
    });

    const getRoleColor = (role: string) => {
        switch (role) {
            case 'super_admin': return 'text-purple-500 bg-purple-500/10 border-purple-500/20';
            case 'admin': return 'text-indigo-500 bg-indigo-500/10 border-indigo-500/20';
            case 'technician': return 'text-blue-500 bg-blue-500/10 border-blue-500/20';
            case 'provider': return 'text-orange-500 bg-orange-500/10 border-orange-500/20';
            case 'client': return 'text-emerald-500 bg-emerald-500/10 border-emerald-500/20';
            default: return 'text-gray-500 bg-gray-500/10 border-gray-500/20';
        }
    };

    return (
        <div className="min-h-screen bg-gray-50 dark:bg-[#050B14] pb-24 relative" onClick={() => setActiveMenuId(null)}>

            {/* Header */}
            <div className="bg-[var(--primary-navy)] pt-8 pb-12 px-6 rounded-b-[2rem] shadow-xl relative overflow-hidden">
                <div className="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full blur-3xl -mr-10 -mt-10"></div>

                <div className="relative z-10 flex items-center justify-between mb-6">
                    <button onClick={() => router.back()} className="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
                        <ArrowLeft size={20} />
                    </button>
                    <h1 className="text-xl font-bold text-white">User Control</h1>
                    <button onClick={() => fetchUsers()} className="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
                        <RefreshCw size={20} className={isLoading ? "animate-spin" : ""} />
                    </button>
                </div>

                {/* Search Bar */}
                <div className="relative z-10">
                    <div className="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center p-1 pr-2">
                        <div className="w-10 h-10 flex items-center justify-center text-white/60">
                            <Search size={20} />
                        </div>
                        <input
                            type="text"
                            placeholder="Search by name, email, category..."
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            className="bg-transparent border-none outline-none text-white text-sm w-full placeholder-white/50 h-10"
                        />
                    </div>
                </div>
            </div>

            {/* Filter Tabs */}
            <div className="px-6 -mt-6 relative z-20">
                <div className="glass-card bg-white dark:bg-[#111827] p-2 rounded-2xl flex justify-between shadow-lg overflow-x-auto no-scrollbar">
                    {['all', 'client', 'providers', 'admin'].map((tab) => (
                        <button
                            key={tab}
                            onClick={() => setActiveTab(tab)}
                            className={`px-4 py-2 rounded-xl text-xs font-bold capitalize transition-all whitespace-nowrap ${activeTab === tab
                                ? 'bg-[var(--primary-navy)] text-white shadow-md'
                                : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5'
                                }`}
                        >
                            {tab}
                        </button>
                    ))}
                </div>
            </div>

            {/* User List */}
            <div className="px-6 pt-6 pb-20 space-y-4">
                <div className="flex justify-between items-center mb-2">
                    <h2 className="font-bold text-gray-900 dark:text-white">
                        Total Users <span className="ml-2 text-xs bg-gray-200 dark:bg-white/10 px-2 py-0.5 rounded-full text-gray-500">{filteredUsers.length}</span>
                    </h2>
                    <button
                        onClick={(e) => { e.stopPropagation(); setShowFilterModal(true); }}
                        className="text-[var(--accent-gold)] text-xs font-bold uppercase flex items-center gap-1 bg-[var(--primary-navy)]/5 px-3 py-1.5 rounded-lg hover:bg-[var(--primary-navy)]/10"
                    >
                        <Filter size={12} /> Filter
                    </button>
                </div>

                <AnimatePresence mode="popLayout">
                    {isLoading ? (
                        // Loading Skeletons
                        [1, 2, 3, 4].map(i => (
                            <div key={i} className="bg-white dark:bg-[#111827] p-4 rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm animate-pulse">
                                <div className="flex items-center gap-4">
                                    <div className="w-12 h-12 rounded-full bg-gray-200 dark:bg-white/10"></div>
                                    <div className="flex-1 space-y-2">
                                        <div className="h-4 w-1/2 bg-gray-200 dark:bg-white/10 rounded"></div>
                                        <div className="h-3 w-1/3 bg-gray-200 dark:bg-white/10 rounded"></div>
                                    </div>
                                </div>
                            </div>
                        ))
                    ) : (
                        filteredUsers.map((user) => (
                            <motion.div
                                key={user.id}
                                layout
                                initial={{ opacity: 0, scale: 0.95 }}
                                animate={{ opacity: 1, scale: 1 }}
                                exit={{ opacity: 0, scale: 0.95 }}
                                className="bg-white dark:bg-[#111827] p-5 rounded-[24px] border border-gray-100 dark:border-white/5 shadow-sm hover:shadow-md transition-all relative group"
                            >
                                <div className="flex items-start justify-between mb-4">
                                    <div className="flex items-center gap-3">
                                        <div className={`w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg ${getRoleColor(user.role).replace('border', 'border-2')}`}>
                                            {user.name.charAt(0)}
                                        </div>
                                        <div>
                                            <h3 className="font-bold text-gray-900 dark:text-white leading-tight">{user.name}</h3>
                                            <span className={`text-[10px] uppercase font-bold px-2 py-0.5 rounded-md inline-block mt-1 ${getRoleColor(user.role)}`}>
                                                {user.role.replace('_', ' ')}
                                            </span>
                                        </div>
                                    </div>
                                    <div className="relative">
                                        <button
                                            onClick={(e) => { e.stopPropagation(); setActiveMenuId(activeMenuId === user.id ? null : user.id); }}
                                            className="w-8 h-8 rounded-full bg-gray-50 dark:bg-white/5 flex items-center justify-center text-gray-400 hover:text-blue-500 dark:hover:text-blue-400"
                                        >
                                            <MoreVertical size={16} />
                                        </button>

                                        {/* Dropdown Menu */}
                                        <AnimatePresence>
                                            {activeMenuId === user.id && (
                                                <motion.div
                                                    initial={{ opacity: 0, scale: 0.9, y: 10 }}
                                                    animate={{ opacity: 1, scale: 1, y: 0 }}
                                                    exit={{ opacity: 0, scale: 0.9, y: 10 }}
                                                    className="absolute right-0 top-10 bg-white dark:bg-[#1f2937] rounded-xl shadow-xl border border-gray-100 dark:border-white/5 py-1 min-w-[140px] z-30"
                                                >
                                                    <button
                                                        onClick={(e) => { e.stopPropagation(); setEditingUser(user); setActiveMenuId(null); }}
                                                        className="w-full text-left px-4 py-2.5 text-xs font-bold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 flex items-center gap-2"
                                                    >
                                                        <Edit2 size={14} /> Edit User
                                                    </button>
                                                    <button
                                                        onClick={(e) => { e.stopPropagation(); toggleStatus(user.id); setActiveMenuId(null); }}
                                                        className="w-full text-left px-4 py-2.5 text-xs font-bold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 flex items-center gap-2"
                                                    >
                                                        {user.status === 'active' ? <XCircle size={14} /> : <CheckCircle size={14} />}
                                                        {user.status === 'active' ? 'Suspend' : 'Activate'}
                                                    </button>
                                                    <div className="h-px bg-gray-100 dark:bg-white/5 my-1" />
                                                    <button
                                                        onClick={(e) => { e.stopPropagation(); handleDelete(user.id, user.name); }}
                                                        className="w-full text-left px-4 py-2.5 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 flex items-center gap-2"
                                                    >
                                                        <Trash2 size={14} /> Delete
                                                    </button>
                                                </motion.div>
                                            )}
                                        </AnimatePresence>
                                    </div>
                                </div>

                                <div className="space-y-2 mb-4">
                                    <div className="flex items-center gap-2 text-xs text-gray-500">
                                        <Briefcase size={14} className="text-gray-400" />
                                        <span className="font-medium">Category:</span>
                                        <span className="text-gray-700 dark:text-gray-300 font-bold">{user.category}</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-xs text-gray-500">
                                        <Mail size={14} className="text-gray-400" />
                                        <span className="truncate">{user.email}</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-xs text-gray-500">
                                        <Calendar size={14} className="text-gray-400" />
                                        <span>Joined: {user.joinDate}</span>
                                    </div>
                                </div>

                                <div className="flex items-center gap-2 border-t border-gray-100 dark:border-white/5 pt-3 mt-3">
                                    <button
                                        onClick={() => toggleStatus(user.id)}
                                        className={`flex-1 py-2 rounded-xl text-xs font-bold flex items-center justify-center gap-2 transition-colors ${user.status === 'active' ? 'bg-green-500/10 text-green-600 hover:bg-green-500/20' : 'bg-red-500/10 text-red-600 hover:bg-red-500/20'}`}
                                    >
                                        {user.status === 'active' ? <CheckCircle size={14} /> : <XCircle size={14} />}
                                        {user.status === 'active' ? 'Active' : 'Suspended'}
                                    </button>
                                    <button
                                        onClick={() => handleDelete(user.id)}
                                        className="w-10 h-9 rounded-xl bg-red-500/10 text-red-600 flex items-center justify-center hover:bg-red-500/20 transition-colors"
                                    >
                                        <Trash2 size={16} />
                                    </button>
                                </div>
                            </motion.div>
                        ))
                    )}
                </AnimatePresence>

                {!isLoading && filteredUsers.length === 0 && (
                    <div className="text-center py-12">
                        <div className="w-16 h-16 bg-gray-100 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                            <User size={32} />
                        </div>
                        <h3 className="font-bold text-gray-900 dark:text-white">No users found</h3>
                        <p className="text-xs text-gray-500">Try adjusting your search or filters</p>
                    </div>
                )}
            </div>

            {/* Edit User Modal */}
            <AnimatePresence>
                {editingUser && (
                    <>
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            exit={{ opacity: 0 }}
                            onClick={() => setEditingUser(null)}
                            className="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100]"
                        />
                        <motion.div
                            initial={{ y: '100%' }}
                            animate={{ y: 0 }}
                            exit={{ y: '100%' }}
                            transition={{ type: "spring", damping: 25, stiffness: 200 }}
                            className="fixed bottom-0 left-0 right-0 bg-white dark:bg-[#111827] rounded-t-[2rem] p-6 z-[101] shadow-2xl max-h-[85vh] overflow-y-auto"
                        >
                            <div className="flex justify-between items-center mb-6">
                                <h2 className="text-xl font-bold text-gray-900 dark:text-white">Edit User</h2>
                                <button onClick={() => setEditingUser(null)} className="p-2 bg-gray-100 dark:bg-white/10 rounded-full text-gray-600 dark:text-white">
                                    <X size={20} />
                                </button>
                            </div>

                            <form onSubmit={handleUpdateUser} className="space-y-4">
                                <div>
                                    <label className="text-xs font-bold text-gray-500 uppercase">Full Name</label>
                                    <input
                                        type="text"
                                        value={editingUser.name}
                                        onChange={(e) => setEditingUser({ ...editingUser, name: e.target.value })}
                                        className="w-full mt-1 p-4 bg-gray-50 dark:bg-white/5 rounded-2xl border-none outline-none font-semibold text-gray-900 dark:text-white"
                                    />
                                </div>

                                <div>
                                    <label className="text-xs font-bold text-gray-500 uppercase">Email Address</label>
                                    <input
                                        type="email"
                                        value={editingUser.email}
                                        onChange={(e) => setEditingUser({ ...editingUser, email: e.target.value })}
                                        className="w-full mt-1 p-4 bg-gray-50 dark:bg-white/5 rounded-2xl border-none outline-none font-semibold text-gray-900 dark:text-white"
                                    />
                                </div>

                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-xs font-bold text-gray-500 uppercase">Role</label>
                                        <select
                                            value={editingUser.role}
                                            onChange={(e) => setEditingUser({ ...editingUser, role: e.target.value })}
                                            className="w-full mt-1 p-4 bg-gray-50 dark:bg-white/5 rounded-2xl border-none outline-none font-bold text-gray-900 dark:text-white"
                                        >
                                            <option value="client">Client</option>
                                            <option value="technician">Technician</option>
                                            <option value="manager">Manager</option>
                                            <option value="admin">Admin</option>
                                            <option value="super_admin">Super Admin</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label className="text-xs font-bold text-gray-500 uppercase">Status</label>
                                        <select
                                            value={editingUser.status}
                                            onChange={(e) => setEditingUser({ ...editingUser, status: e.target.value })}
                                            className="w-full mt-1 p-4 bg-gray-50 dark:bg-white/5 rounded-2xl border-none outline-none font-bold text-gray-900 dark:text-white"
                                        >
                                            <option value="active">Active</option>
                                            <option value="suspended">Suspended</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label className="text-xs font-bold text-gray-500 uppercase">Category</label>
                                    <input
                                        type="text"
                                        value={editingUser.category}
                                        onChange={(e) => setEditingUser({ ...editingUser, category: e.target.value })}
                                        className="w-full mt-1 p-4 bg-gray-50 dark:bg-white/5 rounded-2xl border-none outline-none font-semibold text-gray-900 dark:text-white"
                                    />
                                </div>

                                <button
                                    type="submit"
                                    disabled={isSaving}
                                    className="w-full py-4 bg-[var(--primary-navy)] text-white rounded-2xl font-bold text-lg shadow-lg shadow-blue-900/20 active:scale-95 transition-all mt-4 flex items-center justify-center gap-2"
                                >
                                    {isSaving ? (
                                        <>Saving...</>
                                    ) : (
                                        <>
                                            <Save size={20} /> Save Changes
                                        </>
                                    )}
                                </button>
                            </form>
                        </motion.div>
                    </>
                )}
            </AnimatePresence>

            {/* Filter Modal */}
            <AnimatePresence>
                {showFilterModal && (
                    <>
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            exit={{ opacity: 0 }}
                            onClick={() => setShowFilterModal(false)}
                            className="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100]"
                        />
                        <motion.div
                            initial={{ y: '100%' }}
                            animate={{ y: 0 }}
                            exit={{ y: '100%' }}
                            transition={{ type: "spring", damping: 25, stiffness: 200 }}
                            className="fixed bottom-0 left-0 right-0 bg-white dark:bg-[#162447] rounded-t-[2rem] p-6 z-[101] shadow-2xl"
                        >
                            <div className="flex justify-between items-center mb-6">
                                <h2 className="text-xl font-bold text-gray-900 dark:text-white">Filter Users</h2>
                                <button onClick={() => setShowFilterModal(false)} className="p-2 bg-gray-100 dark:bg-white/10 rounded-full text-gray-600 dark:text-white">
                                    <X size={20} />
                                </button>
                            </div>

                            <div className="space-y-4">
                                <div>
                                    <label className="text-xs font-bold text-gray-500 uppercase mb-2 block">Account Status</label>
                                    <div className="flex flex-wrap gap-2">
                                        {['all', 'active', 'suspended'].map((status) => (
                                            <button
                                                key={status}
                                                onClick={() => { setStatusFilter(status); setShowFilterModal(false); }}
                                                className={`px-4 py-3 rounded-xl text-sm font-bold capitalize transition-all flex-1 ${statusFilter === status
                                                        ? 'bg-[var(--primary-navy)] text-white shadow-lg'
                                                        : 'bg-gray-50 dark:bg-white/5 text-gray-500 hover:bg-gray-100 dark:hover:bg-white/10'
                                                    }`}
                                            >
                                                {status}
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </motion.div>
                    </>
                )}
            </AnimatePresence>
        </div>
    );
}
