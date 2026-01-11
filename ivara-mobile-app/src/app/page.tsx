"use client";

import { useState, useEffect } from 'react';
import { motion } from 'framer-motion';
import { Search, Bell, User, Wrench, Palette, Truck, GraduationCap, Gavel, Radio, Leaf, MoreHorizontal } from 'lucide-react';
import Link from 'next/link';

import { useSearch } from '@/contexts/SearchContext';

export default function Home() {
  const [activeTab, setActiveTab] = useState('home');
  const { searchQuery, setSearchQuery } = useSearch();

  const [pricingPlans, setPricingPlans] = useState<any[]>([
    {
      name: 'Starter',
      price: 'Free',
      period: '',
      features: [{ text: '1 Service Category' }, { text: 'Basic Dashboard' }, { text: 'Community Support' }],
      buttonText: 'Get Started',
      buttonStyle: 'outline'
    },
    {
      name: 'Professional',
      price: '29,000 FRW',
      period: '/mo',
      isPopular: true,
      features: [{ text: '3 Service Categories' }, { text: 'Advanced Analytics' }, { text: 'Priority Support' }, { text: 'Marketing Tools' }],
      buttonText: 'Sign Up Now',
      buttonStyle: 'primary'
    },
    {
      name: 'Enterprise',
      price: 'Custom',
      period: '',
      features: [{ text: 'Unlimited Categories' }, { text: 'Dedicated Manager' }, { text: 'API Access' }, { text: 'Custom Reporting' }],
      buttonText: 'Contact Sales',
      buttonStyle: 'outline'
    }
  ]);

  useEffect(() => {
    // Attempt to fetch dynamic pricing
    const fetchPricing = async () => {
      try {
        const response = await fetch('http://localhost:5001/api/pricing');
        if (response.ok) {
          const data = await response.json();
          if (data && Array.isArray(data) && data.length > 0) {
            setPricingPlans(data);
          }
        }
      } catch (err) {
        console.log('Using default pricing plans');
      }
    };

    fetchPricing();
  }, []);

  const categories = [
    { id: 'technical', name: 'Technical', icon: Wrench, color: 'bg-blue-100 text-blue-600' },
    { id: 'creative', name: 'Creative', icon: Palette, color: 'bg-purple-100 text-purple-600' },
    { id: 'transport', name: 'Transport', icon: Truck, color: 'bg-orange-100 text-orange-600' },
    { id: 'education', name: 'Education', icon: GraduationCap, color: 'bg-green-100 text-green-600' },
    { id: 'legal', name: 'Legal', icon: Gavel, color: 'bg-red-100 text-red-600' },
    { id: 'media', name: 'Media', icon: Radio, color: 'bg-pink-100 text-pink-600' },
    { id: 'agriculture', name: 'Agri', icon: Leaf, color: 'bg-emerald-100 text-emerald-600' },
    { id: 'other', name: 'More', icon: MoreHorizontal, color: 'bg-gray-100 text-gray-600' },
  ];

  // Search Logic
  const query = searchQuery.toLowerCase();

  const filteredCategories = categories.filter(cat =>
    cat.name.toLowerCase().includes(query)
  );

  const filteredPricing = pricingPlans.filter(plan =>
    plan.name.toLowerCase().includes(query) ||
    plan.price.toLowerCase().includes(query)
  );

  const whyContent = "IVARA.com is a premier platform for service seekers and providers. Referrals, ads, promotions. Backend dashboard.";
  const showWhySection = query === '' || whyContent.toLowerCase().includes(query) || "why choose ivara".includes(query);

  return (
    <div className="min-h-screen pb-24 relative bg-gray-50 dark:bg-[#0A1128]">

      {/* Header */}
      {/* Header removed - using global MobileHeader */}

      {/* Hero Section */}
      <section className="px-6 pt-6 pb-2">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="rounded-3xl bg-[var(--primary-navy)] p-6 text-white shadow-xl shadow-blue-900/20 relative overflow-hidden"
        >
          {/* Abstract Background Design */}
          <div className="absolute top-0 right-0 w-32 h-32 bg-[var(--accent-gold)]/20 rounded-full blur-3xl -mr-10 -mt-10"></div>
          <div className="absolute bottom-0 left-0 w-24 h-24 bg-purple-500/20 rounded-full blur-2xl -ml-10 -mb-10"></div>

          <p className="text-indigo-200 mb-1 text-sm font-medium">Welcome Back,</p>
          <h2 className="text-2xl font-bold mb-6">Find the perfect<br />service provider</h2>

          <div className="relative group">
            <input
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder="What are you looking for?"
              className="w-full h-12 rounded-xl pl-12 pr-4 bg-white/10 border border-white/10 backdrop-blur-md text-white placeholder-white/60 outline-none focus:bg-white/20 transition-all font-medium"
            />
            <Search className="absolute left-4 top-3.5 text-white/70 w-5 h-5 group-focus-within:text-[var(--accent-gold)] transition-colors" />
          </div>
        </motion.div>
      </section>

      {/* Categories Grid */}
      {filteredCategories.length > 0 && (
        <section className="px-6 py-6">
          <div className="flex justify-between items-end mb-4">
            <h3 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white">Categories</h3>
            <Link href="/marketplace" className="text-xs text-[var(--accent-gold)] font-bold uppercase tracking-wide">View All</Link>
          </div>

          <div className="grid grid-cols-4 gap-4">
            {filteredCategories.map((cat, i) => (
              <motion.div
                key={cat.id}
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{ opacity: 1, scale: 1 }}
                transition={{ delay: i * 0.05 }}
                className="flex flex-col items-center gap-2"
              >
                <div className={`w-14 h-14 rounded-2xl flex items-center justify-center shadow-sm ${cat.color} bg-white dark:bg-white/5`}>
                  <cat.icon className="w-6 h-6" />
                </div>
                <span className="text-[10px] font-medium text-gray-600 dark:text-gray-300">{cat.name}</span>
              </motion.div>
            ))}
          </div>
        </section>
      )}

      {/* Why IVARA Section */}
      {showWhySection && (
        <section id="why" className="px-6 py-10 mb-6">
          <div className="flex flex-col items-center gap-8">
            <motion.div
              initial={{ opacity: 0, scale: 0.9 }}
              whileInView={{ opacity: 1, scale: 1 }}
              viewport={{ once: true }}
              className="relative w-full"
            >
              <div className="absolute inset-0 bg-[var(--accent-gold)]/20 blur-3xl rounded-full"></div>
              <img
                src="/images/ivara_phone_mockup_clean.png"
                alt="IVARA App Interface"
                className="relative z-10 w-full h-auto object-contain drop-shadow-2xl rotate-[-5deg] hover:rotate-0 transition-transform duration-500"
              />
            </motion.div>

            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              className="space-y-4 text-left"
            >
              <h3 className="text-2xl font-bold text-[var(--primary-navy)] dark:text-white mb-2">
                Why Choose <span className="text-[var(--accent-gold)]">IVARA?</span>
              </h3>

              <p className="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                <strong className="text-[var(--primary-navy)] dark:text-white">IVARA.com</strong> is a premier platform for service seekers and providers, offering the fastest signup in the industry. We skip the lengthy downloads. Our app allows customers to book technical repairs, logistics, and professional services instantly with flexible membership plans.
              </p>

              <p className="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                Referrals, ads, promotions, campaigns, and messaging are all integrated. Our <strong>backend dashboard</strong> gives you total control to make the app work best for you and your customers.
              </p>

              <p className="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                Designed with a robust set of features by industry experts to streamline service operations and increase revenue.
              </p>
            </motion.div>
          </div>
        </section>
      )}

      {/* Featured Service / Promo */}
      <section className="px-6 pb-6">
        <Link href="/register">
          <motion.div
            whileTap={{ scale: 0.98 }}
            className="rounded-2xl bg-gradient-to-r from-[var(--accent-gold)] to-orange-400 p-1 shadow-lg shadow-orange-500/20 cursor-pointer"
          >
            <div className="bg-white dark:bg-[var(--primary-navy)] rounded-xl p-5 flex items-center gap-4">
              <div className="flex-1">
                <span className="px-2 py-1 rounded-md bg-orange-100 text-orange-600 text-[10px] font-bold uppercase mb-2 inline-block">Premium</span>
                <h4 className="font-bold text-[var(--primary-navy)] dark:text-white mb-1">Get Verified Today</h4>
                <p className="text-xs text-muted-foreground">Boost your visibility and trust score.</p>
              </div>
              <div className="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center">
                <span className="text-xl">🌟</span>
              </div>
            </div>
          </motion.div>
        </Link>
      </section>

      {/* Pricing Section */}
      {filteredPricing.length > 0 && (
        <section className="px-6 pb-24" id="pricing">
          <h3 className="text-2xl font-bold text-[var(--primary-navy)] dark:text-white mb-2 text-center">Pricing Plans</h3>
          <p className="text-sm text-center text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
            Choose the best plan for your service needs. Flexible options for everyone.
          </p>

          <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            {filteredPricing.map((plan, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ delay: index * 0.1 }}
                viewport={{ once: true }}
                className={`relative p-6 rounded-3xl border transition-all duration-300 ${plan.isPopular
                  ? 'bg-white dark:bg-[#162447] border-[var(--accent-gold)] shadow-xl shadow-yellow-500/10 scale-105 z-10'
                  : 'bg-white dark:bg-[#162447] border-gray-100 dark:border-white/5 shadow-sm'
                  }`}
              >
                {plan.isPopular && (
                  <div className="absolute -top-3 left-1/2 -translate-x-1/2 bg-[var(--accent-gold)] text-[var(--primary-navy)] text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Most Popular
                  </div>
                )}

                <h4 className="text-lg font-bold text-[var(--primary-navy)] dark:text-white text-center mb-2">{plan.name}</h4>

                <div className="text-center mb-6">
                  <span className="text-4xl font-extrabold text-[var(--primary-navy)] dark:text-white">{plan.price}</span>
                  {plan.period && <span className="text-sm text-gray-500 font-medium">{plan.period}</span>}
                </div>

                <ul className="space-y-3 mb-8">
                  {plan.features.map((feature: any, idx: number) => (
                    <li key={idx} className="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-300">
                      <div className="w-5 h-5 rounded-full bg-green-100 dark:bg-green-500/20 flex items-center justify-center shrink-0 mt-0.5">
                        <span className="text-green-600 dark:text-green-400 text-[10px]">✔</span>
                      </div>
                      {feature.text || feature}
                    </li>
                  ))}
                </ul>

                <Link
                  href={plan.buttonLink || '/register'}
                  className={`w-full py-4 rounded-xl flex items-center justify-center font-bold text-sm transition-transform active:scale-95 ${plan.buttonStyle === 'primary' || plan.isPopular
                    ? 'bg-[var(--primary-navy)] text-white shadow-lg shadow-blue-900/20'
                    : 'border border-[var(--primary-navy)] text-[var(--primary-navy)] dark:border-white dark:text-white bg-transparent'
                    }`}
                >
                  {plan.buttonText || 'Get Started'}
                </Link>
              </motion.div>
            ))}
          </div>
        </section>
      )}

    </div>
  );
}
