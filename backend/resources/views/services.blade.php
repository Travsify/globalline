@extends('layouts.public')

@section('title', 'Our Services | GlobalLine Logistics')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-brand-gold/5 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block px-4 py-1 bg-brand-gold/10 text-brand-gold rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">Enterprise Core</span>
            <h1 class="text-6xl md:text-8xl font-heading font-black text-white mb-8 tracking-tighter uppercase italic">
                Our <span class="gold-outline-text underline decoration-brand-gold/20">Solutions</span>
            </h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto leading-relaxed">
                Integrated logistics, procurement, and financial infrastructure for the modern global trader.
            </p>
        </div>
    </header>

    <!-- Detailed Services Breakdown -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="space-y-40">
                <!-- 01: Procurement -->
                <div class="flex flex-col lg:flex-row items-center gap-24">
                    <div class="w-full lg:w-1/2 order-2 lg:order-1">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic">01</span>
                        <h2 class="text-5xl font-heading font-black text-brand-navy mb-8 tracking-tight uppercase">Product Procurement</h2>
                        <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                            Skip the middleman. We provide direct access to China's largest B2B marketplaces (1688, Taobao, Tmall) with English-simplified search and local purchasing agents.
                        </p>
                        <ul class="space-y-4 mb-12">
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Real-time 1688 Search Integration
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Quality Control Inspections (QC Photos)
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Negotiation & Factory Audits
                            </li>
                        </ul>
                        <a href="/portal/marketplace" class="text-brand-gold font-black uppercase tracking-widest text-xs border-b-2 border-brand-gold/20 hover:border-brand-gold pb-1 transition-soft">
                            Start Sourcing Now &rarr;
                        </a>
                    </div>
                    <div class="w-full lg:w-1/2 order-1 lg:order-2">
                         <div class="relative">
                            <div class="absolute -inset-4 bg-slate-100 rounded-[3rem] -rotate-2"></div>
                            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1000&q=80" 
                                 class="relative z-10 w-full rounded-[2.5rem] shadow-2xl" alt="Procurement">
                         </div>
                    </div>
                </div>

                <!-- 02: Logistics -->
                <div class="flex flex-col lg:flex-row items-center gap-24">
                    <div class="w-full lg:w-1/2">
                         <div class="relative">
                            <div class="absolute -inset-4 bg-brand-gold/5 rounded-[3rem] rotate-2"></div>
                            <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=1000&q=80" 
                                 class="relative z-10 w-full rounded-[2.5rem] shadow-2xl" alt="Logistics">
                         </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic">02</span>
                        <h2 class="text-5xl font-heading font-black text-brand-navy mb-8 tracking-tight uppercase">Global Shipping</h2>
                        <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                            Fast, reliable, and consolidated. Whether it's express air for urgent samples or bulk sea freight for industrial inventory, we've optimized the route.
                        </p>
                        <ul class="space-y-4 mb-12">
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Smart Consolidation (Master Boxes)
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Nationwide Door-to-Door Delivery
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Live Tracking & Automated Status Updates
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 03: Payments -->
                <div class="flex flex-col lg:flex-row items-center gap-24">
                    <div class="w-full lg:w-1/2 order-2 lg:order-1">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic">03</span>
                        <h2 class="text-5xl font-heading font-black text-brand-navy mb-8 tracking-tight uppercase">Multi-Currency Payments</h2>
                        <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                            The bridge for your capital. Our multi-currency platform allows you to settle factory invoices in Yuan or USD using your local currency.
                        </p>
                        <ul class="space-y-4 mb-12">
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                USD, CNY & NGN Wallet Support
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Instant Currency Conversion
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Verified B2B Wire Transfers (within 24h)
                            </li>
                        </ul>
                    </div>
                    <div class="w-full lg:w-1/2 order-1 lg:order-2">
                         <div class="relative">
                            <div class="absolute -inset-4 bg-slate-100 rounded-[3rem] -rotate-2"></div>
                            <div class="relative z-10 w-full rounded-[2.5rem] bg-brand-navy p-12 shadow-2xl text-center overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1 bg-brand-gold"></div>
                                <h4 class="text-brand-gold font-black uppercase tracking-[0.3em] text-[10px] mb-8 italic">Wallet Infrastructure</h4>
                                <div class="flex justify-center space-x-4 mb-8">
                                    <div class="w-16 h-16 rounded-xl border border-white/10 flex items-center justify-center text-white font-black text-xs">USD</div>
                                    <div class="w-16 h-16 rounded-xl border border-white/10 flex items-center justify-center text-white font-black text-xs bg-brand-gold/10">CNY</div>
                                    <div class="w-16 h-16 rounded-xl border border-white/10 flex items-center justify-center text-white font-black text-xs">NGN</div>
                                </div>
                                <p class="text-white/40 text-xs font-medium italic">Enterprise-encrypted Ledger System v2.0</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Network Section -->
    <section class="py-32 bg-brand-slate overflow-hidden relative">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-4xl md:text-5xl font-heading font-black text-brand-navy mb-16 tracking-tight uppercase italic">Our Global <span class="gold-outline-text text-brand-navy italic">Hubs</span></h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-5xl mx-auto">
                <div class="p-10 bg-white rounded-3xl shadow-xl transition-soft hover:shadow-2xl">
                    <span class="block text-brand-gold font-black text-xs uppercase tracking-widest mb-4 italic">China Hub</span>
                    <h5 class="text-2xl font-black font-heading text-brand-navy mb-2">Guangzhou</h5>
                    <p class="text-slate-400 text-sm font-medium">Baiyun District Sourcing Center</p>
                </div>
                <div class="p-10 bg-white rounded-3xl shadow-xl transition-soft hover:shadow-2xl border-2 border-brand-gold/20">
                    <span class="block text-brand-gold font-black text-xs uppercase tracking-widest mb-4 italic">Africa Hub</span>
                    <h5 class="text-2xl font-black font-heading text-brand-navy mb-2">Lagos</h5>
                    <p class="text-slate-400 text-sm font-medium">Ikeja Logistics & Clearing HQ</p>
                </div>
                <div class="p-10 bg-white rounded-3xl shadow-xl transition-soft hover:shadow-2xl">
                    <span class="block text-brand-gold font-black text-xs uppercase tracking-widest mb-4 italic">Finance Hub</span>
                    <h5 class="text-2xl font-black font-heading text-brand-navy mb-2">New York</h5>
                    <p class="text-slate-400 text-sm font-medium">Wall St. Payments Compliance</p>
                </div>
            </div>
        </div>
    </section>

@endsection
