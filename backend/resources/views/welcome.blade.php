@extends('layouts.public')

@section('title', 'GlobalLine | The Operating System for Global Trade')

@section('content')

    <!-- HERO SECTION (Updated Copy) -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden bg-navy-dark selection:bg-amber-brand selection:text-navy-dark">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-navy/90 via-navy/80 to-navy-dark z-10"></div>
            <!-- High-quality abstract network background -->
            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay animate-pulse-slow" 
                 alt="Global Logistic Network">
            
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-amber-brand/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20 py-20">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                 <div class="lg:w-7/12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md mb-8">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-[10px] font-bold text-white/80 uppercase tracking-widest">Global Network: Online</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-bold font-heading text-white leading-[0.9] mb-8 tracking-tighter">
                        Logistics. <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light">Re-Engineered.</span>
                    </h1>
                    
                    <p class="text-lg text-white/60 font-medium mb-10 max-w-xl leading-relaxed">
                        A complete infrastructure for modern trade. Sourcing, payments, consolidation, and shipping—all in one unified operating system.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                         <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-8 py-4 bg-amber-brand hover:bg-amber-light text-navy-dark rounded-xl font-bold uppercase tracking-widest text-xs transition-all hover:shadow-[0_0_30px_rgba(245,158,11,0.3)] hover:-translate-y-1">
                            Start Shipping
                        </a>
                        <a href="{{ route('marketplace.index') }}" class="inline-flex justify-center items-center px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/10 text-white rounded-xl font-bold uppercase tracking-widest text-xs transition-all">
                            Browse Sourcing
                        </a>
                    </div>

                    <div class="flex items-center gap-8 opacity-60">
                         <div class="flex -space-x-4">
                            <div class="w-10 h-10 rounded-full border-2 border-navy overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=64&h=64" class="w-full h-full object-cover">
                            </div>
                            <div class="w-10 h-10 rounded-full border-2 border-navy overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=64&h=64" class="w-full h-full object-cover">
                            </div>
                            <div class="w-10 h-10 rounded-full border-2 border-navy overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=64&h=64" class="w-full h-full object-cover">
                            </div>
                            <div class="w-10 h-10 rounded-full border-2 border-navy bg-navy-light flex items-center justify-center text-[10px] font-bold text-white">
                                +15k
                            </div>
                         </div>
                         <div class="text-sm text-white/60">
                             Trusted by <span class="text-white font-bold">15,000+</span> businesses.
                         </div>
                    </div>
                </div>

                <!-- 3D Globe / Network Viz placeholder -->
                 <div class="lg:w-5/12 relative hidden lg:block" data-aos="zoom-in" data-aos-duration="1200">
                     <div class="w-full aspect-square relative">
                        <div class="absolute inset-0 bg-blue-500/20 rounded-full blur-[100px]"></div>
                        <img src="https://images.unsplash.com/photo-1614728853911-54b09af08a46?q=80&w=2070&auto=format&fit=crop" 
                             class="relative z-10 w-full h-full object-contain rounded-full shadow-2xl border border-white/10 grayscale hover:grayscale-0 transition-all duration-1000 rotate-12 hover:rotate-0" 
                             alt="Global Connect">
                         
                         <!-- Floating Card -->
                         <div class="absolute bottom-10 -left-10 z-20 bg-white/10 backdrop-blur-xl border border-white/10 p-6 rounded-2xl animate-float">
                             <div class="flex items-center gap-4 mb-2">
                                 <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                                 <span class="text-xs font-bold text-white uppercase tracking-wider">System Status</span>
                             </div>
                             <div class="font-mono text-amber-brand text-lg">ALL SYSTEMS OPERATIONAL</div>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- SECTION 1: GLOBAL LOGISTICS INFRASTRUCTURE -->
    <section class="py-24 bg-navy text-white border-t border-white/5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
        <div class="container mx-auto px-6">
            <div class="mb-16 text-center">
                 <span class="text-amber-brand font-bold uppercase tracking-widest text-xs mb-4 block">Infrastructure</span>
                <h2 class="text-4xl md:text-5xl font-bold font-heading mb-6">Borderless Logistics.</h2>
                <p class="text-white/50 max-w-2xl mx-auto text-lg">
                    We've dismantled the barriers of traditional trade. Our integrated network spans 220 countries, creating a seamless pipeline for your goods.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group bg-white/5 border border-white/10 p-8 rounded-[2rem] hover:bg-white/10 transition-colors" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">220+ Countries</h3>
                    <p class="text-white/50 text-sm leading-relaxed">From major hubs to remote destinations, our network ensures your reach is truly global.</p>
                </div>
                 <!-- Card 2 -->
                <div class="group bg-white/5 border border-white/10 p-8 rounded-[2rem] hover:bg-white/10 transition-colors" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-brand to-amber-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Express Speed</h3>
                    <p class="text-white/50 text-sm leading-relaxed">Optimized routing algorithms cut transit times by up to 40% compared to traditional freight.</p>
                </div>
                 <!-- Card 3 -->
                <div class="group bg-white/5 border border-white/10 p-8 rounded-[2rem] hover:bg-white/10 transition-colors" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-600 to-emerald-400 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Customs cleared</h3>
                    <p class="text-white/50 text-sm leading-relaxed">We handle the paperwork. Duties, taxes, and compliance are managed automatically.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: SEAMLESS PAYMENTS -->
    <section class="py-24 bg-white text-navy-dark overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/2" data-aos="fade-right">
                    <span class="text-amber-brand font-bold uppercase tracking-widest text-xs mb-4 block">Financial Infrastructure</span>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading mb-6">Frictionless <br> Supplier Payments.</h2>
                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        Pay global suppliers in their local currency (RMB, USD, EUR) instantly without setting up foreign accounts. We handle the exchange, the transfer, and the verification.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-4 font-bold">
                            <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs">✓</span>
                            Instant RMB/USD Transfers
                        </li>
                        <li class="flex items-center gap-4 font-bold">
                            <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs">✓</span>
                            Zero Hidden Exchange Fees
                        </li>
                        <li class="flex items-center gap-4 font-bold">
                            <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs">✓</span>
                            Verified Supplier Checks
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="text-navy-dark font-bold underline decoration-amber-brand decoration-2 hover:text-amber-brand transition-colors">Start Conveying Funds &rarr;</a>
                </div>
                <!-- Visual -->
                <div class="md:w-1/2 relative" data-aos="fade-left">
                    <div class="relative bg-navy-dark rounded-[3rem] p-8 shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500">
                         <div class="absolute inset-0 bg-gradient-to-br from-navy-light/50 to-navy-dark rounded-[3rem]"></div>
                         <div class="relative z-10 text-white">
                             <div class="flex justify-between items-center mb-8">
                                 <div class="flex items-center gap-3">
                                     <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                     </div>
                                     <div>
                                         <p class="text-xs text-white/50 uppercase tracking-wider">Transaction</p>
                                         <p class="font-bold">Supplier Payment</p>
                                     </div>
                                 </div>
                                 <div class="text-right">
                                     <p class="text-xs text-white/50 uppercase tracking-wider">Status</p>
                                     <p class="text-emerald-400 font-bold">Completed</p>
                                 </div>
                             </div>
                             <div class="text-4xl font-mono font-bold text-white mb-2">¥ 45,000.00</div>
                             <div class="text-sm text-white/50 mb-8">≈ $6,234.50 USD</div>
                             
                             <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                                 <div class="h-full w-full bg-emerald-500"></div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: SOURCING (Bento Grid) -->
    <section class="py-24 bg-slate-50 relative">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                 <span class="text-amber-brand font-bold uppercase tracking-widest text-xs mb-4 block">Direct Access</span>
                 <h2 class="text-4xl md:text-5xl font-bold font-heading text-navy-dark mb-4">Factory Direct. <br> No Middlemen.</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Box 1 -->
                <div class="md:col-span-2 bg-white rounded-[2.5rem] p-10 shadow-lg hover:shadow-xl transition-shadow border border-slate-100 group" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                        <div>
                            <div class="w-12 h-12 bg-amber-brand/10 text-amber-brand rounded-xl mb-6 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-navy-dark mb-4">Verified Manufacturers</h3>
                            <p class="text-slate-600 max-w-md">We physically inspect factories to ensure quality, capacity, and ethical standards before you place an order. No more gambling on quality.</p>
                        </div>
                        <div class="bg-emerald-50 text-emerald-600 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider self-start">Audit Passed</div>
                    </div>
                </div>

                <!-- Box 2 -->
                <div class="bg-navy-dark rounded-[2.5rem] p-10 shadow-lg text-white" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-2xl font-bold mb-4 text-amber-brand">We Negotiate</h3>
                    <p class="text-white/60 mb-6 text-sm">Our local teams speak the language to get you the best price, often cutting 15-20% off quoted rates.</p>
                    <div class="text-4xl font-bold text-white">-20% <span class="text-sm font-normal text-white/40">Avg. Savings</span></div>
                </div>
                
                <!-- Box 3 -->
                <div class="bg-white rounded-[2.5rem] p-10 shadow-lg border border-slate-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl mb-6 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy-dark mb-2">Sample Consolidation</h3>
                    <p class="text-slate-500 text-sm">Get samples from 5 factories sent in 1 single box to save on shipping.</p>
                </div>

                <!-- Box 4 -->
                <div class="md:col-span-2 bg-gradient-to-r from-navy to-navy-dark rounded-[2.5rem] p-10 shadow-lg text-white flex items-center justify-between group cursor-pointer hover:shadow-2xl transition-all" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Private Label (OEM/ODM)</h3>
                        <p class="text-white/60">Create your own brand. Custom packaging and product design.</p>
                    </div>
                     <div class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-navy-dark transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('marketplace.index') }}" class="inline-block bg-navy-dark text-white px-10 py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-brand hover:text-navy-dark transition-all shadow-xl">Start Procurement</a>
            </div>
        </div>
    </section>

    <!-- SECTION 4: SMART WAREHOUSING -->
    <section class="py-24 bg-white border-t border-slate-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-16">
                <div class="lg:w-1/3" data-aos="fade-right">
                    <span class="text-amber-brand font-bold uppercase tracking-widest text-xs mb-4 block">Storage Solutions</span>
                    <h2 class="text-4xl font-bold font-heading text-navy-dark mb-6">Your Virtual <br> Warehouse.</h2>
                    <p class="text-slate-600 mb-8 leading-relaxed">
                        Store goods in our global hubs for free up to 30 days. Consolidate shipments to reduce volumetric weight and shipping costs by up to 40%.
                    </p>
                    <a href="#" class="text-navy-dark font-bold uppercase tracking-widest text-xs border-b-2 border-amber-brand pb-1 hover:text-amber-brand transition-colors">See Locations</a>
                </div>
                <div class="lg:w-2/3" data-aos="fade-left">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <!-- Hub 1 -->
                        <div class="bg-slate-50 rounded-3xl p-6 text-center hover:bg-white hover:shadow-xl transition-all border border-slate-100 group">
                            <h4 class="text-2xl font-bold text-navy-dark mb-1 group-hover:text-amber-brand">CN</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Guangzhou</p>
                        </div>
                        <!-- Hub 2 -->
                        <div class="bg-slate-50 rounded-3xl p-6 text-center hover:bg-white hover:shadow-xl transition-all border border-slate-100 group">
                            <h4 class="text-2xl font-bold text-navy-dark mb-1 group-hover:text-amber-brand">AE</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Dubai</p>
                        </div>
                        <!-- Hub 3 -->
                        <div class="bg-slate-50 rounded-3xl p-6 text-center hover:bg-white hover:shadow-xl transition-all border border-slate-100 group">
                            <h4 class="text-2xl font-bold text-navy-dark mb-1 group-hover:text-amber-brand">US</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">New York</p>
                        </div>
                        <!-- Hub 4 -->
                        <div class="bg-slate-50 rounded-3xl p-6 text-center hover:bg-white hover:shadow-xl transition-all border border-slate-100 group">
                            <h4 class="text-2xl font-bold text-navy-dark mb-1 group-hover:text-amber-brand">NG</h4>
                            <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Lagos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: E-COMMERCE -->
    <section class="py-24 bg-navy text-white">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-r from-blue-900/40 to-navy-dark rounded-[3rem] p-12 relative overflow-hidden text-center border border-white/10 shadow-2xl">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1556742111-a301076d9d18?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
                
                <div class="relative z-10 max-w-3xl mx-auto py-10">
                    <span class="text-amber-brand font-bold uppercase tracking-widest text-xs mb-6 block">For Sellers</span>
                    <h2 class="text-4xl md:text-6xl font-bold font-heading mb-8">Connect Your Store. <br> We Handle the Rest.</h2>
                    <p class="text-white/60 mb-12 text-xl leading-relaxed">
                        Orders sync automatically. We pick, pack, and ship from the nearest warehouse directly to your customer.
                    </p>
                    
                    <div class="flex justify-center flex-wrap gap-4 mb-12">
                         <div class="bg-white/10 px-6 py-3 rounded-xl font-bold text-sm">Shopify</div>
                         <div class="bg-white/10 px-6 py-3 rounded-xl font-bold text-sm">WooCommerce</div>
                         <div class="bg-white/10 px-6 py-3 rounded-xl font-bold text-sm">Wix</div>
                         <div class="bg-white/10 px-6 py-3 rounded-xl font-bold text-sm">Magento</div>
                    </div>

                    <a href="{{ route('register') }}" class="bg-white text-navy-dark px-10 py-5 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-brand transition-colors">
                        Integrate Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6, 7, 8: FEATURES GRID -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- 6. Real-time Tracking -->
                <div class="p-10 rounded-[2.5rem] border border-slate-200 bg-slate-50 hover:bg-white hover:shadow-xl transition-all" data-aos="fade-up">
                    <div class="mb-8 w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-dark mb-4">Control Tower</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Real-time GPS tracking for every container and parcel. Know exactly where your goods are.</p>
                </div>

                <!-- 7. Insurance -->
                <div class="p-10 rounded-[2.5rem] border border-slate-200 bg-slate-50 hover:bg-white hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="100">
                     <div class="mb-8 w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-dark mb-4">100% Insured</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Comprehensive coverage. If it's lost or damaged, we refund the full value instantly. Peace of mind included.</p>
                </div>

                <!-- 8. Industry Solutions -->
                <div class="p-10 rounded-[2.5rem] border border-slate-200 bg-slate-50 hover:bg-white hover:shadow-xl transition-all" data-aos="fade-up" data-aos-delay="200">
                     <div class="mb-8 w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy-dark mb-4">Specialized Handling</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-[10px] font-bold uppercase text-slate-500">Medical</span>
                        <span class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-[10px] font-bold uppercase text-slate-500">Auto</span>
                        <span class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-[10px] font-bold uppercase text-slate-500">Electronics</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- APP CALL TO ACTION -->
    <section class="py-32 bg-navy-dark relative overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-1/2 left-1/2 w-[1000px] h-[1000px] bg-amber-brand/5 rounded-full blur-[150px] -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-6xl font-bold font-heading text-white mb-8">Ready to move your cargo?</h2>
                <p class="text-xl text-white/50 mb-12">Join 15,000+ businesses streamlining their global supply chain today.</p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                     <a href="{{ route('register') }}" class="flex items-center justify-center gap-3 bg-white text-navy-dark px-10 py-5 rounded-2xl font-bold hover:bg-slate-200 transition-colors transform hover:-translate-y-1">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"><path d="M17.061 11.22c-.063-2.583 2.115-3.854 2.208-3.905-1.2-1.761-3.076-2.002-3.739-2.025-1.579-.163-3.078.932-3.878.932-.803 0-2.096-.913-3.465-.892-1.78.026-3.431 1.036-4.349 2.637-1.857 3.218-.475 7.952 1.332 10.552.89 1.282 1.948 2.709 3.056 2.686 1.226-.051 1.693-.794 3.176-.794 1.481 0 1.903.794 3.197.771 1.32-.051 2.164-1.203 2.972-2.392.936-1.369 1.323-2.693 1.346-2.766-.026-.013-2.583-.989-2.659-3.926M14.986 5.253c.691-.836 1.157-1.996 1.026-3.153-1.002.041-2.217.658-2.936 1.498-.638.74-1.196 1.921-1.047 3.048 1.127.086 2.273-.559 2.957-1.393"/></svg>
                         <div class="text-left leading-tight">
                             <div class="text-[10px] uppercase font-bold tracking-wider text-navy-dark/60">Download on the</div>
                             <div class="text-lg font-bold">App Store</div>
                         </div>
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center gap-3 bg-white/10 text-white border border-white/10 px-10 py-5 rounded-2xl font-bold hover:bg-white/20 transition-colors transform hover:-translate-y-1">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm4.72 10.22l7.76-4.305-3.326-1.89-4.434 6.195zm4.814 1.353l-2.043-1.133L9.666 18.5 13.143 13.387zm1.385-2.067l4.137 2.296a1.001 1.001 0 010 1.754l-4.137 2.296L14.075 12 14.528 11.32z"/></svg>
                         <div class="text-left leading-tight">
                             <div class="text-[10px] uppercase font-bold tracking-wider text-white/60">Get it on</div>
                             <div class="text-lg font-bold">Google Play</div>
                         </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
