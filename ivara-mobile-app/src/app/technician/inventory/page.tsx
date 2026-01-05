'use client';

import React, { useEffect, useState } from 'react';
import { motion } from 'framer-motion';
import { Package, Search, Plus, Filter } from 'lucide-react';
import MobileHeader from '@/components/MobileHeader';
import api from '@/lib/api';

export default function TechnicianInventoryPage() {
    const [inventory, setInventory] = useState<any[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchInventory = async () => {
            try {
                const response = await api.get('/technician/inventory');
                setInventory(response.data);
            } catch (err) {
                console.error('Failed to fetch inventory', err);
            } finally {
                setLoading(false);
            }
        };
        fetchInventory();
    }, []);

    return (
        <div className="min-h-screen bg-background pb-20">
            <MobileHeader />

            <div className="p-6">
                <header className="mb-6 mt-4">
                    <div className="flex justify-between items-start">
                        <div>
                            <h1 className="text-3xl font-bold text-foreground">Inventory</h1>
                            <p className="text-muted">Spare parts & stock management</p>
                        </div>
                        <button className="header-icon-btn !rounded-2xl bg-primary text-white shadow-lg shadow-primary/20">
                            <Plus size={24} />
                        </button>
                    </div>
                </header>

                <div className="relative mb-6">
                    <Search className="absolute left-4 top-1/2 -translate-y-1/2 text-muted" size={18} />
                    <input
                        placeholder="Search parts by SKU or name..."
                        className="input-field !pl-12 !py-4 !rounded-2xl"
                    />
                </div>

                <div className="flex gap-2 mb-6 overflow-x-auto pb-2 scrollbar-hide">
                    <button className="px-4 py-2 bg-primary text-white text-xs font-bold rounded-full whitespace-nowrap">All Parts</button>
                    <button className="px-4 py-2 glass text-foreground text-xs font-bold rounded-full whitespace-nowrap">Screens</button>
                    <button className="px-4 py-2 glass text-foreground text-xs font-bold rounded-full whitespace-nowrap">Batteries</button>
                    <button className="px-4 py-2 glass text-foreground text-xs font-bold rounded-full whitespace-nowrap">Cables</button>
                    <button className="px-4 py-2 glass text-foreground text-xs font-bold rounded-full border-none"><Filter size={14} /></button>
                </div>

                <div className="space-y-4">
                    {loading ? (
                        <div className="flex justify-center py-10">
                            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                        </div>
                    ) : inventory.length > 0 ? (
                        inventory.map((item, idx) => (
                            <motion.div
                                key={item._id || idx}
                                initial={{ opacity: 0, scale: 0.95 }}
                                animate={{ opacity: 1, scale: 1 }}
                                transition={{ delay: idx * 0.05 }}
                                className="glass-card p-4 !rounded-3xl flex items-center gap-4"
                            >
                                <div className="w-14 h-14 rounded-2xl bg-secondary flex items-center justify-center text-muted">
                                    <Package size={24} />
                                </div>
                                <div className="flex-1">
                                    <h4 className="font-bold text-foreground">{item.name || 'Unknown Part'}</h4>
                                    <p className="text-[10px] text-muted font-bold uppercase tracking-widest">{item.sku || 'N/A'}</p>
                                    <div className="flex items-center gap-2 mt-2">
                                        <div className="h-1.5 flex-1 bg-secondary rounded-full overflow-hidden">
                                            <div
                                                className={`h-full rounded-full ${item.quantity < 5 ? 'bg-red-500' : 'bg-primary'}`}
                                                style={{ width: `${Math.min((item.quantity / 20) * 100, 100)}%` }}
                                            />
                                        </div>
                                        <span className="text-xs font-bold text-foreground">{item.quantity} In Stock</span>
                                    </div>
                                </div>
                            </motion.div>
                        ))
                    ) : (
                        <div className="text-center py-20 glass-card !rounded-[32px]">
                            <Package size={48} className="mx-auto text-muted/30 mb-4" />
                            <h3 className="text-lg font-bold text-foreground">Inventory Empty</h3>
                            <p className="text-sm text-muted">Stock items will appear here.</p>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
