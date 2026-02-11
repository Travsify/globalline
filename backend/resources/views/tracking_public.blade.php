@extends('layouts.public')

@section('title', 'Track Shipment | GlobalLine Logistics')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden text-center">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 left-0 w-full h-full bg-brand-gold/5 blur-[120px] rounded-full translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <span class="inline-block px-4 py-1 bg-brand-gold/10 text-brand-gold rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">Live Cargo Intel</span>
            <h1 class="text-6xl md:text-8xl font-heading font-black text-white mb-8 tracking-tighter uppercase italic">
                Track <span class="gold-outline-text underline decoration-brand-gold/20">Shipment</span>
            </h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto leading-relaxed">
                Enter your GlobalLine Tracking ID to get an instant status update on your cargo.
            </p>
        </div>
    </header>

    <!-- Tracking Tool -->
    <section class="py-32 bg-white" x-data="{ trackingId: '', loading: false, result: null }">
        <div class="container mx-auto px-6 max-w-2xl">
            
            <div class="relative group mb-20">
                <div class="relative flex flex-col md:flex-row bg-slate-900/5 backdrop-blur-md p-3 rounded-2xl border border-slate-200 transition-soft group-hover:border-brand-gold/30">
                    <div class="flex-1 flex items-center px-6 py-4">
                        <svg class="w-6 h-6 text-slate-300 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        <input type="text" 
                               x-model="trackingId"
                               placeholder="GL-XXXX-XXXXX" 
                               class="w-full bg-transparent text-brand-navy font-black placeholder-slate-300 focus:outline-none text-xl uppercase italic">
                    </div>
                    <button @click="loading = true; setTimeout(() => { loading = false; result = true }, 1500)"
                            class="bg-brand-navy hover:bg-brand-lightNavy text-brand-gold px-12 py-5 rounded-xl font-black uppercase tracking-[0.2em] text-sm transition-soft shadow-xl active:scale-95 flex items-center justify-center min-w-[180px]">
                        <span x-show="!loading">Locate</span>
                        <svg x-show="loading" class="animate-spin h-5 w-5 text-brand-gold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Demo Result -->
            <div x-show="result" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-slate-900 border border-white/5 rounded-[3rem] p-12 text-white relative overflow-hidden" x-cloak>
                 <div class="absolute top-0 right-0 w-32 h-32 bg-brand-gold/10 blur-[80px] rounded-full"></div>
                 
                 <div class="flex justify-between items-start mb-12">
                     <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-brand-gold mb-2">Current Status</p>
                        <h5 class="text-3xl font-heading font-black uppercase italic tracking-tighter">In Transit</h5>
                     </div>
                     <div class="text-right">
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/30 mb-2">Estimated Arrival</p>
                        <h5 class="text-xl font-heading font-black uppercase italic">Feb 24, 2026</h5>
                     </div>
                 </div>

                 <!-- Timeline Preview -->
                 <div class="space-y-8 relative">
                    <div class="absolute left-[7px] top-2 bottom-2 w-0.5 bg-white/10"></div>
                    <div class="flex items-center space-x-6 relative">
                        <div class="w-4 h-4 rounded-full bg-brand-gold shadow-[0_0_15px_rgba(197,160,89,0.5)]"></div>
                        <div>
                            <p class="text-[10px] font-black text-brand-gold uppercase tracking-[0.2em]">Guangzhou Hub</p>
                            <p class="text-xs font-medium text-white/60 mt-1">Cargo Consolidated & Dispatched</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6 relative">
                        <div class="w-4 h-4 rounded-full bg-white/20"></div>
                        <div>
                            <p class="text-[10px] font-black text-white/40 uppercase tracking-[0.2em]">Lagos International</p>
                            <p class="text-xs font-medium text-white/20 mt-1">Pending Arrival / Customs Clearing</p>
                        </div>
                    </div>
                 </div>

                 <div class="mt-16 pt-12 border-t border-white/5 text-center">
                    <p class="text-xs text-white/30 font-medium mb-6 italic">Need more details? Log in to your portal for full journey mapping.</p>
                    <a href="/portal/dashboard" class="text-brand-gold font-black uppercase tracking-widest text-xs border-b border-brand-gold/20 hover:border-brand-gold pb-1 transition-soft">Enter Enterprise Portal &rarr;</a>
                 </div>
            </div>

        </div>
    </section>

@endsection
