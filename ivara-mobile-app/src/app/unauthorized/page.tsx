'use client';

import { motion } from 'framer-motion';
import { ShieldX, ArrowLeft, Home } from 'lucide-react';
import Link from 'next/link';

export default function UnauthorizedPage() {
    return (
        <div className="min-h-screen bg-background flex items-center justify-center p-6">
            <motion.div
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{ opacity: 1, scale: 1 }}
                className="max-w-md w-full text-center"
            >
                <div className="w-20 h-20 mx-auto mb-6 rounded-full bg-red-500/10 flex items-center justify-center">
                    <ShieldX size={40} className="text-red-500" />
                </div>

                <h1 className="text-3xl font-bold text-foreground mb-2">Access Denied</h1>
                <p className="text-muted mb-8">
                    You don't have permission to access this page. Please contact your administrator
                    if you believe this is an error.
                </p>

                <div className="flex flex-col gap-3">
                    <Link
                        href="/dashboard"
                        className="btn-primary flex items-center justify-center gap-2"
                    >
                        <Home size={18} /> Go to Dashboard
                    </Link>
                    <button
                        onClick={() => window.history.back()}
                        className="flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-border text-foreground font-semibold hover:bg-secondary transition-colors"
                    >
                        <ArrowLeft size={18} /> Go Back
                    </button>
                </div>

                <p className="text-xs text-muted mt-8">
                    Error Code: 403 - Forbidden
                </p>
            </motion.div>
        </div>
    );
}
