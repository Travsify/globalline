@extends('layouts.public')

@section('title', 'Control Tower | Real-Time Global Visibility')

@section('content')
<main class="bg-navy-dark min-h-screen pt-20 overflow-hidden" x-data="{ trackingId: '', searched: false }">

    <!-- 1. MISSION CONTROL HERO -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-navy/90 via-navy-dark/95 to-navy-dark z-10"></div>
            <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?q=80&w=2069&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-overlay scale-110" 
                 alt="Control Tower Visual">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-amber-brand/5 rounded-full blur-[150px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md mb-8" data-aos="fade-up">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[10px] font-bold text-white/70 uppercase tracking-widest text-xs">Sat-Link Active :: 99.9% Uptime</span>
            </div>
            <h1 class="text-6xl md:text-8xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up">
                The Control <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand via-white to-white/40">Tower.</span>
            </h1>
            
            <div class="max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                <div class="relative group">
                    <div class="absolute inset-0 bg-amber-brand/10 blur-[40px] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative bg-white/5 border border-white/10 p-2 rounded-3xl backdrop-blur-3xl flex items-center">
                        <input type="text" x-model="trackingId" placeholder="Enter Global Tracking ID (e.g., GL-88921)" 
                               class="w-full bg-transparent border-none text-white font-bold text-xl px-8 py-4 focus:ring-0 placeholder:text-white/20">
                        <button @click="searched = true" class="bg-amber-brand text-navy-dark px-10 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-white transition-all shadow-xl">
                            Initialize Sequence
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. LIVE NODE FEED -->
    <section class="py-12 bg-navy border-y border-white/5 relative z-20">
        <div class="overflow-hidden whitespace-nowrap flex group">
            <div class="flex animate-marquee group-hover:pause gap-12">
                @foreach(['GZ-HUB: Clear', 'LOS-PORT: High Congestion', 'DXB-CARGO: Processing', 'NYC-NODE: Expedited', 'IST-BASE: Online', 'TLV-NODE: Active'] as $status)
                <div class="flex items-center gap-4 text-white/40 text-[10px] font-bold uppercase tracking-[0.3em]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    {{ $status }}
                </div>
                @endforeach
            </div>
            <!-- Duplicate for infinite effect -->
            <div class="flex animate-marquee group-hover:pause gap-12 ml-12">
                @foreach(['GZ-HUB: Clear', 'LOS-PORT: High Congestion', 'DXB-CARGO: Processing', 'NYC-NODE: Expedited', 'IST-BASE: Online', 'TLV-NODE: Active'] as $status)
                <div class="flex items-center gap-4 text-white/40 text-[10px] font-bold uppercase tracking-[0.3em]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    {{ $status }}
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. THE CARGO JOURNEY (Visual Stepper) -->
    <section class="py-32 relative" x-show="searched" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto bg-white/5 border border-white/10 rounded-[4rem] p-12 lg:p-20">
                <div class="flex flex-col lg:flex-row justify-between gap-12 mb-20 relative">
                    <!-- Progress Line -->
                    <div class="absolute top-1/2 left-0 w-full h-0.5 bg-white/5 -translate-y-1/2 hidden lg:block">
                        <div class="h-full bg-amber-brand w-3/4 shadow-[0_0_15px_rgba(255,191,0,0.5)]"></div>
                    </div>
                    
                    @foreach(['Origin Node', 'Hub Sortation', 'International Transit', 'Final Delivery'] as $index => $step)
                    <div class="relative z-10 flex flex-col items-center text-center lg:w-1/4">
                        <div class="w-12 h-12 rounded-full {{ $index < 3 ? 'bg-amber-brand text-navy-dark' : 'bg-white/10 text-white/20' }} border-4 border-navy-dark flex items-center justify-center font-bold mb-4 shadow-xl">
                            {{ $index + 1 }}
                        </div>
                        <h4 class="text-white font-bold text-sm mb-2">{{ $step }}</h4>
                        <p class="text-[9px] text-white/30 uppercase tracking-widest">{{ $index < 3 ? 'Completed' : 'Pending' }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                     <div class="bg-navy-dark/50 p-10 rounded-3xl border border-white/5 font-mono">
                         <h5 class="text-amber-brand text-[10px] font-bold mb-6 uppercase tracking-widest">History Log :: GL-{{ rand(10000,99999) }}</h5>
                         <div class="space-y-6">
                             <div class="flex gap-4">
                                 <span class="text-emerald-500 font-bold shrink-0">14:20</span>
                                 <span class="text-white/60 text-xs">Arrived at Lagos-LOS Port Concentration Node</span>
                             </div>
                             <div class="flex gap-4">
                                 <span class="text-white/20 font-bold shrink-0">08:14</span>
                                 <span class="text-white/40 text-xs">Departed Guangzhou-GZ Int'l Sortation</span>
                             </div>
                             <div class="flex gap-4">
                                 <span class="text-white/20 font-bold shrink-0">YEST.</span>
                                 <span class="text-white/40 text-xs">Picked up from Supplier Factory (Shenzhen)</span>
                             </div>
                         </div>
                     </div>
                     <div class="flex flex-col justify-center">
                         <h3 class="text-3xl font-bold text-white mb-6">In Bound : Lagos.</h3>
                         <p class="text-white/40 mb-8 leading-relaxed">Your shipment is currently undergoing digital clearance at the primary destination port. Estimated release: <span class="text-white font-bold font-mono">6h 12m</span>.</p>
                         <div class="flex gap-4">
                             <a href="#" class="px-6 py-3 bg-white/10 border border-white/10 text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-white/20">View Invoice</a>
                             <a href="#" class="px-6 py-3 bg-blue-600/20 border border-blue-600/30 text-blue-400 rounded-xl text-xs font-bold uppercase tracking-widest">Insurance Cert.</a>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. VISIBILITY BENTO (Features) -->
    <section class="py-32 bg-white text-navy-dark relative">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                 <span class="text-amber-brand font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block">Platform Pillars</span>
                 <h2 class="text-4xl md:text-5xl font-bold font-heading mb-6 tracking-tighter">Radical Transparency.</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                 <div class="bg-slate-50 p-10 rounded-[3rem] border border-slate-100 group hover:bg-navy-dark hover:text-white transition-all duration-500">
                      <div class="w-12 h-12 bg-amber-brand rounded-2xl mb-8 flex items-center justify-center text-navy-dark group-hover:scale-110 transition-transform">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                      </div>
                      <h4 class="text-2xl font-bold mb-4">Precision GPS</h4>
                      <p class="text-sm opacity-50 leading-relaxed">Real-time satellite tracking for sea and air freight. Know exactly where your goods are, anytime.</p>
                 </div>
                 <div class="bg-slate-50 p-10 rounded-[3rem] border border-slate-100 group hover:bg-navy-dark hover:text-white transition-all duration-500">
                      <div class="w-12 h-12 bg-blue-500 rounded-2xl mb-8 flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                      </div>
                      <h4 class="text-2xl font-bold mb-4">Cloud Records</h4>
                      <p class="text-sm opacity-50 leading-relaxed">Every document, invoice, and inspection photo is archived in the cloud forever. No more lost papers.</p>
                 </div>
                 <div class="bg-slate-50 p-10 rounded-[3rem] border border-slate-100 group hover:bg-navy-dark hover:text-white transition-all duration-500">
                      <div class="w-12 h-12 bg-emerald-500 rounded-2xl mb-8 flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                      </div>
                      <h4 class="text-2xl font-bold mb-4">Predictive ETA</h4>
                      <p class="text-sm opacity-50 leading-relaxed">Our AI analyzes weather, port congestion, and flight data to provide hyper-accurate arrival times.</p>
                 </div>
            </div>
        </div>
    </section>

    <!-- 5. NODE STATUS MONITOR -->
    <section class="py-32 bg-navy-dark text-white relative border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                 <div class="lg:w-1/2">
                      <h2 class="text-4xl md:text-5xl font-bold font-heading mb-8">Node Health <br>Monitor.</h2>
                      <p class="text-white/40 mb-10 text-lg leading-relaxed">GlobalLine maintains a live pulse on major trade artery health. We route around congestion so you don't have to wait.</p>
                 </div>
                 <div class="lg:w-1/2 grid grid-cols-2 gap-4">
                      @foreach(['Guangzhou HUb', 'Lagos Port', 'Turkey Exit', 'USA Gateway'] as $node)
                      <div class="p-6 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-between">
                           <span class="text-xs uppercase font-bold tracking-widest">{{ $node }}</span>
                           <div class="flex items-center gap-2">
                               <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                               <span class="text-[9px] font-black uppercase text-emerald-500">Nominal</span>
                           </div>
                      </div>
                      @endforeach
                 </div>
            </div>
        </div>
    </section>

    <!-- 6. UNIFIED TRACK CTA -->
    <section class="py-40 bg-white relative overflow-hidden text-center">
         <div class="container mx-auto px-6 relative z-10">
              <h2 class="text-4xl md:text-7xl font-bold font-heading text-navy-dark mb-8 tracking-tighter">Never lose sight.</h2>
              <p class="text-xl text-slate-500 mb-12 max-w-xl mx-auto">Create an account to save tracking IDs, toggle SMS notifications, and manage all your global movements in one dashboard.</p>
              <div class="flex justify-center gap-6">
                   <a href="{{ route('register') }}" class="px-12 py-6 bg-navy-dark text-white rounded-[2rem] font-bold uppercase tracking-widest text-xs hover:bg-amber-brand hover:text-navy-dark transition-all shadow-3xl">
                       Get Started For Free
                   </a>
              </div>
         </div>
    </section>

</main>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 30s linear infinite;
    }
    .pause {
        animation-play-state: paused;
    }
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-ping-slow {
        animation: ping 3s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    .shadow-3xl {
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.3);
    }
</style>
@endsection
