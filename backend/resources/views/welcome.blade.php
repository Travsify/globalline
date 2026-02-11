@extends('layouts.public')

@section('title', 'GlobalLine | The Engine of African Enterprise')

@section('content')

    <!-- Hero Section: The Enterprise Gateway -->
    <header class="relative min-h-screen flex items-center pt-24 overflow-hidden bg-brand-navy">
        <!-- Background Imagery & Effects -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2400&q=80" 
                 class="w-full h-full object-cover opacity-20 scale-105" alt="Logistics Network">
            <div class="absolute inset-0 bg-gradient-to-b from-brand-navy via-brand-navy/80 to-brand-navy"></div>
        </div>

        <!-- Animated Background Orbs -->
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-brand-gold/10 blur-[120px] rounded-full animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-brand-gold/5 blur-[120px] rounded-full animate-pulse-slow-delay"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-5xl">
                <div class="inline-flex items-center px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md mb-8">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full mr-3 animate-ping"></span>
                    <p class="text-[10px] font-black text-white uppercase tracking-[0.3em] italic">Live Intelligence: Guangzhou Node Active</p>
                </div>

                <h1 class="text-7xl md:text-9xl font-heading font-black text-white leading-none mb-8 tracking-tighter uppercase italic">
                    The Engine of <br>
                    <span class="gold-outline-text">African</span> <br>
                    <span class="text-brand-gold">Enterprise</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/50 font-medium mb-16 max-w-2xl leading-relaxed italic">
                    Direct access to China's manufacturing giants. <br>
                    <span class="text-white font-black uppercase tracking-widest text-sm">Sourcing · Logistics · Settlement</span>
                </p>

                <!-- Glassmorphism 1688 Search Integration -->
                <div class="max-w-4xl group">
                    <form action="{{ route('marketplace.index') }}" method="GET" class="relative flex flex-col md:flex-row bg-white/5 backdrop-blur-2xl p-3 rounded-[2.5rem] border border-white/10 shadow-2xl transition-soft group-hover:border-brand-gold/40">
                        <div class="flex-1 flex items-center px-8 py-4">
                            <div class="bg-brand-gold/10 p-3 rounded-2xl mr-6">
                                <svg class="w-6 h-6 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="query"
                                   placeholder="Paste 1688.com or Alibaba URL to initiate sourcing..." 
                                   class="w-full bg-transparent text-white font-bold placeholder-white/20 focus:outline-none text-lg">
                        </div>
                        <button type="submit" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-16 py-6 rounded-[1.8rem] font-black uppercase tracking-[0.2em] text-xs transition-soft shadow-2xl active:scale-95 italic">
                            Deploy Bot
                        </button>
                    </form>
                    <div class="mt-6 flex items-center space-x-6 px-4">
                        <span class="text-[9px] font-black text-white/20 uppercase tracking-widest">Global Node Support:</span>
                        <div class="flex space-x-4">
                            <span class="text-[9px] font-bold text-white/40 hover:text-brand-gold cursor-pointer transition-colors uppercase italic tracking-tighter">1688.com</span>
                            <span class="text-[9px] font-bold text-white/40 hover:text-brand-gold cursor-pointer transition-colors uppercase italic tracking-tighter">Alibaba.com</span>
                            <span class="text-[9px] font-bold text-white/40 hover:text-brand-gold cursor-pointer transition-colors uppercase italic tracking-tighter">Taobao</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Abstract Geometry -->
        <div class="absolute right-0 bottom-0 w-1/3 h-full hidden xl:block pointer-events-none">
            <div class="relative w-full h-full">
                <div class="absolute top-1/2 left-0 w-[500px] h-[500px] border border-white/5 rounded-full rotate-45"></div>
                <div class="absolute top-1/2 left-20 w-[400px] h-[400px] border border-brand-gold/10 rounded-full -rotate-12"></div>
            </div>
        </div>
    </header>

    <!-- Trust Ledger: The Connected Network -->
    <section class="py-20 bg-brand-navy border-y border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12 opacity-40 grayscale group hover:grayscale-0 transition-soft duration-700">
                <span class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] italic mb-8 md:mb-0">Verified Logistics Nodes</span>
                <div class="flex flex-wrap items-center justify-center gap-16 md:gap-24">
                    <span class="text-2xl font-black text-white font-heading tracking-tighter italic uppercase underline decoration-brand-gold decoration-4 underline-offset-8">Cosco</span>
                    <span class="text-2xl font-black text-white font-heading tracking-tighter italic uppercase">Maersk</span>
                    <span class="text-2xl font-black text-white font-heading tracking-tighter italic uppercase underline decoration-brand-gold decoration-4 underline-offset-8">CMA CGM</span>
                    <span class="text-2xl font-black text-white font-heading tracking-tighter italic uppercase">SF Express</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Intelligence Pillars -->
    <section class="py-40 bg-brand-navy relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-32">
                <h2 class="text-4xl md:text-6xl font-heading font-black text-white mb-6 uppercase italic tracking-tighter">The Holy Trinity <br>of <span class="text-brand-gold">Sourcing</span></h2>
                <div class="w-24 h-1 bg-brand-gold mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Sourcing Node -->
                <div class="bg-white/5 border border-white/10 p-16 rounded-[4rem] group hover:bg-white/10 transition-soft relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-gold/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:bg-brand-gold/20"></div>
                    <div class="w-20 h-20 bg-brand-gold rounded-[2rem] flex items-center justify-center mb-10 shadow-2xl group-hover:scale-110 transition-soft">
                        <svg class="w-10 h-10 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-heading font-black text-white mb-6 uppercase italic tracking-tighter">Direct Sourcing</h3>
                    <p class="text-white/40 text-lg leading-relaxed mb-10 italic">We synchronize your orders directly with China's factory-tier pricing. No Middlemen.</p>
                    <a href="/portal/marketplace" class="text-brand-gold text-xs font-black uppercase tracking-[0.3em] italic border-b border-brand-gold/20 pb-2 hover:border-brand-gold">Tactical Entry &rarr;</a>
                </div>

                <!-- Consolidation Node -->
                <div class="bg-brand-gold p-16 rounded-[4rem] group transition-soft relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 text-brand-navy"></div>
                    <div class="w-20 h-20 bg-brand-navy rounded-[2rem] flex items-center justify-center mb-10 shadow-2xl group-hover:scale-110 transition-soft">
                        <svg class="w-10 h-10 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-3xl font-heading font-black text-brand-navy mb-6 uppercase italic tracking-tighter">Master Merge</h3>
                    <p class="text-brand-navy/60 text-lg font-bold leading-relaxed mb-10 italic">Combine multi-vendor orders into a single Master Box. Save 45% on volumetric freight.</p>
                    <a href="/portal/consolidation" class="text-brand-navy text-xs font-black uppercase tracking-[0.3em] italic border-b border-brand-navy/20 pb-2 hover:border-brand-navy">Optimize Logistics &rarr;</a>
                </div>

                <!-- Settlement Node -->
                <div class="bg-white/5 border border-white/10 p-16 rounded-[4rem] group hover:bg-white/10 transition-soft relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-gold/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:bg-brand-gold/20"></div>
                    <div class="w-20 h-20 bg-brand-gold rounded-[2rem] flex items-center justify-center mb-10 shadow-2xl group-hover:scale-110 transition-soft">
                        <svg class="w-10 h-10 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-heading font-black text-white mb-6 uppercase italic tracking-tighter">Instant Settle</h3>
                    <p class="text-white/40 text-lg leading-relaxed mb-10 italic">Multi-currency wallet (NGN/CNY/USD) with real-time settlement for supplier invoices.</p>
                    <a href="/portal/wallet" class="text-brand-gold text-xs font-black uppercase tracking-[0.3em] italic border-b border-brand-gold/20 pb-2 hover:border-brand-gold">Deploy Capital &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Inventory Scroller -->
    <section class="py-40 bg-slate-50 relative">
        <div class="container mx-auto px-6 mb-20 flex justify-between items-end">
            <div>
                <span class="text-[10px] font-black text-brand-gold uppercase tracking-[0.3em] italic">Live Intelligence</span>
                <h2 class="text-5xl font-heading font-black text-brand-navy mt-4 uppercase italic tracking-tighter">Recently <span class="text-brand-gold">Sourced</span></h2>
            </div>
            <a href="{{ route('portal.marketplace') }}" class="text-[10px] font-black text-brand-navy uppercase tracking-widest italic border-b-2 border-brand-gold pb-1">View Full Terminal &rarr;</a>
        </div>
        
        <div class="overflow-x-auto pb-20 no-scrollbar">
            <div class="flex space-x-12 px-6">
                @php
                    $samples = [
                        ['name' => 'Industrial CNC Node', 'price' => '¥4,200', 'img' => 'https://images.unsplash.com/photo-1581092583537-20d51b4b4f1b?auto=format&fit=crop&w=600&q=80'],
                        ['name' => 'Solar Power Core', 'price' => '¥1,500', 'img' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80'],
                        ['name' => 'Premium Textile Mesh', 'price' => '¥120', 'img' => 'https://images.unsplash.com/photo-1558444452-92f7671f618a?auto=format&fit=crop&w=600&q=80'],
                        ['name' => 'Logistics Tablet Pro', 'price' => '¥1,800', 'img' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=600&q=80'],
                        ['name' => 'Smart Cargo Sensor', 'price' => '¥300', 'img' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?auto=format&fit=crop&w=600&q=80'],
                    ];
                @endphp
                @foreach($samples as $item)
                <div class="min-w-[400px] bg-white rounded-[3.5rem] shadow-xl overflow-hidden group hover:shadow-2xl transition-soft cursor-pointer" 
                     onclick="window.location.href='{{ route('portal.marketplace') }}?item={{ urlencode($item['name']) }}';">
                    <div class="h-64 relative overflow-hidden">
                        <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-soft duration-700" alt="{{ $item['name'] }}">
                        <div class="absolute top-6 left-6 bg-brand-navy text-brand-gold px-6 py-2 rounded-full text-[10px] font-black uppercase italic tracking-widest shadow-lg">1688 Verified</div>
                    </div>
                    <div class="p-10">
                        <h4 class="text-2xl font-heading font-black text-brand-navy uppercase italic tracking-tighter mb-4">{{ $item['name'] }}</h4>
                        <div class="flex justify-between items-center">
                            <span class="text-3xl font-heading font-black text-brand-gold italic tracking-tighter">{{ $item['price'] }}</span>
                            <button class="bg-slate-50 p-4 rounded-2xl group-hover:bg-brand-gold transition-soft">
                                <svg class="w-6 h-6 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- The Sourcing Assistance Block: Enterprise Grade -->
    <section class="py-40 bg-brand-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white/5 to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <div class="max-w-4xl mx-auto">
                <span class="text-[10px] font-black text-brand-gold uppercase tracking-[0.4em] italic mb-8 inline-block">Bespoke Manufacturing Conduit</span>
                <h2 class="text-6xl md:text-8xl font-heading font-black text-white mb-12 uppercase italic tracking-tighter leading-none">Can't Find It? <br>We'll <span class="gold-outline-text italic">Build</span> It.</h2>
                <p class="text-xl md:text-2xl text-white/50 font-medium mb-16 leading-relaxed italic">Direct factory connections for custom production, OEM branding, and large-scale enterprise procurement.</p>
                <a href="/portal/sourcing" class="inline-block bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-16 py-6 rounded-[2rem] font-black uppercase tracking-[0.3em] text-sm transition-soft shadow-2xl active:scale-95 italic">
                    Initiate Factory Inquiry
                </a>
            </div>
        </div>

        <!-- Abstract Grid lines -->
        <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-brand-gold/30 to-transparent"></div>
    </section>

    <!-- Intelligence Grid: Real-time Stats -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 text-center">
                <div class="space-y-4">
                    <span class="text-5xl md:text-7xl font-heading font-black text-brand-navy italic tracking-tighter">12k+</span>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] italic">Delivered Loads</p>
                </div>
                <div class="space-y-4">
                    <span class="text-5xl md:text-7xl font-heading font-black text-brand-navy italic tracking-tighter">120+</span>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] italic">Verified Ports</p>
                </div>
                <div class="space-y-4">
                    <span class="text-5xl md:text-7xl font-heading font-black text-brand-navy italic tracking-tighter">8.4k</span>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] italic">Active Merchants</p>
                </div>
                <div class="space-y-4">
                    <span class="text-5xl md:text-7xl font-heading font-black text-brand-navy italic tracking-tighter">4.9/5</span>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] italic">Protocol Rating</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .gold-outline-text {
            -webkit-text-stroke: 2px #C5A059;
            color: transparent;
        }
        .animate-pulse-slow { animation: pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .animate-pulse-slow-delay { animation: pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite; animation-delay: 2s; }
        @keyframes pulse {
            0%, 100% { opacity: 0.1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(1.1); }
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

@endsection
