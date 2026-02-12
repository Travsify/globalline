@extends('layouts.public')

@section('title', 'GlobalLine | Direct Factory Access for African Enterprise')

@section('content')

    <!-- [SECTION 1] The Global Gateway: White-label Hero -->
    <header class="relative min-h-[90vh] flex items-center pt-24 overflow-hidden bg-brand-navy font-sans">
        <!-- Intelligent Depth Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-154919438c-f4c635f199bc?auto=format&fit=crop&w=2400&q=80" 
                 class="w-full h-full object-cover opacity-10 scale-105" alt="Global Trade Network">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-navy via-brand-navy/95 to-[#050810]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <!-- Deployment Pulse -->
                <div class="inline-flex items-center px-4 py-1.5 bg-brand-gold/5 border border-brand-gold/10 rounded-full backdrop-blur-md mb-10">
                    <span class="w-1.5 h-1.5 bg-brand-gold rounded-full mr-3 animate-pulse"></span>
                    <p class="text-[9px] font-bold text-brand-gold/80 uppercase tracking-[0.3em]">GlobalLine Trade Protocol Active</p>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold text-white leading-[1.1] mb-8 tracking-tight">
                    Direct Access to <br>
                    <span class="text-brand-gold">Global Manufacturing</span>
                </h1>
                
                <p class="text-lg md:text-xl text-white/50 font-medium mb-12 max-w-2xl leading-relaxed">
                    The frontier for African businesses to source directly from global manufacturers. 
                    <span class="text-white/80">Search. Settle. Move.</span> Our own terminal, your enterprise.
                </p>

                <!-- White-label Search Terminal -->
                <div class="max-w-3xl">
                    <form action="{{ route('marketplace.index') }}" method="GET" class="relative flex flex-col md:flex-row bg-white/[0.03] backdrop-blur-xl p-2 rounded-2xl border border-white/10 shadow-3xl focus-within:border-brand-gold/40 transition-all duration-500">
                        <div class="flex-1 flex items-center px-6 py-3">
                            <input type="text" name="query"
                                   placeholder="Search global manufacturers or paste factory product URL..." 
                                   class="w-full bg-transparent text-white font-semibold placeholder-white/20 focus:outline-none text-base">
                        </div>
                        <button type="submit" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-12 py-4 rounded-xl font-bold uppercase tracking-widest text-[11px] transition-all active:scale-95 shadow-lg shadow-brand-gold/10">
                            Source Now
                        </button>
                    </form>
                    <div class="mt-4 flex items-center space-x-4 px-2">
                        <span class="text-[8px] font-bold text-white/30 uppercase tracking-[0.4em]">Integrated Supply Nodes:</span>
                        <div class="flex space-x-3">
                            <span class="text-[8px] font-black text-white/40 uppercase tracking-tighter">Guangzhou</span>
                            <span class="text-[8px] font-black text-white/40 uppercase tracking-tighter">Istanbul</span>
                            <span class="text-[8px] font-black text-white/40 uppercase tracking-tighter">Tel Aviv</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- [SECTION 2] The Intelligence Registry: Multi-tier Scope -->
    <section class="py-24 bg-[#050810] border-y border-white/5">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 text-center md:text-left">
                <div class="group border-r border-white/5 last:border-0 pr-12">
                    <p class="text-[9px] font-bold text-brand-gold/60 uppercase tracking-[0.3em] mb-3">Tons Moved</p>
                    <span class="text-4xl font-bold text-white tracking-tighter group-hover:text-brand-gold transition-colors">4.8k+</span>
                </div>
                <div class="group border-r border-white/5 last:border-0 pr-12">
                    <p class="text-[9px] font-bold text-white/30 uppercase tracking-[0.3em] mb-3">African Businesses</p>
                    <span class="text-4xl font-bold text-white tracking-tighter group-hover:text-brand-gold transition-colors">12k+</span>
                </div>
                <div class="group border-r border-white/5 last:border-0 pr-12">
                    <p class="text-[9px] font-bold text-white/30 uppercase tracking-[0.3em] mb-3">Supply Corridors</p>
                    <span class="text-4xl font-bold text-white tracking-tighter group-hover:text-brand-gold transition-colors">Global</span>
                </div>
                <div class="group">
                    <p class="text-[9px] font-bold text-white/30 uppercase tracking-[0.3em] mb-3">Settlement Node</p>
                    <span class="text-4xl font-bold text-white tracking-tighter group-hover:text-brand-gold transition-colors">Instant</span>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 3] The Everything Movement: 5-Tier Logistics -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-end justify-between mb-24 gap-8">
                <div class="max-w-2xl">
                    <span class="text-[10px] font-bold text-brand-gold uppercase tracking-[0.4em] mb-4 inline-block">The Logistics Domain</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-brand-navy leading-tight tracking-tight">
                        Every Movement. <br>Everywhere. Multi-tier.
                    </h2>
                </div>
                <p class="text-slate-500 max-w-sm text-sm italic">
                    From your neighborhood to the other side of the planet. GlobalLine handles the entire spectrum of logistics.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tier 1 & 2 -->
                <div class="p-10 rounded-3xl bg-slate-50 border border-slate-100 hover:shadow-xl transition-all group">
                    <div class="w-10 h-10 bg-brand-navy text-brand-gold rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-brand-navy uppercase mb-3">Intra & Inter-City</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Swift, precision delivery within your city or between states. Local logistics powered by global technology.</p>
                </div>
                <!-- Tier 3 & 4 -->
                <div class="p-10 rounded-3xl bg-slate-50 border border-slate-100 hover:shadow-xl transition-all group">
                    <div class="w-10 h-10 bg-brand-navy text-brand-gold rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.065M15 20.33V18a2 2 0 012-2h3.065M12 2.13v20m0-20L10.5 4M12 2.13l1.5 1.87"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-brand-navy uppercase mb-3">Intra & Inter-Country</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Moving cargo across borders and nations. We simplify the complexity of cross-country transport.</p>
                </div>
                <!-- Tier 5 -->
                <div class="p-10 rounded-3xl bg-brand-gold hover:shadow-xl transition-all group">
                    <div class="w-10 h-10 bg-brand-navy text-brand-gold rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9-3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold text-brand-navy uppercase mb-3">Inter-Continental</h4>
                    <p class="text-brand-navy/70 text-sm leading-relaxed">Direct freight lines from manufacturing hubs in Asia and Europe to the African continent.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 4] The Sourcing Marketplace: White-labeled Catalouge -->
    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-6 mb-20 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] font-bold text-brand-gold uppercase tracking-[0.4em] mb-4 inline-block">Direct From Source</span>
                <h2 class="text-4xl font-bold text-brand-navy leading-tight uppercase tracking-tighter">Verified Sourcing Terminal</h2>
            </div>
            <a href="{{ route('portal.marketplace') }}" class="text-[11px] font-bold text-brand-navy uppercase tracking-widest border-b-2 border-brand-gold pb-1 hover:text-brand-gold transition-colors">Enter Terminal &rarr;</a>
        </div>
        
        <div class="overflow-x-auto pb-12 no-scrollbar">
            <div class="flex space-x-8 px-6">
                @php
                    $samples = [
                        ['name' => 'Industrial Precision Node', 'price' => 'Factory Direct', 'img' => 'https://images.unsplash.com/photo-1581092583537-20d51b4b4f1b?auto=format&fit=crop&w=600&q=80'],
                        ['name' => 'Solar Energy Core', 'price' => 'Wholesale Tier', 'img' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80'],
                        ['name' => 'Textile Manufacturing Mesh', 'price' => 'Bulk Unit', 'img' => 'https://images.unsplash.com/photo-1558444452-92f7671f618a?auto=format&fit=crop&w=600&q=80'],
                        ['name' => 'Enterprise Logic Board', 'price' => 'Direct Import', 'img' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=600&q=80'],
                    ];
                @endphp
                @foreach($samples as $item)
                <div class="min-w-[320px] bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-xl transition-all cursor-pointer" 
                     onclick="window.location.href='{{ route('portal.marketplace') }}';">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 grayscale-[20%] group-hover:grayscale-0" alt="{{ $item['name'] }}">
                        <div class="absolute top-4 left-4 bg-brand-navy/90 text-brand-gold px-4 py-1.5 rounded-lg text-[9px] font-bold uppercase tracking-widest">Global Sourced</div>
                    </div>
                    <div class="p-8">
                        <h4 class="text-base font-bold text-brand-navy mb-4">{{ $item['name'] }}</h4>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-brand-gold uppercase tracking-tighter">{{ $item['price'] }}</span>
                            <div class="bg-slate-50 p-2.5 rounded-lg group-hover:bg-brand-gold transition-colors">
                                <svg class="w-4 h-4 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- [SECTION 5] Capital Bridge: African Payment Focus -->
    <section class="py-40 bg-brand-navy relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2">
                    <span class="text-[10px] font-bold text-brand-gold uppercase tracking-[0.4em] mb-8 inline-block">The Settlement Layer</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-8">
                        The Frontier for <br>African <span class="text-brand-gold">Capital Settlement</span>
                    </h2>
                    <p class="text-white/40 text-base leading-relaxed mb-12 max-w-xl">
                        Designed for the African business. Pay your global suppliers in China, Turkey, or Israel directly using your local currency. We handle the currency bridge, you handle the growth.
                    </p>
                    <div class="grid grid-cols-2 gap-8 mb-12">
                        <div>
                            <p class="text-[10px] font-bold text-white/20 uppercase mb-2">Multicurrency</p>
                            <p class="text-white font-bold">CNY · USD · NGN</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-white/20 uppercase mb-2">Compliance</p>
                            <p class="text-white font-bold">Secure Gateway</p>
                        </div>
                    </div>
                    <a href="{{ route('register') }}" class="inline-block bg-brand-gold text-brand-navy px-12 py-5 rounded-xl font-bold uppercase tracking-widest text-[11px] hover:bg-brand-goldHover transition-colors">
                        Start Settling
                    </a>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <div class="absolute inset-0 bg-brand-gold/10 blur-[100px] rounded-full"></div>
                        <div class="relative bg-white/[0.03] p-12 rounded-[3rem] border border-white/10 backdrop-blur-sm">
                            <div class="space-y-6">
                                <div class="flex justify-between items-center text-white/30 text-[10px] font-bold uppercase pb-4 border-b border-white/5">
                                    <span>Real-time Invoice Settle</span>
                                    <span>Sync: Guaranteed</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-brand-gold rounded-full flex items-center justify-center font-bold text-brand-navy">NGN</div>
                                    <div class="flex-1 h-px bg-white/10"></div>
                                    <div class="w-12 h-12 bg-white/10 border border-white/20 rounded-full flex items-center justify-center font-bold text-white">CNY</div>
                                </div>
                                <p class="text-brand-gold font-bold text-center text-sm">Automated Manufacturer Credit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- [SECTION 6] Final Gateway -->
    <section class="py-40 bg-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-6xl font-bold text-brand-navy tracking-tight leading-none mb-10">
                    Your Enterprise, <br>Directly Connected.
                </h2>
                <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                    <a href="{{ route('register') }}" class="w-full md:w-auto bg-brand-navy text-white px-14 py-6 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:shadow-2xl hover:shadow-brand-navy/30 transition-all">
                        Create Account
                    </a>
                    <a href="{{ route('login') }}" class="w-full md:w-auto bg-white text-brand-navy border-2 border-brand-navy px-14 py-6 rounded-2xl font-bold uppercase tracking-widest text-[11px] hover:bg-slate-50 transition-all">
                        Enter Terminal
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

@endsection
