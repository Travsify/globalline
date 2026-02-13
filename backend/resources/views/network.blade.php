@extends('layouts.public')

@section('title', 'Global Network Map | Our Nodes & Arteries')

@section('content')
<main class="bg-navy-dark min-h-screen pt-20 overflow-hidden" x-data="{ activeNode: 'GZ' }">

    <!-- 1. THE GLOBAL GRID HERO -->
    <section class="relative pt-32 pb-48 flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-b from-navy/90 via-navy-dark/95 to-navy-dark z-10"></div>
             <!-- Large abstract world map or dots pattern -->
             <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 40px 40px;"></div>
             <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1000px] h-[1000px] bg-blue-600/5 rounded-full blur-[150px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-20 text-center">
            <span class="text-amber-brand mb-6 block platform-label" data-aos="fade-up">Physical Infrastructure</span>
            <h1 class="text-6xl md:text-9xl font-bold font-heading text-white mb-8 tracking-tighter" data-aos="fade-up">
                Trade Without <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand via-white to-white/40 italic">Borders.</span>
            </h1>
            <p class="max-w-2xl mx-auto leading-relaxed platform-body text-white/50" data-aos="fade-up" data-aos-delay="100">
                A dense mesh of proprietary nodes, strategic hubs, and digital arteries spanning 220 countries and territories.
            </p>
        </div>

        <!-- Float Mapping Nodes -->
        <div class="absolute bottom-10 left-10 p-6 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-xl hidden lg:block" data-aos="fade-right">
             <div class="flex items-center gap-4 text-white/40 platform-label">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                  Active Connections :: 4,892
             </div>
        </div>
    </section>

    <!-- 2. INTERACTIVE NODE CARDS -->
    <section class="py-24 relative z-20 -mt-32">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                 @foreach([
                    ['id' => 'GZ', 'city' => 'Guangzhou', 'country' => 'China', 'type' => 'Primary Sourcing Hub', 'img' => 'https://images.unsplash.com/photo-1578319439584-104c94d37305?q=80&w=2070&auto=format&fit=crop'],
                    ['id' => 'LOS', 'city' => 'Lagos', 'country' => 'Nigeria', 'type' => 'Strategic West Africa Node', 'img' => 'https://images.unsplash.com/photo-1541844053589-3d041c59ef4a?q=80&w=2070&auto=format&fit=crop'],
                    ['id' => 'DXB', 'city' => 'Dubai', 'country' => 'UAE', 'type' => 'Global Transit Gateway', 'img' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?q=80&w=2070&auto=format&fit=crop'],
                    ['id' => 'NYC', 'city' => 'New York', 'country' => 'USA', 'type' => 'North America Terminal', 'img' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e3e9?q=80&w=2070&auto=format&fit=crop']
                 ] as $node)
                 <div class="group relative aspect-[3/4] rounded-[2.5rem] overflow-hidden border border-white/10 transition-all hover:-translate-y-4" 
                      @mouseenter="activeNode = '{{ $node['id'] }}'" data-aos="fade-up">
                      <img src="{{ $node['img'] }}" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:opacity-60 transition-all duration-700">
                      <div class="absolute inset-0 bg-gradient-to-t from-navy-dark via-navy-dark/40 to-transparent"></div>
                      <div class="absolute bottom-0 left-0 p-10 w-full">
                           <p class="text-amber-brand mb-2 platform-label">{{ $node['country'] }}</p>
                           <h3 class="text-3xl font-bold text-white mb-4">{{ $node['city'] }}</h3>
                           <p class="text-white/40 leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity platform-body">{{ $node['type'] }}</p>
                      </div>
                 </div>
                 @endforeach
            </div>
        </div>
    </section>

    <!-- 3. CONNECTIVITY STATS -->
    <section class="py-32 bg-navy relative border-y border-white/5">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                 <div data-aos="zoom-in">
                      <div class="text-5xl font-bold font-heading text-white mb-4">220+</div>
                      <p class="text-white/20 platform-label">Countries Reached</p>
                 </div>
                 <div data-aos="zoom-in" data-aos-delay="100">
                      <div class="text-5xl font-bold font-heading text-emerald-400 mb-4">48h</div>
                      <p class="text-white/20 platform-label">Avg Node-to-Node Transfer</p>
                 </div>
                 <div data-aos="zoom-in" data-aos-delay="200">
                      <div class="text-5xl font-bold font-heading text-amber-brand mb-4">Master</div>
                      <p class="text-white/20 platform-label">Global Logistics License</p>
                 </div>
            </div>
        </div>
    </section>

    <!-- 4. THE ROUTING PROTOCOL (Algorithm) -->
    <section class="py-32 bg-white text-navy-dark">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <span class="text-amber-brand mb-6 block platform-label">Intelligent Logistics</span>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-navy-dark mb-8 tracking-tighter">Dynamic Pathing <br>Optimization.</h2>
                    <p class="text-slate-600 mb-10 leading-relaxed platform-body">
                        Our routing engine doesn't just look for the cheapest route—it constantly updates based on port congestion, flight availability, and customs speed to find the absolute fastest path for your cargo.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-full bg-navy-dark text-white flex items-center justify-center font-bold text-xs italic">1</span>
                            <span class="text-sm font-bold opacity-60">Source Concentration Nodes (Guangzhou / Yiwu)</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-full bg-navy-dark text-white flex items-center justify-center font-bold text-xs italic">2</span>
                            <span class="text-sm font-bold opacity-60">Multi-Modal Transit (Sea/Air Hybrid)</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-full bg-navy-dark text-white flex items-center justify-center font-bold text-xs italic">3</span>
                            <span class="text-sm font-bold opacity-60">Last Mile Digital Handshake</span>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                     <div class="bg-navy-dark p-12 rounded-[4rem] text-white relative group overflow-hidden shadow-3xl">
                          <div class="absolute inset-0 bg-blue-600/10 mix-blend-overlay"></div>
                          <h4 class="text-xs font-bold text-white/20 uppercase tracking-[0.3em] mb-8 font-mono">Routing Protocol :: ACTIVE_STREAM_08</h4>
                          <div class="space-y-6">
                               <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-brand w-3/4 animate-expand"></div>
                               </div>
                               <p class="text-[10px] font-mono text-emerald-400">OPTIMIZING_ROUTE: CN-GZ &rarr; UAE-DXB &rarr; NG-LOS</p>
                               <p class="text-[10px] text-white/30 italic">Congestion at Lagos Sea Port detected. Re-routing priority air express to Murtala Muhammed Node.</p>
                          </div>
                     </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. ON-THE-GROUND PRESENCE -->
    <section class="py-32 bg-navy-dark text-white relative border-t border-white/5">
        <div class="container mx-auto px-6">
             <div class="text-center mb-20">
                 <h2 class="text-4xl font-bold font-heading mb-6 italic tracking-tighter">Concrete & Steel.</h2>
                 <p class="text-white/40 max-w-2xl mx-auto">While we are tech-first, we are built on physical dominance. Over 1,000,000 sq ft of warehouse space under management.</p>
             </div>
             <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <div class="relative h-96 rounded-[3rem] overflow-hidden group" data-aos="fade-up">
                       <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                       <div class="absolute inset-0 bg-navy-dark/20 group-hover:bg-navy-dark/0 transition-all"></div>
                       <div class="absolute bottom-10 left-10 text-white">
                            <h4 class="text-2xl font-bold italic">High-Cap Distribution Center</h4>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-amber-brand">Guangzhou, CN</p>
                       </div>
                  </div>
                  <div class="relative h-96 rounded-[3rem] overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                       <img src="https://images.unsplash.com/photo-1494412574643-35d3d1706f28?q=80&w=1974&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                       <div class="absolute inset-0 bg-navy-dark/20 group-hover:bg-navy-dark/0 transition-all"></div>
                       <div class="absolute bottom-10 left-10 text-white">
                            <h4 class="text-2xl font-bold italic">Port Concentration Node</h4>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-blue-500">Lagos, NG</p>
                       </div>
                  </div>
             </div>
        </div>
    </section>

    <!-- 6. NETWORK EXPANSION CTA -->
    <section class="py-40 bg-white relative overflow-hidden text-center">
         <div class="container mx-auto px-6 relative z-10">
              <h2 class="text-4xl md:text-7xl font-bold font-heading text-navy-dark mb-8 tracking-tighter">Expand the grid.</h2>
              <p class="text-xl text-slate-500 mb-12 max-w-xl mx-auto">Want to join or utilize the GlobalLine node network? Enterprise accounts unlock the full power of our physical infrastructure.</p>
              <div class="flex justify-center gap-6">
                   <a href="{{ route('register') }}" class="px-12 py-6 bg-navy-dark text-white rounded-full font-bold uppercase tracking-widest text-xs hover:bg-amber-brand hover:text-navy-dark transition-all shadow-3xl">
                       Establish Connection &rarr;
                   </a>
              </div>
         </div>
    </section>

</main>

<style>
    @keyframes expand {
        0% { width: 0%; }
        100% { width: 75%; }
    }
    .animate-expand {
        animation: expand 3s cubic-bezier(0.65, 0, 0.35, 1) forwards;
    }
    .shadow-3xl {
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.4);
    }
</style>
@endsection
