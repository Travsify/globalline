@extends('layouts.public')

@section('title', 'Track Shipment | GlobalLine Logistics')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-48 bg-navy-dark overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute bottom-0 right-0 w-[800px] h-[800px] bg-blue-600/5 rounded-full blur-[120px] translate-y-1/2"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-xs mb-6 block" data-aos="fade-up">Real-time Visibility</span>
            <h1 class="text-5xl md:text-7xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up" data-aos-delay="100">
                Track Your <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand to-amber-light">Cargo.</span>
            </h1>
        </div>
    </section>

    <!-- TRACKING INTERFACE -->
    <section class="relative -mt-24 pb-24">
        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 md:p-14 border border-slate-100" data-aos="fade-up" data-aos-delay="200">
                    <form action="#" method="GET" class="relative">
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-brand/20 to-blue-500/20 rounded-2xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-100 rounded-2xl flex items-center p-2 focus-within:border-amber-brand focus-within:ring-4 focus-within:ring-amber-brand/10 transition-all">
                                <div class="pl-6 text-slate-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <input type="text" placeholder="Enter Tracking Number (e.g. GL-12345678)" class="w-full bg-transparent border-none text-navy-dark placeholder-slate-400 font-bold text-lg px-6 py-4 focus:ring-0">
                                <button type="submit" class="bg-navy-dark text-white px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-amber-brand hover:text-navy-dark transition-all">
                                    Track
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Example Result (Hardcoded state for visual verification) -->
                    <!-- In production, this would be dynamic based on search -->
                    <div class="mt-12 pt-12 border-t border-slate-100 hidden">
                         <div class="flex items-center justify-between mb-8">
                             <div>
                                 <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-1">Status</p>
                                 <p class="text-emerald-500 font-bold text-2xl">In Transit</p>
                             </div>
                             <div class="text-right">
                                 <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-1">Estimated Delivery</p>
                                 <p class="text-navy-dark font-bold text-xl">Oct 24, 2026</p>
                             </div>
                         </div>
                         
                         <div class="relative pl-8 border-l-2 border-slate-100 space-y-8">
                             <div class="relative">
                                 <div class="absolute -left-[39px] w-5 h-5 bg-emerald-500 rounded-full border-4 border-white shadow-md"></div>
                                 <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Today, 09:30 AM</p>
                                 <p class="text-navy-dark font-bold">Arrived at Destination Hub</p>
                                 <p class="text-sm text-slate-500">Lagos, Nigeria</p>
                             </div>
                             <div class="relative opacity-50">
                                 <div class="absolute -left-[39px] w-5 h-5 bg-slate-200 rounded-full border-4 border-white"></div>
                                 <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Yesterday, 14:00 PM</p>
                                 <p class="text-navy-dark font-bold">Departed Origin Facility</p>
                                 <p class="text-sm text-slate-500">Guangzhou, China</p>
                             </div>
                         </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <p class="text-slate-500 mb-4">Having trouble?</p>
                    <a href="{{ route('contact') }}" class="text-navy-dark font-bold underline hover:text-amber-brand transition-colors">Contact Support</a>
                </div>
            </div>
        </div>
    </section>

@endsection
