@extends('layouts.public')

@section('title', 'Design Preview | Modern Sections')

@section('content')

<div class="bg-navy-dark min-h-screen text-white pt-24 pb-20">
    
    <div class="container mx-auto px-6 mb-20 text-center">
        <span class="text-amber-brand uppercase tracking-[0.3em] text-xs font-bold mb-4 block">Design Concept</span>
        <h1 class="text-5xl md:text-7xl font-bold font-heading mb-6">Modern Section <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light">Prototypes.</span></h1>
        <p class="text-white/50 max-w-2xl mx-auto">Below are the 8 proposed white-label sections implemented with the new "Dark Glass" aesthetic.</p>
    </div>

    <!-- 1. Global Logistics Infrastructure -->
    <section class="py-20 border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="mb-10 opacity-50 text-xs font-mono uppercase">01 / Global Infrastructure</div>
            
            <div class="relative bg-navy rounded-[3rem] overflow-hidden border border-white/5 shadow-2xl">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop')] bg-cover bg-center opacity-20"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-navy-dark via-navy/90 to-transparent"></div>
                
                <div class="relative z-10 p-12 md:p-20 flex flex-col md:flex-row items-center gap-12">
                    <div class="md:w-1/2">
                        <h2 class="text-4xl md:text-6xl font-bold font-heading leading-none mb-6">Borderless <br> Logistics.</h2>
                        <p class="text-lg text-white/60 mb-8 leading-relaxed">
                            We've dismantled the barriers of traditional trade. Our integrated network spans 220 countries, creating a seamless pipeline for your goods from factory floor to customer door.
                        </p>
                        <div class="flex gap-4">
                            <div class="bg-white/5 backdrop-blur-md border border-white/10 px-6 py-4 rounded-2xl">
                                <div class="text-2xl font-bold text-amber-brand">220+</div>
                                <div class="text-[10px] uppercase tracking-wider text-white/50">Countries</div>
                            </div>
                            <div class="bg-white/5 backdrop-blur-md border border-white/10 px-6 py-4 rounded-2xl">
                                <div class="text-2xl font-bold text-amber-brand">72h</div>
                                <div class="text-[10px] uppercase tracking-wider text-white/50">Global Avg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/2 relative">
                        <!-- Abstract Globe Viz -->
                        <div class="w-full aspect-square bg-gradient-to-tr from-blue-500/10 to-amber-500/10 rounded-full border border-white/10 backdrop-blur-sm relative animate-spin-slow">
                            <div class="absolute top-1/4 left-1/4 w-4 h-4 bg-amber-brand rounded-full shadow-[0_0_20px_rgba(245,158,11,0.5)]"></div>
                            <div class="absolute bottom-1/3 right-1/4 w-3 h-3 bg-blue-500 rounded-full shadow-[0_0_20px_rgba(59,130,246,0.5)]"></div>
                            <!-- Connection Line -->
                            <svg class="absolute inset-0 w-full h-full text-white/20" viewBox="0 0 100 100">
                                <path d="M25,25 Q50,50 75,66" fill="none" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Seamless Supplier Payments -->
    <section class="py-20 border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="mb-10 opacity-50 text-xs font-mono uppercase">02 / Seamless Payments</div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                <div class="order-2 md:order-1">
                    <!-- Glass Card Stack -->
                    <div class="relative w-full max-w-md mx-auto">
                        <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-br from-amber-brand/20 to-blue-600/20 blur-3xl -z-10"></div>
                        
                        <!-- Card: Invoice -->
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-3xl transform -rotate-6 translate-y-4">
                            <div class="flex justify-between items-center mb-4">
                                <div class="w-8 h-8 bg-slate-700 rounded-lg"></div>
                                <div class="text-xs font-mono text-white/50">INV-2024-001</div>
                            </div>
                            <div class="h-2 w-24 bg-white/20 rounded mb-2"></div>
                            <div class="h-2 w-16 bg-white/10 rounded"></div>
                        </div>

                        <!-- Card: Payment Success -->
                        <div class="relative bg-navy-light/90 backdrop-blur-xl border border-white/10 p-8 rounded-3xl shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <div class="w-16 h-16 bg-emerald-500/20 text-emerald-500 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Payment Sent</h3>
                            <p class="text-white/60 text-sm mb-6">Supplier received CNY 45,000 instantly.</p>
                            <div class="flex gap-4 text-xs font-mono text-white/40">
                                <span>RMB</span>
                                <span>USD</span>
                                <span>EUR</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <h2 class="text-4xl md:text-5xl font-bold font-heading mb-6">Frictionless <br> Finance.</h2>
                    <p class="text-white/60 text-lg leading-relaxed mb-8">
                        Pay global suppliers in their local currency without setting up foreign accounts. We handle the exchange, the transfer, and the verification.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4">
                            <span class="w-6 h-6 rounded-full bg-amber-brand/20 flex items-center justify-center text-amber-brand text-xs">✓</span>
                            <span class="text-white/80">Instant RMB/USD Transfers</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="w-6 h-6 rounded-full bg-amber-brand/20 flex items-center justify-center text-amber-brand text-xs">✓</span>
                            <span class="text-white/80">Zero Hidden Fees</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. White-Label Sourcing (Bento Grid) -->
    <section class="py-20 border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="mb-10 opacity-50 text-xs font-mono uppercase">03 / Direct Sourcing</div>
            <div class="text-center mb-16">
                 <h2 class="text-4xl md:text-5xl font-bold font-heading mb-4">Factory Direct. <br> No Middlemen.</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Box 1: Verified -->
                <div class="md:col-span-2 bg-white/5 border border-white/10 rounded-[2rem] p-10 hover:bg-white/10 transition-colors group">
                    <div class="flex justify-between items-start mb-8">
                        <h3 class="text-2xl font-bold">Verified Manufacturers</h3>
                        <div class="px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full text-xs font-bold uppercase tracking-wider">Audit Passed</div>
                    </div>
                    <p class="text-white/60 max-w-md">We physically inspect factories to ensure quality, capacity, and ethical standards before you place an order.</p>
                </div>

                <!-- Box 2: Negotiation -->
                <div class="bg-gradient-to-br from-amber-brand to-amber-dark rounded-[2rem] p-10 text-navy-dark">
                    <h3 class="text-2xl font-bold mb-4">We Negotiate</h3>
                    <p class="opacity-80 font-medium">Our local teams speak the language to get you the best price, cutting usually 15-20% off quoted rates.</p>
                </div>
                
                <!-- Box 3: Samples -->
                <div class="bg-navy-light border border-white/10 rounded-[2rem] p-10">
                    <div class="w-12 h-12 bg-white/10 rounded-xl mb-6 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Sample Consolidation</h3>
                    <p class="text-white/50 text-sm">Get samples from 5 factories sent in 1 box.</p>
                </div>

                <!-- Box 4: Custom Production -->
                <div class="md:col-span-2 bg-white/5 border border-white/10 rounded-[2rem] p-10 flex items-center justify-between group hover:border-amber-brand/50 transition-colors cursor-pointer">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Private Label (OEM/ODM)</h3>
                        <p class="text-white/50">Create your own brand. Custom packaging and product design.</p>
                    </div>
                     <div class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-navy-dark transition-all">
                        &rarr;
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Smart Warehousing -->
    <section class="py-20 border-t border-white/5 bg-navy-light/30">
        <div class="container mx-auto px-6">
            <div class="mb-10 opacity-50 text-xs font-mono uppercase">04 / Smart Warehousing</div>
            
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-1/3">
                    <h2 class="text-4xl font-bold font-heading mb-6">Your Virtual <br> Warehouse.</h2>
                    <p class="text-white/60 mb-8">
                        Store goods in our global hubs for free up to 30 days. Consolidate shipments to reduce volumetric weight and shipping costs by up to 40%.
                    </p>
                    <a href="#" class="text-amber-brand font-bold uppercase tracking-widest text-xs border-b border-amber-brand pb-1">Calculate Savings</a>
                </div>
                <div class="lg:w-2/3">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Abstract "Box" visualization -->
                        <div class="aspect-square bg-white/5 rounded-2xl border border-white/10 flex flex-col items-center justify-center p-4 text-center hover:bg-amber-brand/10 transition-colors">
                            <span class="text-2xl font-bold mb-1">Guangzhou</span>
                            <span class="text-[10px] uppercase text-white/40">Hub</span>
                        </div>
                         <div class="aspect-square bg-white/5 rounded-2xl border border-white/10 flex flex-col items-center justify-center p-4 text-center hover:bg-amber-brand/10 transition-colors">
                            <span class="text-2xl font-bold mb-1">Dubai</span>
                            <span class="text-[10px] uppercase text-white/40">Hub</span>
                        </div>
                         <div class="aspect-square bg-white/5 rounded-2xl border border-white/10 flex flex-col items-center justify-center p-4 text-center hover:bg-amber-brand/10 transition-colors">
                            <span class="text-2xl font-bold mb-1">New York</span>
                            <span class="text-[10px] uppercase text-white/40">Hub</span>
                        </div>
                         <div class="aspect-square bg-white/5 rounded-2xl border border-white/10 flex flex-col items-center justify-center p-4 text-center hover:bg-amber-brand/10 transition-colors">
                            <span class="text-2xl font-bold mb-1">Lagos</span>
                            <span class="text-[10px] uppercase text-white/40">Hub</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Automated E-commerce -->
    <section class="py-20 border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="mb-10 opacity-50 text-xs font-mono uppercase">05 / E-commerce Automation</div>
            
            <div class="bg-gradient-to-r from-blue-900/20 to-navy-dark rounded-[3rem] p-12 relative overflow-hidden text-center">
                <div class="relative z-10 max-w-2xl mx-auto">
                    <div class="flex justify-center gap-6 mb-8 text-white/30">
                        <span class="text-2xl font-bold">Shopify</span>
                        <span class="text-2xl font-bold">WooCommerce</span>
                        <span class="text-2xl font-bold">Magento</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Connect Your Store. <br> We Handle the Rest.</h2>
                    <p class="text-white/60 mb-10 text-lg">
                        Orders sync automatically. We pick, pack, and ship from the nearest warehouse directly to your customer.
                    </p>
                    <button class="bg-white text-navy-dark px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-brand transition-colors">
                        View API Documentation
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- 6, 7, 8 compacted for preview -->
    <section class="py-20 border-t border-white/5">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- 6. Real-time Tracking -->
            <div class="p-8 rounded-3xl border border-emerald-500/20 bg-emerald-900/5 hover:border-emerald-500/50 transition-colors">
                <div class="mb-6 opacity-50 text-xs font-mono uppercase">06 / Visibility</div>
                <h3 class="text-2xl font-bold mb-4">Control Tower</h3>
                <p class="text-white/50 text-sm mb-6">Real-time GPS tracking for every container and parcel. Predictive ETA updates.</p>
                <div class="h-1 bg-emerald-500/20 rounded-full overflow-hidden">
                    <div class="h-full w-2/3 bg-emerald-500 animate-pulse"></div>
                </div>
            </div>

            <!-- 7. Insurance -->
            <div class="p-8 rounded-3xl border border-white/10 bg-white/5 hover:bg-white/10 transition-colors">
                 <div class="mb-6 opacity-50 text-xs font-mono uppercase">07 / Security</div>
                <h3 class="text-2xl font-bold mb-4 text-amber-brand">100% Insured</h3>
                <p class="text-white/50 text-sm">Comprehensive coverage. If it's lost or damaged, we refund the full value instantly.</p>
            </div>

            <!-- 8. Industry Solutions -->
            <div class="p-8 rounded-3xl border border-white/10 bg-white/5 hover:bg-white/10 transition-colors">
                 <div class="mb-6 opacity-50 text-xs font-mono uppercase">08 / Specialized</div>
                <h3 class="text-2xl font-bold mb-4">Tailored Handling</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 rounded-lg bg-white/10 text-xs">Medical</span>
                    <span class="px-3 py-1 rounded-lg bg-white/10 text-xs">Automotive</span>
                    <span class="px-3 py-1 rounded-lg bg-white/10 text-xs">Fashion</span>
                    <span class="px-3 py-1 rounded-lg bg-white/10 text-xs">Electronics</span>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
