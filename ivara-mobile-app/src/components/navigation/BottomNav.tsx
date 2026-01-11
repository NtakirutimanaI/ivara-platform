"use client";

import { Home, Search, Calendar, User, Grid } from 'lucide-react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';

export default function BottomNav() {
    const pathname = usePathname();

    const navItems = [
        { label: 'Home', icon: Home, route: '/' },
        { label: 'Market', icon: Search, route: '/marketplace' },
        { label: 'Bookings', icon: Calendar, route: '/bookings' },
        { label: 'Menu', icon: Grid, route: '/menu' },
        { label: 'Profile', icon: User, route: '/profile' },
    ];

    return (
        <div className="fixed bottom-4 left-4 right-4 h-16 bg-[var(--primary-navy)]/90 backdrop-blur-lg rounded-2xl shadow-2xl shadow-blue-900/20 flex items-center justify-around px-2 z-50 border border-white/10">
            {navItems.map((item) => {
                const isActive = pathname === item.route;
                return (
                    <Link
                        key={item.label}
                        href={item.route}
                        className={`flex flex-col items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 ${isActive
                                ? 'bg-[var(--accent-gold)] text-[var(--primary-navy)] -translate-y-4 shadow-lg shadow-yellow-500/30'
                                : 'text-white/60 hover:text-white'
                            }`}
                    >
                        <item.icon className={`w-5 h-5 ${isActive ? 'scale-110' : ''}`} />
                        {!isActive && <span className="text-[9px] mt-1 font-medium">{item.label}</span>}
                    </Link>
                );
            })}
        </div>
    );
}
