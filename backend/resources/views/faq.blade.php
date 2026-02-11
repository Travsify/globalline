@extends('layouts.public')

@section('title', 'FAQ | GlobalLine Logistics Help Center')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden text-center">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 right-0 w-1/2 h-full bg-brand-gold/5 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <span class="inline-block px-4 py-1 bg-brand-gold/10 text-brand-gold rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">Help Center</span>
            <h1 class="text-6xl md:text-8xl font-heading font-black text-white mb-8 tracking-tighter uppercase italic">
                Common <span class="gold-outline-text underline decoration-brand-gold/20">Questions</span>
            </h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto leading-relaxed">
                Everything you need to know about global sourcing, consolidated shipping, and B2B payments.
            </p>
        </div>
    </header>

    <!-- FAQ Section -->
    <section class="py-32 bg-white" x-data="{ active: null }">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <div class="space-y-16">
                <!-- Group 1: Logistics -->
                <div>
                    <h4 class="text-xs font-black text-brand-navy uppercase tracking-[0.3em] mb-8 border-l-4 border-brand-gold pl-4 italic">Logistics & Shipping</h4>
                    <div class="space-y-4">
                        <!-- Q1 -->
                        <div class="border border-slate-100 rounded-2xl overflow-hidden transition-soft" :class="active === 1 ? 'shadow-xl border-brand-gold/30' : ''">
                            <button @click="active = active === 1 ? null : 1" class="w-full px-8 py-6 text-left flex justify-between items-center bg-slate-50/30">
                                <span class="text-lg font-black font-heading text-brand-navy uppercase tracking-tight italic">How long does shipping take from China?</span>
                                <svg class="w-5 h-5 transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-brand-gold' : 'text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="active === 1" x-collapse>
                                <div class="px-8 pb-8 text-slate-500 font-medium leading-relaxed">
                                    Express Air freight typically takes 3-7 business days, while Cargo Sea freight ranges from 30-45 days depending on the destination port (e.g., Lagos, New York). You can track your shipment in real-time through the [portal](file:///portal/tracking).
                                </div>
                            </div>
                        </div>
                        <!-- Q2 -->
                        <div class="border border-slate-100 rounded-2xl overflow-hidden transition-soft" :class="active === 2 ? 'shadow-xl border-brand-gold/30' : ''">
                            <button @click="active = active === 2 ? null : 2" class="w-full px-8 py-6 text-left flex justify-between items-center bg-slate-50/30">
                                <span class="text-lg font-black font-heading text-brand-navy uppercase tracking-tight italic">What is Consolidation?</span>
                                <svg class="w-5 h-5 transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-brand-gold' : 'text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="active === 2" x-collapse>
                                <div class="px-8 pb-8 text-slate-500 font-medium leading-relaxed">
                                    Consolidation allows you to group multiple packages from different suppliers into one "Master Box." This significantly reduces the dimensional weight and shipping costs compared to shipping items individually.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Group 2: Sourcing -->
                <div>
                    <h4 class="text-xs font-black text-brand-navy uppercase tracking-[0.3em] mb-8 border-l-4 border-brand-gold pl-4 italic">Sourcing & Suppliers</h4>
                    <div class="space-y-4">
                        <!-- Q3 -->
                        <div class="border border-slate-100 rounded-2xl overflow-hidden transition-soft" :class="active === 3 ? 'shadow-xl border-brand-gold/30' : ''">
                            <button @click="active = active === 3 ? null : 3" class="w-full px-8 py-6 text-left flex justify-between items-center bg-slate-50/30">
                                <span class="text-lg font-black font-heading text-brand-navy uppercase tracking-tight italic">Can you source items not on 1688?</span>
                                <svg class="w-5 h-5 transition-transform duration-300" :class="active === 3 ? 'rotate-180 text-brand-gold' : 'text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="active === 3" x-collapse>
                                <div class="px-8 pb-8 text-slate-500 font-medium leading-relaxed">
                                    Yes! If an item isn't listed on our integrated marketplace, you can submit a [Besoke Sourcing Request](file:///portal/sourcing) with a photo or description. Our local agents in China will find the factory for you.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Group 3: Financial -->
                <div>
                    <h4 class="text-xs font-black text-brand-navy uppercase tracking-[0.3em] mb-8 border-l-4 border-brand-gold pl-4 italic">Payments & Wallets</h4>
                    <div class="space-y-4">
                        <!-- Q4 -->
                        <div class="border border-slate-100 rounded-2xl overflow-hidden transition-soft" :class="active === 4 ? 'shadow-xl border-brand-gold/30' : ''">
                            <button @click="active = active === 4 ? null : 4" class="w-full px-8 py-6 text-left flex justify-between items-center bg-slate-50/30">
                                <span class="text-lg font-black font-heading text-brand-navy uppercase tracking-tight italic">How do I fund my multi-currency wallet?</span>
                                <svg class="w-5 h-5 transition-transform duration-300" :class="active === 4 ? 'rotate-180 text-brand-gold' : 'text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="active === 4" x-collapse>
                                <div class="px-8 pb-8 text-slate-500 font-medium leading-relaxed">
                                    You can fund your wallet via bank transfer or credit card. We support deposits in NGN, USD, and CNY. Once funded, you can convert between currencies instantly to settle supplier payments.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
