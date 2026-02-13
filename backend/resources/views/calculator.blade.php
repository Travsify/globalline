@extends('layouts.public')

@section('title', 'Shipping Calculator | Precise Cost Projections')

@section('content')
<main class="bg-navy-dark min-h-screen pt-20" x-data="{ 
    weight: 5, 
    volume: 0.1, 
    source: 'GZ', 
    destination: 'LOS',
    baseRate: 450,
    calculate() {
        return (this.weight * 5.5 + this.volume * 200 + this.baseRate).toFixed(2);
    }
}">

    <!-- 1. THE CALCULATOR HERO -->
    <section class="relative py-32 overflow-hidden border-b border-white/5">
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-6xl md:text-8xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up">
                Zero <span class="text-amber-brand italic">Guesstimates.</span>
            </h1>
            <p class="text-white/50 max-w-2xl mx-auto leading-relaxed mb-12 platform-body" data-aos="fade-up" data-aos-delay="100">
                Landed cost complexity is now a solved problem. Use our spatial engine to project exact shipping, duty, and handling fees.
            </p>
        </div>
        <!-- Background elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none">
             <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px]"></div>
             <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-amber-brand/5 rounded-full blur-[100px]"></div>
        </div>
    </section>

    <!-- 2. THE INTERACTIVE ENGINE -->
    <section class="py-24 relative z-20 -mt-20">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto bg-white/5 backdrop-blur-3xl border border-white/10 rounded-[4rem] p-12 lg:p-20 shadow-3xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                    <div class="space-y-12">
                        <div>
                            <label class="block text-white/40 mb-6 platform-label">Cargo Geography</label>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <span class="text-white/20 platform-label uppercase">Origin Node</span>
                                    <select x-model="source" class="w-full bg-navy-dark border border-white/10 rounded-2xl p-4 text-white focus:border-amber-brand focus:ring-0 transition-all">
                                        <option value="GZ">Guangzhou (CN)</option>
                                        <option value="DXB">Dubai (UAE)</option>
                                        <option value="NYC">New York (US)</option>
                                        <option value="IST">Istanbul (TR)</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <span class="text-white/20 platform-label uppercase">Destination Node</span>
                                    <select x-model="destination" class="w-full bg-navy-dark border border-white/10 rounded-2xl p-4 text-white focus:border-amber-brand focus:ring-0 transition-all">
                                        <option value="LOS">Lagos (NG)</option>
                                        <option value="ACC">Accra (GH)</option>
                                        <option value="LHR">London (UK)</option>
                                        <option value="DXB">Dubai (UAE)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                             <div>
                                <div class="flex justify-between items-center mb-4">
                                     <label class="text-white/40 platform-label">Estimated Weight (KG)</label>
                                     <span class="text-amber-brand font-mono font-bold" x-text="weight"></span>
                                </div>
                                <input type="range" min="1" max="1000" x-model="weight" class="w-full accent-amber-brand bg-white/10 h-1 rounded-full appearance-none cursor-pointer">
                             </div>
                             <div>
                                <div class="flex justify-between items-center mb-4">
                                     <label class="text-white/40 platform-label">Volumetric Volume (CBM)</label>
                                     <span class="text-amber-brand font-mono font-bold" x-text="volume"></span>
                                </div>
                                <input type="range" min="0.1" max="10" step="0.1" x-model="volume" class="w-full accent-blue-500 bg-white/10 h-1 rounded-full appearance-none cursor-pointer">
                             </div>
                        </div>
                    </div>

                    <div class="bg-navy-dark/50 p-12 rounded-[3.5rem] border border-white/10 flex flex-col justify-between">
                         <div>
                             <h3 class="text-white/30 mb-10 platform-label uppercase">Live Quotation Pipeline</h3>
                             <div class="space-y-6 mb-12">
                                 <div class="flex justify-between text-white/50 text-sm">
                                     <span>Freight (Air Express)</span>
                                     <span class="text-white font-mono">$ <span x-text="(weight * 5.5).toFixed(2)"></span></span>
                                 </div>
                                 <div class="flex justify-between text-white/50 text-sm">
                                     <span>Handling & Duty</span>
                                     <span class="text-white font-mono">$ <span x-text="(volume * 200).toFixed(2)"></span></span>
                                 </div>
                                 <div class="flex justify-between text-white/50 text-sm">
                                     <span>Consolidation (Node GZ)</span>
                                     <span class="text-white font-mono">$ <span x-text="baseRate"></span></span>
                                 </div>
                             </div>
                         </div>
                         <div class="pt-10 border-t border-white/10">
                             <p class="text-amber-brand mb-2 platform-label uppercase">Total Landed Estimate</p>
                             <div class="text-6xl font-bold text-white font-heading tracking-tighter">$ <span x-text="calculate()"></span></div>
                             <p class="text-white/20 mt-4 italic platform-body">*Estimates include door-to-door clearing for most standard nodes.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VOLUMETRIC EXPLAINER -->
    <section class="py-32 bg-navy relative border-y border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <h2 class="text-4xl font-bold text-white mb-8">Understanding <br><span class="text-amber-brand">Volumetric Weight.</span></h2>
                    <p class="text-white/40 leading-relaxed mb-8 platform-body">
                        Most legacy shippers hide their formulas. We don't. Our calculator uses a 1:6000 ratio for air and 1:3000 for express, ensuring you never pay for "ghost volume."
                    </p>
                    <div class="p-8 bg-white/5 border border-white/10 rounded-3xl font-mono text-emerald-400 text-sm">
                        (Length * Width * Height) / 6000 = KG equivalent
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="relative group">
                         <div class="absolute inset-0 bg-blue-600/20 blur-[100px]"></div>
                         <div class="relative bg-navy-dark p-12 rounded-[4rem] border border-white/10">
                              <div class="text-white/20 mb-8 platform-label uppercase">Algorithm Spotlight :: SPATIAL_EFFICIENCY_V2</div>
                              <h4 class="text-white text-2xl font-bold mb-4 italic">Repackaging Protocol.</h4>
                              <p class="text-white/40 leading-relaxed platform-body">Our warehouse robots automatically calculate if repacking your items into a smaller footprint can trigger a lower volumetric tier.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. DUTY & COMPLIANCE ENGINE -->
    <section class="py-32 bg-white text-navy-dark">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center mb-20">
                 <h2 class="text-4xl md:text-5xl font-bold font-heading mb-8">Dynamic Duty Predictions.</h2>
                 <p class="text-slate-500 text-lg">
                    Global tax codes change daily. Our engine links directly with customs databases in 220+ countries to provide real-time duty estimates based on HS-Code classification.
                 </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                 <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100" data-aos="fade-up">
                      <h4 class="text-xl font-bold mb-4 uppercase italic">HS-Intelligence</h4>
                      <p class="text-sm text-slate-500">Auto-classification of goods to prevent fines and duty overpayment.</p>
                 </div>
                 <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100" data-aos="fade-up" data-aos-delay="100">
                      <h4 class="text-xl font-bold mb-4 uppercase italic">VAT Reclaims</h4>
                      <p class="text-sm text-slate-500">GlobalLine automatically processes export tax reclaims where applicable.</p>
                 </div>
                 <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100" data-aos="fade-up" data-aos-delay="200">
                      <h4 class="text-xl font-bold mb-4 uppercase italic">Zero Hidden Fees</h4>
                      <p class="text-sm text-slate-500">What you see is what you pay. No surprise "brokerage" or "documentation" fees.</p>
                 </div>
            </div>
        </div>
    </section>

    <!-- 5. THE SCALE FACTOR -->
    <section class="py-32 bg-navy-dark text-white relative border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                 <div class="lg:w-1/2">
                      <h2 class="text-4xl font-bold font-heading mb-8">Scale Up. <br>Pay Less.</h2>
                      <p class="text-white/40 text-lg mb-10 leading-relaxed">
                         The more you ship, the lower your base rate. High-volume merchants auto-unlock the **"Titan Tier"** pricing, reducing freight costs by an additional 15%.
                      </p>
                 </div>
                 <div class="lg:w-1/2 grid grid-cols-2 gap-4" data-aos="zoom-in">
                      <div class="p-8 bg-white/5 border border-white/10 rounded-2xl">
                           <div class="text-emerald-400 font-bold mb-1">STANDARD</div>
                           <p class="text-[10px] text-white/30 uppercase">0 - 500 KG / mo</p>
                      </div>
                      <div class="p-8 bg-amber-brand/10 border border-amber-brand/30 rounded-2xl">
                           <div class="text-amber-brand font-bold mb-1">TITAN</div>
                           <p class="text-[10px] text-amber-brand/60 uppercase">500KG+ / mo</p>
                      </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- 6. SHIP NOW CTA -->
    <section class="py-40 bg-white relative overflow-hidden text-center">
         <div class="container mx-auto px-6 relative z-10">
             <h2 class="text-4xl md:text-7xl font-bold font-heading text-navy-dark mb-8 tracking-tighter">Ready to initiate?</h2>
             <a href="{{ route('register') }}" class="px-12 py-6 bg-navy-dark text-white rounded-full transition-all shadow-3xl platform-label hover:bg-amber-brand hover:text-navy-dark">
                 Secure This Rate &rarr;
             </a>
         </div>
    </section>

</main>
@endsection
