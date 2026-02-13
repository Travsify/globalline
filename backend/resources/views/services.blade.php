@extends('layouts.public')

@section('title', 'Our Solutions | GlobalLine Logistics')

@section('content')

    <!-- HERO SECTION -->
     <section class="relative pt-32 pb-20 bg-navy-dark overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-1/2 left-1/2 w-[800px] h-[800px] bg-gradient-to-r from-blue-600/10 to-amber-brand/5 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-xs mb-6 block" data-aos="fade-up">Logistics Ecosystem</span>
            <h1 class="text-5xl md:text-7xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up" data-aos-delay="100">
                End-to-End <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-white to-white/50">Supply Chain Solutions.</span>
            </h1>
        </div>
    </section>

    <!-- SERVICES GRID -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            
            <!-- Service 1: Air Freight -->
            <div class="flex flex-col lg:flex-row items-center gap-16 mb-32 group">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1559297434-fae8a1916a79?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-105" alt="Air Freight">
                        <div class="absolute bottom-10 left-10 p-4 bg-white/90 backdrop-blur-md rounded-2xl shadow-lg">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-brand text-navy-dark rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                </div>
                                <div>
                                    <p class="text-navy-dark font-bold text-sm uppercase tracking-wide">Express Air</p>
                                    <p class="text-xs text-slate-500">3-5 Days Delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <h2 class="text-4xl font-bold text-navy-dark mb-6">Expert Air Freight</h2>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        When speed is critical, our air freight network delivers. We leverage partnerships with major airlines to secure cargo space even during peak seasons.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Door-to-Door Delivery
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Customs Clearance Handling
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Cargo Insurance Included
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="inline-flex items-center bg-navy-dark text-white px-8 py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-brand hover:text-navy-dark transition-all">
                        Start Shipping
                    </a>
                </div>
            </div>

            <!-- Service 2: Ocean Freight -->
            <div class="flex flex-col lg:flex-row-reverse items-center gap-16 mb-32 group">
                <div class="lg:w-1/2" data-aos="fade-left">
                     <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1494412574643-35d3d1706f28?q=80&w=1974&auto=format&fit=crop" class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-105" alt="Ocean Freight">
                        <div class="absolute bottom-10 right-10 p-4 bg-navy-dark/90 backdrop-blur-md rounded-2xl shadow-lg border border-white/10">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/10 text-amber-brand rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold text-sm uppercase tracking-wide">Ocean Cargo</p>
                                    <p class="text-xs text-white/50">FCL & LCL Options</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-right">
                    <h2 class="text-4xl font-bold text-navy-dark mb-6">Ocean Transport</h2>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        Cost-effective solutions for large volume shipments. Whether you need a full container (FCL) or less than a container (LCL), we optimize consolidation to save you money.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Consolidation Services
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Port-to-Port & Door-to-Door
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Heavy Equipment Handling
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="inline-flex items-center bg-navy-dark text-white px-8 py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-brand hover:text-navy-dark transition-all">
                        Get a Quote
                    </a>
                </div>
            </div>

            <!-- Service 3: Sourcing -->
            <div class="flex flex-col lg:flex-row items-center gap-16 group">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop" class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-105" alt="Sourcing">
                        <div class="absolute inset-0 bg-navy/20 mix-blend-multiply"></div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <h2 class="text-4xl font-bold text-navy-dark mb-6">Global Sourcing</h2>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        Don't just ship it, buy it through us. We enable you to procure goods directly from factories in China, Vietnam, and Turkey without barriers.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Payment Intermediary (RMB/USD)
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Quality Inspection
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-navy-dark">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Supplier Verification
                        </li>
                    </ul>
                    <a href="{{ route('marketplace.index') }}" class="inline-flex items-center bg-amber-brand text-navy-dark px-8 py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-light transition-all">
                        Browse Market
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 bg-navy-dark relative overflow-hidden">
         <div class="absolute inset-0 z-0">
             <div class="absolute top-1/2 left-1/2 w-[1000px] h-[1000px] bg-amber-brand/5 rounded-full blur-[150px] -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-4xl font-bold text-white mb-8">Ready to move your cargo?</h2>
            <a href="{{ route('register') }}" class="inline-flex items-center bg-white text-navy-dark px-10 py-4 rounded-xl font-bold uppercase tracking-widest text-sm hover:bg-amber-brand transition-all shadow-xl hover:shadow-amber-brand/20 hover:-translate-y-1">
                Create Free Account
            </a>
        </div>
    </section>

@endsection
