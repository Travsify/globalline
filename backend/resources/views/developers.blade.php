@extends('layouts.public')

@section('title', 'Developers | The Trade API Infrastructure')

@section('content')
<main class="bg-navy-dark min-h-screen pt-20 overflow-hidden">

    <!-- 1. INFRASTRUCTURE HERO -->
    <section class="relative pt-32 pb-48 flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-b from-navy/90 via-navy-dark/95 to-navy-dark z-10"></div>
             <!-- Matrix-like digital grid background -->
             <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(0,123,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,123,255,0.1) 1px, transparent 1px); background-size: 50px 50px;"></div>
             <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] bg-blue-600/5 rounded-full blur-[140px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md mb-8" data-aos="fade-up">
                <span class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">GlobalLine API :: v2.8 Standard</span>
            </div>
            <h1 class="text-6xl md:text-8xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up">
                Build the <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-white to-white/40 italic">Rails.</span>
            </h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Embed global sourcing, instant trade finance, and logistics tracking directly into your own applications with our robust REST API.
            </p>
        </div>
    </section>

    <!-- 2. REST API DOCUMENTATION (Code Snippet) -->
    <section class="py-24 relative z-20 -mt-32">
        <div class="container mx-auto px-6 text-center mb-12">
             <h2 class="text-4xl font-bold text-white mb-6">Designed for Engineers.</h2>
        </div>
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto bg-slate-900 rounded-[3rem] p-10 lg:p-20 shadow-3xl border border-slate-800" data-aos="zoom-in">
                 <div class="flex items-center justify-between mb-8">
                     <div class="flex gap-2">
                         <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                         <div class="w-2.5 h-2.5 rounded-full bg-amber-brand"></div>
                         <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                     </div>
                     <div class="text-[10px] font-mono text-white/20 uppercase tracking-widest">POST /v2/shipments/create</div>
                 </div>
                 
                 <div class="font-mono text-[13px] md:text-[15px] leading-relaxed">
<pre class="text-blue-400">
<span class="text-white">curl</span> -X POST https://api.globalline.io/v2/shipments \
  -H <span class="text-emerald-400">"Authorization: Bearer GL_LIVE_TOKEN"</span> \
  -H <span class="text-emerald-400">"Content-Type: application/json"</span> \
  -d '{
    <span class="text-white/60">"origin_node":</span> <span class="text-amber-brand">"CN-GZ"</span>,
    <span class="text-white/60">"destination_node":</span> <span class="text-amber-brand">"NG-LOS"</span>,
    <span class="text-white/60">"cargo_type":</span> <span class="text-amber-brand">"ELECTRONICS"</span>,
    <span class="text-white/60">"insurance":</span> <span class="text-amber-brand">true</span>,
    <span class="text-white/60">"auto_settle":</span> <span class="text-amber-brand">true</span>
  }'
</pre>
                 </div>
            </div>
        </div>
    </section>

    <!-- 3. GLOBAL WEBHOOK ENGINE -->
    <section class="py-32 bg-navy relative border-y border-white/5 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-blue-400 font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block font-mono">System Events</span>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-white mb-8">Live Webhooks. <br>Zero Latency.</h2>
                    <p class="text-white/50 text-lg mb-10 leading-relaxed">
                        Don't poll our API. Listen for events. Get instantly notified when cargo arrives at a hub, customs is cleared, or a supplier payment is settled.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-6 bg-white/5 border border-white/10 rounded-2xl">
                             <code class="text-emerald-400 text-[10px] block mb-2">cargo.node_arrival</code>
                             <p class="text-white/30 text-[9px] uppercase tracking-tighter">Triggered on scan</p>
                        </div>
                        <div class="p-6 bg-white/5 border border-white/10 rounded-2xl">
                             <code class="text-blue-400 text-[10px] block mb-2">payment.settled</code>
                             <p class="text-white/30 text-[9px] uppercase tracking-tighter">Instant RMB/USD link</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                     <div class="relative bg-navy-dark p-12 rounded-[4rem] border border-white/10 text-center">
                          <div class="absolute inset-0 bg-blue-600/5 blur-3xl"></div>
                          <div class="text-6xl font-black text-white/5 font-heading mb-6 tracking-tighter uppercase italic">Real-Time</div>
                          <h4 class="text-white text-2xl font-bold italic tracking-tighter mb-4">Event Streaming.</h4>
                          <p class="text-white/30 text-xs">Propagate logistics state across your entire enterprise architecture in &lt;100ms.</p>
                     </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SDKs & LIBS -->
    <section class="py-32 bg-white text-navy-dark">
        <div class="container mx-auto px-6 text-center">
             <h2 class="text-4xl font-bold font-heading mb-16 italic tracking-tighter">Multi-Language Rails.</h2>
             <div class="flex flex-wrap justify-center gap-12 lg:gap-24 opacity-60">
                  <div class="flex flex-col items-center gap-4">
                       <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center font-bold text-2xl">JS</div>
                       <span class="text-[10px] font-black uppercase tracking-widest">Node.js</span>
                  </div>
                  <div class="flex flex-col items-center gap-4">
                       <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center font-bold text-2xl">Py</div>
                       <span class="text-[10px] font-black uppercase tracking-widest">Python</span>
                  </div>
                  <div class="flex flex-col items-center gap-4">
                       <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center font-bold text-2xl">Go</div>
                       <span class="text-[10px] font-black uppercase tracking-widest">GoLang</span>
                  </div>
                  <div class="flex flex-col items-center gap-4">
                       <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center font-bold text-2xl">PHP</div>
                       <span class="text-[10px] font-black uppercase tracking-widest">Laravel</span>
                  </div>
             </div>
        </div>
    </section>

    <!-- 5. SECURITY & COMPLIANCE -->
    <section class="py-32 bg-navy-dark text-white relative border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2">
                    <h2 class="text-4xl md:text-5xl font-bold font-heading mb-8">Hardened Security.</h2>
                    <p class="text-white/40 text-lg leading-relaxed mb-10">
                        Our API follows PCI-DSS and SOC2 standards for financial and trade security. We support OAuth 2.0, mutual TLS, and granular key permissions to protect your global operations.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4">
                             <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                             <span class="text-sm font-bold uppercase tracking-widest opacity-60">Rotating Access Keys</span>
                        </li>
                        <li class="flex items-center gap-4">
                             <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                             <span class="text-sm font-bold uppercase tracking-widest opacity-60">Endpoint Signing (HMAC)</span>
                        </li>
                        <li class="flex items-center gap-4">
                             <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                             <span class="text-sm font-bold uppercase tracking-widest opacity-60">IP Whitelisting Architecture</span>
                        </li>
                    </ul>
                </div>
                <div class="lg:w-1/2" data-aos="zoom-in">
                     <div class="p-12 bg-white/5 border border-white/10 rounded-[3rem] shadow-3xl text-center">
                          <div class="w-20 h-20 bg-blue-600/20 text-blue-400 rounded-full mx-auto mb-8 flex items-center justify-center border border-blue-600/30">
                             <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                          </div>
                          <h4 class="text-2xl font-bold italic mb-4">SOC2 Ready Infrastructure.</h4>
                          <p class="text-white/30 text-xs">A technical foundation built on the trust requirements of Fortune 500 enterprises.</p>
                     </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. JOIN THE SANDBOX CTA -->
    <section class="py-40 bg-white relative overflow-hidden text-center">
         <div class="container mx-auto px-6 relative z-10">
              <h2 class="text-4xl md:text-7xl font-bold font-heading text-navy-dark mb-8 tracking-tighter">Enter the Sandbox.</h2>
              <p class="text-xl text-slate-500 mb-12 max-w-xl mx-auto">Get your development API keys in minutes and start building on top of the GlobalLine logistics and payment rails.</p>
              <div class="flex justify-center gap-6">
                   <a href="#" class="px-12 py-6 bg-navy-dark text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-blue-600 transition-all shadow-3xl">
                       Request API Access &rarr;
                   </a>
              </div>
         </div>
    </section>

</main>

<style>
    .shadow-3xl {
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.4);
    }
</style>
@endsection
