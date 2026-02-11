@extends('layouts.portal')

@section('page_title', 'Infinity Marketplace')

@section('content')
<div class="space-y-10">
    <!-- Marketplace Search Header -->
    <div class="bg-brand-navy rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl shadow-brand-navy/20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-gold/10 rounded-full -translate-y-1/2 translate-x-1/4 blur-3xl"></div>
        <div class="relative z-10 max-w-3xl mx-auto text-center space-y-6">
            <h2 class="text-4xl font-heading font-bold tracking-tight">Direct from the Factory</h2>
            <p class="text-white/60 text-lg">Search millions of products from 1688, Taobao & Tmall at wholesale prices.</p>
            
            <form action="{{ route('portal.marketplace') }}" method="GET" class="relative group mt-10">
                <input type="text" name="query" placeholder="Enter product link or keywords (e.g. sneakers, electronics...)" 
                       class="w-full bg-white/10 border-white/20 border-2 rounded-3xl px-8 py-6 text-white placeholder-white/40 focus:bg-white focus:text-slate-800 focus:border-brand-gold transition-all shadow-2xl outline-none text-lg">
                <button type="submit" class="absolute right-4 top-4 bottom-4 bg-brand-gold text-brand-navy px-8 rounded-2xl font-bold hover:scale-105 transition-transform flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Search
                </button>
            </form>
            
            <div class="flex items-center justify-center gap-6 pt-4">
                <span class="text-xs font-bold text-white/40 uppercase tracking-widest">Powered by API:</span>
                <span class="px-3 py-1 bg-white/5 rounded-lg text-[10px] font-bold text-brand-gold">1688.com</span>
                <span class="px-3 py-1 bg-white/5 rounded-lg text-[10px] font-bold text-brand-gold">ALIBABA</span>
                <span class="px-3 py-1 bg-white/5 rounded-lg text-[10px] font-bold text-brand-gold">TAOBAO</span>
            </div>
        </div>
    </div>

    <!-- Featured Categories & Trending -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $sampleProducts = [
                ['name' => 'Men\'s Running Shoes', 'price' => 8.50, 'moq' => 10, 'img' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=300&q=80'],
                ['name' => 'Smart Watch Pro', 'price' => 22.00, 'moq' => 5, 'img' => 'https://images.unsplash.com/photo-1546868832-0e61e9d09238?auto=format&fit=crop&w=300&q=80'],
                ['name' => 'Portable Power Station', 'price' => 145.00, 'moq' => 1, 'img' => 'https://images.unsplash.com/photo-1628557118391-56cd6060c29f?auto=format&fit=crop&w=300&q=80'],
                ['name' => 'Wireless Headphones', 'price' => 15.20, 'moq' => 20, 'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=300&q=80'],
            ];
        @endphp

        @foreach($sampleProducts as $product)
        <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100 group hover:shadow-xl transition-shadow">
            <div class="aspect-square relative overflow-hidden">
                <img src="{{ $product['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4 bg-slate-900/80 text-white text-[10px] font-bold px-3 py-1 rounded-full backdrop-blur-md italic">
                    MOQ {{ $product['moq'] }}
                </div>
            </div>
            <div class="p-6">
                <h4 class="font-bold text-slate-800 text-sm mb-1 line-clamp-2">{{ $product['name'] }}</h4>
                <div class="flex items-center justify-between mt-4">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-none">Wholesale</p>
                        <p class="text-xl font-heading font-bold text-brand-navy">${{ number_format($product['price'], 2) }}</p>
                    </div>
                    <button class="w-10 h-10 bg-brand-gold text-brand-navy rounded-xl flex items-center justify-center hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Sourcing Assistance Block -->
    <div class="bg-white rounded-[3rem] p-10 border border-slate-100 flex flex-col lg:flex-row items-center gap-10">
        <div class="w-full lg:w-1/3">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=600&q=80" class="rounded-[2.5rem] shadow-2xl">
        </div>
        <div class="space-y-6 flex-1">
            <span class="text-brand-navy font-bold text-xs uppercase tracking-widest px-3 py-1 bg-brand-gold/20 rounded-lg italic">Premium Sourcing</span>
            <h3 class="text-3xl font-heading font-bold text-slate-800">Can't find a specific item?</h3>
            <p class="text-slate-500 leading-relaxed">Our procurement experts in Guangzhou and Yiwu can help you source directly from verified manufacturers. We handle the negotiation, quality inspection, and logistics.</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('portal.sourcing') }}" class="bg-brand-navy text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-accent transition-all shadow-lg shadow-brand-navy/10">Request Sourcing</a>
                <a href="#" class="bg-slate-50 text-slate-600 px-8 py-4 rounded-2xl font-bold border border-slate-200 hover:bg-slate-100">Browse Full Catalog</a>
            </div>
        </div>
    </div>
</div>
@endsection
