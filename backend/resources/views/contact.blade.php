@extends('layouts.public')

@section('title', 'Contact Us | GlobalLine Logistics')

@section('content')

    <!-- Hero Header -->
    <header class="pt-48 pb-24 bg-brand-navy relative overflow-hidden text-center">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 left-0 w-full h-full bg-brand-gold/5 blur-[120px] rounded-full translate-y-1/2"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <span class="inline-block px-4 py-1 bg-brand-gold/10 text-brand-gold rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 italic">24/7 Support</span>
            <h1 class="text-6xl md:text-8xl font-heading font-black text-white mb-8 tracking-tighter uppercase italic">
                Get In <span class="gold-outline-text underline decoration-brand-gold/20">Touch</span>
            </h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto leading-relaxed">
                Our logistics experts are standing by to assist with your global enterprise needs.
            </p>
        </div>
    </header>

    <!-- Support Grid -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
                
                <!-- Support Info -->
                <div class="lg:col-span-1 space-y-12">
                    <div>
                        <h4 class="text-sm font-black text-brand-navy uppercase tracking-[0.3em] mb-8 italic">Global Support</h4>
                        <div class="space-y-8">
                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-brand-navy shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Email Us</p>
                                    <p class="text-lg font-black font-heading text-brand-navy uppercase tracking-tighter italic">support@globalline.com</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-brand-navy shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">WhatsApp Support</p>
                                    <p class="text-lg font-black font-heading text-brand-navy uppercase tracking-tighter italic">+1 (212) 555-LINE</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-black text-brand-navy uppercase tracking-[0.3em] mb-8 italic">Operating Locations</h4>
                        <div class="space-y-6">
                            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 transition-soft hover:border-brand-gold/30">
                                <p class="text-brand-navy font-black text-sm uppercase italic">Guangzhou, CN</p>
                                <p class="text-slate-500 text-xs font-medium">Baiyun Logistics District, Floor 4</p>
                            </div>
                            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 transition-soft hover:border-brand-gold/30">
                                <p class="text-brand-navy font-black text-sm uppercase italic">Lagos, NG</p>
                                <p class="text-slate-500 text-xs font-medium">Victoria Island, Giga Tower</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inquiry Form -->
                <div class="lg:col-span-2 bg-brand-navy p-12 lg:p-20 rounded-[3rem] shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-brand-gold/5 blur-[100px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-4xl font-heading font-black text-white mb-12 uppercase italic tracking-tight">Enterprise Inquiry</h3>
                        
                        <form action="#" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-brand-gold uppercase tracking-widest">Full Name</label>
                                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 text-white focus:outline-none focus:border-brand-gold transition-soft" placeholder="John Doe">
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-brand-gold uppercase tracking-widest">Business Email</label>
                                    <input type="email" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 text-white focus:outline-none focus:border-brand-gold transition-soft" placeholder="john@enterprise.com">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-brand-gold uppercase tracking-widest">Inquiry Type</label>
                                <select class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 text-white focus:outline-none focus:border-brand-gold transition-soft appearance-none">
                                    <option class="bg-brand-navy">Global Logistics & Freight</option>
                                    <option class="bg-brand-navy">1688 / Alibaba Sourcing</option>
                                    <option class="bg-brand-navy">B2B Payments & Wallets</option>
                                    <option class="bg-brand-navy">Technical / API Support</option>
                                </select>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-brand-gold uppercase tracking-widest">Message Details</label>
                                <textarea rows="5" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 text-white focus:outline-none focus:border-brand-gold transition-soft" placeholder="How can we help your business scale globally?"></textarea>
                            </div>

                            <button class="w-full bg-brand-gold hover:bg-brand-goldHover text-brand-navy py-5 rounded-xl text-sm font-black uppercase tracking-[0.2em] transition-soft shadow-xl italic active:scale-95">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
