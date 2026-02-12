@extends('layouts.public')

@section('title', 'GlobalLine | The OS for Global Trade & Logistics')

@section('content')

    <!-- [SECTION 1] The Global Terminal : Hero -->
    <header class="relative min-h-[90vh] flex items-center pt-24 overflow-hidden bg-brand-navy selection:bg-brand-gold selection:text-brand-navy">
        <!-- Intelligent Particles/Grid Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:40px_40px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
            <!-- Electric Blue Accents -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/20 blur-[120px] rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-brand-gold/10 blur-[100px] rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-brand-navy via-brand-navy/95 to-[#050810]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 py-20">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-7/12" data-aos="fade-up">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full mb-8">
                        <span class="relative flex h-2 w-2 mr-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                        <p class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em]">GlobalLine Unified Protocol v5.2 Active</p>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-black text-white leading-[0.95] mb-8 tracking-tighter italic uppercase">
                        Source. Settle. <br>
                        <span class="text-brand-gold">Synchronize.</span>
                    </h1>
                    
                    <p class="text-lg md:text-xl text-white/50 font-medium mb-12 max-w-2xl leading-relaxed">
                        The ultimate terminal for high-velocity global trade. Direct factory pipelines from Guangzhou to Lagos, secured by the GlobalLine node network.
                    </p>

                    <!-- Unified Search Terminal (Enhanced) -->
                    <div class="max-w-2xl mb-12 relative group" data-aos="fade-up" data-aos-delay="200">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-500/30 to-brand-gold/30 rounded-[2.5rem] blur-xl opacity-20 group-hover:opacity-100 transition duration-1000"></div>
                        <form action="{{ route('marketplace.index') }}" method="GET" class="relative bg-[#0A142F]/80 backdrop-blur-2xl border border-white/10 rounded-[2rem] overflow-hidden focus-within:border-blue-500/50 transition-all shadow-3xl">
                            <div class="flex items-center">
                                <div class="pl-8 hidden md:flex gap-4 border-r border-white/5 pr-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-[8px] font-black text-white/40 uppercase tracking-widest">Market</span>
                                        <span class="text-[10px] font-black text-brand-gold italic">1688.com</span>
                                    </div>
                                </div>
                                <input type="text" name="query" 
                                       placeholder="Paste manufacturing link or search global nodes..." 
                                       class="w-full bg-transparent p-7 text-white focus:outline-none placeholder-white/20 font-bold text-sm tracking-tight text-center md:text-left">
                                <button type="submit" class="bg-blue-600 text-white px-10 py-7 font-black uppercase tracking-[0.2em] text-[10px] hover:bg-brand-gold hover:text-brand-navy transition-all italic border-none outline-none hidden md:block">
                                    Initiate Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-wrap items-center gap-8 opacity-40 grayscale group-hover:grayscale-0 transition-soft">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/42/Alibaba_Group_Logo.svg" class="h-6" alt="Alibaba">
                        <img src="https://logowik.com/content/uploads/images/taobao5968.jpg" class="h-8" alt="Taobao">
                        <img src="https://logowik.com/content/uploads/images/16886475.jpg" class="h-8" alt="1688">
                    </div>
                </div>

                <div class="lg:w-5/12 relative" data-aos="fade-left">
                    <div class="relative z-10 bg-gradient-to-br from-white/10 to-transparent p-1 rounded-[3rem] border border-white/20 backdrop-blur-xl shadow-4xl group">
                        <img src="https://images.unsplash.com/photo-1494412519320-aa613dfb7738?auto=format&fit=crop&w=800&q=80" 
                             class="rounded-[2.8rem] w-full mix-blend-lighten opacity-80 group-hover:opacity-100 transition-soft" alt="Global Supply Hub">
                        <div class="absolute -bottom-10 -left-10 bg-white/10 backdrop-blur-2xl p-8 rounded-[2.5rem] shadow-2xl border border-white/10">
                            <p class="text-brand-gold text-[10px] font-black uppercase tracking-widest mb-1 italic">Node Activity</p>
                            <span class="text-4xl font-black text-white tracking-tighter uppercase italic">99.8%</span>
                            <p class="text-white/40 text-[8px] font-bold uppercase mt-1">Uptime Synchronized</p>
                        </div>
                    </div>
                    <!-- Decorative Orbit -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[130%] h-[130%] border border-blue-500/10 rounded-full animate-[spin_30s_linear_infinite]"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[110%] h-[110%] border border-brand-gold/10 rounded-full animate-[spin_20s_linear_infinite_reverse]"></div>
                </div>
            </div>
        </div>
    </header>

    <!-- [SECTION 2] Global Sourcing Lanes : Logistics Ticker -->
    <section class="py-12 bg-black border-y border-white/5 whitespace-nowrap overflow-hidden">
        <div class="flex animate-[slide_40s_linear_infinite] gap-12 items-center">
            @for($i = 0; $i < 5; $i++)
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em]">Lane_042</span>
                <span class="text-xs font-black text-white uppercase italic">Guangzhou &rarr; Lagos</span>
                <span class="text-[10px] font-black text-brand-gold">Express Air: 3-5 Days</span>
            </div>
            <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em]">Lane_118</span>
                <span class="text-xs font-black text-white uppercase italic">Shanghai &rarr; Nairobi</span>
                <span class="text-[10px] font-black text-brand-gold">Sea Freight: 22 Days</span>
            </div>
            <div class="w-1.5 h-1.5 rounded-full bg-white/10"></div>
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em]">Lane_009</span>
                <span class="text-xs font-black text-white uppercase italic">Istanbul &rarr; Accra</span>
                <span class="text-[10px] font-black text-brand-gold">Economy Air: 7 Days</span>
            </div>
            <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
            @endfor
        </div>
    </section>

    <style>
        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>

    <!-- [SECTION 3] The Everything Movement : Multi-tier Stats -->
    <section class="py-24 bg-[#050810] selection:bg-blue-600">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="relative group" data-aos="fade-up" data-aos-delay="0">
                    <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.4em] mb-4">Intra-City Delivery</p>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-4xl font-bold text-white group-hover:text-brand-gold transition-colors tracking-tighter">0-24hr</span>
                        <div class="w-8 h-[2px] bg-brand-gold"></div>
                    </div>
                </div>
                <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.4em] mb-4">Global Trade Nodes</p>
                    <span class="text-4xl font-bold text-white group-hover:text-brand-gold transition-colors tracking-tighter">4,800+</span>
                </div>
                <div class="relative group" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.4em] mb-4">Capital Protected</p>
                    <span class="text-4xl font-bold text-white group-hover:text-brand-gold transition-colors tracking-tighter">$2.4M</span>
                </div>
                <div class="relative group" data-aos="fade-up" data-aos-delay="300">
                    <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.4em] mb-4">API Settlement</p>
                    <span class="text-4xl font-bold text-brand-gold tracking-tighter">Instant</span>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 3] MasterMerge : Volumetric Optimization -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-[11px] font-bold text-brand-gold uppercase tracking-[0.4em] mb-6 inline-block">The Logistics Solution</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-brand-navy leading-tight tracking-tight mb-8">
                        Stop Shipping Air. <br>Start <span class="bg-brand-navy text-white px-4">MasterMerge.</span>
                    </h2>
                    <p class="text-slate-500 text-lg leading-relaxed mb-10 max-w-xl">
                        Small orders from multiple factories shouldn't cost a fortune. We consolidate your multi-vendor goods into high-density containers, reducing volumetric weight costs by up to 45%.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-brand-navy font-bold">Automatic Vendor Sync & Consolidation</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-brand-navy font-bold">Zero-Commission Sourcing Guarantee</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80" 
                             class="rounded-[3rem] shadow-2xl border border-slate-100" alt="Consolidation Hub">
                        <div class="absolute -top-10 -right-10 bg-brand-navy p-10 rounded-[2.5rem] shadow-2xl border border-white/10 hidden md:block">
                            <p class="text-white/40 text-[10px] uppercase font-bold tracking-widest mb-4">MasterMerge Metrics</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-bold text-white tracking-tighter">45%</span>
                                <span class="text-brand-gold text-xs font-bold">Cost Saved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 4] The Global Network Domain -->
    <section class="py-32 bg-slate-50 border-y border-slate-200 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="inline-flex items-center px-4 py-2 bg-brand-navy/5 border border-brand-navy/10 rounded-full mb-8">
                        <p class="text-[10px] font-bold text-brand-navy uppercase tracking-[0.2em]">Global Trade Logistics OS</p>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-brand-navy leading-tight mb-8">
                        The Frontier is <span class="text-brand-gold italic">Everywhere.</span>
                    </h2>
                    <p class="text-slate-500 text-lg leading-relaxed mb-10">
                        Sourcing isn't just an API call. It's about a physical, verified global presence. From our high-density consolidation nodes to your warehouse, we provide 100% visibility across all trade corridors.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-2xl font-bold text-brand-navy tracking-tighter">Active Corridor</p>
                            <p class="text-slate-400 text-xs uppercase font-bold tracking-widest mt-1">Movement Tracking</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-brand-navy tracking-tighter">Verified Node</p>
                            <p class="text-slate-400 text-xs uppercase font-bold tracking-widest mt-1">Physical Presence</p>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 relative" data-aos="zoom-in">
                    <!-- Globe / Network Visual -->
                    <div class="relative z-10 bg-brand-navy rounded-[4rem] p-4 shadow-4xl aspect-square flex items-center justify-center overflow-hidden group">
                        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1200&q=80" 
                             class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-110 transition-transform duration-[5s]" alt="Global Movement Globe">
                        <div class="relative z-10 text-center p-12">
                            <div class="w-20 h-20 border-2 border-brand-gold rounded-full mx-auto mb-8 flex items-center justify-center animate-pulse">
                                <div class="w-3 h-3 bg-brand-gold rounded-full"></div>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">Unified Global Grid</h3>
                            <p class="text-white/40 text-sm font-medium">Real-time movement of goods across 12,000+ logistics pathways.</p>
                        </div>
                        <!-- Decorative Scanning Line -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-gold/50 to-transparent animate-[scan_3s_linear_infinite]"></div>
                    </div>
                    <style>
                        @keyframes scan {
                            0% { top: 0; }
                            100% { top: 100%; }
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 5] The Capital Bridge : Payments -->
    <section class="py-40 bg-brand-navy relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-[11px] font-bold text-brand-gold uppercase tracking-[0.4em] mb-8 inline-block">The Settlement Solution</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-8">
                        Pay Local. <br>Settle <span class="text-brand-gold italic">Globally.</span>
                    </h2>
                    <p class="text-white/40 text-lg leading-relaxed mb-12 max-w-xl">
                        Designated for the African entrepreneur. Convert your Naira or local currency to factory-direct payments in USD, CNY, or TRY instantly. No black market hassles.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('register') }}" class="bg-brand-gold text-brand-navy px-12 py-5 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-white transition-all shadow-xl shadow-brand-gold/10">
                            Start Sourcing Now
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 relative" data-aos="fade-left">
                    <div class="bg-white/5 p-12 rounded-[4rem] border border-white/10 backdrop-blur-xl">
                        <div class="flex justify-between items-center mb-10">
                            <div class="flex flex-col gap-1">
                                <p class="text-[10px] text-white/30 uppercase font-bold tracking-widest">GlobalLine Ledger</p>
                                <p class="text-white font-bold">Sourcing Terminal #042</p>
                            </div>
                            <div class="w-12 h-12 bg-brand-gold rounded-full flex items-center justify-center font-bold text-brand-navy">NGN</div>
                        </div>
                        <div class="space-y-4 mb-10">
                            <div class="h-px bg-white/5"></div>
                            <div class="flex justify-between items-center">
                                <span class="text-white/60 text-sm font-medium">Payment to Manufacturer [GZ-48]</span>
                                <span class="text-brand-gold font-bold">Confirmed</span>
                            </div>
                            <div class="h-px bg-white/5"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="text-white/20 text-[8px] uppercase tracking-[0.2em] mb-4">Currency Conversion Stream</p>
                            <div class="flex gap-4">
                                <div class="px-5 py-2 bg-white/10 rounded-xl text-white text-xs font-bold">TRY</div>
                                <div class="px-5 py-2 bg-white/10 rounded-xl text-white text-xs font-bold">USD</div>
                                <div class="px-5 py-2 bg-brand-gold/20 text-brand-gold rounded-xl text-xs font-bold">CNY</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 6] The SaaS Preview : Smart Terminal -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-24" data-aos="fade-up">
                <span class="text-[11px] font-bold text-brand-gold uppercase tracking-[0.4em] mb-6 inline-block">The Control Center</span>
                <h2 class="text-4xl md:text-5xl font-bold text-brand-navy leading-tight tracking-tight">Your Supply Chain, Unified.</h2>
            </div>
            
            <div class="relative max-w-6xl mx-auto" data-aos="zoom-in-up">
                <div class="absolute -inset-10 bg-brand-navy/5 blur-[120px] rounded-full"></div>
                <div class="relative bg-white rounded-[4rem] shadow-4xl border border-slate-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2400&q=80" 
                         class="w-full opacity-60" alt="Dashboard Preview">
                    <div class="absolute inset-0 bg-gradient-to-t from-white via-white/40 to-transparent"></div>
                    <div class="absolute bottom-20 left-1/2 -translate-x-1/2 text-center w-full">
                        <a href="{{ route('register') }}" class="inline-block bg-brand-navy text-white px-14 py-6 rounded-2xl font-bold uppercase tracking-widest text-[11px] shadow-2xl hover:scale-105 transition-transform">
                            Enter The Terminal &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 7] The Pan-African Protocol -->
    <section class="py-40 bg-slate-50 border-y border-slate-200 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div data-aos="fade-right">
                    <span class="text-[11px] font-bold text-brand-gold uppercase tracking-[0.4em] mb-8 inline-block">AfCFTA Integration</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-brand-navy leading-tight mb-8">Move Across <br>The Continent.</h2>
                    <p class="text-slate-500 text-lg leading-relaxed mb-10 italic font-medium">
                        Logistics doesn't stop at your country's borders. GlobalLine is built for the African continent. Move cargo from Nairobi to Lagos, or Accra to Cairo with the same protocol.
                    </p>
                    <div class="flex gap-4">
                        <span class="px-6 py-3 bg-brand-navy text-brand-gold rounded-full text-[10px] font-bold uppercase tracking-widest">Regional Settlement</span>
                        <span class="px-6 py-3 border border-brand-navy/10 text-brand-navy/60 rounded-full text-[10px] font-bold uppercase tracking-widest">AfCFTA Ready</span>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-154919438c-f4c635f199bc?auto=format&fit=crop&w=1200&q=80" class="rounded-[3rem] w-full" alt="Pan-African Trade">
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 8] OEM Enterprise : custom sourcing -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="p-16 md:p-24 rounded-[4rem] bg-brand-gold relative overflow-hidden group">
                <div class="relative z-10 max-w-xl">
                    <h2 class="text-4xl md:text-5xl font-bold text-brand-navy leading-none tracking-tighter mb-8 uppercase">Your Ideas, <br>Global Built.</h2>
                    <p class="text-brand-navy/70 text-lg mb-12">Looking for bespoke manufacturing or custom OEM branding? We bridge the gap between your engineering requirements and the factory floor.</p>
                    <a href="{{ route('contact') }}" class="inline-block bg-brand-navy text-white px-12 py-5 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-white hover:text-brand-navy transition-all">
                        Inquiry Enterprise
                    </a>
                </div>
                <div class="absolute top-0 right-0 h-full w-1/2 opacity-20 hidden lg:block group-hover:scale-105 transition-transform duration-1000">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover rounded-l-[4rem]" alt="OEM Industrial Manufacturing">
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 9] Frontier Protection : Insurance -->
    <section class="py-32 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <div data-aos="fade-up" data-aos-delay="0">
                    <div class="w-12 h-12 bg-brand-navy text-brand-gold rounded-2xl flex items-center justify-center mb-8 mx-auto md:mx-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-brand-navy uppercase mb-4">Total Assurance</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Automatic insurance on every cargo move. From factory gate to your doorstep, you are 100% protected.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-brand-navy text-brand-gold rounded-2xl flex items-center justify-center mb-8 mx-auto md:mx-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-brand-navy uppercase mb-4">Real-time Heartbeat</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">No black holes. Experience granular, real-time tracking of your assets as they move through local and global nodes.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-brand-navy text-brand-gold rounded-2xl flex items-center justify-center mb-8 mx-auto md:mx-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-brand-navy uppercase mb-4">Zero Hidden Costs</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">What you see is what you pay. Transparent rates at factory-tier pricing with no middleman margins.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 10] Final Terminal : App Download -->
    <section class="py-40 bg-brand-navy relative overflow-hidden">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-4xl mx-auto" data-aos="zoom-in">
                <h2 class="text-5xl md:text-7xl font-bold text-white tracking-tighter leading-none mb-10">
                    Movement, <br><span class="text-brand-gold">Globalized.</span>
                </h2>
                <p class="text-white/40 text-lg mb-16 max-w-2xl mx-auto">
                    Take the terminal everywhere you go. Download the GlobalLine app for real-time sourcing and tracking on the frontier.
                </p>
                
                <div class="flex flex-col md:flex-row items-center justify-center gap-6 mb-20">
                    <a href="{{ route('register') }}" class="w-full md:w-auto bg-brand-gold text-brand-navy px-12 py-5 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-white transition-all shadow-xl shadow-brand-gold/10">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="w-full md:w-auto bg-white/5 text-white border border-white/10 px-12 py-5 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-white/10 transition-all">
                        Login Terminal
                    </a>
                </div>

                <!-- Store Badge CTAs -->
                <div class="flex flex-col md:flex-row items-center justify-center gap-10 opacity-60">
                    <div class="flex items-center gap-10">
                        <a href="{{ route('register') }}" class="hover:opacity-100 transition-opacity">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" class="h-10" alt="App Store">
                        </a>
                        <a href="{{ route('register') }}" class="hover:opacity-100 transition-opacity">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" class="h-14" alt="Google Play">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Essential Modern Scripts -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>

    <style>
        .shadow-4xl { box-shadow: 0 50px 100px -20px rgba(0,0,0,0.25); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

@endsection
