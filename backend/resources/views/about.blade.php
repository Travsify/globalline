@extends('layouts.public')

@section('title', 'About Us | GlobalLine Logistics')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 bg-navy-dark overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-amber-brand/5 rounded-full blur-[120px] translate-x-1/2 -translate-y-1/2"></div>
             <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-600/5 rounded-full blur-[100px] -translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-xs mb-6 block" data-aos="fade-up">Our Mission</span>
            <h1 class="text-5xl md:text-7xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up" data-aos-delay="100">
                Rewiring Global <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light">Supply Chains.</span>
            </h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                We are building the digital infrastructure for the next generation of global trade. Faster, transparent, and accessible to everyone.
            </p>
        </div>
    </section>

    <!-- STORY SECTION -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto object-cover" alt="Logistics Planning">
                        <div class="absolute inset-0 bg-gradient-to-tr from-navy/80 to-transparent"></div>
                        <div class="absolute bottom-10 left-10 p-6 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl">
                            <p class="text-amber-brand font-bold text-4xl mb-1">2018</p>
                            <p class="text-white text-xs uppercase tracking-widest">Founded in Guangzhou</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <h2 class="text-4xl font-bold text-navy-dark mb-8 leading-tight">From a Warehouse to <br> a Global Network.</h2>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        GlobalLine began with a simple observation: international shipping was too complex, too opaque, and too slow for modern businesses.
                    </p>
                    <p class="text-slate-600 leading-relaxed mb-8">
                        We set out to change that by combining world-class logistics infrastructure with advanced technology. Today, we connect thousands of businesses to global markets through our unified platform.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-8 mt-12">
                        <div>
                            <h4 class="text-3xl font-bold text-navy-dark mb-2">10M+</h4>
                            <p class="text-xs uppercase tracking-widest text-slate-500 font-bold">Packages Delivered</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold text-navy-dark mb-2">99.9%</h4>
                            <p class="text-xs uppercase tracking-widest text-slate-500 font-bold">Uptime Reliability</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VALUES SECTION -->
    <section class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-navy-dark mb-4">Our Core Values</h2>
                <div class="w-20 h-1 bg-amber-brand mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-10 rounded-3xl shadow-lg border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 bg-navy-light/10 text-navy-dark rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy-dark mb-4">Speed & Precision</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Time is money. We optimize every route and process to ensure your cargo arrives faster.</p>
                </div>
                
                <div class="bg-white p-10 rounded-3xl shadow-lg border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 bg-navy-light/10 text-navy-dark rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy-dark mb-4">Integrity First</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">We believe in total transparency. No hidden fees, no surprises. Just honest logistics.</p>
                </div>

                <div class="bg-white p-10 rounded-3xl shadow-lg border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 bg-navy-light/10 text-navy-dark rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy-dark mb-4">Customer Obsessed</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Your success is our success. Our support team is available 24/7 to solve your challenges.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
