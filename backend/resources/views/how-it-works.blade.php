@extends('layouts.public')

@section('title', 'How It Works | GlobalLine Logistics')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden text-center">
        <div class="absolute inset-0 z-0">
             <div class="absolute bottom-0 left-0 w-1/2 h-full bg-brand-gold/5 blur-[120px] rounded-full -translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <span class="inline-block px-4 py-1 bg-brand-gold/10 text-brand-gold rounded-full mb-6 italic platform-label">Seamless Operations</span>
            <h1 class="text-6xl md:text-8xl font-heading font-black text-white mb-8 tracking-tighter uppercase italic">
                Our <span class="gold-outline-text underline decoration-brand-gold/20">Process</span>
            </h1>
            <p class="text-white/50 max-w-2xl mx-auto leading-relaxed platform-body">
                From factory floor to your doorstep in five strategic steps.
            </p>
        </div>
    </header>

    <!-- Stepper Section -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="grid grid-cols-1 gap-24 relative">
                <!-- Vertical Progress Line -->
                <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-brand-navy/5 hidden lg:block -translate-x-1/2"></div>

                <!-- Step 01 -->
                <div class="flex flex-col lg:flex-row items-center justify-between relative z-10">
                    <div class="w-full lg:w-[45%] mb-12 lg:mb-0">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic text-right lg:text-left">01</span>
                        <h4 class="text-3xl font-black font-heading text-brand-navy mb-6 uppercase tracking-tight italic">Source & Search</h4>
                        <p class="text-slate-500 leading-relaxed platform-body">
                            Use our [Marketplace](file:///portal/marketplace) to browse millions of products from 1688, Alibaba, and Taobao. Paste any product URL to get an instant quote or submit a [Sourcing Request](file:///portal/sourcing).
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-brand-navy text-brand-gold rounded-full flex items-center justify-center font-black text-xl shadow-2xl shrink-0 hidden lg:flex">01</div>
                    <div class="w-full lg:w-[45%]">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=600&q=80" 
                             class="w-full rounded-[2rem] shadow-xl grayscale hover:grayscale-0 transition-soft" alt="Sourcing">
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="flex flex-col lg:flex-row-reverse items-center justify-between relative z-10">
                    <div class="w-full lg:w-[45%] mb-12 lg:mb-0 lg:text-right">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic">02</span>
                        <h4 class="text-3xl font-black font-heading text-brand-navy mb-6 uppercase tracking-tight italic">Procure & Inspect</h4>
                        <p class="text-slate-500 leading-relaxed platform-body">
                            Our agents in China handle the purchase and negotiation. Once the items arrive at our Guangzhou hub, we perform a thorough quality check and provide you with high-resolution photos.
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-brand-navy text-brand-gold rounded-full flex items-center justify-center font-black text-xl shadow-2xl shrink-0 hidden lg:flex">02</div>
                    <div class="w-full lg:w-[45%]">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=600&q=80" 
                             class="w-full rounded-[2rem] shadow-xl grayscale hover:grayscale-0 transition-soft" alt="Inspection">
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="flex flex-col lg:flex-row items-center justify-between relative z-10">
                    <div class="w-full lg:w-[45%] mb-12 lg:mb-0">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic">03</span>
                        <h4 class="text-3xl font-black font-heading text-brand-navy mb-6 uppercase tracking-tight italic">Consolidate & Verify</h4>
                        <p class="text-slate-500 leading-relaxed platform-body">
                            Combine multiple packages into a single [Consolidation Master Box]. This optimizes shipping volume and significantly reduces your international freight costs.
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-brand-navy text-brand-gold rounded-full flex items-center justify-center font-black text-xl shadow-2xl shrink-0 hidden lg:flex">03</div>
                    <div class="w-full lg:w-[45%]">
                        <div class="bg-brand-navy p-10 rounded-[2rem] shadow-xl text-center">
                            <h5 class="text-brand-gold mb-4 italic platform-label">Optimization Active</h5>
                            <p class="text-white text-3xl font-heading font-black italic">40% SAVINGS</p>
                            <div class="h-1 bg-brand-gold w-20 mx-auto mt-4"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 04 -->
                <div class="flex flex-col lg:flex-row-reverse items-center justify-between relative z-10">
                    <div class="w-full lg:w-[45%] mb-12 lg:mb-0 lg:text-right">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic">04</span>
                        <h4 class="text-3xl font-black font-heading text-brand-navy mb-6 uppercase tracking-tight italic">Ship & Track</h4>
                        <p class="text-slate-500 leading-relaxed platform-body">
                            Choose between Express Air or Cargo Sea freight. Monitor your journey in real-time with our [Interactive Tracking](file:///portal/tracking) and receive native push notifications on your mobile.
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-brand-navy text-brand-gold rounded-full flex items-center justify-center font-black text-xl shadow-2xl shrink-0 hidden lg:flex">04</div>
                    <div class="w-full lg:w-[45%]">
                        <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=600&q=80" 
                             class="w-full rounded-[2rem] shadow-xl" alt="Shipping">
                    </div>
                </div>

                <!-- Step 05 -->
                <div class="flex flex-col lg:flex-row items-center justify-between relative z-10">
                    <div class="w-full lg:w-[45%] mb-12 lg:mb-0">
                        <span class="text-brand-gold font-black font-heading text-6xl opacity-20 block mb-6 italic">05</span>
                        <h4 class="text-3xl font-black font-heading text-brand-navy mb-6 uppercase tracking-tight italic">Receive & Scale</h4>
                        <p class="text-slate-500 leading-relaxed platform-body">
                            Your cargo cleared and delivered. Use your profit to scale further with our [Multi-Currency Wallet](file:///portal/wallet) and automatic reinvestment tools.
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-brand-gold text-white rounded-full flex items-center justify-center font-black text-xl shadow-2xl shrink-0 hidden lg:flex">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="w-full lg:w-[45%]">
                        <a href="/portal/dashboard" class="block bg-brand-gold hover:bg-brand-goldHover text-white text-center py-10 rounded-[2rem] transition-soft shadow-xl platform-label">
                            Unlock Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
