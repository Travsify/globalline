@extends('layouts.public')

@section('title', 'About Us | GlobalLine Logistics')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden text-center">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 right-0 w-1/2 h-full bg-brand-gold/5 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <span class="inline-block px-4 py-1 bg-brand-gold/10 text-brand-gold rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">World Identity</span>
            <h1 class="text-6xl md:text-8xl font-heading font-black text-white mb-8 tracking-tighter uppercase italic">
                Our <span class="gold-outline-text underline decoration-brand-gold/20">Story</span>
            </h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto leading-relaxed">
                Removing borders and simplifying global commerce for everyone, everywhere.
            </p>
        </div>
    </header>

    <!-- Content Section -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-center">
                <div>
                    <h2 class="text-4xl font-heading font-black text-brand-navy mb-8 tracking-tight uppercase italic">The Mission</h2>
                    <p class="text-lg text-slate-500 font-medium leading-relaxed mb-6">
                        GlobalLine was founded on a single conviction: international trade should be as easy as sending an email. We've built an ecosystem that merges high-speed logistics with modern financial tech.
                    </p>
                    <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                        Today, we serve thousands of SMEs, helping them source directly from world-class factories and ship across continents without the traditional complexity.
                    </p>
                    <div class="bg-brand-navy p-10 rounded-2xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-brand-gold/10 translate-x-full group-hover:translate-x-0 transition-soft duration-1000"></div>
                        <p class="text-white italic text-xl font-heading font-bold relative z-10 leading-relaxed">
                            "We don't just move boxes; we move economies by empowering the local trader with global tools."
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80" 
                         class="w-full aspect-square object-cover rounded-[3rem] shadow-2xl" alt="Global Trade">
                    <!-- Floating Stat Badge -->
                    <div class="absolute -top-10 -left-10 bg-brand-gold text-white p-8 rounded-3xl shadow-2xl z-20">
                        <strong class="block text-4xl font-heading font-black tracking-tighter italic">2026</strong>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-brand-navy">Excellence Pillar</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-32 bg-brand-slate">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-4xl font-heading font-black text-brand-navy mb-16 uppercase italic">Driven by <span class="gold-outline-text italic text-brand-navy underline decoration-brand-gold/20">Values</span></h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
                <div class="group">
                    <div class="mb-8 overflow-hidden rounded-2xl">
                         <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=400&q=80" 
                              class="w-full h-48 object-cover group-hover:scale-110 transition-soft grayscale hover:grayscale-0" alt="Integrity">
                    </div>
                    <h5 class="text-xl font-black font-heading tracking-tighter uppercase mb-4 text-brand-navy group-hover:text-brand-gold transition-soft">Uncompromising Integrity</h5>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">Every transaction is secured with enterprise-grade encryption and transparent reporting.</p>
                </div>
                <div class="group">
                    <div class="mb-8 overflow-hidden rounded-2xl">
                         <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=400&q=80" 
                              class="w-full h-48 object-cover group-hover:scale-110 transition-soft grayscale hover:grayscale-0" alt="Innovation">
                    </div>
                    <h5 class="text-xl font-black font-heading tracking-tighter uppercase mb-4 text-brand-navy group-hover:text-brand-gold transition-soft">Relentless Innovation</h5>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">We continuously refine our API and logistics routes to save you time and capital.</p>
                </div>
                <div class="group">
                    <div class="mb-8 overflow-hidden rounded-2xl">
                         <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=400&q=80" 
                              class="w-full h-48 object-cover group-hover:scale-110 transition-soft grayscale hover:grayscale-0" alt="Impact">
                    </div>
                    <h5 class="text-xl font-black font-heading tracking-tighter uppercase mb-4 text-brand-navy group-hover:text-brand-gold transition-soft">Economic Impact</h5>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">Our success is measured by the growth of our partners across the emerging markets.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
