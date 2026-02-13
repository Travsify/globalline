@extends('layouts.public')

@section('title', 'Contact Us | GlobalLine Logistics')

@section('content')

     <!-- HERO SECTION -->
     <section class="relative pt-32 pb-20 bg-navy-dark overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-amber-brand/5 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-xs mb-6 block" data-aos="fade-up">Get Connections</span>
            <h1 class="text-5xl md:text-7xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up" data-aos-delay="100">
                Contact <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light">GlobalLine.</span>
            </h1>
        </div>
    </section>

    <!-- CONTACT FORM & INFO -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                
                <!-- Info Column -->
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-navy-dark mb-8">We'd love to hear from you.</h2>
                    <p class="text-slate-600 mb-10 leading-relaxed">
                        Whether you have a specific shipment query, need a custom quote, or just want to know more about our services, our team is ready to assist.
                    </p>
                    
                    <div class="space-y-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-navy-dark text-white rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-navy-dark text-lg mb-1">Headquarters</h4>
                                <p class="text-slate-500 text-sm">Level 24, Global Trade Tower, Lagos, Nigeria</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-navy-dark text-white rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-navy-dark text-lg mb-1">Email Us</h4>
                                <a href="mailto:support@globalline.io" class="text-amber-brand font-bold">support@globalline.io</a>
                                <p class="text-slate-500 text-xs mt-1">Response time: &lt; 2 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] shadow-lg border border-slate-100" data-aos="fade-left">
                    <form action="#" class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-navy-dark">First Name</label>
                                <input type="text" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-brand focus:ring-1 focus:ring-amber-brand transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-navy-dark">Last Name</label>
                                <input type="text" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-brand focus:ring-1 focus:ring-amber-brand transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-navy-dark">Email Address</label>
                            <input type="email" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-brand focus:ring-1 focus:ring-amber-brand transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-navy-dark">Message</label>
                            <textarea rows="4" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-brand focus:ring-1 focus:ring-amber-brand transition-all"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-navy-dark text-white font-bold uppercase tracking-widest text-xs py-4 rounded-xl hover:bg-amber-brand hover:text-navy-dark transition-all shadow-lg hover:shadow-amber-brand/20">
                            Send Message
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection
