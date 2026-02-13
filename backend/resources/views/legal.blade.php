@extends('layouts.public')

@section('title', 'Legal & Compliance | GlobalLine')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-0 w-full h-full bg-blue-600/5 blur-[120px] rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block px-4 py-1 bg-white/5 text-white/40 border border-white/10 rounded-full mb-6 italic platform-label">Protocol Governance</span>
            <h1 class="text-6xl md:text-8xl font-black text-white mb-8 tracking-tighter uppercase italic">
                Legal <span class="text-brand-gold italic">&</span> <span class="gold-outline-text text-brand-navy italic">Compliance</span>
            </h1>
            <p class="text-white/30 max-w-2xl mx-auto leading-relaxed platform-body">
                GlobalLine operates under strict international trade and financial compliance protocols.
            </p>
        </div>
    </header>

    <!-- Legal Sections -->
    <section class="py-32 bg-white" x-data="{ tab: 'terms' }">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <!-- Tab Controls -->
                <div class="flex flex-wrap gap-4 mb-20 border-b border-slate-100 pb-8">
                    <button @click="tab = 'terms'" 
                            :class="tab === 'terms' ? 'bg-brand-navy text-white' : 'bg-slate-50 text-slate-400'"
                            class="px-8 py-3 rounded-2xl transition-all italic platform-label">
                        Terms of Engagement
                    </button>
                    <button @click="tab = 'privacy'" 
                            :class="tab === 'privacy' ? 'bg-brand-navy text-white' : 'bg-slate-50 text-slate-400'"
                            class="px-8 py-3 rounded-2xl transition-all italic platform-label">
                        Data Privacy
                    </button>
                    <button @click="tab = 'compliance'" 
                            :class="tab === 'compliance' ? 'bg-brand-navy text-white' : 'bg-slate-50 text-slate-400'"
                            class="px-8 py-3 rounded-2xl transition-all italic platform-label">
                        Global Compliance
                    </button>
                </div>

                <!-- Tab Content: Terms -->
                <div x-show="tab === 'terms'" x-cloak class="prose prose-slate max-w-none">
                    <h2 class="text-3xl font-black text-brand-navy uppercase italic tracking-tight mb-8">Terms of Engagement</h2>
                    <p class="text-slate-500 mb-6 platform-body">Last Updated: February 2026</p>
                    <p class="text-slate-500 leading-relaxed mb-6 platform-body">By using the GlobalLine terminal, you enter into a binding agreement for the facilitation of global sourcing and logistics. GlobalLine acts as a technology bridge between you and verified global manufacturers.</p>
                    <h4 class="text-brand-navy mb-4 platform-label">1. Sourcing Protocols</h4>
                    <p class="text-slate-500 mb-8">GlobalLine does not manufacturing products. We facilitate procurement from 1688, Taobao, and other marketplaces. Quality control is performed at our hubs, and acceptance of QC photos constitutes approval for shipping.</p>
                    <h4 class="text-brand-navy mb-4 platform-label">2. Payment Settlements</h4>
                    <p class="text-slate-500 mb-8">All currency conversions are performed in real-time. Payments to factories are non-refundable once the manufacturer has accepted the order.</p>
                </div>

                <!-- Tab Content: Privacy -->
                <div x-show="tab === 'privacy'" x-cloak class="prose prose-slate max-w-none">
                    <h2 class="text-3xl font-black text-brand-navy uppercase italic tracking-tight mb-8">Data Privacy Protocol</h2>
                    <p class="text-slate-500 mb-6 platform-body">We protect your trade secrets and business data with enterprise-grade encryption.</p>
                    <p class="text-slate-500 leading-relaxed mb-8 platform-body">Your procurement history, factory listings, and transit data are strictly confidential and encrypted at the node level. We do not sell trade data to third parties.</p>
                </div>

                <!-- Tab Content: Compliance -->
                <div x-show="tab === 'compliance'" x-cloak class="prose prose-slate max-w-none">
                    <h2 class="text-3xl font-black text-brand-navy uppercase italic tracking-tight mb-8">Global Compliance</h2>
                    <p class="text-slate-500 leading-relaxed mb-8 platform-body">GlobalLine adheres strictly to AML (Anti-Money Laundering) and KYC (Know Your Customer) regulations in every jurisdiction we operate.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="p-8 bg-slate-50 rounded-3xl">
                            <h5 class="text-brand-navy mb-4 platform-label">China Hub</h5>
                            <p class="text-slate-500 platform-body">Compliance with PRC export and trade manufacturing regulations.</p>
                        </div>
                        <div class="p-8 bg-slate-50 rounded-3xl">
                            <h5 class="text-brand-navy mb-4 platform-label">Africa Hub</h5>
                            <p class="text-slate-500 platform-body">Customs and clearing compliance across West and East Africa (Nigeria, Kenya, Ghana).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
