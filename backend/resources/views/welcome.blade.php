@extends('layouts.public')

@section('title', 'GlobalLine | Global Sourcing & Logistics Simplified')

@section('content')

    <!-- Hero Section -->
    <header class="relative min-h-[90vh] flex items-center pt-24 overflow-hidden bg-brand-navy">
        <!-- Background Imagery (Simulating the reference image) -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1494412574744-ff70438f6920?auto=format&fit=crop&w=2000&q=80" 
                 class="w-full h-full object-cover opacity-30 scale-105" alt="Logistics Background">
            <div class="absolute inset-0 hero-overlay"></div>
        </div>

        <!-- Decorative Elements from Reference -->
        <div class="absolute top-40 right-40 w-96 h-96 bg-brand-gold/10 blur-[120px] rounded-full"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <h1 class="text-6xl md:text-8xl font-heading font-black text-white leading-[1.1] mb-6 tracking-tight">
                    Global Sourcing & <br>
                    <span class="text-brand-gold italic">Logistics</span> Simplified
                </h1>
                <p class="text-xl md:text-2xl text-white/70 font-medium mb-12 max-w-2xl leading-relaxed">
                    Easily source products from <span class="text-white font-bold">Alibaba, Taobao, 1688</span> & more.
                </p>

                <!-- Search Bar (Direct Reference) -->
                <div class="max-w-3xl group mb-20">
                    <div class="relative flex flex-col md:flex-row bg-white/10 backdrop-blur-md p-2 rounded-xl border border-white/20 shadow-2xl transition-soft group-hover:border-brand-gold/30">
                        <div class="flex-1 flex items-center px-4 py-3">
                            <svg class="w-6 h-6 text-white/40 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input type="text" 
                                   placeholder="Enter Product URL (e.g. https://www.1688.com/... )" 
                                   class="w-full bg-transparent text-white font-medium placeholder-white/30 focus:outline-none text-lg">
                        </div>
                        <button class="bg-brand-gold hover:bg-brand-goldHover text-white px-12 py-4 rounded-lg font-black uppercase tracking-widest text-sm transition-soft shadow-lg active:scale-95">
                            Search
                        </button>
                    </div>
                </div>

                <!-- Floating Logistics Element (Visual Reference Tip) -->
                <div class="absolute -right-20 top-1/4 hidden xl:block animate-bounce-slow">
                     <div class="relative">
                        <div class="absolute inset-0 bg-brand-gold blur-3xl opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=600&q=80" 
                             class="w-80 h-48 object-cover rounded-[2rem] shadow-2xl border-4 border-white/10" alt="Cargo Plane">
                     </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-30px); }
            }
            .animate-bounce-slow { animation: bounce-slow 6s ease-in-out infinite; }
        </style>
    </header>

    <!-- Essential Service Cards (As per Reference) -->
    <section class="py-24 bg-brand-navy relative z-10 -mt-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Card 1: B2B Payments -->
                <div class="bg-white p-12 rounded-2xl shadow-2xl flex flex-col transition-soft hover:-translate-y-2">
                    <div class="flex items-start mb-8">
                        <div class="w-16 h-16 bg-brand-navy/5 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-10 h-10 text-brand-navy" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-1 6h2v2h-2V7zm0 4h2v6h-2v-6z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-heading font-black text-brand-navy mb-3 tracking-tight uppercase">B2B Payments</h3>
                            <p class="text-slate-500 font-medium text-lg leading-relaxed">Secure and easy transactions for your sourcing needs.</p>
                        </div>
                    </div>
                    <div class="mt-auto flex justify-end">
                        <a href="{{ url('/services') }}" class="bg-brand-gold hover:bg-brand-goldHover text-white px-8 py-3 rounded-md font-bold text-sm tracking-widest uppercase transition-soft">
                            Learn More
                        </a>
                    </div>
                </div>

                <!-- Card 2: Global Shipping -->
                <div class="bg-white p-12 rounded-2xl shadow-2xl flex flex-col transition-soft hover:-translate-y-2">
                    <div class="flex items-start mb-8">
                        <div class="w-16 h-16 bg-brand-navy/5 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-10 h-10 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-heading font-black text-brand-navy mb-3 tracking-tight uppercase">Global Shipping</h3>
                            <p class="text-slate-500 font-medium text-lg leading-relaxed">Fast and reliable international delivery.</p>
                        </div>
                    </div>
                    <div class="mt-auto flex justify-end">
                        <a href="{{ url('/services') }}" class="bg-brand-gold hover:bg-brand-goldHover text-white px-8 py-3 rounded-md font-bold text-sm tracking-widest uppercase transition-soft">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End-to-End Solutions Section (As per Reference) -->
    <section class="py-32 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <!-- Imagery from Reference -->
                <div class="w-full lg:w-1/2 relative">
                    <div class="absolute -inset-4 bg-brand-gold/10 rounded-[3rem] blur-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80" 
                         class="relative z-10 w-full aspect-[4/3] object-cover rounded-[3rem] shadow-2xl grayscale-[20%] hover:grayscale-0 transition-soft" alt="Container Vessel">
                    
                    <!-- Floating Stat Badge -->
                    <div class="absolute -bottom-10 -right-10 bg-brand-navy p-8 rounded-3xl text-white shadow-2xl z-20 hidden md:block">
                        <strong class="block text-4xl font-heading font-black text-brand-gold">120+</strong>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-white/50">Countries Served</span>
                    </div>
                </div>

                <!-- Copy from Reference -->
                <div class="w-full lg:w-1/2">
                    <h2 class="text-5xl md:text-6xl font-heading font-black text-brand-navy mb-8 tracking-tight uppercase">
                        End-to-End <br>Logistics Solutions
                    </h2>
                    <p class="text-xl text-slate-500 font-medium mb-10 leading-relaxed italic">
                        From China to your doorstep, we handle it all.
                    </p>

                    <ul class="space-y-6 mb-12">
                        <li class="flex items-center group">
                            <div class="w-8 h-8 bg-brand-gold text-white rounded-md flex items-center justify-center mr-4 group-hover:scale-110 transition-soft">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-xl font-black font-heading text-brand-navy uppercase tracking-tighter">Product Sourcing</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-8 h-8 bg-brand-gold text-white rounded-md flex items-center justify-center mr-4 group-hover:scale-110 transition-soft">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-xl font-black font-heading text-brand-navy uppercase tracking-tighter">Customs & Compliance</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-8 h-8 bg-brand-gold text-white rounded-md flex items-center justify-center mr-4 group-hover:scale-110 transition-soft">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-xl font-black font-heading text-brand-navy uppercase tracking-tighter">Worldwide Delivery</span>
                        </li>
                    </ul>

                    <a href="/portal/dashboard" class="inline-block bg-brand-gold hover:bg-brand-goldHover text-white px-12 py-5 rounded-lg font-black uppercase tracking-widest text-sm transition-soft shadow-xl">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
