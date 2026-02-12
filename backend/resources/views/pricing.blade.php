@extends('layouts.public')

@section('title', 'Pricing | Transparent Global Trade')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-600/10 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-1/2 h-full bg-brand-gold/5 blur-[120px] rounded-full -translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block px-4 py-1 bg-blue-500/10 text-blue-400 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">Fiscal Transparency</span>
            <h1 class="text-6xl md:text-8xl font-black text-white mb-8 tracking-tighter uppercase italic">
                Build. Scale. <span class="text-brand-gold italic">Pay Less.</span>
            </h1>
            <p class="text-xl text-white/40 max-w-2xl mx-auto leading-relaxed">
                Zero hidden costs. Professional-grade sourcing and logistics at factory-direct rates.
            </p>
        </div>
    </header>

    <!-- Pricing Tiers -->
    <section class="py-32 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <!-- Basic / Individual -->
                <div class="bg-white rounded-[3rem] p-12 border border-slate-100 shadow-xl hover:shadow-3xl transition-all duration-500 group relative overflow-hidden" data-aos="fade-right">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-full translate-x-16 -translate-y-16 group-hover:bg-blue-50 transition-colors"></div>
                    
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 block italic">Frontier Series</span>
                    <h3 class="text-4xl font-black text-brand-navy mb-8 tracking-tighter">Individual</h3>
                    <div class="flex items-baseline gap-2 mb-8">
                        <span class="text-6xl font-black text-brand-navy tracking-tighter">Free</span>
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">To Start</span>
                    </div>
                    
                    <p class="text-slate-500 font-bold mb-10 text-sm italic">Perfect for solo entrepreneurs and small importers.</p>
                    
                    <ul class="space-y-6 mb-12">
                        <li class="flex items-center gap-4 text-sm font-bold text-brand-navy">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Direct 1688/Taobao Sourcing
                        </li>
                        <li class="flex items-center gap-4 text-sm font-bold text-brand-navy">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Pay-as-you-go Logistics
                        </li>
                        <li class="flex items-center gap-4 text-sm font-bold text-brand-navy">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Basic Wallet (USD/CNY/NGN)
                        </li>
                        <li class="flex items-center gap-4 text-sm font-bold text-slate-300">
                             <span class="w-5 h-[2px] bg-slate-200"></span>
                             No Multi-user RBAC
                        </li>
                    </ul>
                    
                    <a href="{{ route('register') }}" class="block text-center bg-brand-navy text-white px-8 py-5 rounded-2xl font-black uppercase tracking-widest text-[11px] hover:bg-brand-gold hover:text-brand-navy transition-all shadow-xl">
                        Open Free Account
                    </a>
                </div>

                <!-- Business / Enterprise -->
                <div class="bg-brand-navy rounded-[3rem] p-12 shadow-4xl group relative overflow-hidden" data-aos="fade-left">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-600/20 rounded-full blur-[60px]"></div>
                    <div class="absolute top-8 right-8 bg-brand-gold text-brand-navy px-4 py-1.5 rounded-full font-black text-[9px] uppercase tracking-widest italic animate-pulse">
                        Most Popular
                    </div>

                    <span class="text-[10px] font-black text-brand-gold uppercase tracking-widest mb-4 block italic">Enterprise Series</span>
                    <h3 class="text-4xl font-black text-white mb-8 tracking-tighter text-blue-400">Business</h3>
                    <div class="flex items-baseline gap-2 mb-8">
                        <span class="text-6xl font-black text-white tracking-tighter">Custom</span>
                        <span class="text-white/30 font-bold uppercase text-[10px] tracking-widest">Volume Based</span>
                    </div>
                    
                    <p class="text-white/40 font-bold mb-10 text-sm italic">Scaled infrastructure for importers & manufacturers.</p>
                    
                    <ul class="space-y-6 mb-12">
                        <li class="flex items-center gap-4 text-sm font-bold text-white">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Priority Logistics Handling
                        </li>
                        <li class="flex items-center gap-4 text-sm font-bold text-white">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Dedicated Procurement Manager
                        </li>
                        <li class="flex items-center gap-4 text-sm font-bold text-white">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Multi-user Roles & Permissions
                        </li>
                        <li class="flex items-center gap-4 text-sm font-bold text-white">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Direct API/Webhook Access
                        </li>
                    </ul>
                    
                    <a href="{{ route('contact') }}" class="block text-center bg-brand-gold text-brand-navy px-8 py-5 rounded-2xl font-black uppercase tracking-widest text-[11px] hover:bg-white hover:text-brand-navy transition-all shadow-xl shadow-brand-gold/10">
                        Inquiry Enterprise
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Fee Transparency -->
    <section class="py-24 bg-slate-50 border-y border-slate-200">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h4 class="text-3xl font-black text-brand-navy tracking-tight uppercase italic mb-4">Transparent Protocols</h4>
                    <p class="text-slate-400 font-medium">We believe in a zero-markup philosophy for the high-velocity trader.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                        <p class="text-[10px] font-black text-brand-gold uppercase tracking-widest mb-4 italic">Sourcing Feed</p>
                        <p class="text-3xl font-black text-brand-navy mb-2 tracking-tighter">5% - 8%</p>
                        <p class="text-xs text-slate-400 font-bold leading-relaxed">Service fee for procurement, inspection, and warehouse hand-off.</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 border-b-4 border-blue-500">
                        <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-4 italic">FX Conversion</p>
                        <p class="text-3xl font-black text-brand-navy mb-2 tracking-tighter">Market + 0</p>
                        <p class="text-xs text-slate-400 font-bold leading-relaxed">We settle factory invoices at transparent black-market parallel rates.</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                        <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-4 italic">Logistics</p>
                        <p class="text-3xl font-black text-brand-navy mb-2 tracking-tighter">Dynamic</p>
                        <p class="text-xs text-slate-400 font-bold leading-relaxed">Freight costs based on volumetric weight. No GlobalLine markup.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ CTA -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h4 class="text-2xl font-black text-brand-navy tracking-tight uppercase italic mb-8">Need a custom quote for bulk freight?</h4>
            <a href="{{ route('contact') }}" class="inline-block border-2 border-brand-navy text-brand-navy px-12 py-5 rounded-2xl font-black uppercase tracking-widest text-[11px] hover:bg-brand-navy hover:text-white transition-all">
                Talk to a Node Specialist
            </a>
        </div>
    </section>

@endsection
