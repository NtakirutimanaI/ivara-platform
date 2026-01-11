"use client";

import { motion } from 'framer-motion';
import { Search, Filter, ShoppingCart, Heart, Star, Eye, CheckCircle, AlertTriangle, XCircle } from 'lucide-react';
import Link from 'next/link';
import Image from 'next/image';
import MobileHeader from '@/components/MobileHeader';

export default function Marketplace() {
    // Mimicking frontend data for Technical category
    const products = [
        {
            id: '6954c05715b2daeae91faa35',
            name: "Phone Screen Replacement",
            description: "Quick and professional phone screen replacement service for all smartphone brands.",
            price: "45,000",
            currency: "RWF",
            rating: 4.8,
            image: "/images/products/phone-screen.jpg", // Placeholder path
            category: "Technical",
            stockStatus: "In Stock",
            stockQuantity: 15
        },
        {
            id: '6954c05715b2daeae91faa34',
            name: "Laptop Repair Service",
            description: "Professional laptop repair and maintenance service. We fix all brands including HP, Dell, Lenovo, and more.",
            price: "25,000",
            currency: "RWF",
            rating: 4.9,
            image: "/images/products/laptop-repair.jpg",
            category: "Technical",
            stockStatus: "Low Stock",
            stockQuantity: 3
        },
        {
            id: '695375e2f28374023709248e',
            name: "Smartphone Screen Replacement",
            description: "High-quality smartphone screen replacement for all major brands. Original and aftermarket screens available.",
            price: "35,000",
            currency: "RWF",
            rating: 4.7,
            image: "/images/products/screen-replace.jpg",
            category: "Technical",
            stockStatus: "Out of Stock",
            stockQuantity: 0
        },
        {
            id: '695375e2f28374023709248c',
            name: "General Maintenance",
            description: "Professional laptop repair and maintenance services including hardware upgrades, virus removal, and software installation.",
            price: "15,000",
            currency: "RWF",
            rating: 4.5,
            image: "/images/products/maintenance.jpg",
            category: "Technical",
            stockStatus: "In Stock",
            stockQuantity: 10
        },
    ];

    const categories = ["Technical", "Creative", "Transport", "Food & Fashion", "Education", "Agri & Env", "Media", "Legal", "Other"];

    const handleAddToCart = (id: string) => {
        // Placeholder for cart functionality
        console.log(`Added product ${id} to cart`);
        alert("Product added to cart!");
    };

    const getStockColor = (status: string) => {
        switch (status.toLowerCase()) {
            case 'in stock': return 'text-green-500';
            case 'low stock': return 'text-amber-500';
            case 'out of stock': return 'text-red-500';
            default: return 'text-gray-500';
        }
    };

    const getStockIcon = (status: string) => {
        switch (status.toLowerCase()) {
            case 'in stock': return <CheckCircle size={10} />;
            case 'low stock': return <AlertTriangle size={10} />;
            case 'out of stock': return <XCircle size={10} />;
            default: return <CheckCircle size={10} />;
        }
    };

    return (
        <div className="min-h-screen pb-24 bg-gray-50 dark:bg-[#0A1128]">
            <MobileHeader />

            {/* Sub-Header for Category */}
            <div className="pt-4 px-6 mb-6">
                <div className="text-center">
                    <h1 className="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-[var(--primary-navy)] to-[var(--secondary-navy)] dark:from-white dark:to-gray-400">
                        Technical Marketplace
                    </h1>
                    <p className="text-xs text-gray-500 mt-1">Discover amazing products and services in Technical</p>
                </div>
            </div>

            {/* Categories Horizontal Scroll */}
            <div className="px-6 mb-6">
                <div className="flex gap-3 overflow-x-auto hide-scrollbar pb-2">
                    {categories.map((cat, i) => (
                        <button
                            key={i}
                            className={`px-5 py-2 rounded-full text-xs font-semibold whitespace-nowrap shadow-sm border transition-all ${i === 0 ? 'bg-[var(--accent-gold)] text-[var(--primary-navy)] border-[var(--accent-gold)]' : 'bg-white dark:bg-[#162447] dark:text-gray-300 dark:border-white/5 border-gray-100 hover:border-[var(--accent-gold)]'}`}
                        >
                            {cat}
                        </button>
                    ))}
                </div>
            </div>

            {/* Products Grid */}
            <div className="px-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                {products.map((product, i) => (
                    <motion.div
                        key={product.id}
                        initial={{ opacity: 0, y: 10 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: i * 0.1 }}
                        className="bg-white dark:bg-[#162447] rounded-xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden flex flex-col"
                    >
                        {/* Image Section */}
                        <div className="h-40 bg-gradient-to-br from-indigo-500 to-purple-600 relative overflow-hidden flex items-center justify-center group">
                            {/* Placeholder Icon/Image */}
                            <div className="text-[var(--accent-gold)] text-4xl">
                                <WrenchIcon size={48} />
                            </div>

                            <button className="absolute top-2 right-2 w-8 h-8 bg-white/90 dark:bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors shadow-sm">
                                <Heart size={16} />
                            </button>
                        </div>

                        {/* Content Section */}
                        <div className="p-4 flex-1 flex flex-col">
                            <div className="mb-2">
                                <span className="inline-block bg-[var(--accent-gold)] text-[var(--primary-navy)] text-[10px] font-bold px-2 py-0.5 rounded-full uppercase mb-2">
                                    {product.category}
                                </span>
                                <h3 className="font-bold text-base text-[var(--primary-navy)] dark:text-white leading-tight mb-1 line-clamp-2">
                                    {product.name}
                                </h3>
                                <p className="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 min-h-[2.5em]">
                                    {product.description}
                                </p>
                            </div>

                            <div className="mt-auto">
                                <div className="flex items-end justify-between mb-3">
                                    <div className="text-xl font-extrabold text-[var(--accent-gold)]">
                                        {product.price} <span className="text-xs font-semibold text-[var(--primary-navy)] dark:text-white">{product.currency}</span>
                                    </div>
                                    <div className={`flex items-center gap-1 text-[10px] font-bold uppercase ${getStockColor(product.stockStatus)}`}>
                                        {getStockIcon(product.stockStatus)}
                                        {product.stockStatus}
                                    </div>
                                </div>

                                <div className="flex gap-2">
                                    <Link
                                        href={`/marketplace/product/${product.id}`}
                                        className="flex-1 bg-[var(--primary-navy)] hover:bg-[var(--secondary-navy)] text-white text-xs font-bold py-2.5 px-3 rounded-lg flex items-center justify-center gap-2 transition-colors"
                                    >
                                        <Eye size={14} /> View
                                    </Link>
                                    <button
                                        onClick={() => handleAddToCart(product.id)}
                                        className="flex-1 bg-[var(--accent-gold)] hover:bg-yellow-400 text-[var(--primary-navy)] text-xs font-bold py-2.5 px-3 rounded-lg flex items-center justify-center gap-2 transition-colors shadow-sm"
                                    >
                                        <ShoppingCart size={14} /> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </motion.div>
                ))}
            </div>

            {/* Empty State / Loading would go here */}
        </div>
    );
}

// Icon helper since we don't have the actual icons array from frontend
function WrenchIcon({ size }: { size: number }) {
    return (
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width={size}
            height={size}
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
        >
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
        </svg>
    )
}
