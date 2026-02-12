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
                <!-- 01: Importing (Sourcing) -->
                <div class="flex flex-col lg:flex-row items-center gap-24">
                    <div class="w-full lg:w-1/2 order-2 lg:order-1">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full mb-8">
                            <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em] italic">Track_01: Procurement</p>
                        </div>
                        <h2 class="text-5xl md:text-6xl font-black text-brand-navy mb-8 tracking-tighter uppercase italic">Importing <br><span class="text-brand-gold italic">Made Simple.</span></h2>
                        <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                            Stop navigating complex Chinese marketplaces alone. Our "Buy-for-me" protocol allows you to source direct from 1688, Taobao, and Alibaba with local quality control and verified factory audits.
                        </p>
                        <ul class="space-y-4 mb-12">
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Unified Sourcing Terminal (1688/Taobao)
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Mandatory Quality Control & QC Photos
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Multi-vendor Consolidation (MasterMerge)
                            </li>
                        </ul>
                        <a href="{{ route('marketplace.index') }}" class="inline-block bg-brand-navy text-white px-10 py-5 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-brand-gold hover:text-brand-navy transition-all shadow-xl">
                            Launch Sourcing Engine
                        </a>
                    </div>
                    <div class="w-full lg:w-1/2 order-1 lg:order-2">
                         <div class="relative group">
                            <div class="absolute -inset-4 bg-blue-500/5 rounded-[4rem] group-hover:scale-105 transition-all duration-700"></div>
                            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1000&q=80" 
                                 class="relative z-10 w-full rounded-[3.5rem] shadow-3xl grayscale hover:grayscale-0 transition-all duration-1000" alt="Importing">
                            <div class="absolute top-10 right-10 z-20 bg-brand-gold text-brand-navy p-4 rounded-2xl font-black italic text-xs uppercase tracking-widest shadow-2xl animate-bounce">
                                4,800+ Factories
                            </div>
                         </div>
                    </div>
                </div>

                <!-- 02: Exporting (Shipping) -->
                <div class="flex flex-col lg:flex-row items-center gap-24">
                    <div class="w-full lg:w-1/2">
                         <div class="relative group">
                            <div class="absolute -inset-4 bg-brand-gold/5 rounded-[4rem] group-hover:scale-105 transition-all duration-700"></div>
                            <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=1000&q=80" 
                                 class="relative z-10 w-full rounded-[3.5rem] shadow-3xl grayscale hover:grayscale-0 transition-all duration-1000" alt="Exporting">
                            <div class="absolute -bottom-10 -left-10 z-20 bg-brand-navy text-white p-8 rounded-[2.5rem] shadow-3xl border border-white/10 italic">
                                <p class="text-[10px] uppercase font-black tracking-widest text-brand-gold mb-2">Transit Intel</p>
                                <p class="text-2xl font-black tracking-tighter">3-5 Day Express</p>
                            </div>
                         </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="inline-flex items-center px-4 py-2 bg-brand-gold/10 border border-brand-gold/20 rounded-full mb-8">
                            <p class="text-[10px] font-black text-brand-gold uppercase tracking-[0.2em] italic">Track_02: Logistics</p>
                        </div>
                        <h2 class="text-5xl md:text-6xl font-black text-brand-navy mb-8 tracking-tighter uppercase italic">Exporting <br><span class="text-blue-500 italic">Globally.</span></h2>
                        <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                            Fast, reliable cargo movement from GlobalLine hubs to your doorstep. We handle the documentation, clearing, and last-mile delivery across all major trade corridors.
                        </p>
                        <ul class="space-y-4 mb-12">
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Air & Sea Freight Custom Solutions
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Real-time Granular Asset Tracking
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Nationwide Distribution Centers
                            </li>
                        </ul>
                        <a href="{{ route('tracking') }}" class="inline-block border-2 border-brand-navy text-brand-navy px-10 py-5 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-brand-navy hover:text-white transition-all italic">
                            Track Your Freight
                        </a>
                    </div>
                </div>

                <!-- 03: Supplier Payments -->
                <div class="flex flex-col lg:flex-row items-center gap-24">
                    <div class="w-full lg:w-1/2 order-2 lg:order-1">
                        <div class="inline-flex items-center px-4 py-2 bg-emerald-500/10 border border-emerald-500/20 rounded-full mb-8">
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] italic">Track_03: Financials</p>
                        </div>
                        <h2 class="text-5xl md:text-6xl font-black text-brand-navy mb-8 tracking-tighter uppercase italic">Supplier <br><span class="text-emerald-500 italic">Settlements.</span></h2>
                        <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                            Bridging the currency gap. Pay factory invoices in USD, CNY, or TRY instantly using your local currency. Secure B2B wire transfers protected by the GlobalLine Ledger.
                        </p>
                        <ul class="space-y-4 mb-12">
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Multi-currency Enterprise Wallets
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Automated 1688 Checkout (Naira to Yuan)
                            </li>
                            <li class="flex items-center text-sm font-bold text-brand-navy uppercase tracking-widest italic group">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-4 group-hover:scale-150 transition-soft"></span>
                                Zero-Middleman FX Rates
                            </li>
                        </ul>
                        <a href="{{ route('portal.wallet') }}" class="inline-block bg-emerald-600 text-white px-10 py-5 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-brand-navy transition-all shadow-xl shadow-emerald-500/20">
                            Access Ledger System
                        </a>
                    </div>
                    <div class="w-full lg:w-1/2 order-1 lg:order-2">
                         <div class="relative group">
                            <div class="absolute -inset-4 bg-emerald-500/5 rounded-[4rem] group-hover:scale-105 transition-all duration-700"></div>
                            <div class="relative z-10 w-full rounded-[3.5rem] bg-brand-navy p-12 shadow-4xl text-center overflow-hidden border border-white/5">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-500 via-brand-gold to-emerald-500"></div>
                                <h4 class="text-white/20 font-black uppercase tracking-[0.4em] text-[10px] mb-8 italic">Financial Node Protocol</h4>
                                <div class="flex justify-center space-x-6 mb-12">
                                    <div class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 flex flex-col items-center justify-center text-white">
                                        <span class="text-[8px] font-black uppercase tracking-widest text-white/40 mb-1">Local</span>
                                        <span class="font-black text-xs">NGN</span>
                                    </div>
                                    <div class="w-20 h-20 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
                                         <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    </div>
                                    <div class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 flex flex-col items-center justify-center text-white">
                                        <span class="text-[8px] font-black uppercase tracking-widest text-white/40 mb-1">Global</span>
                                        <span class="font-black text-xs">CNY</span>
                                    </div>
                                </div>
                                <p class="text-emerald-500 font-black text-[10px] uppercase tracking-widest italic animate-pulse">Settlement Stream Active</p>
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
