@extends('layouts.portal')

@section('page_title', 'Collective Settlement Station')

@section('content')
<div class="space-y-12 pb-20" x-data="portalMarketplace()">
    
    <!-- Synchronized Collective Cart (Settle Station) -->
    <template x-if="cart.length > 0">
        <div class="bg-brand-navy rounded-[3.5rem] p-12 text-white relative overflow-hidden shadow-2xl border border-white/5">
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 mb-12">
                    <div>
                        <span class="inline-block px-4 py-1.5 bg-brand-gold/10 text-brand-gold rounded-full text-[10px] font-black uppercase tracking-[0.4em] mb-4 italic">Synchronized Collective v2.1</span>
                        <h2 class="text-4xl font-heading font-black tracking-tight uppercase italic">Finalize <span class="text-brand-gold">Sourcing Intel</span></h2>
                    </div>
                    <div class="bg-white/5 px-8 py-5 rounded-[2rem] border border-white/10 text-right">
                        <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-1 italic">Aggregate Valuation</p>
                        <p class="text-3xl font-heading font-black text-brand-gold italic tracking-tighter" x-text="cart[0].symbol + numberFormat(totalCost)"></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <template x-for="item in cart" :key="item.source + '_' + item.id">
                        <div class="bg-white/5 p-6 rounded-[2.5rem] border border-white/10 flex items-center space-x-6 group">
                            <div class="w-24 h-24 bg-white/5 rounded-3xl overflow-hidden border border-white/10 shrink-0">
                                <img :src="item.img" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-black uppercase italic tracking-tight line-clamp-1" x-text="item.name"></h4>
                                <p class="text-[9px] font-black text-white/30 mt-1 uppercase tracking-widest italic" x-text="'Verified Node: ' + item.source"></p>
                                <div class="flex items-center justify-between mt-4">
                                    <p class="text-xl font-heading font-black text-white italic" x-text="item.symbol + numberFormat(item.display_price)"></p>
                                    <div class="flex items-center bg-white/5 rounded-xl border border-white/10 p-1">
                                        <button @click="updateQty(item, -1)" class="w-8 h-8 flex items-center justify-center hover:bg-white/10 rounded-lg transition-soft">-</button>
                                        <span class="w-10 text-center text-xs font-black" x-text="item.qty"></span>
                                        <button @click="updateQty(item, 1)" class="w-8 h-8 flex items-center justify-center hover:bg-white/10 rounded-lg transition-soft">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="mt-16 pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-10">
                    <div class="flex items-center space-x-6">
                        <div class="w-16 h-16 bg-brand-gold rounded-[1.5rem] flex items-center justify-center shadow-lg transform rotate-6">
                            <svg class="w-8 h-8 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em] italic">Payment Method</p>
                            <p class="text-xs font-black uppercase tracking-tight">GlobalLine Operating Wallet</p>
                        </div>
                    </div>
                    <button @click="settleCart()" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-20 py-7 rounded-[2.2rem] font-black uppercase tracking-[0.2em] text-xs transition-soft shadow-2xl active:scale-95 italic border-none outline-none">
                        Authorize Settlement
                    </button>
                </div>
            </div>
            
            <!-- Abstract Background Decoration -->
            <div class="absolute -top-40 -right-40 w-[60rem] h-[60rem] bg-brand-gold/5 rounded-full blur-[150px]"></div>
        </div>
    </template>

    <template x-if="cart.length === 0">
        <div class="text-center py-32 bg-slate-50 rounded-[4rem] border border-slate-100">
            <div class="w-24 h-24 bg-slate-100 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h3 class="text-2xl font-heading font-black text-brand-navy uppercase italic">Collective is Vacuum</h3>
            <p class="text-slate-400 mt-4 max-w-sm mx-auto">Explore the marketplace to synchronize items with your professional sourcing grid.</p>
            <a href="{{ route('marketplace.index') }}" class="mt-8 inline-block bg-brand-navy text-brand-gold px-12 py-4 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] italic hover:scale-105 transition-soft">Browse Marketplace</a>
        </div>
    </template>

    <!-- Global Collective Hub (Categories) -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        <!-- Explorer Sidebar -->
        <div class="space-y-10">
            <div>
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-6 italic">Grid Categories</h4>
                <div class="space-y-2">
                    <button class="w-full text-left p-5 rounded-2xl bg-brand-navy text-brand-gold font-black uppercase tracking-widest text-[9px] italic flex justify-between items-center transition-soft">
                        Industrial Hardware <span>(2.4k)</span>
                    </button>
                    <button class="w-full text-left p-5 rounded-2xl bg-white border border-slate-100 text-slate-400 font-black uppercase tracking-widest text-[9px] italic flex justify-between items-center hover:bg-slate-50 transition-soft">
                        Electronics Node <span>(1.8k)</span>
                    </button>
                    <button class="w-full text-left p-5 rounded-2xl bg-white border border-slate-100 text-slate-400 font-black uppercase tracking-widest text-[9px] italic flex justify-between items-center hover:bg-slate-50 transition-soft">
                        Textile Factories <span>(4.2k)</span>
                    </button>
                </div>
            </div>

            <div class="p-8 bg-brand-gold rounded-[2.5rem] relative overflow-hidden group">
                <p class="text-brand-navy font-black text-[10px] uppercase tracking-widest mb-4 italic">Frontier Intel</p>
                <p class="text-brand-navy/70 text-sm font-bold leading-snug">Volume discounts apply for orders exceeding $5,000 via Guangzhou Terminal.</p>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-white/20 rounded-full blur-2xl group-hover:bg-white/30 transition-soft"></div>
            </div>
        </div>

        <!-- Marketplace Stream -->
        <div class="lg:col-span-3 space-y-10">
            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] italic">High-Velocity Stream</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @php
                    $trending = [
                        ['name' => 'G-Force Industrial Press', 'price' => 450.00, 'moq' => 1, 'img' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=600&q=80', 'node' => 'Guangzhou'],
                        ['name' => 'Elite Mesh Fabric Roll', 'price' => 8.40, 'moq' => 100, 'img' => 'https://images.unsplash.com/photo-1544441893-675973e31985?auto=format&fit=crop&w=600&q=80', 'node' => 'Istanbul'],
                    ];
                @endphp

                @foreach($trending as $product)
                <div class="bg-white rounded-[3rem] p-8 border border-slate-100 flex items-center space-x-8 group hover:shadow-2xl transition-soft">
                    <div class="w-32 h-32 bg-slate-50 rounded-3xl overflow-hidden shrink-0">
                        <img src="{{ $product['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-soft duration-700">
                    </div>
                    <div class="flex-1">
                        <p class="text-[8px] font-black text-brand-gold uppercase tracking-[0.2em] mb-2 italic">Node: {{ $product['node'] }}</p>
                        <h5 class="text-lg font-black uppercase italic tracking-tight line-clamp-1 truncate">{{ $product['name'] }}</h5>
                        <div class="flex justify-between items-end mt-6">
                            <p class="text-2xl font-black text-brand-navy italic tracking-tighter">${{ number_format($product['price'], 2) }}</p>
                            <button class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-300 hover:text-brand-navy transition-soft shadow-sm group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function portalMarketplace() {
    return {
        cart: @js(array_values(session()->get('collective_cart', []))),
        totalCost: 0,
        
        init() {
            this.calculateTotal();
        },

        numberFormat(val) {
            return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2 }).format(val);
        },

        calculateTotal() {
            this.totalCost = this.cart.reduce((sum, item) => sum + (item.display_price * item.qty), 0);
        },

        updateQty(item, amount) {
            const index = this.cart.findIndex(i => i.source + '_' + i.id === item.source + '_' + item.id);
            if (index !== -1) {
                this.cart[index].qty = Math.max(1, this.cart[index].qty + amount);
                this.calculateTotal();
                // In a real app, update session via AJAX here
            }
        },

        settleCart() {
            alert('Sourcing Authorization Initiated. Deducting ' + this.cart[0].symbol + this.numberFormat(this.totalCost) + ' from wallet...');
            // Redirect to a real payment processor or handle wallet deduction here
        }
    }
}
</script>
@endsection
