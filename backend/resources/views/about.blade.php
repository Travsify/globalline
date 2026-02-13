@extends('layouts.public')

@section('title', 'About | The GlobalLine Manifesto')

@section('content')
<main class="bg-navy-dark min-h-screen pt-20 overflow-hidden">

    <!-- 1. THE GLOBAL MANIFESTO (Hero) -->
    <section class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-navy/90 via-navy-dark/95 to-navy-dark z-10"></div>
            <!-- High-quality abstract network/trade background -->
            <img src="https://images.unsplash.com/photo-1549439602-43ebca2327af?q=80&w=2070&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay scale-105 animate-pulse-slow" 
                 alt="Global Logistic Manifesto">
            
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-amber-brand/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-5xl" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md mb-8">
                    <span class="w-2 h-2 rounded-full bg-amber-brand animate-ping"></span>
                    <span class="text-white/80 platform-label">GlobalLine Network :: Established 2018</span>
                </div>

                <h1 class="text-6xl md:text-9xl font-bold font-heading text-white leading-[0.85] mb-8 tracking-tighter">
                    Rewiring <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand via-white to-white/40 italic">Global Trade.</span>
                </h1>
                
                <p class="mb-12 max-w-3xl leading-relaxed platform-body text-white/50">
                    Logistics is the heartbeat of civilization. We are building the operating system that makes it beat faster, smarter, and without friction.
                </p>

                <div class="flex flex-wrap gap-6">
                     <a href="{{ route('register') }}" class="px-10 py-5 bg-amber-brand text-navy-dark rounded-2xl font-bold uppercase tracking-widest text-xs transition-all hover:bg-amber-light shadow-3xl hover:shadow-amber-brand/40">
                        Join the Revolution
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. THE LEGACY GAP (Problem/Solution) -->
    <section class="py-32 bg-navy relative border-t border-white/5 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-white mb-8">The Legacy Gap.</h2>
                    <p class="text-white/50 mb-10 leading-relaxed platform-body">
                        Traditional trade is trapped in a pre-digital era—bogged down by manual paperwork, shadow-pricing, and fragmented agents.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-6 p-6 bg-white/5 border border-white/10 rounded-3xl group hover:bg-white/10 transition-all">
                            <div class="w-12 h-12 rounded-2xl bg-red-500/10 flex items-center justify-center text-red-500 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Legacy Logistics</h4>
                                <p class="text-white/40 platform-body">Manual entries, 3-week delays, hidden markups, and fax machines.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 p-6 bg-amber-brand/10 border border-amber-brand/20 rounded-3xl animate-float">
                            <div class="w-12 h-12 rounded-2xl bg-amber-brand flex items-center justify-center text-navy-dark shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-amber-brand font-bold mb-1">GlobalLine OS</h4>
                                <p class="text-amber-brand/60 platform-body">API-first automation, instant global payments, and total transparency.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Visual Comparison Grid -->
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="aspect-square bg-white/5 border border-white/10 rounded-[2.5rem] p-8 flex flex-col justify-between">
                            <span class="text-white/20 platform-label">Speed</span>
                            <div class="text-3xl font-bold text-white italic">+400%</div>
                        </div>
                        <div class="aspect-square bg-white/5 border border-white/10 rounded-[2.5rem] p-8 flex flex-col justify-between">
                            <span class="text-white/20 platform-label">Transparency</span>
                            <div class="text-3xl font-bold text-emerald-500 italic">Total</div>
                        </div>
                        <div class="aspect-square bg-white/5 border border-white/10 rounded-[2.5rem] p-8 flex flex-col justify-between">
                            <span class="text-white/20 platform-label">Cost Redux</span>
                            <div class="text-3xl font-bold text-amber-brand italic">-30%</div>
                        </div>
                        <div class="aspect-square bg-white/5 border border-white/10 rounded-[2.5rem] p-8 flex flex-col justify-between">
                            <span class="text-white/20 platform-label">Human Error</span>
                            <div class="text-3xl font-bold text-red-500 italic">0.02%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. OUR FEET ON THE GROUND (Global Network) -->
    <section class="py-32 bg-white text-navy-dark relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row-reverse items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-left">
                    <span class="text-amber-brand mb-6 block platform-label">Physical Infrastructure</span>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-navy-dark mb-8">Hardware Logistics. <br>Software Speed.</h2>
                    <p class="text-slate-600 mb-10 leading-relaxed platform-body">
                        We aren't just a technical layer. We operate a massive physical network of owned warehouses, audited factory nodes, and local customs agents across 220 countries.
                    </p>
                    <div class="flex gap-4">
                        <div class="px-6 py-3 bg-slate-100 rounded-xl platform-label">Guangzhou Hub</div>
                        <div class="px-6 py-3 bg-slate-100 rounded-xl platform-label">Lagos Port</div>
                        <div class="px-6 py-3 bg-slate-100 rounded-xl platform-label">Dubai Gateway</div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="relative rounded-[3.5rem] overflow-hidden shadow-3xl">
                        <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto" alt="Global Hubs">
                        <div class="absolute inset-0 bg-navy-dark/10 mix-blend-multiply"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                             <div class="w-20 h-20 bg-amber-brand rounded-full flex items-center justify-center animate-ping opacity-25"></div>
                             <div class="absolute top-0 w-20 h-20 bg-amber-brand rounded-full flex items-center justify-center shadow-2xl">
                                <svg class="w-8 h-8 text-navy-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. BUILT BY BUILDERS (Technology) -->
    <section class="py-32 bg-navy-dark text-white relative">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                 <h2 class="text-4xl md:text-6xl font-bold font-heading mb-8">Software DNA.</h2>
                 <p class="text-white/50 text-xl leading-relaxed mb-16">
                    GlobalLine was founded by engineers and trade veterans. We don't use 3rd party legacy systems—we write our own code to automate everything from duty calculation to 1-tap supplier payments.
                 </p>
                 
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                     <div class="p-8 bg-white/5 border border-white/10 rounded-3xl hover:bg-white/10 transition-all">
                         <div class="w-10 h-10 bg-amber-brand rounded-xl flex items-center justify-center text-navy-dark mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                         </div>
                         <h4 class="text-lg font-bold mb-2">API-First</h4>
                         <p class="text-white/40 leading-relaxed platform-body">Every logistics event is an endpoint. Real-time integration for your ERP.</p>
                     </div>
                     <div class="p-8 bg-white/5 border border-white/10 rounded-3xl hover:bg-white/10 transition-all">
                         <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                         </div>
                         <h4 class="text-lg font-bold mb-2">Security-Native</h4>
                         <p class="text-white/40 leading-relaxed platform-body">Enterprise-grade encryption for all trade data and financial settlements.</p>
                     </div>
                     <div class="p-8 bg-white/5 border border-white/10 rounded-3xl hover:bg-white/10 transition-all">
                         <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m2-1l-2-1m2 1l2 1m-2-1l2-1m-4 10l4-1m-4 1l-1-2m1 2l1 2m3-1l1 2M9 21l-4-1m4 1l1-2M5 20l-1-2m1 2l1 2m-1-4l1-2m2 5l-2-1m2 1l1-2m-3 1l-1-2m14-9l4-1m-4 1l1-2m-1 2l-1-2m4 1l-1 2M9 3l4 1m-4-1l-1 2M9 3l1 2m3-1l1 2m-1-2l1-2"></path></svg>
                         </div>
                         <h4 class="text-lg font-bold mb-2">Self-Optimizing</h4>
                         <p class="text-white/40 leading-relaxed platform-body">AI that learns from millions of data points to find the best routes instantly.</p>
                     </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- 5. PROOF OF SCALE (The Numbers) -->
    <section class="py-32 bg-slate-50 relative border-y border-slate-200">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-navy-dark mb-16 platform-label">Global Traction.</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div data-aos="zoom-in">
                    <p class="text-6xl font-bold font-heading text-navy-dark mb-4">$1.4B+</p>
                    <p class="text-slate-400 platform-label uppercase">Managed Trade Value</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="100">
                    <p class="text-6xl font-bold font-heading text-navy-dark mb-4">15k+</p>
                    <p class="text-slate-400 platform-label uppercase">Global Enterprise Clients</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="200">
                    <p class="text-6xl font-bold font-heading text-navy-dark mb-4">99.9%</p>
                    <p class="text-slate-400 platform-label uppercase">Clearance Success Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. THE INVITATION (High-Conversion CTA) -->
    <section class="py-40 bg-navy-dark relative overflow-hidden text-center">
         <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('https://images.unsplash.com/photo-1549439602-43ebca2327af?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl md:text-7xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up">The future is global. <br>Build it with us.</h2>
            <p class="text-white/40 mb-12 max-w-xl mx-auto platform-body" data-aos="fade-up" data-aos-delay="100">Don't settle for legacy logistics. Switch to the OS for global trade.</p>
            <div class="flex justify-center flex-wrap gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('register') }}" class="px-12 py-6 bg-amber-brand text-navy-dark rounded-[2.5rem] transition-all hover:bg-amber-light shadow-3xl hover:shadow-amber-brand/40 platform-label">
                    Initialize Setup &rarr;
                </a>
            </div>
        </div>
    </section>

</main>
@endsection

<style>
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    .animate-pulse-slow {
        animation: pulse 12s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    .shadow-3xl {
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.5);
    }
</style>
