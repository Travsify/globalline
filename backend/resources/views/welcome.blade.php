@extends('layouts.public')

@section('title', 'GlobalLine | Global Shipping & Freight Solutions')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden bg-navy-dark selection:bg-amber-brand selection:text-navy-dark">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-navy/90 via-navy/80 to-navy-dark z-10"></div>
            <!-- Background Image -->
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay animate-pulse-slow" 
                 alt="Global Logistics Network">
            
            <!-- Animated Custom Elements -->
             <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
             <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-amber-brand/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20 py-20">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Content -->
                <div class="lg:w-7/12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md mb-8">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-[10px] font-bold text-white/80 uppercase tracking-widest">Global Network: Online</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-bold font-heading text-white leading-[0.9] mb-8 tracking-tighter">
                        Move Goods. <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light">Beyond Borders.</span>
                    </h1>
                    
                    <p class="text-lg text-white/60 font-medium mb-10 max-w-xl leading-relaxed">
                        The operating system for modern global trade. Manufacturer-direct sourcing, freight forwarding, and customs clearance in one unified platform.
                    </p>

                    <!-- Search/Track Bar -->
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-2 rounded-2xl max-w-2xl mb-12 shadow-2xl relative group overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-brand/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <form action="{{ route('tracking') }}" method="GET" class="relative flex flex-col md:flex-row items-center gap-2">
                            <div class="flex-1 w-full relative">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-white/40">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text" name="tracking_number" placeholder="Enter tracking number or container ID..." 
                                       class="w-full bg-transparent border-none text-white placeholder-white/30 px-14 py-4 focus:ring-0 font-medium tracking-wide">
                            </div>
                            <button type="submit" class="w-full md:w-auto bg-amber-brand hover:bg-amber-light text-navy-dark px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-xs transition-all hover:scale-[1.02]">
                                Track Cargo
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-wrap items-center gap-8 opacity-60">
                        <span class="text-white/40 text-xs font-bold uppercase tracking-widest">Trusted Partners:</span>
                         <!-- Partner Logos Placeholder -->
                        <div class="flex gap-6 grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                            <!-- DHL-ish -->
                            <svg class="h-6 w-auto text-white" viewBox="0 0 100 30" fill="currentColor">
                                <path d="M10,5 L30,5 L25,25 L5,25 Z M35,5 L45,5 L40,25 L30,25 Z M50,5 L70,5 L65,10 L55,10 L52,25 L65,25 L60,30 L45,30 Z"/>
                            </svg>
                             <!-- Maersk-ish -->
                             <svg class="h-6 w-auto text-white" viewBox="0 0 100 30" fill="currentColor">
                                <path d="M10,15 L20,5 L30,15 L20,25 Z M40,5 L50,5 L50,25 L40,25 Z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Visual -->
                <div class="lg:w-5/12 relative hidden lg:block" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative z-10 w-full aspect-[4/5] rounded-[3rem] overflow-hidden border border-white/10 shadow-2xl group">
                         <div class="absolute inset-0 bg-gradient-to-b from-transparent to-navy/90 z-10"></div>
                         <img src="https://images.unsplash.com/photo-1566576912906-253c723f38aa?q=80&w=1974&auto=format&fit=crop" 
                              class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110" alt="Shipping Container">
                         
                         <!-- Floating Card -->
                         <div class="absolute bottom-10 left-10 right-10 z-20 bg-white/10 backdrop-blur-xl border border-white/10 p-6 rounded-2xl transform transition-transform group-hover:-translate-y-2">
                             <div class="flex justify-between items-start mb-4">
                                 <div>
                                     <p class="text-amber-brand text-[10px] font-bold uppercase tracking-widest mb-1">Live Shipment</p>
                                     <h3 class="text-white font-bold text-lg">Electronics Components</h3>
                                 </div>
                                 <div class="bg-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-[10px] font-bold uppercase">In Transit</div>
                             </div>
                             <div class="w-full bg-white/10 h-1 rounded-full overflow-hidden">
                                 <div class="bg-amber-brand w-2/3 h-full rounded-full"></div>
                             </div>
                             <div class="flex justify-between mt-2 text-[10px] font-medium text-white/50 uppercase">
                                 <span>Shanghai</span>
                                 <span>Lagos</span>
                             </div>
                         </div>
                    </div>
                    
                    <!-- Decorative Ring -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 border-[3px] border-white/5 rounded-full animate-spin-slow pointer-events-none"></div>
                </div>
            </div>
        </div>
        
        <!-- Scrolling Ticker -->
        <div class="absolute bottom-0 w-full py-4 bg-navy-dark border-t border-white/5 overflow-hidden flex whitespace-nowrap z-20">
            <div class="flex animate-slide items-center gap-12 text-white/30 text-[10px] font-bold uppercase tracking-[0.2em]">
                <span>Logistics OS v5.2</span>
                <span class="text-amber-brand/50">&bull;</span>
                <span>Active Nodes: 12,402</span>
                <span class="text-amber-brand/50">&bull;</span>
                <span>Real-time Tracking</span>
                <span class="text-amber-brand/50">&bull;</span>
                <span>Customs Clearance</span>
                <span class="text-amber-brand/50">&bull;</span>
                <span>Air Freight</span>
                <span class="text-amber-brand/50">&bull;</span>
                <span>Ocean Cargo</span>
                <span class="text-amber-brand/50">&bull;</span>
                <span>Last Mile Delivery</span>
                <!-- Duplicate for seamless loop -->
                <span class="text-amber-brand/50">&bull;</span>
                 <span>Logistics OS v5.2</span>
                <span class="text-amber-brand/50">&bull;</span>
                <span>Active Nodes: 12,402</span>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="py-24 bg-navy border-b border-white/5">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="group" data-aos="fade-up" data-aos-delay="0">
                    <p class="text-amber-brand text-[10px] font-bold uppercase tracking-widest mb-2">Global Reach</p>
                    <h3 class="text-4xl md:text-5xl font-bold text-white mb-2 group-hover:text-amber-brand transition-colors">220+</h3>
                    <p class="text-white/40 text-sm">Countries & Territories</p>
                </div>
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-amber-brand text-[10px] font-bold uppercase tracking-widest mb-2">Efficiency</p>
                    <h3 class="text-4xl md:text-5xl font-bold text-white mb-2 group-hover:text-amber-brand transition-colors">24h</h3>
                    <p class="text-white/40 text-sm">Clearance Time Average</p>
                </div>
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-amber-brand text-[10px] font-bold uppercase tracking-widest mb-2">Reliability</p>
                    <h3 class="text-4xl md:text-5xl font-bold text-white mb-2 group-hover:text-amber-brand transition-colors">99.9%</h3>
                    <p class="text-white/40 text-sm">Delivery Success Rate</p>
                </div>
                <div class="group" data-aos="fade-up" data-aos-delay="300">
                    <p class="text-amber-brand text-[10px] font-bold uppercase tracking-widest mb-2">Clients</p>
                    <h3 class="text-4xl md:text-5xl font-bold text-white mb-2 group-hover:text-amber-brand transition-colors">15k+</h3>
                    <p class="text-white/40 text-sm">Active Businesses</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 px-2" data-aos="fade-up">
                <div>
                     <span class="text-amber-brand font-bold uppercase tracking-widest text-xs mb-4 block">Our Capabilities</span>
                    <h2 class="text-4xl font-bold text-navy-dark leading-tight">Global Logistics <br>Infrastructure.</h2>
                </div>
                <a href="{{ url('/services') }}" class="hidden md:inline-flex items-center gap-2 text-navy-dark font-bold uppercase text-xs tracking-widest hover:text-amber-brand transition-colors group">
                    View All Services 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Air Freight -->
                <div class="group bg-white p-10 rounded-[2.5rem] shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-100 relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                         <svg class="w-32 h-32 text-navy-dark" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                    </div>
                    <div class="w-14 h-14 bg-navy-light/5 rounded-2xl flex items-center justify-center text-navy-dark mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy-dark mb-4 group-hover:text-amber-brand transition-colors">Air Freight Express</h3>
                    <p class="text-slate-500 leading-relaxed text-sm mb-8">Rapid global delivery for time-sensitive cargo. Door-to-door service with customs handling included.</p>
                    <a href="#" class="inline-flex items-center text-navy-dark font-bold text-xs uppercase tracking-wider hover:translate-x-2 transition-transform">
                        Learn More <span class="text-amber-brand ml-2">&rarr;</span>
                    </a>
                </div>

                <!-- Ocean Freight -->
                <div class="group bg-navy-dark p-10 rounded-[2.5rem] shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute inset-0 bg-gradient-to-br from-navy-light/50 to-navy-dark z-0"></div>
                     <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity z-10">
                         <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 21c-1.39 0-2.78-.47-4-1.32-2.44 1.71-5.56 1.71-8 0C6.78 20.53 5.39 21 4 21H2v2h2c1.38 0 2.74-.35 4-.99 2.52 1.29 5.48 1.29 8 0 1.26.65 2.62.99 4 .99h2v-2h-2zM3.95 19H4c1.6 0 3.02-.88 4-2 .98 1.12 2.4 2 4 2s3.02-.88 4-2c.98 1.12 2.4 2 4 2h.05l.02-1.91C19.03 17.18 18.06 17 17 17c-1.58 0-2.9 1.15-3.8 2.54-.36-.5-1.04-1.3-1.2-1.54l-1.95.89-.04-.01.07-.15c-1.11-2.22-3.41-3.73-6.08-3.73-2.6 0-4.88 1.44-6 3.56l1.95.53z"/></svg>
                    </div>
                    <div class="relative z-20">
                        <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-amber-brand mb-8 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Ocean Cargo</h3>
                        <p class="text-white/60 leading-relaxed text-sm mb-8">Cost-effective shipping for heavy volume. FCL and LCL options available with real-time tracking.</p>
                        <a href="#" class="inline-flex items-center text-white font-bold text-xs uppercase tracking-wider hover:translate-x-2 transition-transform">
                            Learn More <span class="text-amber-brand ml-2">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Sourcing -->
                <div class="group bg-white p-10 rounded-[2.5rem] shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-100 relative overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                         <svg class="w-32 h-32 text-navy-dark" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2V9h-2V7h8v12zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
                    </div>
                    <div class="w-14 h-14 bg-navy-light/5 rounded-2xl flex items-center justify-center text-navy-dark mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy-dark mb-4 group-hover:text-amber-brand transition-colors">Direct Sourcing</h3>
                    <p class="text-slate-500 leading-relaxed text-sm mb-8">Purchase directly from manufacturers in China, Turkey, and Vietnam. We handle the payments and logistics.</p>
                    <a href="#" class="inline-flex items-center text-navy-dark font-bold text-xs uppercase tracking-wider hover:translate-x-2 transition-transform">
                        Learn More <span class="text-amber-brand ml-2">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- PROMO / APP SECTION -->
    <section class="py-32 bg-navy-dark relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-amber-brand font-bold uppercase tracking-widest text-xs mb-6 block">Mobile First</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-white leading-none mb-8 tracking-tight">
                        Your Logistics Terminal, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light italic">In Your Pocket.</span>
                    </h2>
                    <p class="text-white/50 text-lg leading-relaxed mb-10">
                        Track shipments, pay suppliers, and manage your inventory from anywhere. The GlobalLine mobile app gives you complete control over your supply chain.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="flex items-center justify-center gap-3 bg-white text-navy-dark px-8 py-4 rounded-xl font-bold hover:bg-slate-200 transition-colors">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M17.061 11.22c-.063-2.583 2.115-3.854 2.208-3.905-1.2-1.761-3.076-2.002-3.739-2.025-1.579-.163-3.078.932-3.878.932-.803 0-2.096-.913-3.465-.892-1.78.026-3.431 1.036-4.349 2.637-1.857 3.218-.475 7.952 1.332 10.552.89 1.282 1.948 2.709 3.056 2.686 1.226-.051 1.693-.794 3.176-.794 1.481 0 1.903.794 3.197.771 1.32-.051 2.164-1.203 2.972-2.392.936-1.369 1.323-2.693 1.346-2.766-.026-.013-2.583-.989-2.659-3.926M14.986 5.253c.691-.836 1.157-1.996 1.026-3.153-1.002.041-2.217.658-2.936 1.498-.638.74-1.196 1.921-1.047 3.048 1.127.086 2.273-.559 2.957-1.393"/></svg>
                             <div class="text-left leading-tight">
                                 <div class="text-[10px] uppercase font-bold tracking-wider text-navy-dark/60">Download on the</div>
                                 <div class="text-sm font-bold">App Store</div>
                             </div>
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center gap-3 bg-white/10 text-white border border-white/10 px-8 py-4 rounded-xl font-bold hover:bg-white/20 transition-colors">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm4.72 10.22l7.76-4.305-3.326-1.89-4.434 6.195zm4.814 1.353l-2.043-1.133L9.666 18.5 13.143 13.387zm1.385-2.067l4.137 2.296a1.001 1.001 0 010 1.754l-4.137 2.296L14.075 12 14.528 11.32z"/></svg>
                             <div class="text-left leading-tight">
                                 <div class="text-[10px] uppercase font-bold tracking-wider text-white/60">Get it on</div>
                                 <div class="text-sm font-bold">Google Play</div>
                             </div>
                        </a>
                    </div>
                </div>
                
                <div class="lg:w-1/2 relative">
                    <!-- Phone Mockup (Abstract) -->
                    <div class="relative z-10 mx-auto w-[300px] h-[600px] bg-navy border-8 border-navy-light rounded-[3rem] shadow-4xl overflow-hidden" data-aos="zoom-in-up">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?q=80&w=1887&auto=format&fit=crop" class="w-full h-full object-cover opacity-80" alt="App Screen">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy to-transparent"></div>
                        <div class="absolute bottom-10 left-0 w-full text-center p-6">
                            <p class="text-white font-bold text-xl mb-2">Track in Real-time</p>
                            <p class="text-white/50 text-xs">Get push notifications for every movement.</p>
                        </div>
                    </div>
                    <!-- Background Glow -->
                     <div class="absolute top-1/2 left-1/2 w-[500px] h-[500px] bg-amber-brand/20 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                </div>
            </div>
        </div>
    </section>

@endsection
