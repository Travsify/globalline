@extends('layouts.public')

@section('title', 'Pricing | GlobalLine Logistics')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 bg-navy-dark overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-emerald-500/5 rounded-full blur-[120px] -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-amber-brand mb-6 block platform-label" data-aos="fade-up">Transparent Pricing</span>
            <h1 class="text-5xl md:text-7xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up" data-aos-delay="100">
                Simple Rates. <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light">No Hidden Fees.</span>
            </h1>
        </div>
    </section>

    <!-- PRICING CARDS -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <!-- Card 1: Standard Air -->
                <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-xl hover:shadow-2xl hover:border-amber-brand/30 transition-all duration-300 relative group" data-aos="fade-up">
                    <div class="mb-8">
                        <span class="bg-navy-light/10 text-navy-dark px-4 py-2 rounded-lg platform-label">Economy</span>
                        <h3 class="text-2xl font-bold text-navy-dark mt-4">Standard Air</h3>
                        <div class="flex items-baseline mt-4">
                            <span class="text-4xl font-bold text-navy-dark">$4.50</span>
                            <span class="text-slate-500 text-sm ml-2">/ kg</span>
                        </div>
                        <p class="text-slate-500 mt-4 leading-relaxed platform-body">Best for non-urgent shipments. Reliable delivery within a week.</p>
                    </div>

                    <ul class="space-y-4 mb-8 text-slate-600 platform-body">
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            5-7 Business Days
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Basic Tracking
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Minimal Clearing Fees
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="block w-full text-center py-4 rounded-xl border-2 border-slate-100 text-navy-dark hover:border-navy-dark transition-colors platform-label">
                        Calculate Cost
                    </a>
                </div>

                <!-- Card 2: Express Air (Featured) -->
                <div class="bg-navy-dark p-8 rounded-[2rem] shadow-2xl overflow-hidden relative group transform lg:-translate-y-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 right-0 bg-amber-brand text-navy-dark px-4 py-2 rounded-bl-2xl platform-label">Most Popular</div>
                    <div class="absolute inset-0 bg-gradient-to-b from-navy-light/50 to-navy-dark z-0"></div>
                    
                    <div class="relative z-10">
                        <div class="mb-8">
                             <span class="bg-white/10 text-amber-brand px-4 py-2 rounded-lg platform-label">Express</span>
                            <h3 class="text-2xl font-bold text-white mt-4">Priority Air</h3>
                             <div class="flex items-baseline mt-4">
                                <span class="text-4xl font-bold text-white">$6.99</span>
                                <span class="text-white/50 text-sm ml-2">/ kg</span>
                            </div>
                            <p class="text-white/60 mt-4 leading-relaxed platform-body">For fast, time-sensitive cargo. Delivery in specific time windows.</p>
                        </div>

                        <ul class="space-y-4 mb-8 text-white/80 platform-body">
                            <li class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                3-5 Business Days
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Real-time GPS Tracking
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Priority Customs Clearance
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Cargo Insurance Included
                            </li>
                        </ul>

                        <a href="{{ route('register') }}" class="block w-full text-center py-4 rounded-xl bg-amber-brand text-navy-dark hover:bg-white transition-colors platform-label">
                            Get Rates
                        </a>
                    </div>
                </div>

                <!-- Card 3: Sea Cargo -->
                <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-xl hover:shadow-2xl hover:border-amber-brand/30 transition-all duration-300 relative group" data-aos="fade-up" data-aos-delay="200">
                    <div class="mb-8">
                        <span class="bg-navy-light/10 text-navy-dark px-4 py-2 rounded-lg platform-label">Volume</span>
                        <h3 class="text-2xl font-bold text-navy-dark mt-4">Sea Cargo</h3>
                         <div class="flex items-baseline mt-4">
                            <span class="text-4xl font-bold text-navy-dark">$250</span>
                            <span class="text-slate-500 text-sm ml-2">/ CBM</span>
                        </div>
                        <p class="text-slate-500 mt-4 leading-relaxed platform-body">Ideal for heavy or bulky items. Optimized for volume cost savings.</p>
                    </div>

                    <ul class="space-y-4 mb-8 text-slate-600 platform-body">
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            30-45 Days
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Container Tracking
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Port & Door Delivery
                        </li>
                    </ul>

                     <a href="{{ route('register') }}" class="block w-full text-center py-4 rounded-xl border-2 border-slate-100 font-bold uppercase tracking-widest text-xs text-navy-dark hover:border-navy-dark transition-colors">
                        Get Quote
                    </a>
                </div>

            </div>
            
            <div class="text-center mt-12 text-slate-400 platform-body">
                Prices are estimates and may vary based on route, volume, and current market fuel surcharges.
            </div>
        </div>
    </section>

@endsection
