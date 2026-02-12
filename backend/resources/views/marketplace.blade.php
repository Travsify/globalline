@extends('layouts.public')

@section('title', 'Global Collective | Frontier Sourcing Hub')

@section('content')
<main class="bg-brand-navy min-h-screen pt-40 pb-32 overflow-hidden" x-data="marketplaceController()">
    <!-- Marketplace Header -->
    <div class="container mx-auto px-6 relative z-10 mb-20">
        <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-12">
            <div class="text-left">
                <span class="inline-block px-4 py-1.5 bg-brand-gold/10 text-brand-gold rounded-full text-[10px] font-black uppercase tracking-[0.4em] mb-4 italic">Global Collective v2.1</span>
                <h1 class="text-5xl md:text-7xl font-heading font-black text-white uppercase italic tracking-tighter leading-none">
                    Verified <br><span class="gold-outline-text underline decoration-brand-gold/20">Supply Nodes</span>
                </h1>
            </div>

            <!-- Currency Switcher Terminal -->
            <div class="bg-white/5 p-2 rounded-2xl border border-white/10 flex items-center gap-2">
                @foreach($availableCurrencies as $curr)
                <a href="?currency={{ $curr }}&node={{ request('node', 'all') }}&query={{ request('query') }}" 
                   class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-soft {{ $selectedCurrency == $curr ? 'bg-brand-gold text-brand-navy' : 'text-white/40 hover:text-white' }}">
                    {{ $curr }}
                </a>
                @endforeach
            </div>
        </div>
        
        <!-- Deep Search Form -->
        <div class="max-w-4xl mx-auto relative group">
            <div class="absolute -inset-4 bg-brand-gold/5 blur-[80px] rounded-full opacity-50"></div>
            <form action="{{ route('marketplace.index') }}" method="GET" class="relative flex flex-col md:flex-row bg-white/5 backdrop-blur-3xl p-3 rounded-[3rem] border border-white/10 shadow-2xl group-hover:border-brand-gold/40 transition-soft">
                <input type="hidden" name="currency" value="{{ $selectedCurrency }}">
                <div class="flex-1 flex items-center px-8 py-4">
                    <select name="node" class="bg-white/5 text-brand-gold font-black uppercase tracking-widest text-[10px] py-2 px-4 rounded-xl border-none focus:ring-0 cursor-pointer mr-6 outline-none italic">
                        <option value="all" @if(request('node') == 'all') selected @endif>Universal Grid</option>
                        <option value="1688" @if(request('node') == '1688') selected @endif>Node: Guangzhou</option>
                        <option value="alibaba" @if(request('node') == 'alibaba') selected @endif>Node: Istanbul</option>
                        <option value="taobao" @if(request('node') == 'taobao') selected @endif>Node: Tel Aviv</option>
                    </select>
                    <input type="text" name="query" value="{{ request('query') }}"
                           placeholder="Scan millions of frontier SKU points..." 
                           class="w-full bg-transparent text-white font-bold placeholder-white/20 focus:outline-none text-xl uppercase italic">
                </div>
                <button type="submit" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-16 py-7 rounded-[2.2rem] font-black uppercase tracking-[0.2em] text-xs transition-soft shadow-2xl active:scale-95 italic border-none outline-none">
                    Sync Intel
                </button>
            </form>
        </div>
    </div>

    <!-- Product Universe -->
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse($products as $product)
            <div class="bg-white/5 border border-white/10 rounded-[4rem] overflow-hidden group hover:bg-white/10 transition-soft relative flex flex-col h-full shadow-2xl">
                <!-- Node Identifier -->
                <div class="absolute top-8 right-8 z-20">
                    <span class="bg-brand-gold text-brand-navy text-[8px] font-black px-4 py-2 rounded-full uppercase italic tracking-widest shadow-xl">
                        @if($product['source'] == '1688') Node: GZ @elseif($product['source'] == 'Alibaba') Node: IST @else Node: TLV @endif
                    </span>
                </div>

                <div class="aspect-square relative overflow-hidden">
                    <img src="{{ $product['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-soft duration-1000 grayscale-[30%] group-hover:grayscale-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-navy via-transparent to-transparent opacity-60"></div>
                </div>

                <div class="p-12 pt-8 flex-1 flex flex-col relative">
                    <h3 class="text-3xl font-heading font-black text-white mb-4 uppercase italic tracking-tighter leading-none line-clamp-2">{{ $product['name'] }}</h3>
                    <p class="text-[9px] font-black text-white/30 uppercase tracking-[0.3em] mb-10 italic">MOQ: {{ $product['moq'] ?? 'Variable' }} Units</p>
                    
                    <div class="mt-auto flex items-center justify-between">
                        <div>
                            <p class="text-[8px] font-black text-brand-gold uppercase tracking-[0.3em] mb-1 italic">Collective Valuation</p>
                            <p class="text-4xl font-heading font-black text-white italic tracking-tighter uppercase leading-none">
                                {{ $product['symbol'] }}{{ number_format($product['display_price'], 2) }}
                            </p>
                        </div>
                        <button @click="addToCollective(@js($product))" 
                                class="w-20 h-20 bg-brand-gold hover:bg-brand-goldHover text-brand-navy rounded-[1.8rem] flex items-center justify-center transition-soft shadow-2xl transform active:rotate-12 outline-none border-none">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-white/30 font-black uppercase tracking-widest italic">Zero matches in current projection.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Collective Drawer (Floating Cart) -->
    <div x-show="cartOpen" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full"
         class="fixed inset-y-0 right-0 w-full md:w-[28rem] bg-brand-navy border-l border-white/10 z-[100] p-12 shadow-inner-white overflow-y-auto" x-cloak>
        
        <div class="flex justify-between items-center mb-16">
            <h2 class="text-3xl font-heading font-black text-white uppercase italic tracking-tighter">Your <span class="text-brand-gold">Collective</span></h2>
            <button @click="cartOpen = false" class="text-white/40 hover:text-white transition-soft">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <template x-if="cart.length > 0">
            <div class="space-y-10">
                <template x-for="item in cart" :key="item.source + '_' + item.id">
                    <div class="flex items-center space-x-6 group">
                        <div class="w-20 h-20 bg-white/5 rounded-2xl overflow-hidden shadow-lg border border-white/10">
                            <img :src="item.img" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xs font-black text-white uppercase italic tracking-tighter line-clamp-1" x-text="item.name"></h4>
                            <p class="text-[8px] font-black text-white/30 mt-1 uppercase italic tracking-widest" x-text="'Verified Node: ' + item.source"></p>
                            <p class="text-lg font-heading font-black text-brand-gold mt-2 italic" x-text="item.symbol + numberFormat(item.display_price)"></p>
                        </div>
                        <div class="text-[10px] font-black text-white px-3 py-1 bg-white/5 rounded-lg italic" x-text="'x' + item.qty"></div>
                    </div>
                </template>

                <div class="pt-12 border-t border-white/5 mt-12">
                    <div class="flex justify-between items-center mb-12">
                        <span class="text-[10px] font-black text-white/40 uppercase tracking-widest">Aggregate Valuation</span>
                        <span class="text-2xl font-black text-white italic" x-text="cart[0].symbol + numberFormat(totalCost)"></span>
                    </div>
                    
                    @auth
                        <a href="{{ route('portal.dashboard') }}" class="block w-full bg-brand-gold hover:bg-brand-goldHover text-brand-navy py-6 rounded-[2rem] text-center font-black uppercase tracking-widest text-xs transition-soft shadow-2xl italic">Secure Checkout</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-brand-gold hover:bg-brand-goldHover text-brand-navy py-6 rounded-[2rem] text-center font-black uppercase tracking-widest text-xs transition-soft shadow-2xl italic">Login to Settle</a>
                        <p class="text-center text-[8px] font-bold text-white/20 uppercase tracking-[0.2em] mt-4">Required to synchronize portal logistics.</p>
                    @endauth
                </div>
            </div>
        </template>

        <template x-if="cart.length === 0">
            <div class="text-center py-20">
                <p class="text-white/20 font-black uppercase tracking-widest italic">Collective is Vacuum.</p>
            </div>
        </template>
    </div>

    <!-- Sticky Cart Trigger -->
    <div class="fixed bottom-12 right-12 z-50" x-show="cart.length > 0" x-cloak>
        <button @click="cartOpen = true" class="relative bg-brand-gold text-brand-navy p-6 rounded-[2rem] shadow-2xl transition-soft hover:scale-110 active:scale-95 group border-none outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <span class="absolute -top-2 -right-2 bg-white text-brand-navy text-[10px] font-black px-2.5 py-1 rounded-full shadow-lg" x-text="cart.length"></span>
        </button>
    </div>

    <style>
        .gold-outline-text { -webkit-text-stroke: 2px #C5A059; color: transparent; }
        .shadow-inner-white { box-shadow: inset 1px 0 0 rgba(255,255,255,0.05); }
    </style>
</main>

<script>
function marketplaceController() {
    return {
        cartOpen: false,
        cart: @js(array_values(Session::get('collective_cart', []))),
        totalCost: 0,
        
        init() {
            this.calculateTotal();
            this.$watch('cart', () => this.calculateTotal());
        },

        numberFormat(val) {
            return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2 }).format(val);
        },

        calculateTotal() {
            this.totalCost = this.cart.reduce((sum, item) => sum + (item.display_price * item.qty), 0);
        },

        async addToCollective(product) {
            try {
                const response = await fetch('{{ route('marketplace.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        display_price: product.display_price,
                        symbol: product.symbol,
                        source: product.source,
                        img: product.img,
                        qty: 1
                    })
                });
                
                const data = await response.json();
                if (data.success) {
                    // Update local cart to match the new item
                    const cartId = product.source + '_' + product.id;
                    const index = this.cart.findIndex(i => i.source + '_' + i.id === cartId);
                    
                    if (index !== -1) {
                        this.cart[index].qty++;
                    } else {
                        this.cart.push({
                            id: product.id,
                            name: product.name,
                            display_price: product.display_price,
                            symbol: product.symbol,
                            source: product.source,
                            img: product.img,
                            qty: 1
                        });
                    }
                    
                    this.cartOpen = true;
                }
            } catch (error) {
                console.error('Terminal sync error:', error);
            }
        }
    }
}
</script>
@endsection
