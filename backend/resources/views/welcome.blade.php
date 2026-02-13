@extends('layouts.public')

@section('title', 'GlobalLine | The Operating System for Global Trade')

@section('content')

    <!-- HERO SLIDER SECTION -->
    <section class="relative min-h-[90vh] lg:min-h-screen bg-navy-dark overflow-hidden">
        <!-- Swiper Container -->
        <div class="swiper heroSwiper h-full">
            <div class="swiper-wrapper">
                
                <!-- Slide 1: Global Shipping -->
                <div class="swiper-slide relative flex items-center pt-32 pb-20 overflow-hidden">
                    <div class="absolute inset-0 z-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-navy-dark via-navy-dark/80 to-transparent z-10"></div>
                        <img src="https://images.unsplash.com/photo-1494412574744-ff70438f6920?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" alt="Global Shipping">
                    </div>
                    <div class="container mx-auto px-6 relative z-20">
                        <div class="max-w-4xl" data-aos="fade-right">
                            <span class="inline-block px-4 py-2 bg-amber-brand/10 border border-amber-brand/20 rounded-full text-amber-brand text-[10px] font-black uppercase tracking-[0.4em] mb-8">Infrastructure_Alpha</span>
                            <h1 class="text-6xl md:text-8xl font-bold font-heading text-white leading-[0.85] mb-8 tracking-tighter">
                                Logistics. <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-white">Re-Engineered.</span>
                            </h1>
                            <p class="text-xl md:text-2xl text-white/50 font-medium mb-12 max-w-2xl leading-relaxed italic border-l-4 border-amber-brand pl-8">
                                One unified operating system for global trade nodes, high-velocity shipping, and seamless customs.
                            </p>
                            <div class="flex flex-wrap gap-6">
                                <a href="{{ route('register') }}" class="px-10 py-5 bg-amber-brand hover:bg-white text-navy-dark rounded-2xl font-black uppercase tracking-widest text-xs transition-all shadow-btn active:scale-95">
                                    Initialize Shipments
                                </a>
                                <a href="{{ route('services') }}" class="px-10 py-5 bg-white/5 hover:bg-white/10 border border-white/10 text-white rounded-2xl font-black uppercase tracking-widest text-xs transition-all backdrop-blur-md">
                                    Explore Nodes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Factory Sourcing -->
                <div class="swiper-slide relative flex items-center pt-32 pb-20 overflow-hidden">
                    <div class="absolute inset-0 z-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-navy-dark via-navy-dark/80 to-transparent z-10"></div>
                        <img src="https://images.unsplash.com/photo-1565034946487-0b75026995ce?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" alt="Factory Sourcing">
                    </div>
                    <div class="container mx-auto px-6 relative z-20">
                        <div class="max-w-4xl">
                            <span class="inline-block px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full text-blue-400 text-[10px] font-black uppercase tracking-[0.4em] mb-8">Direct_Access_v5</span>
                            <h1 class="text-6xl md:text-8xl font-bold font-heading text-white leading-[0.85] mb-8 tracking-tighter">
                                Factory. <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-white">Direct.</span>
                            </h1>
                            <p class="text-xl md:text-2xl text-white/50 font-medium mb-12 max-w-2xl leading-relaxed italic border-l-4 border-blue-500 pl-8">
                                Bypass the noise. Connect directly to verified manufacturing clusters in CN, TR, and UAE with local node support.
                            </p>
                            <div class="flex flex-wrap gap-6">
                                <a href="{{ route('marketplace.index') }}" class="px-10 py-5 bg-blue-600 hover:bg-blue-400 text-white rounded-2xl font-black uppercase tracking-widest text-xs transition-all shadow-btn active:scale-95">
                                    Browse Marketplace
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Trade Finance -->
                <div class="swiper-slide relative flex items-center pt-32 pb-20 overflow-hidden">
                    <div class="absolute inset-0 z-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-navy-dark via-navy-dark/80 to-transparent z-10"></div>
                        <img src="https://images.unsplash.com/photo-1554224155-169641357599?q=80&w=2072&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" alt="Trade Finance">
                    </div>
                    <div class="container mx-auto px-6 relative z-20">
                        <div class="max-w-4xl">
                            <span class="inline-block px-4 py-2 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-emerald-400 text-[10px] font-black uppercase tracking-[0.4em] mb-8">Capital_Rail_0x</span>
                            <h1 class="text-6xl md:text-8xl font-bold font-heading text-white leading-[0.85] mb-8 tracking-tighter">
                                Zero-Latency. <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-white">Settlements.</span>
                            </h1>
                            <p class="text-xl md:text-2xl text-white/50 font-medium mb-12 max-w-2xl leading-relaxed italic border-l-4 border-emerald-500 pl-8">
                                Pay suppliers instantly in RMB or USD. High-frequency trade financing built into your workflow.
                            </p>
                            <div class="flex flex-wrap gap-6">
                                <a href="{{ route('pricing') }}" class="px-10 py-5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-black uppercase tracking-widest text-xs transition-all shadow-btn active:scale-95">
                                    View Financing Plans
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Slider Controls -->
            <div class="absolute bottom-12 right-12 z-30 flex items-center gap-6">
                <div class="swiper-pagination !static !w-auto flex items-center gap-2"></div>
                <div class="flex items-center gap-2">
                    <button class="hero-prev w-14 h-14 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-white hover:text-navy-dark transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="hero-next w-14 h-14 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-white hover:text-navy-dark transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Embedded Control Suite (Floating Over Hero) -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 z-40 w-full container px-6 translate-y-1/2 hidden lg:block">
            <div class="bg-white rounded-[3rem] shadow-4xl p-10 flex items-center gap-12 border border-slate-100 backdrop-blur-xl bg-white/95" x-data="{ activeTab: 'track' }">
                
                <div class="w-1/4 pr-12 border-r border-slate-100">
                    <h3 class="text-3xl font-bold font-heading text-navy-dark tracking-tighter mb-2">Control <span class="italic text-slate-300">Hub.</span></h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Execute instant actions below.</p>
                </div>

                <div class="flex-1 flex items-center gap-8">
                    <!-- Tabs -->
                    <div class="flex flex-col gap-2">
                        <button @click="activeTab = 'track'" :class="activeTab === 'track' ? 'bg-navy-dark text-white' : 'text-slate-400 hover:bg-slate-50'" class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Quick_Track</button>
                        <button @click="activeTab = 'calc'" :class="activeTab === 'calc' ? 'bg-navy-dark text-white' : 'text-slate-400 hover:bg-slate-50'" class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Cost_Engine</button>
                    </div>

                    <!-- Tab Content: Track -->
                    <div x-show="activeTab === 'track'" class="flex-1" x-transition>
                        <form action="{{ route('tracking') }}" method="GET" class="flex gap-4">
                            <input type="text" name="tracking_id" class="flex-1 bg-slate-50 border-2 border-slate-100 rounded-2xl px-8 py-5 text-navy-dark font-black focus:outline-none focus:border-amber-brand transition-all italic" placeholder="Enter Global Node ID (e.g. GL-77X-2026)">
                            <button type="submit" class="bg-amber-brand hover:bg-navy-dark hover:text-white px-8 py-5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all group">
                                Trace Node &rarr;
                            </button>
                        </form>
                    </div>

                    <!-- Tab Content: Calc -->
                    <div x-show="activeTab === 'calc'" class="flex-1 flex items-center gap-12" x-transition>
                        <div class="flex-1">
                            <label class="block text-[8px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4">Payload_Volume (KG)</label>
                            <input type="range" min="1" max="5000" value="500" class="w-full h-2 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-amber-brand">
                        </div>
                        <div class="shrink-0 text-center">
                            <p class="text-[10px] font-black text-slate-300 uppercase italic mb-1">Estimated Cost</p>
                            <div class="text-3xl font-black text-navy-dark italic leading-none">$1,240.00*</div>
                        </div>
                        <a href="{{ route('calculator') }}" class="bg-navy-dark text-white px-8 py-5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-amber-brand hover:text-navy-dark transition-all">
                            Full Estimate
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SPACER FOR FLOATING HUB ON DESKTOP -->
    <div class="hidden lg:block h-32"></div>

    <!-- SECTION 1: GLOBAL LOGISTICS INFRASTRUCTURE -->
    <section class="py-24 bg-navy-dark text-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-amber-brand font-black uppercase tracking-[0.4em] text-[10px] mb-6 block">Backbone_Protocol</span>
                    <h2 class="text-5xl md:text-7xl font-bold font-heading mb-8 tracking-tighter leading-[0.9]">Borderless <br><span class="italic text-slate-400">Logistics.</span></h2>
                    <p class="text-xl text-white/50 font-medium mb-12 leading-relaxed">
                        We've dismantled the legacy friction of global freight. Our unified network spans 220 countries, creating a seamless high-speed pipeline for your enterprise assets.
                    </p>
                    <div class="grid grid-cols-2 gap-10">
                        <div class="p-8 bg-white/5 border border-white/10 rounded-3xl">
                            <p class="text-4xl font-black text-white mb-2 tracking-tighter italic">220+</p>
                            <p class="text-[9px] font-black text-white/30 uppercase tracking-[0.4em]">Active Hubs</p>
                        </div>
                        <div class="p-8 bg-white/5 border border-white/10 rounded-3xl">
                            <p class="text-4xl font-black text-white mb-2 tracking-tighter italic">40%</p>
                            <p class="text-[9px] font-black text-white/30 uppercase tracking-[0.4em]">Lower Latency</p>
                        </div>
                    </div>
                </div>
                <!-- Visual Nodes -->
                <div class="lg:w-1/2 relative" data-aos="fade-left">
                    <div class="relative bg-white/5 border border-white/10 rounded-[4rem] p-12 backdrop-blur-3xl overflow-hidden group">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-amber-brand/10 rounded-full blur-[80px]"></div>
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=1200&auto=format&fit=crop" class="rounded-[3rem] w-full h-[400px] object-cover opacity-60 grayscale group-hover:grayscale-0 transition-all duration-1000" alt="Logistics Center">
                        <div class="absolute bottom-16 left-16 right-16 bg-navy-dark/90 backdrop-blur-xl border border-white/10 p-8 rounded-3xl translate-y-8 group-hover:translate-y-0 transition-transform">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-white/50">Node_Stream: Live</span>
                            </div>
                            <p class="text-lg font-bold text-white italic tracking-tight uppercase leading-none">Status: All Nodes Operational</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: SEAMLESS PAYMENTS -->
    <section class="py-32 bg-white text-navy-dark overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="group md:w-1/2 relative" data-aos="fade-right">
                    <div class="relative bg-navy-dark rounded-[3.5rem] p-12 shadow-4xl rotate-2 group-hover:rotate-0 transition-transform duration-700">
                         <div class="absolute inset-0 bg-gradient-to-br from-navy-light/50 to-navy-dark rounded-[3.5rem]"></div>
                         <div class="relative z-10 text-white">
                             <div class="flex justify-between items-center mb-10">
                                 <div class="flex items-center gap-4">
                                     <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center">
                                        <svg class="w-7 h-7 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                     </div>
                                     <div>
                                         <p class="text-[10px] text-white/30 uppercase font-black tracking-widest">Transaction_ID</p>
                                         <p class="font-bold text-xl tracking-tight italic">GL_SETTLE_0x92</p>
                                     </div>
                                 </div>
                                 <div class="text-right">
                                     <p class="text-[10px] text-white/30 uppercase font-black tracking-widest italic">Status</p>
                                     <p class="text-emerald-400 font-black italic">VERIFIED</p>
                                 </div>
                             </div>
                             <div class="text-6xl font-black text-white mb-4 tracking-tighter">¥ 45,000.00</div>
                             <div class="text-xl text-white/40 italic mb-12">≈ $6,234.50 USD</div>
                             
                             <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
                                 <div class="h-full w-full bg-emerald-500 animate-shimmer"></div>
                             </div>
                         </div>
                    </div>
                    <!-- Decorative back card -->
                    <div class="absolute -bottom-6 -right-6 w-full h-full bg-amber-brand/10 border-2 border-amber-brand/20 -z-10 rounded-[3.5rem]"></div>
                </div>

                <div class="md:w-1/2" data-aos="fade-left">
                    <span class="text-amber-brand font-black uppercase tracking-[0.4em] text-[10px] mb-6 block">Settlement_Rails</span>
                    <h2 class="text-5xl md:text-7xl font-bold font-heading mb-8 tracking-tighter leading-[0.9]">Frictionless <br><span class="italic text-slate-300">Capital.</span></h2>
                    <p class="text-xl text-slate-500 font-medium leading-relaxed mb-10 italic border-l-4 border-slate-100 pl-8">
                        Pay global manufacturers instantly in RMB or USD without foreign accounts. We handle the high-frequency exchange and transfer protocols.
                    </p>
                    <ul class="space-y-6 mb-12">
                        <li class="flex items-center gap-5">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-lg font-bold text-navy-dark tracking-tight">Instant Node-to-Node Settlements</span>
                        </li>
                        <li class="flex items-center gap-5">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-lg font-bold text-navy-dark tracking-tight">Zero-Threshold FX Latency</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-4 text-navy-dark font-black uppercase tracking-widest text-xs border-b-4 border-amber-brand pb-2 hover:text-amber-brand transition-colors">
                        Deploy Capital Hub <span class="group-hover:translate-x-2 transition-transform">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: SOURCING (Bento Grid) -->
    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-24 max-w-3xl mx-auto" data-aos="fade-up">
                 <span class="text-blue-600 font-black uppercase tracking-[0.4em] text-[10px] mb-6 block">Supply_Chain_v2</span>
                 <h2 class="text-6xl md:text-8xl font-bold font-heading text-navy-dark mb-6 tracking-tighter leading-[0.85]">Factory Direct. <br><span class="italic text-slate-300">No Mid-Nodes.</span></h2>
                 <p class="text-lg text-slate-400 font-bold italic">Bypass intermediaries. Access physical manufacturing clusters directly via GlobalLine.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Box 1 -->
                <div class="md:col-span-2 bg-white rounded-[3.5rem] p-16 shadow-2xl border border-slate-100 group hover:shadow-4xl transition-all duration-500" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-12">
                        <div class="flex-1">
                            <div class="w-20 h-20 bg-blue-600/10 text-blue-600 rounded-3xl mb-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-4xl font-bold text-navy-dark tracking-tighter mb-6">Verified Production Nodes</h3>
                            <p class="text-xl text-slate-500 font-medium italic leading-relaxed">We physically audit factory clusters to ensure quality-yield, node capacity, and ethical compliance before you initialize a contract.</p>
                        </div>
                        <div class="bg-emerald-50 text-emerald-600 px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-[0.2em] self-start border border-emerald-100">Audit_Cleared</div>
                    </div>
                </div>

                <!-- Box 2 -->
                <div class="bg-navy-dark rounded-[3.5rem] p-16 shadow-2xl text-white group hover:shadow-4xl transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 bg-amber-brand text-navy-dark rounded-3xl mb-10 flex items-center justify-center font-black text-3xl">-20%</div>
                    <h3 class="text-4xl font-bold tracking-tighter mb-6 text-amber-brand">Volume Leverage</h3>
                    <p class="text-white/40 font-medium italic leading-relaxed">Our local sourcing teams leverage cluster-volume to slash procurement costs by an average of 20%.</p>
                </div>
                
                <!-- Box 3 -->
                <div class="bg-white rounded-[3.5rem] p-12 shadow-2xl border border-slate-100 group hover:bg-navy-dark hover:text-white transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl mb-10 flex items-center justify-center group-hover:bg-white/10 group-hover:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold tracking-tighter mb-6 italic">Node Consolidation</h3>
                    <p class="text-slate-400 font-medium italic leading-relaxed group-hover:text-white/40">Fuse samples from multiple factory nodes into a single high-velocity shipment. Reduce payload redundancy.</p>
                </div>

                <!-- Box 4 -->
                <div class="md:col-span-2 bg-gradient-to-r from-navy-dark to-navy rounded-[3.5rem] p-16 shadow-2xl text-white flex items-center justify-between group cursor-pointer hover:shadow-4xl transition-all" data-aos="fade-up" data-aos-delay="300">
                    <div class="max-w-md">
                        <h3 class="text-4xl font-bold tracking-tighter mb-6 leading-tight">Private Label <br><span class="italic text-white/40 uppercase tracking-widest text-2xl">OEM/ODM Sync</span></h3>
                        <p class="text-white/40 font-medium italic leading-relaxed">Deploy custom-engineered assets. We manage the full stack from prototype engineering to mass-port delivery.</p>
                    </div>
                     <div class="w-20 h-20 rounded-full border-2 border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-navy-dark transition-all duration-500 group-hover:scale-110">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: SMART WAREHOUSING -->
    <section class="py-32 bg-white border-t border-slate-100 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-20">
                <div class="lg:w-1/3" data-aos="fade-right">
                    <span class="text-amber-brand font-black uppercase tracking-[0.4em] text-[10px] mb-6 block">Buffer_Nodes</span>
                    <h2 class="text-5xl font-bold font-heading text-navy-dark mb-8 tracking-tighter leading-[0.9]">Virtual <br><span class="italic text-slate-300">Hubs.</span></h2>
                    <p class="text-xl text-slate-500 font-medium leading-relaxed italic border-l-4 border-slate-100 pl-8 mb-12">
                        Store payload at our global hubs for 30 days at zero cost. Re-route and consolidate instantly to optimize spatial freight.
                    </p>
                    <a href="{{ route('network') }}" class="text-navy-dark font-black uppercase tracking-widest text-xs border-b-4 border-blue-500 pb-2 hover:text-blue-500 transition-colors">Surface Hub Metadata &rarr;</a>
                </div>
                <div class="lg:w-2/3" data-aos="fade-left">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <!-- Hub 1 -->
                        <div class="bg-slate-50 rounded-[2.5rem] p-10 text-center hover:bg-navy-dark hover:text-white transition-all duration-500 border border-slate-100 group shadow-lg hover:shadow-4xl">
                            <h4 class="text-4xl font-black text-navy-dark mb-2 group-hover:text-amber-brand tracking-tighter italic">CN</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-black tracking-[0.2em] group-hover:text-white/20">Guangzhou</p>
                        </div>
                        <!-- Hub 2 -->
                        <div class="bg-slate-50 rounded-[2.5rem] p-10 text-center hover:bg-navy-dark hover:text-white transition-all duration-500 border border-slate-100 group shadow-lg hover:shadow-4xl">
                            <h4 class="text-4xl font-black text-navy-dark mb-2 group-hover:text-amber-brand tracking-tighter italic">AE</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-black tracking-[0.2em] group-hover:text-white/20">Dubai</p>
                        </div>
                        <!-- Hub 3 -->
                        <div class="bg-slate-50 rounded-[2.5rem] p-10 text-center hover:bg-navy-dark hover:text-white transition-all duration-500 border border-slate-100 group shadow-lg hover:shadow-4xl">
                            <h4 class="text-4xl font-black text-navy-dark mb-2 group-hover:text-amber-brand tracking-tighter italic">US</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-black tracking-[0.2em] group-hover:text-white/20">New York</p>
                        </div>
                        <!-- Hub 4 -->
                        <div class="bg-slate-50 rounded-[2.5rem] p-10 text-center hover:bg-navy-dark hover:text-white transition-all duration-500 border border-slate-100 group shadow-lg hover:shadow-4xl">
                            <h4 class="text-4xl font-black text-navy-dark mb-2 group-hover:text-amber-brand tracking-tighter italic">NG</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-black tracking-[0.2em] group-hover:text-white/20">Lagos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: E-COMMERCE -->
    <section class="py-32 bg-navy-dark text-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-br from-navy to-navy-dark rounded-[4rem] p-16 md:p-24 relative overflow-hidden text-center border border-white/5 shadow-4xl shadow-navy-dark/50">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1556742111-a301076d9d18?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
                
                <div class="relative z-10 max-w-4xl mx-auto py-10">
                    <span class="text-amber-brand font-black uppercase tracking-[0.4em] text-[10px] mb-8 block">Sales_Relay</span>
                    <h2 class="text-6xl md:text-8xl font-bold font-heading mb-10 tracking-tighter leading-[0.85]">Connect. <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-white">Liquidate.</span></h2>
                    <p class="text-white/40 mb-16 text-2xl font-medium leading-relaxed italic">
                        Sync enterprise orders automatically. We pick, pack, and deploy from the nearest buffer-hub directly to your customer node.
                    </p>
                    
                    <div class="flex justify-center flex-wrap gap-6 mb-16">
                         <div class="bg-white/5 px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest border border-white/5 backdrop-blur-md">Shopify_API</div>
                         <div class="bg-white/5 px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest border border-white/5 backdrop-blur-md">Woo_Module</div>
                         <div class="bg-white/5 px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest border border-white/5 backdrop-blur-md">Wix_Engine</div>
                    </div>

                    <a href="{{ route('register') }}" class="group bg-white text-navy-dark px-16 py-6 rounded-3xl font-black uppercase tracking-widest text-[10px] hover:bg-amber-brand transition-all shadow-btn active:scale-95 italic border-2 border-transparent">
                        Initialize Integration Engine &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6, 7, 8: FEATURES GRID -->
    <section class="py-32 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- 6. Real-time Tracking -->
                <div class="p-16 rounded-[3.5rem] border-2 border-slate-100 bg-slate-50 hover:bg-white hover:border-emerald-500/20 hover:shadow-4xl transition-all duration-500 group" data-aos="fade-up">
                    <div class="mb-10 w-20 h-20 bg-emerald-500/10 text-emerald-600 rounded-3xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-navy-dark mb-6 tracking-tighter italic">Control Tower</h3>
                    <p class="text-slate-500 font-medium leading-relaxed italic">Real-time GPS telemetry for every container and pallet node. Full trajectory transparency.</p>
                </div>

                <!-- 7. Insurance -->
                <div class="p-16 rounded-[3.5rem] border-2 border-slate-100 bg-slate-50 hover:bg-white hover:border-amber-brand/20 hover:shadow-4xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                     <div class="mb-10 w-20 h-20 bg-amber-brand/10 text-amber-brand rounded-3xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-navy-dark mb-6 tracking-tighter italic">Risk Shield</h3>
                    <p class="text-slate-500 font-medium leading-relaxed italic">Full-stack insurance protocol. Lost or damaged nodes are refunded at 100% face value instantly.</p>
                </div>

                <!-- 8. Industry Solutions -->
                <div class="p-16 rounded-[3.5rem] border-2 border-slate-100 bg-slate-50 hover:bg-white hover:border-blue-500/20 hover:shadow-4xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                     <div class="mb-10 w-20 h-20 bg-blue-500/10 text-blue-600 rounded-3xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-navy-dark mb-8 tracking-tighter italic">Unified Solutions</h3>
                    <div class="flex flex-wrap gap-4">
                        <span class="px-5 py-2 rounded-xl bg-white border border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-400 group-hover:border-blue-500 group-hover:text-blue-500 transition-colors">Medical</span>
                        <span class="px-5 py-2 rounded-xl bg-white border border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-400 group-hover:border-blue-500 group-hover:text-blue-500 transition-colors">Industrial</span>
                        <span class="px-5 py-2 rounded-xl bg-white border border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-400 group-hover:border-blue-500 group-hover:text-blue-500 transition-colors">Tech_Nodes</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 10: APP CALL TO ACTION -->
    <section class="py-40 bg-navy-dark relative overflow-hidden text-center border-t border-white/5">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-1/2 left-1/2 w-[1200px] h-[1200px] bg-amber-brand/5 rounded-full blur-[200px] -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-6xl md:text-9xl font-bold font-heading text-white mb-10 tracking-tighter leading-[0.85]">Join the <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-white">Propulsion.</span></h2>
            <p class="text-2xl text-white/40 mb-20 max-w-3xl mx-auto italic font-medium leading-relaxed">
                Connect your supply chain to the GlobalLine grid. Join 15,000+ businesses optimizing their trade nodes today.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-8">
                 <a href="{{ route('register') }}" class="group flex items-center gap-6 bg-white text-navy-dark px-12 py-8 rounded-[2.5rem] font-bold transition-all hover:bg-slate-200 active:scale-95 shadow-btn">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor"><path d="M17.061 11.22c-.063-2.583 2.115-3.854 2.208-3.905-1.2-1.761-3.076-2.002-3.739-2.025-1.579-.163-3.078.932-3.878.932-.803 0-2.096-.913-3.465-.892-1.78.026-3.431 1.036-4.349 2.637-1.857 3.218-.475 7.952 1.332 10.552.89 1.282 1.948 2.709 3.056 2.686 1.226-.051 1.693-.794 3.176-.794 1.481 0 1.903.794 3.197.771 1.32-.051 2.164-1.203 2.972-2.392.936-1.369 1.323-2.693 1.346-2.766-.026-.013-2.583-.989-2.659-3.926M14.986 5.253c.691-.836 1.157-1.996 1.026-3.153-1.002.041-2.217.658-2.936 1.498-.638.74-1.196 1.921-1.047 3.048 1.127.086 2.273-.559 2.957-1.393"/></svg>
                     <div class="text-left leading-tight">
                         <div class="text-[10px] uppercase font-black tracking-widest text-navy-dark/40 italic">Available on</div>
                         <div class="text-2xl font-black tracking-tighter italic">App Store</div>
                     </div>
                </a>
                <a href="{{ route('register') }}" class="group flex items-center gap-6 bg-white/5 text-white border-2 border-white/10 px-12 py-8 rounded-[2.5rem] font-bold backdrop-blur-md transition-all hover:bg-white/10 active:scale-95 shadow-btn">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm4.72 10.22l7.76-4.305-3.326-1.89-4.434 6.195zm4.814 1.353l-2.043-1.133L9.666 18.5 13.143 13.387zm1.385-2.067l4.137 2.296a1.001 1.001 0 010 1.754l-4.137 2.296L14.075 12 14.528 11.32z"/></svg>
                     <div class="text-left leading-tight">
                         <div class="text-[10px] uppercase font-black tracking-widest text-white/30 italic">Available on</div>
                         <div class="text-2xl font-black tracking-tighter italic">Google Play</div>
                     </div>
                </a>
            </div>
        </div>
    </section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .heroSwiper { width: 100%; height: 100%; transition-timing-function: cubic-bezier(0.23, 1, 0.32, 1); }
    .heroSwiper .swiper-pagination-bullet { width: 8px; height: 8px; background: rgba(255,255,255,0.2) !important; opacity: 1 !important; border-radius: 4px; transition: all 0.5s; }
    .heroSwiper .swiper-pagination-bullet-active { width: 40px; background: #f59e0b !important; }
    
    .shadow-4xl { box-shadow: 0 50px 100px -20px rgba(0,0,0,0.15); }
    .shadow-btn { box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.4); }

    .animate-float { animation: float 6s ease-in-out infinite; }
    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }

    .animate-shimmer { position: relative; overflow: hidden; }
    .animate-shimmer::after { content: ''; position: absolute; inset: 0; transform: translateX(-100%); background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); animation: shimmer 2s infinite; }
    @keyframes shimmer { 100% { transform: translateX(100%); } }

    [x-cloak] { display: none !important; }

    @media (max-width: 1024px) {
        .heroSwiper h1 { font-size: 3.5rem; }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            effect: 'fade',
            speed: 1200,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.hero-next',
                prevEl: '.hero-prev',
            },
            fadeEffect: {
                crossFade: true
            }
        });
    });
</script>
@endpush
