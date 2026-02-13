@extends('layouts.public')

@section('title', 'Services | The GlobalLine Engine')

@section('content')
<main class="bg-navy-dark min-h-screen pt-20 overflow-hidden" x-data="{ activeService: null }">

    <!-- 1. THE GLOBAL PIPELINE (Hero) -->
    <section class="relative min-h-[80vh] flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-navy/90 via-navy-dark/95 to-navy-dark z-10"></div>
            <!-- Dynamic Data Visualization Image -->
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-overlay scale-110 animate-pulse-slow" 
                 alt="Global Data Pipeline">
            
            <div class="absolute top-1/4 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] animate-float"></div>
            <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-amber-brand/5 rounded-full blur-[100px] animate-float" style="animation-delay: -2s"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-4xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md mb-8">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                    <span class="text-[10px] font-bold text-white/70 uppercase tracking-widest">Core Systems: v2.4.0 Live</span>
                </div>

                <h1 class="text-6xl md:text-8xl font-bold font-heading text-white leading-[0.85] mb-8 tracking-tighter">
                    The Engine of <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand via-white to-white/40">Global Commerce.</span>
                </h1>
                
                <p class="text-xl text-white/50 font-medium mb-12 max-w-2xl leading-relaxed">
                    A multi-layered infrastructure designed to dissolve the boundaries between sourcing, logistics, and finance.
                </p>

                <div class="flex flex-wrap gap-4">
                     <a href="#sourcing" class="px-8 py-4 bg-white text-navy-dark rounded-xl font-bold uppercase tracking-widest text-xs transition-all hover:bg-amber-brand">
                        Explore Capabilities
                    </a>
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-xl font-bold uppercase tracking-widest text-xs transition-all hover:bg-white/10">
                        Join the Network
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 animate-bounce">
            <svg class="w-6 h-6 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <!-- 2. INTELLIGENT SOURCING (AI Agents) -->
    <section id="sourcing" class="py-32 bg-navy relative border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">Module :: 01</span>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-white mb-8">Agentic Sourcing. <br>Beyond the Directory.</h2>
                    <p class="text-white/50 text-lg mb-10 leading-relaxed">
                        Say goodbye to endless catalog searching. Our sourcing protocols deploy on-the-ground agents to physically verify, negotiate, and audit manufacturers specifically for your requirements.
                    </p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                        <div class="p-6 bg-white/5 border border-white/10 rounded-2xl">
                            <h4 class="text-white font-bold mb-2">Live Verification</h4>
                            <p class="text-xs text-white/40">Physical inspection of facilities before any deposit is paid.</p>
                        </div>
                        <div class="p-6 bg-white/5 border border-white/10 rounded-2xl">
                            <h4 class="text-white font-bold mb-2">Negotiation Engine</h4>
                            <p class="text-xs text-white/40">Local language speakers to drive down prices by up to 25%.</p>
                        </div>
                    </div>
                </div>

                <!-- Bento Logic Visualization -->
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="bg-gradient-to-br from-white/10 to-transparent p-1 rounded-[3rem] border border-white/10 shadow-2xl overflow-hidden">
                        <div class="bg-navy-dark/80 backdrop-blur-xl rounded-[2.9rem] p-10">
                             <div class="flex items-center justify-between mb-8">
                                 <div class="text-xs font-mono text-emerald-500 uppercase tracking-widest">Request Status :: ACTIVE</div>
                                 <div class="text-white/20 text-[10px] font-bold">NODE: GZ-HQ</div>
                             </div>
                             <div class="space-y-4 mb-8">
                                 <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                     <div class="h-full w-4/5 bg-amber-brand animate-expand"></div>
                                 </div>
                                 <p class="text-xs text-white/60">Scanning 42 factories for <span class="text-white font-bold">"Industrial LED Panels"</span></p>
                             </div>
                             <div class="grid grid-cols-3 gap-4">
                                 <div class="aspect-square bg-white/5 rounded-xl border border-white/5 flex flex-col items-center justify-center">
                                     <div class="text-amber-brand font-bold text-lg italic">12</div>
                                     <p class="text-[8px] text-white/30 uppercase tracking-tighter">Verified</p>
                                 </div>
                                 <div class="aspect-square bg-white/5 rounded-xl border border-white/5 flex flex-col items-center justify-center">
                                     <div class="text-emerald-500 font-bold text-lg italic">08</div>
                                     <p class="text-[8px] text-white/30 uppercase tracking-tighter">Audited</p>
                                 </div>
                                 <div class="aspect-square bg-white/5 rounded-xl border border-white/5 flex flex-col items-center justify-center">
                                     <div class="text-blue-400 font-bold text-lg italic">03</div>
                                     <p class="text-[8px] text-white/30 uppercase tracking-tighter">Shortlisted</p>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. TRADE FINANCE (The Wallet Engine) -->
    <section class="py-32 bg-white text-navy-dark relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row-reverse items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-left">
                     <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">Module :: 02</span>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-navy-dark mb-8">Instant Trade Finance. <br>High-Frequency Liquidity.</h2>
                    <p class="text-slate-600 text-lg mb-10 leading-relaxed">
                        Convert currency at the speed of code. Pay your global suppliers in RMB, USD, or EUR directly from your local wallet without the friction of traditional banking lags.
                    </p>
                    <ul class="space-y-4 mb-10">
                         <li class="flex items-center gap-4 text-navy-dark font-bold">
                             <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">✓</span>
                             Sub-30 second settlement to CN nodes
                         </li>
                         <li class="flex items-center gap-4 text-navy-dark font-bold">
                             <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">✓</span>
                             Zero-lag Currency Transformation
                         </li>
                         <li class="flex items-center gap-4 text-navy-dark font-bold">
                             <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">✓</span>
                             Embedded Trade Credit Lines (COMING SOON)
                         </li>
                    </ul>
                </div>
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="relative">
                        <div class="absolute inset-0 bg-navy-dark/5 rounded-[4rem] rotate-3"></div>
                        <div class="relative bg-navy-dark p-12 rounded-[4rem] text-white shadow-3xl">
                             <div class="mb-12">
                                 <p class="text-xs text-white/30 uppercase tracking-[0.3em] mb-2 font-mono italic">Account Balance (Global Unified)</p>
                                 <h3 class="text-4xl md:text-5xl font-bold font-heading">$142,506.88</h3>
                             </div>
                             <div class="space-y-6">
                                 <div class="flex justify-between items-center p-4 bg-white/5 rounded-2xl border border-white/5">
                                     <div class="flex items-center gap-4">
                                         <div class="w-10 h-10 bg-amber-brand rounded-lg flex items-center justify-center text-navy-dark font-bold text-xs">CN</div>
                                         <span class="text-sm font-bold tracking-tight">Factory Settlement (Guangzhou)</span>
                                     </div>
                                     <span class="text-emerald-400 font-mono text-sm leading-none">- ¥ 450,000.00</span>
                                 </div>
                                 <div class="flex justify-between items-center p-4 bg-white/5 rounded-2xl border border-white/5 opacity-50">
                                     <div class="flex items-center gap-4">
                                         <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-navy-dark font-bold text-xs">US</div>
                                         <span class="text-sm font-bold tracking-tight">Logistics Hub (Tax/Duty)</span>
                                     </div>
                                     <span class="text-amber-brand font-mono text-sm leading-none">- $ 1,240.00</span>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SMART CONSOLIDATION (The Space Optimizer) -->
    <section class="py-32 bg-slate-50 relative border-y border-slate-200">
        <div class="container mx-auto px-6">
             <div class="text-center mb-20">
                 <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">Module :: 03</span>
                 <h2 class="text-4xl md:text-5xl font-bold font-heading text-navy-dark mb-6">Smart Consolidation. <br>Space Optimization.</h2>
                 <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                    Stop paying for empty space. Our spatial algorithms repackage goods from multiple suppliers into a single, highly dense unit, reducing volumetric weight and shipping costs by up to 45%.
                 </p>
             </div>
             
             <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                 <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 group hover:shadow-2xl transition-all" data-aos="fade-up">
                     <div class="w-14 h-14 bg-amber-brand/10 text-amber-brand rounded-2xl mb-8 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                     </div>
                     <h3 class="text-2xl font-bold mb-4">Fragmented Mode</h3>
                     <p class="text-slate-500 text-sm leading-relaxed mb-6">Traditional shipping where each supplier sends a box separately, incurring 10-15 base fees and wasted space.</p>
                     <p class="text-[10px] font-black uppercase text-red-500 tracking-widest">Efficiency: 35%</p>
                 </div>
                 
                 <div class="bg-navy-dark p-10 rounded-[3rem] shadow-2xl group flex flex-col justify-center relative overflow-hidden" data-aos="scale-up" data-aos-delay="100">
                     <div class="absolute top-0 right-0 p-8">
                         <span class="text-amber-brand text-[10px] font-bold uppercase tracking-[0.3em] animate-pulse">Optimal State</span>
                     </div>
                     <h3 class="text-3xl font-bold mb-4 text-white">GlobalLine <br>Unified Mode.</h3>
                     <p class="text-white/40 text-sm mb-10 leading-relaxed italic">"Dynamic tetris-style packaging used to eliminate void space across multimodal routes."</p>
                     <div class="text-4xl font-bold text-emerald-400 font-mono tracking-tighter">98.2% <span class="text-[10px] text-white/30 uppercase font-black">Fill Rate</span></div>
                 </div>

                 <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 group hover:shadow-2xl transition-all" data-aos="fade-up" data-aos-delay="200">
                     <div class="w-14 h-14 bg-blue-600/10 text-blue-600 rounded-2xl mb-8 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                     </div>
                     <h3 class="text-2xl font-bold mb-4">The Savings</h3>
                     <p class="text-slate-500 text-sm leading-relaxed mb-6">Clients typically see a reduction of 40% on their total landed cost just by switching to our consolidation engine.</p>
                     <p class="text-[10px] font-black uppercase text-emerald-500 tracking-widest">Avg Saving: $1,400 / m3</p>
                 </div>
             </div>
        </div>
    </section>

    <!-- 5. VERIFIED FACTORY NODES (The Trust Grid) -->
    <section class="py-32 bg-navy-dark text-white relative">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/3" data-aos="fade-right">
                    <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">Module :: 04</span>
                    <h2 class="text-4xl font-bold font-heading mb-8 uppercase tracking-tighter">The Trust <br> Network.</h2>
                    <p class="text-white/40 mb-10">
                        Every manufacturer on our grid is multi-factor verified. We don't just check websites; we check machine capacity, labor compliance, and bank reputation.
                    </p>
                </div>
                <!-- Interactive Grid -->
                <div class="lg:w-2/3 grid grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-left">
                     @for($i=1; $i<=8; $i++)
                     <div class="aspect-square bg-white/5 border border-white/10 rounded-3xl p-6 flex flex-col justify-between hover:bg-white/10 hover:border-amber-brand/40 transition-all cursor-crosshair group">
                         <div class="w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center">
                             <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L9.03 1.703c.628-.292 1.319-.292 1.947 0L17.835 4.9c.433.201.7 6.002.7 6.1s-.267 5.9-6.368 7.3a1.94 1.94 0 01-1.934 0C5.167 16.9 3.9 11.1 3.9 11s-.267-5.9.7-6.1zM10.5 8.5V6.7l-3.3 1.5v2.8h3.3v-2.5zm1.5-1.5v2.5h3.3V7.7l-3.3-1.5z" clip-rule="evenodd"></path></svg>
                         </div>
                         <div>
                             <p class="text-[8px] font-bold text-white/30 tracking-widest uppercase mb-1">Node ID: CN-GZ-{{ rand(1000,9999) }}</p>
                             <p class="text-[10px] font-bold text-white uppercase group-hover:text-amber-brand transition-colors">Factory Audited</p>
                         </div>
                     </div>
                     @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- 6. CUSTOMS AUTOMATION (The Digital Broker) -->
    <section class="py-32 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center mb-20" data-aos="fade-up">
                 <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">Module :: 05</span>
                 <h2 class="text-4xl md:text-5xl font-bold font-heading text-navy-dark mb-8">Code-Driven Compliance.</h2>
                 <p class="text-slate-600 text-lg">
                    Human brokers are slow. Our Customs Engine automatically categorizes goods using HS-Code intelligence, calculates duties in real-time, and files digital declarations across 220+ jurisdictions.
                 </p>
            </div>
            
            <div class="relative max-w-5xl mx-auto" data-aos="zoom-in">
                 <div class="absolute inset-0 bg-blue-600 rounded-[3rem] blur-[150px] opacity-10"></div>
                 <div class="bg-navy-dark rounded-[3.5rem] p-12 lg:p-20 text-white relative z-10 overflow-hidden">
                     <div class="flex flex-col lg:flex-row items-center gap-12">
                         <div class="lg:w-1/2">
                             <div class="h-12 w-12 bg-white/10 rounded-2xl flex items-center justify-center mb-8">
                                 <svg class="w-6 h-6 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                             </div>
                             <h3 class="text-3xl font-bold mb-6 italic tracking-tighter">Zero-Manual Clearance.</h3>
                             <p class="text-white/50 text-sm leading-relaxed mb-8">
                                 From T1 documentation to EUR1 certifications, we automate the paperwork that usually stops trade.
                             </p>
                             <div class="flex gap-4">
                                 <span class="px-4 py-2 bg-white/5 rounded-xl border border-white/5 text-[9px] font-bold uppercase tracking-widest">HS-Classification</span>
                                 <span class="px-4 py-2 bg-white/5 rounded-xl border border-white/5 text-[9px] font-bold uppercase tracking-widest">VAT Auto-Reclaim</span>
                             </div>
                         </div>
                         <div class="lg:w-1/2 bg-white/5 p-10 rounded-[2.5rem] border border-white/10 font-mono">
                             <div class="text-emerald-500 mb-4 animate-pulse-slow font-bold text-xs uppercase">&gt; INITIALIZING_COMPLIANCE_PROTOCOL</div>
                             <div class="text-[10px] text-white/40 space-y-1">
                                 <div>[AUTH] :: Verified User ID #892</div>
                                 <div>[SCAN] :: Cargo Manifest (GZ-Hub)</div>
                                 <div>[RUN] :: Duty Analysis (NIGERIA/CET)</div>
                                 <div>[CALC] :: Total Tax Liability: $ 1,452.12</div>
                                 <div class="text-white mt-4">[SUCCESS] :: Clearance Granted</div>
                             </div>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- 7. VIRTUAL WAREHOUSING (The Proxy Office) -->
    <section class="py-32 bg-navy relative border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                     <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">Module :: 06</span>
                     <h2 class="text-4xl md:text-5xl font-bold font-heading text-white mb-8">Virtual HQ. <br>Local Presence.</h2>
                     <p class="text-white/50 text-lg mb-10 leading-relaxed">
                        Control your goods remotely with our high-res virtual warehouse interface. Inspect products via HD video, manage inventory across continents, and trigger shipments with a tap.
                     </p>
                     
                     <div class="space-y-6">
                         <div class="flex items-start gap-4">
                             <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0">
                                 <svg class="w-5 h-5 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                             </div>
                             <div>
                                 <h4 class="text-white font-bold text-sm mb-1 uppercase tracking-tight">Free 30-Day Staging</h4>
                                 <p class="text-xs text-white/30">Store at any of our global hubs for zero cost for the first month.</p>
                             </div>
                         </div>
                         <div class="flex items-start gap-4">
                             <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0">
                                 <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                             </div>
                             <div>
                                 <h4 class="text-white font-bold text-sm mb-1 uppercase tracking-tight">HD Inspection Streams</h4>
                                 <p class="text-xs text-white/30">We unbox and stream the inspection so you see what you're buying.</p>
                             </div>
                         </div>
                     </div>
                </div>
                <!-- Visual Hub Map -->
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="relative bg-white/5 rounded-[4rem] p-12 border border-white/5 overflow-hidden">
                         <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-10 grayscale hover:grayscale-0 transition-all duration-1000">
                         <div class="relative z-10">
                              <div class="flex justify-between items-center mb-12">
                                  <h4 class="text-2xl font-bold text-white tracking-tighter uppercase italic">Inventory Pulse</h4>
                                  <div class="h-8 w-8 bg-emerald-500 rounded-full animate-ping-slow"></div>
                              </div>
                              <div class="space-y-4">
                                  <div class="bg-navy-dark/90 p-4 rounded-2xl border border-white/10 flex items-center justify-between">
                                      <span class="text-xs text-white/60">Node: GUANGZHOU</span>
                                      <span class="text-xs text-white font-bold">816 Units Staged</span>
                                  </div>
                                  <div class="bg-navy-dark/90 p-4 rounded-2xl border border-white/10 flex items-center justify-between">
                                      <span class="text-xs text-white/60">Node: DUBAI</span>
                                      <span class="text-xs text-white font-bold">12 Packages In-Transit</span>
                                  </div>
                                  <div class="bg-navy-dark/90 p-4 rounded-2xl border border-white/10 flex items-center justify-between">
                                      <span class="text-xs text-white/60">Node: LAGOS</span>
                                      <span class="text-xs text-emerald-400 font-bold font-mono">DELIVERED</span>
                                  </div>
                              </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. THE TRADE API (Infrastructure for Developers) -->
    <section class="py-32 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                     <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">Module :: 07</span>
                     <h2 class="text-4xl lg:text-5xl font-bold font-heading text-navy-dark mb-8">Build on Logic. <br>The Logistics Stack.</h2>
                     <p class="text-slate-600 text-lg mb-10 leading-relaxed">
                        Don't build your own shipping infra. Integrate ours. Our RESTful APIs allow any platform to embed global sourcing, payments, and delivery tracking directly into their own UI.
                     </p>
                     <div class="flex gap-4">
                         <a href="#" class="px-8 py-4 bg-navy-dark text-white rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-brand hover:text-navy-dark transition-all">API Docs</a>
                         <a href="#" class="px-8 py-4 bg-slate-100 text-navy-dark rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-slate-200 transition-all">Developer Portal</a>
                     </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-3xl text-blue-400 font-mono text-[11px] leading-relaxed border border-slate-800">
```javascript
const globalline = require('@globalline-trade/sdk');

// Initialize Sourcing Intelligence
const agent = new globalline.SourcingAgent({
  node: 'CN_SOUTH',
  apiKey: process.env.GL_KEY
});

// Deploy Search Sequence
agent.findManufacturer({
  product: 'Custom PCBA',
  auditLevel: 'PREMIUM',
  targetUnitCost: 15.00
}).then(results => {
  console.log('Nodes Synchronized:', results.length);
});
```
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="py-40 bg-navy-dark relative overflow-hidden text-center">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-1/2 left-1/2 w-[1200px] h-[1200px] bg-amber-brand/5 rounded-full blur-[200px] -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl md:text-7xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up">Ready to initiate?</h2>
            <p class="text-xl text-white/40 mb-12 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">Join the thousands of modern enterprises running their global trade on the Engine.</p>
            <div class="flex justify-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('register') }}" class="px-12 py-6 bg-amber-brand text-navy-dark rounded-[2rem] font-bold uppercase tracking-widest text-xs hover:bg-amber-light transition-all shadow-3xl hover:shadow-amber-brand/40">
                    Settle Account
                </a>
            </div>
        </div>
    </section>

</main>
@endsection

<style>
    @keyframes expand {
        0% { width: 0%; }
        100% { width: 80%; }
    }
    .animate-expand {
        animation: expand 3s cubic-bezier(0.65, 0, 0.35, 1) forwards;
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-ping-slow {
        animation: ping 3s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-30px); }
    }
    .animate-pulse-slow {
        animation: pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    .shadow-3xl {
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.3);
    }
</style>
