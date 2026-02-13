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
                        <div>
                            <p class="text-4xl font-bold text-white mb-2 tracking-tighter">220+</p>
                            <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em]">Active Hubs</p>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-white mb-2 tracking-tighter">40%</p>
                            <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em]">Lower Latency</p>
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
                                <span class="text-[10px] font-black uppercase tracking-widest text-white/50">Lagos_Hub: Incoming_Cargo</span>
                            </div>
                            <p class="text-lg font-bold text-white italic tracking-tight uppercase leading-none">Node_Status: Processing_v2.4</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: THE OPERATING SYSTEM (Bento) -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mb-24" data-aos="fade-up">
                <span class="text-blue-600 font-black uppercase tracking-[0.4em] text-[10px] mb-6 block">Unified_Sourcing</span>
                <h2 class="text-6xl md:text-8xl font-bold font-heading text-navy-dark mb-10 tracking-tighter leading-[0.85]">One Core. <br><span class="italic text-slate-300">Infinite Trade.</span></h2>
                <p class="text-xl text-slate-500 font-bold italic leading-relaxed border-l-4 border-slate-100 pl-8">
                    Direct factory negotiation, multi-currency settlements, and smart warehousing unified in a single dashboard.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Bento 1 -->
                <div class="md:col-span-2 bg-slate-50 border-2 border-slate-100 rounded-[3.5rem] p-16 flex flex-col md:flex-row gap-12 group hover:bg-white hover:border-blue-500/20 hover:shadow-4xl transition-all duration-500" data-aos="fade-up">
                    <div class="flex-1">
                        <div class="w-20 h-20 bg-blue-600/10 text-blue-600 rounded-3xl mb-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-4xl font-bold text-navy-dark tracking-tighter mb-6">Factory Audit Protocol</h3>
                        <p class="text-lg text-slate-500 font-medium leading-relaxed italic">We physically inspect nodes to ensure 100% compliance before you deploy capital.</p>
                    </div>
                    <div class="md:w-1/3 bg-white rounded-3xl p-8 border border-slate-100 flex flex-col justify-center text-center">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-4">Node_Verified</span>
                        <div class="text-5xl font-black text-navy-dark mb-1 tracking-tighter">98.4%</div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase italic">Quality Yield</p>
                    </div>
                </div>

                <!-- Bento 2 -->
                <div class="bg-navy-dark rounded-[3.5rem] p-16 text-white group hover:shadow-4xl transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 bg-amber-brand text-navy-dark rounded-3xl mb-10 flex items-center justify-center font-black text-3xl">-20%</div>
                    <h3 class="text-4xl font-bold tracking-tighter mb-6 text-amber-brand">Negotiated Rates</h3>
                    <p class="text-white/40 font-medium leading-relaxed italic">Our local sourcing teams leverage volume clusters to slash your procurement costs by up to 20%.</p>
                </div>

                <!-- Bento 3 -->
                <div class="bg-slate-50 border-2 border-slate-100 rounded-[3.5rem] p-12 flex flex-col justify-end min-h-[400px] group hover:bg-white transition-all duration-500" data-aos="fade-up">
                    <div class="w-16 h-16 bg-emerald-500/10 text-emerald-600 rounded-2xl mb-8 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-navy-dark tracking-tighter mb-4 italic">Settlement Rails</h3>
                    <p class="text-slate-500 font-medium italic">Execute payments in RMB or USD via high-speed trade corridors with zero hidden fees.</p>
                </div>

                <!-- Bento 4 -->
                <div class="md:col-span-2 bg-gradient-to-br from-navy-dark via-navy to-navy-dark border border-white/5 rounded-[3.5rem] p-16 flex items-center justify-between group cursor-pointer hover:shadow-[0_0_50px_rgba(0,0,0,0.2)] transition-all" data-aos="fade-up" data-aos-delay="200">
                    <div class="max-w-md">
                         <span class="text-amber-brand font-black uppercase tracking-[0.4em] text-[10px] mb-4 block">OEM_ODM_Protocol</span>
                        <h3 class="text-4xl font-bold text-white tracking-tighter mb-6 leading-tight">Private Labeling & <br><span class="italic text-white/40 uppercase tracking-widest text-2xl">Asset Creation</span></h3>
                        <p class="text-white/40 font-medium italic">Deploy your own brand. We manage custom engineering, packaging, and scale from prototype to port.</p>
                    </div>
                    <div class="w-24 h-24 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-navy-dark transition-all duration-500 group-hover:scale-110">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: NETWORK HUD -->
    <section class="py-32 bg-navy-dark relative border-t border-white/5 overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-1/2 left-1/2 w-[1200px] h-[1200px] bg-blue-600/5 rounded-full blur-[150px] -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-24 max-w-4xl mx-auto" data-aos="fade-up">
                <span class="text-amber-brand font-black uppercase tracking-[0.4em] text-[10px] mb-6 block">The_Scaling_Engine</span>
                <h2 class="text-6xl md:text-8xl font-bold font-heading text-white mb-10 tracking-tighter leading-[0.85]">Join the <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-white">Propulsion.</span></h2>
                <div class="flex flex-col sm:flex-row justify-center gap-6 mt-16">
                     <a href="{{ route('register') }}" class="px-16 py-8 bg-white text-navy-dark rounded-3xl font-black uppercase tracking-widest text-[10px] hover:bg-amber-brand transition-all shadow-btn active:scale-95 italic border-2 border-transparent">
                        Initialize Identity Gateway
                    </a>
                    <a href="{{ route('network') }}" class="px-16 py-8 bg-transparent border-2 border-white/10 text-white rounded-3xl font-black uppercase tracking-widest text-[10px] hover:bg-white/10 transition-all italic">
                        Surface All Global Nodes
                    </a>
                </div>
            </div>

            <!-- Dashboard Mock Preview (Floating) -->
            <div class="relative max-w-6xl mx-auto" data-aos="zoom-in" data-aos-duration="1500">
                 <div class="bg-white/[0.03] backdrop-blur-3xl border border-white/10 rounded-[4rem] p-10 md:p-20 overflow-hidden shadow-4xl relative">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                         <div class="md:col-span-3">
                              <div class="flex items-center gap-6 mb-12 pb-8 border-b border-white/5">
                                   <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center">
                                       <div class="w-8 h-8 rounded-full border-4 border-amber-brand/30 border-t-amber-brand animate-spin"></div>
                                   </div>
                                   <div>
                                       <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em]">Node_Stream: Active</p>
                                       <h4 class="text-3xl font-bold text-white tracking-tighter italic">Live Enterprise Terminal</h4>
                                   </div>
                              </div>
                              <div class="space-y-8">
                                   <div class="h-6 w-full bg-white/5 rounded-full overflow-hidden relative">
                                        <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-blue-600 to-blue-400 w-[84%] animate-shimmer"></div>
                                   </div>
                                    <div class="h-6 w-[70%] bg-white/5 rounded-full overflow-hidden relative">
                                        <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-amber-600 to-amber-brand w-[45%] animate-shimmer" style="animation-delay: 0.5s"></div>
                                   </div>
                              </div>
                         </div>
                         <div class="bg-navy-dark/80 rounded-[2.5rem] border border-white/10 p-10 flex flex-col justify-center items-center text-center">
                              <span class="text-[10px] font-black text-amber-brand uppercase tracking-widest mb-6">Uptime_Meta</span>
                              <div class="text-5xl font-black text-white mb-2 tracking-tighter italic">99.9%</div>
                              <div class="text-[8px] font-bold text-white/30 uppercase tracking-[0.3em]">Precision Reliability</div>
                         </div>
                    </div>
                 </div>
                 <!-- Decorative floating code -->
                 <div class="absolute -top-10 -right-10 hidden lg:block bg-navy p-6 rounded-2xl border border-white/10 shadow-btn animate-float">
                      <pre class="text-emerald-400 text-[8px] font-mono leading-relaxed">
{
  "node": "LAG-01",
  "status": "OPERATIONAL",
  "auth": "GL_SECURE_v8"
}
                      </pre>
                 </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .heroSwiper { width: 100%; height: 100%; }
    .heroSwiper .swiper-pagination-bullet { width: 8px; height: 8px; background: rgba(255,255,255,0.2) !important; opacity: 1 !important; border-radius: 4px; transition: all 0.3s; }
    .heroSwiper .swiper-pagination-bullet-active { width: 40px; background: #f59e0b !important; }
    
    .shadow-4xl { box-shadow: 0 50px 100px -20px rgba(0,0,0,0.15); }
    .shadow-btn { box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.4); }

    .animate-float { animation: float 6s ease-in-out infinite; }
    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }

    .animate-shimmer { position: relative; overflow: hidden; }
    .animate-shimmer::after { content: ''; position: absolute; inset: 0; transform: translateX(-100%); background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); animation: shimmer 2s infinite; }
    @keyframes shimmer { 100% { transform: translateX(100%); } }

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
            speed: 1000,
            autoplay: {
                delay: 6000,
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
