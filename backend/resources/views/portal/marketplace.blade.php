@extends('layouts.portal')

@section('page_title', 'Infinity Marketplace')

@section('content')
<div class="space-y-12 pb-20">
    <!-- Marketplace Search Header (Glassmorphism) -->
    <div class="bg-brand-navy rounded-[3.5rem] p-16 text-white relative overflow-hidden shadow-2xl shadow-brand-navy/30">
        <!-- Interactive Background Patterns -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-brand-gold/10 rounded-full -translate-y-1/2 translate-x-1/4 blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-brand-gold/5 rounded-full translate-y-1/2 -translate-x-1/4 blur-[80px]"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center space-y-8">
            <div class="inline-flex items-center px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                <span class="w-2 h-2 bg-brand-gold rounded-full mr-3 animate-pulse"></span>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] italic">Direct Factory Integration Active</p>
            </div>
            
            <h2 class="text-5xl font-heading font-black tracking-tight leading-tight uppercase italic">Global Sourcing Hub</h2>
            <p class="text-white/60 text-lg font-medium max-w-2xl mx-auto">Source millions of products directly from 1688, Taobao & Tmall at manufacturing baseline costs.</p>
            
            <form action="{{ route('portal.marketplace') }}" method="GET" class="relative group mt-12 max-w-3xl mx-auto">
                <div class="absolute inset-y-0 left-8 flex items-center pointer-events-none">
                    <svg class="w-6 h-6 text-white/20 group-focus-within:text-brand-gold transition-soft" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="query" placeholder="Paste 1688 Link or Search Keywords..." 
                       class="w-full bg-white/5 border-white/10 border-2 rounded-[2.5rem] pl-20 pr-12 py-7 text-white placeholder-white/20 focus:bg-white focus:text-brand-navy focus:placeholder-slate-400 focus:border-brand-gold transition-soft shadow-2xl outline-none text-lg font-bold">
                <button type="submit" class="absolute right-3 top-3 bottom-3 bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-10 rounded-[1.8rem] text-sm font-black uppercase tracking-widest transition-soft shadow-xl transform active:scale-95 italic">
                    Search Intel
                </button>
            </form>
            
            <div class="flex items-center justify-center gap-10 pt-4">
                <div class="flex flex-col items-center">
                    <p class="text-[8px] font-black text-white/30 uppercase tracking-[0.4em] mb-2">Primary Node</p>
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/80/1688.com_logo.png/220px-1688.com_logo.png" class="h-6 opacity-40 grayscale invert brightness-0 hover:grayscale-0 hover:opacity-100 transition-soft cursor-pointer" alt="1688">
                </div>
                <div class="w-px h-8 bg-white/10"></div>
                <div class="flex flex-col items-center">
                    <p class="text-[8px] font-black text-white/30 uppercase tracking-[0.4em] mb-2">Secondary Node</p>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Alibaba_Group_logo.svg/1280px-Alibaba_Group_logo.svg.png" class="h-5 opacity-40 grayscale invert brightness-0 hover:grayscale-0 hover:opacity-100 transition-soft cursor-pointer" alt="Alibaba">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories & Trending -->
    <div class="space-y-8">
        <div class="flex justify-between items-end">
            <div>
                <h3 class="text-2xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">Market Hot-Items</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">High-velocity products with verified logistics routes</p>
            </div>
            <div class="flex space-x-2">
                <button class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-brand-navy transition-soft shadow-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                <button class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-brand-navy transition-soft shadow-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $sampleProducts = [
                    ['name' => 'Ultra-Performance Athletic Shoes', 'price' => 12.50, 'moq' => 10, 'img' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=400&q=80', 'category' => 'Apparel'],
                    ['name' => 'Cyber-Series Smart Watch V4', 'price' => 45.00, 'moq' => 5, 'img' => 'https://images.unsplash.com/photo-1546868832-0e61e9d09238?auto=format&fit=crop&w=400&q=80', 'category' => 'Electronics'],
                    ['name' => 'Industrial Grade Power Hub', 'price' => 189.00, 'moq' => 1, 'img' => 'https://images.unsplash.com/photo-1628557118391-56cd6060c29f?auto=format&fit=crop&w=400&q=80', 'category' => 'Power Hardware'],
                    ['name' => 'Pro-Acoustic Wireless Pods', 'price' => 18.20, 'moq' => 20, 'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=400&q=80', 'category' => 'Audio'],
                ];
            @endphp

            @foreach($sampleProducts as $product)
            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-slate-100 group hover:shadow-2xl transition-soft flex flex-col h-full">
                <div class="aspect-square relative overflow-hidden">
                    <img src="{{ $product['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-soft duration-700">
                    <div class="absolute top-6 left-6 flex flex-col space-y-2">
                        <span class="bg-brand-navy/90 text-brand-gold text-[8px] font-black px-3 py-1.5 rounded-full backdrop-blur-md italic uppercase tracking-widest shadow-lg">
                            MOQ {{ $product['moq'] }}
                        </span>
                        <span class="bg-white/90 text-brand-navy text-[8px] font-black px-3 py-1.5 rounded-full backdrop-blur-md italic uppercase tracking-widest shadow-lg">
                            {{ $product['category'] }}
                        </span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h4 class="font-black font-heading text-brand-navy uppercase italic tracking-tight mb-2 line-clamp-2">{{ $product['name'] }}</h4>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-6">Guangzhou Direct Warehouse</p>
                    
                    <div class="mt-auto flex items-center justify-between">
                        <div>
                            <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em] leading-none mb-1">Scale Unit Price</p>
                            <p class="text-2xl font-heading font-black text-brand-navy italic uppercase tracking-tighter">${{ number_format($product['price'], 2) }} <span class="text-[10px] text-slate-300 font-medium lowercase">/unit</span></p>
                        </div>
                        <button class="w-12 h-12 bg-slate-50 border border-slate-100 text-brand-navy rounded-2xl flex items-center justify-center hover:bg-brand-navy hover:text-brand-gold transition-soft shadow-sm group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Sourcing Assistance Block (Enterprise Grade) -->
    <div class="bg-white rounded-[4rem] p-12 border border-slate-100 flex flex-col lg:flex-row items-center gap-16 relative overflow-hidden group">
        <!-- Visual Accent -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-gold/5 rounded-full blur-3xl group-hover:bg-brand-gold/10 transition-soft"></div>
        
        <div class="w-full lg:w-[45%] relative">
            <div class="absolute -inset-4 bg-brand-gold/10 rounded-[4rem] blur-2xl group-hover:blur-3xl transition-soft"></div>
            <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1000&q=80" 
                 class="w-full h-[30rem] object-cover rounded-[3.5rem] shadow-2xl relative z-10 hover:scale-[1.02] transition-soft grayscale-[50%] hover:grayscale-0">
            <div class="absolute bottom-10 -right-10 w-48 bg-brand-navy p-6 rounded-3xl shadow-2xl z-20 border border-white/10 hidden xl:block">
                <p class="text-brand-gold font-black text-[10px] uppercase tracking-widest mb-2 italic">Official Presence</p>
                <p class="text-white text-xs font-medium">Guangzhou & Yiwu Procurement Offices</p>
            </div>
        </div>

        <div class="flex-1 space-y-8 relative z-10">
            <div class="space-y-2">
                <span class="text-brand-gold font-black text-[10px] uppercase tracking-[0.4em] italic">Enterprise Protocol</span>
                <h3 class="text-4xl font-heading font-black text-brand-navy uppercase tracking-tighter italic leading-none">Custom Production & Sourcing</h3>
            </div>
            
            <p class="text-slate-500 font-medium leading-relaxed max-w-xl">Unable to locate a specific model? Our on-site specialized procurement teams in China's industrial hubs handle end-to-end manufacturing inquiries, direct price negotiations, and rigorous quality assurance before freight dispatch.</p>
            
            <div class="grid grid-cols-2 gap-6 max-w-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-emerald-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                    <p class="text-[10px] font-black text-brand-navy uppercase tracking-widest italic">Factory Auditing</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-emerald-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                    <p class="text-[10px] font-black text-brand-navy uppercase tracking-widest italic">Price Escrow</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-emerald-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                    <p class="text-[10px] font-black text-brand-navy uppercase tracking-widest italic">Logistics Sync</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-emerald-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                    <p class="text-[10px] font-black text-brand-navy uppercase tracking-widest italic">Bulk Discounts</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-5 pt-4">
                <a href="{{ route('portal.sourcing') }}" class="bg-brand-navy text-brand-gold px-12 py-5 rounded-[1.8rem] text-xs font-black uppercase tracking-[0.2em] hover:bg-brand-lightNavy transition-soft shadow-2xl italic active:scale-95">Initiate Request</a>
                <a href="#" class="bg-slate-50 text-slate-400 border border-slate-200 px-10 py-5 rounded-[1.8rem] text-xs font-black uppercase tracking-widest hover:text-brand-navy hover:bg-white transition-soft italic">Directory Access</a>
            </div>
        </div>
    </div>
</div>
@endsection
