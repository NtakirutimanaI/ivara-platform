'use client';

import React from 'react';
import { useRouter } from 'next/navigation';
import { motion } from 'framer-motion';
import {
  ArrowRight, Smartphone, Shield, Zap, Globe,
  CheckCircle, LayoutGrid, Users, Briefcase,
  MessageSquare, Download, Layers, Star,
  Menu, Search, Bell, Plus, User
} from 'lucide-react';
import Link from 'next/link';

// Animation Variants
const fadeIn = {
  hidden: { opacity: 0, y: 30 },
  visible: { opacity: 1, y: 0, transition: { duration: 0.6 } }
};

const staggerContainer = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: {
      staggerChildren: 0.2
    }
  }
};

import MobileHeader from '@/components/MobileHeader';

export default function LandingPage() {
  const router = useRouter();

  return (
    <div className="min-h-screen bg-background text-foreground overflow-x-hidden">

      <MobileHeader />

      {/* Main Content Area (Added padding-top to account for fixed header) */}
      <div className="pt-[64px]">

        {/* 1. HERO SECTION (web.top) */}
        <section className="relative min-h-[90vh] flex flex-col justify-center items-center px-6 pt-10 pb-10 overflow-hidden">
          {/* Background Ambience */}
          <div className="absolute top-[-20%] left-[-20%] w-[80%] h-[50%] bg-primary/20 blur-[100px] rounded-full sm:blur-[120px]" />
          <div className="absolute bottom-[-10%] right-[-10%] w-[60%] h-[40%] bg-blue-600/10 blur-[80px] rounded-full" />

          <motion.div
            initial={{ scale: 0.8, opacity: 0 }}
            animate={{ scale: 1, opacity: 1 }}
            transition={{ duration: 0.8 }}
            className="mb-8 relative z-10"
          >
            <div className="w-24 h-24 bg-gradient-to-tr from-primary to-blue-600 rounded-3xl rotate-3 flex items-center justify-center shadow-[0_0_30px_rgba(146,79,194,0.4)]">
              <Smartphone size={48} className="text-white" />
            </div>
          </motion.div>

          <motion.h1
            initial={{ y: 20, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ delay: 0.2 }}
            className="text-5xl font-black mb-4 tracking-tighter text-center leading-tight z-10"
          >
            IVARA<span className="text-primary">.</span>
          </motion.h1>

          <motion.p
            initial={{ y: 20, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ delay: 0.4 }}
            className="text-lg text-muted text-center max-w-xs mb-8 leading-relaxed z-10"
          >
            The ultimate ecosystem for managing services, repairs, and business growth.
          </motion.p>

          <motion.div
            initial={{ y: 20, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ delay: 0.6 }}
            className="w-full z-10"
          >
            <Link href="/login" className="block w-full">
              <button className="w-full btn-primary h-14 text-lg font-bold flex items-center justify-center gap-3 shadow-lg shadow-primary/25">
                Get Started <ArrowRight size={20} />
              </button>
            </Link>
          </motion.div>

          {/* Floating Icons Background (Visual) */}
          <div className="absolute inset-0 pointer-events-none opacity-20">
            <LayoutGrid className="absolute top-20 left-10 animate-bounce" size={32} />
            <Users className="absolute bottom-40 right-10 animate-pulse" size={32} />
            <Briefcase className="absolute top-1/2 left-[-10px] animate-spin-slow" size={40} />
          </div>
        </section>


        {/* 2. PARTNERS / TRUST (web.partners) */}
        <section className="py-8 border-y border-white/5 bg-white/2">
          <p className="text-center text-xs text-gray-500 uppercase tracking-widest mb-6">Trusted by Industry Leaders</p>
          <div className="flex justify-center gap-8 opacity-50 grayscale">
            <div className="flex items-center gap-2"><Globe size={20} /><span className="font-bold">GlobalTech</span></div>
            <div className="flex items-center gap-2"><Shield size={20} /><span className="font-bold">SecureNet</span></div>
            <div className="flex items-center gap-2"><Zap size={20} /><span className="font-bold">FastFix</span></div>
          </div>
        </section>


        {/* 3. ABOUT & SOLUTIONS (web.about, web.solutions) */}
        <section id="solutions" className="py-20 px-6">
          <motion.div
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            variants={fadeIn}
            className="mb-12"
          >
            <h2 className="text-3xl font-bold mb-4 text-foreground">One Platform,<br /><span className="text-primary">Endless Solutions.</span></h2>
            <p className="text-muted">IVARA bridges the gap between service providers and clients with a suite of powerful tools.</p>
          </motion.div>

          <motion.div
            variants={staggerContainer}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            className="grid grid-cols-1 gap-4"
          >
            {[
              { title: 'Technical Repairs', icon: CheckCircle, desc: 'Track repairs, manage tickets, and update clients instantly.' },
              { title: 'Inventory Management', icon: Layers, desc: 'Real-time stock tracking with automated low-stock alerts.' },
              { title: 'Business Analytics', icon: Star, desc: 'Insightful reports on sales, commissions, and growth.' },
            ].map((item, i) => (
              <motion.div key={i} variants={fadeIn} className="glass-card p-6 flex flex-col gap-3">
                <div className="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                  <item.icon size={20} />
                </div>
                <h3 className="font-bold text-lg text-foreground">{item.title}</h3>
                <p className="text-sm text-muted">{item.desc}</p>
              </motion.div>
            ))}
          </motion.div>
        </section>


        {/* 4. WHY US (web.why) */}
        <section id="why" className="py-20 px-6 bg-gradient-to-b from-transparent to-primary/5">
          <motion.div
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true }}
            variants={fadeIn}
            className="text-center mb-12"
          >
            <div className="inline-block px-4 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-4">
              Why Choose Us
            </div>
            <h2 className="text-3xl font-bold">Built for <span className="text-white">Success</span></h2>
          </motion.div>

          <div className="grid grid-cols-2 gap-4">
            <div className="glass p-5 rounded-2xl text-center">
              <Shield className="mx-auto mb-3 text-blue-400" size={32} />
              <h4 className="font-bold">Secure</h4>
              <p className="text-xs text-gray-400 mt-1">Bank-grade data protection</p>
            </div>
            <div className="glass p-5 rounded-2xl text-center">
              <Zap className="mx-auto mb-3 text-yellow-400" size={32} />
              <h4 className="font-bold">Fast</h4>
              <p className="text-xs text-gray-400 mt-1">Lightweight & responsive</p>
            </div>
            <div className="glass p-5 rounded-2xl text-center">
              <Globe className="mx-auto mb-3 text-green-400" size={32} />
              <h4 className="font-bold">Global</h4>
              <p className="text-xs text-gray-400 mt-1">Multi-language support</p>
            </div>
            <div className="glass p-5 rounded-2xl text-center">
              <Smartphone className="mx-auto mb-3 text-purple-400" size={32} />
              <h4 className="font-bold">Mobile</h4>
              <p className="text-xs text-gray-400 mt-1">Accessibility on any device</p>
            </div>
          </div>
        </section>


        {/* 5. DOWNLOAD APP (web.down) */}
        <section id="download" className="py-20 px-6 relative overflow-hidden">
          <div className="absolute inset-0 bg-primary opacity-10 blur-[100px] rounded-full" />

          <div className="glass-card p-8 text-center relative z-10 border-primary/30">
            <Download className="mx-auto mb-4 text-white" size={48} />
            <h2 className="text-2xl font-bold mb-4">Get the Mobile App</h2>
            <p className="text-sm text-gray-300 mb-6">Experience the full power of Ivara on your device. Available for iOS and Android.</p>
            <button className="btn-primary w-full flex items-center justify-center gap-2">
              Download Now
            </button>
          </div>
        </section>


        {/* 6. CONTACT & FOOTER (web.contact, layouts.footer) */}
        <section id="contact" className="py-12 px-6 bg-black text-center border-t border-white/10">
          <h3 className="text-xl font-bold mb-6">Need Help?</h3>
          <div className="flex flex-col gap-4 mb-10">
            <a href="mailto:support@ivara.com" className="glass p-4 rounded-xl flex items-center justify-center gap-3">
              <MessageSquare size={20} /> Chat with Support
            </a>
          </div>

          <div className="text-gray-600 text-sm">
            <p className="mb-2">© 2025 IVARA Platform. All rights reserved.</p>
            <div className="flex justify-center gap-4 text-xs">
              <Link href="#">Privacy Policy</Link>
              <Link href="#">Terms of Service</Link>
            </div>
          </div>
        </section>

      </div>
    </div>
  );
}
