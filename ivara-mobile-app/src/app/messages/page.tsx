'use client';

import React from 'react';
// MobileHeader import removed
import { motion } from 'framer-motion';
import { MessageSquare } from 'lucide-react';

export default function MessagesPage() {
    return (
        <div className="min-h-screen bg-background pb-24">
            <div className="p-6 flex flex-col items-center justify-center min-h-[60vh] text-center">
                <motion.div
                    initial={{ scale: 0.8, opacity: 0 }}
                    animate={{ scale: 1, opacity: 1 }}
                    className="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary mb-6"
                >
                    <MessageSquare size={40} />
                </motion.div>
                <h1 className="text-2xl font-bold text-foreground mb-2">Messages</h1>
                <p className="text-muted">Your conversations will appear here.</p>
            </div>
        </div>
    );
}
