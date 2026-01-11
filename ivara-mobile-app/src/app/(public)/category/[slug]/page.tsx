"use client";

import { motion } from 'framer-motion';
import { useParams } from 'next/navigation';
import { ArrowLeft, Filter, Search, Star } from 'lucide-react';
import Link from 'next/link';

export default function CategoryPage() {
    const params = useParams();
    const slug = params.slug as string;
    const categoryName = slug ? slug.charAt(0).toUpperCase() + slug.slice(1) : "Category";

    // Mock data based on category (simplified)
    const services = [1, 2, 3, 4, 5, 6].map(i => ({
        id: i,
        name: `${categoryName} Service ${i}`,
        rating: 4.8,
        price: 'Start from 10k',
        provider: 'John Doe',
        image: `bg-${['blue', 'purple', 'green', 'orange', 'red', 'gray'][i % 6]}-100`
    }));

    return (
        <div className="min-h-screen bg-gray-50 dark:bg-[#0A1128] pb-24">

            {/* Header */}
            <div className="bg-[var(--primary-navy)] text-white p-6 pb-12 rounded-b-[40px] shadow-lg sticky top-0 z-30">
                <div className="flex items-center gap-4 mb-6">
                    <Link href="/" className="p-2 bg-white/10 rounded-full hover:bg-white/20">
                        <ArrowLeft className="w-5 h-5" />
                    </Link>
                    <h1 className="text-xl font-bold">{categoryName}</h1>
                </div>

                <div className="relative">
                    <input
                        type="text"
                        placeholder={`Search ${categoryName}...`}
                        className="w-full h-12 rounded-xl pl-12 pr-4 bg-white/10 border border-white/10 placeholder-white/60 text-white outline-none focus:bg-white/20"
                    />
                    <Search className="absolute left-4 top-3.5 text-white/60 w-5 h-5" />
                    <button className="absolute right-2 top-2 p-2 bg-white/10 rounded-lg">
                        <Filter className="w-4 h-4 text-white" />
                    </button>
                </div>
            </div>

            {/* Sub-Categories (Horizontal) */}
            <div className="px-6 -mt-6 mb-6 relative z-40">
                <div className="flex gap-3 overflow-x-auto hide-scrollbar pb-4">
                    {['All', 'Popular', 'Nearby', 'Verified', 'New'].map((tag, i) => (
                        <button key={i} className={`px-5 py-2.5 rounded-full text-xs font-bold shadow-md whitespace-nowrap ${i === 0 ? 'bg-[var(--accent-gold)] text-[var(--primary-navy)]' : 'bg-white dark:bg-[#162447] text-gray-600 dark:text-gray-300'}`}>
                            {tag}
                        </button>
                    ))}
                </div>
            </div>

            {/* Service List */}
            <div className="px-6 space-y-4">
                {services.map((service, i) => (
                    <motion.div
                        key={i}
                        initial={{ opacity: 0, y: 10 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: i * 0.05 }}
                        className="bg-white dark:bg-[#162447] p-3 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 flex gap-4"
                    >
                        <div className={`w-24 h-24 rounded-xl ${service.image} flex-shrink-0`}></div>
                        <div className="flex-1 py-1">
                            <div className="flex justify-between items-start mb-1">
                                <span className="text-[10px] px-2 py-0.5 bg-blue-50 text-blue-600 rounded-md font-bold uppercase">Verified</span>
                                <div className="flex items-center gap-1">
                                    <Star className="w-3 h-3 text-[var(--accent-gold)] fill-[var(--accent-gold)]" />
                                    <span className="text-xs font-bold dark:text-white">{service.rating}</span>
                                </div>
                            </div>
                            <h3 className="font-bold text-[var(--primary-navy)] dark:text-white mb-1">{service.name}</h3>
                            <p className="text-xs text-gray-500 mb-2">by {service.provider}</p>
                            <p className="text-sm font-bold text-[var(--accent-gold)]">{service.price}</p>
                        </div>
                    </motion.div>
                ))}
            </div>
        </div>
    );
}
