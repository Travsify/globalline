@extends('layouts.public')

@section('title', 'Marketplace | GlobalLine Collective')

@section('content')
<main class="bg-navy-dark min-h-screen pt-32 pb-32 overflow-hidden" 
      x-data="marketplaceController($el)"
      data-initial-cart="{{ json_encode(array_values(Session::get('collective_cart', []))) }}">
    
    <!-- Hero / Discovery Section -->
    <div class="container mx-auto px-6 relative z-10 mb-20">
        <div class="max-w-4xl px-2">
            <span class="text-amber-brand block mb-4 platform-label">Direct Infrastructure</span>
            <h1 class="text-5xl md:text-7xl font-bold font-heading text-white leading-[0.9] mb-8 tracking-tighter">
                Global <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-white/40">Collective.</span>
            </h1>
            <p class="text-white/60 max-w-2xl mb-12 platform-body">
                Scan across thousands of verified production nodes. Source direct from factories with integrated quality control and logistics.
            </p>
        </div>

        <!-- Advanced Search Bar -->
        <div class="relative group max-w-5xl">
            <div class="absolute -inset-1 bg-gradient-to-r from-amber-brand/50 to-blue-500/50 rounded-[2.5rem] blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
            <form action="{{ route('marketplace.index') }}" method="GET" class="relative flex flex-col lg:flex-row bg-navy-light/80 backdrop-blur-2xl p-2 rounded-[2rem] border border-white/10 shadow-3xl">
                <input type="hidden" name="currency" value="{{ $selectedCurrency }}">
                
                <div class="flex-1 flex items-center gap-4 px-6 py-3">
                    <svg class="w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="query" value="{{ request('query') }}" 
                           placeholder="Search by product, category, or industry..." 
                           class="w-full bg-transparent border-none text-white placeholder-white/20 focus:ring-0 text-lg font-medium">
                </div>

                <div class="flex flex-col lg:flex-row gap-2 h-full">
                    <!-- Node Filter -->
                    <select name="node" class="bg-white/5 text-white px-6 py-4 rounded-xl border-none focus:ring-0 cursor-pointer outline-none platform-label">
                        <option value="all" class="bg-navy-dark">All Production Nodes</option>
                        <option value="Factory Direct (CN)" class="bg-navy-dark">Factory Direct (CN)</option>
                        <option value="Premium Tech (US)" class="bg-navy-dark">Premium Tech (US)</option>
                        <option value="Eco-Friendly Hub (EU)" class="bg-navy-dark">Eco-Friendly Hub (EU)</option>
                    </select>

                    <button type="submit" class="bg-amber-brand hover:bg-amber-light text-navy-dark px-10 py-5 rounded-2xl transition-all hover:shadow-xl hover:shadow-amber-brand/20 platform-label">
                        Search Collective
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Category Ticker / Filters -->
    <div class="border-y border-white/5 bg-navy/50 backdrop-blur-sm mb-16 py-4 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex items-center gap-8 overflow-x-auto no-scrollbar whitespace-nowrap text-white/40 platform-label">
                <span class="text-amber-brand">Trending Now:</span>
                <a href="#" class="hover:text-white transition-colors">Electronics</a>
                <a href="#" class="hover:text-white transition-colors">Industrial Parts</a>
                <a href="#" class="hover:text-white transition-colors">Medical Supplies</a>
                <a href="#" class="hover:text-white transition-colors">Renewable Energy</a>
                <a href="#" class="hover:text-white transition-colors">Precision Tools</a>
                <a href="#" class="hover:text-white transition-colors">Textiles</a>
                <a href="#" class="hover:text-white transition-colors">Automotive</a>
            </div>
        </div>
    </div>

    <!-- Currency Swapper Floating -->
    <div class="fixed top-32 right-6 z-40 hidden xl:flex flex-col gap-2">
        @foreach($availableCurrencies as $curr)
        <a href="?currency={{ $curr }}&node={{ request('node', 'all') }}&query={{ request('query') }}" 
           class="w-12 h-12 rounded-full flex items-center justify-center border transition-all platform-label {{ $selectedCurrency == $curr ? 'bg-amber-brand text-navy-dark border-amber-brand' : 'bg-navy/50 text-white/40 border-white/10 hover:border-white/30' }}">
            {{ $curr }}
        </a>
        @endforeach
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($products as $product)
            <div class="group relative bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden hover:bg-white/10 transition-all duration-500 hover:-translate-y-2 hover:shadow-3xl" data-aos="fade-up">
                
                <!-- Badge Overlay -->
                <div class="absolute top-6 left-6 z-20">
                    <span class="bg-navy-dark/80 backdrop-blur-md border border-white/10 text-white px-3 py-1.5 rounded-full flex items-center gap-2 platform-label">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-brand animate-pulse"></span>
                        Verified Node: {{ $product['source'] }}
                    </span>
                </div>

                <!-- Product Visual -->
                <div class="aspect-[4/5] relative overflow-hidden">
                    <img src="{{ $product['img'] }}" class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-dark via-transparent to-transparent opacity-80"></div>
                </div>

                <!-- Product Data -->
                <div class="p-8 pt-4 flex flex-col h-full">
                    <h3 class="text-2xl font-bold text-white mb-2 leading-tight group-hover:text-amber-brand transition-colors line-clamp-1">{{ $product['name'] }}</h3>
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-white/40 platform-label">MOQ: {{ $product['moq'] ?? 'Variable' }} Units</span>
                        <span class="w-1 h-1 rounded-full bg-white/20"></span>
                        <span class="text-emerald-400 platform-label">In Stock</span>
                    </div>
                    
                    <div class="mt-auto flex items-center justify-between gap-4">
                        <div>
                            <p class="text-white/30 mb-1 platform-label">Unit Valuation</p>
                            <p class="text-3xl font-bold text-white font-heading">
                                {{ $product['symbol'] }}{{ number_format($product['display_price'], 2) }}
                            </p>
                        </div>
                        <button @click="addToCollective(@js($product))" 
                                class="w-14 h-14 bg-white text-navy-dark rounded-2xl flex items-center justify-center hover:bg-amber-brand transition-all shadow-xl active:scale-95 group/btn">
                            <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-40 text-center bg-white/5 rounded-[3rem] border border-dashed border-white/10">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">No Matching Nodes Found</h3>
                <p class="text-white/40">Try adjusting your filters or search terms.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- RFQ / Custom Request Section -->
    <div class="container mx-auto px-6 mt-32">
        <div class="bg-gradient-to-br from-navy-light to-navy-dark p-12 lg:p-20 rounded-[4rem] border border-white/5 relative overflow-hidden group">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-amber-brand/10 rounded-full blur-[100px] group-hover:bg-amber-brand/20 transition-all duration-1000"></div>
            
            <div class="flex flex-col lg:flex-row items-center gap-16 relative z-10">
                <div class="lg:w-1/2">
                    <span class="text-amber-brand mb-6 block platform-label">Bespoke Sourcing</span>
                    <h2 class="text-4xl md:text-5xl font-bold font-heading text-white mb-8">Can't Find <br> What You Need?</h2>
                    <p class="text-white/50 mb-10 leading-relaxed platform-body">
                        Our expert procurement teams can hunt down any item across our global manufacturing network. Simply share the details, and we'll bring you the best factory direct quotes.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-4 bg-white text-navy-dark px-10 py-5 rounded-2xl transition-all hover:bg-amber-brand platform-label">
                        Request a Quote (RFQ)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                <div class="lg:w-1/2 grid grid-cols-2 gap-4">
                     <div class="aspect-square bg-white/5 rounded-[2rem] border border-white/5 p-8 flex flex-col justify-center items-center text-center">
                        <div class="text-3xl font-bold text-white mb-2">24h</div>
                        <p class="text-white/40 platform-label">Quote Response</p>
                    </div>
                    <div class="aspect-square bg-white/5 rounded-[2rem] border border-white/5 p-8 flex flex-col justify-center items-center text-center">
                        <div class="text-3xl font-bold text-white mb-2">100%</div>
                        <p class="text-white/40 platform-label">Quality Guarantee</p>
                    </div>
                    <div class="aspect-square bg-white/5 rounded-[2rem] border border-white/5 p-8 flex flex-col justify-center items-center text-center">
                        <div class="text-3xl font-bold text-white mb-2">∞</div>
                        <p class="text-white/40 platform-label">Scalability</p>
                    </div>
                    <div class="aspect-square bg-white/5 rounded-[2rem] border border-white/5 p-8 flex flex-col justify-center items-center text-center">
                        <div class="text-3xl font-bold text-white mb-2">Direct</div>
                        <p class="text-white/40 platform-label">Factory Sync</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collective Cart Drawer -->
    <div x-show="cartOpen" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full"
         class="fixed inset-y-0 right-0 w-full md:w-[32rem] bg-navy-dark/95 backdrop-blur-2xl border-l border-white/10 z-[100] p-12 shadow-inner-white overflow-y-auto" x-cloak>
        
        <div class="flex justify-between items-center mb-16 px-4">
            <h2 class="text-3xl font-bold font-heading text-white tracking-tighter">Your <span class="text-amber-brand">Collective</span></h2>
            <button @click="cartOpen = false" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center text-white/40 hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <template x-if="cart.length > 0">
            <div class="space-y-10">
                <template x-for="item in cart" :key="item.source + '_' + item.id">
                    <div class="flex items-center space-x-6 group px-4">
                        <div class="w-24 h-24 bg-white/5 rounded-2xl overflow-hidden shadow-lg border border-white/10 shrink-0">
                            <img :src="item.img" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-white tracking-tight line-clamp-1 group-hover:text-amber-brand transition-colors" x-text="item.name"></h4>
                            <p class="text-white/30 mt-1 platform-label" x-text="'Verified Node: ' + item.source"></p>
                            <div class="flex items-end justify-between mt-4">
                                <p class="text-xl font-bold text-white" x-text="item.symbol + numberFormat(item.display_price)"></p>
                                <div class="text-[10px] font-bold text-amber-brand px-3 py-1 bg-amber-brand/10 rounded-lg" x-text="'x' + item.qty"></div>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="pt-12 border-t border-white/5 mt-12 bg-white/5 p-10 rounded-[3rem]">
                    <div class="flex justify-between items-center mb-10">
                        <span class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]">Total Valuation</span>
                        <span class="text-3xl font-bold text-white" x-text="cart[0].symbol + numberFormat(totalCost)"></span>
                    </div>
                    
                    @auth
                        <a href="{{ route('portal.dashboard') }}" class="block w-full bg-amber-brand hover:bg-amber-light text-navy-dark py-6 rounded-2xl text-center font-bold uppercase tracking-widest text-xs transition-all shadow-2xl">Proceed to Settlement</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-white text-navy-dark py-6 rounded-2xl text-center font-bold uppercase tracking-widest text-xs transition-all hover:bg-amber-brand">Login to Settle</a>
                    @endauth
                </div>
            </div>
        </template>

        <template x-if="cart.length === 0">
            <div class="text-center py-40">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <p class="text-white/20 font-bold uppercase tracking-widest">Collective is Empty.</p>
            </div>
        </template>
    </div>

    <!-- Sticky Cart Trigger -->
    <div class="fixed bottom-12 right-12 z-50" x-show="cart.length > 0" x-cloak>
        <button @click="cartOpen = true" class="relative group">
            <div class="absolute -inset-2 bg-amber-brand opacity-20 blur-xl group-hover:opacity-40 transition-opacity rounded-full"></div>
            <div class="relative bg-amber-brand text-navy-dark p-6 rounded-[2rem] shadow-2xl transition-all hover:scale-110 active:scale-95 group-hover:rotate-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <div class="absolute -top-2 -right-2 bg-white text-navy-dark text-[10px] font-bold h-7 w-7 flex items-center justify-center rounded-full shadow-lg border-2 border-amber-brand" x-text="cart.length"></div>
            </div>
        </button>
    </div>

</main>

<script>
function marketplaceController(el) {
    return {
        cartOpen: false,
        cart: JSON.parse(el.dataset.initialCart || '[]'),
        totalCost: 0,
        
        init() {
            this.calculateTotal();
            this.$watch('cart', () => this.calculateTotal());
        },

        numberFormat(val) {
            return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2 }).format(val);
        },

        calculateTotal() {
            this.totalCost = this.cart.reduce((sum, item) => sum + (parseFloat(item.display_price) * item.qty), 0);
        },

        async addToCollective(product) {
            try {
                const addRoute = "{{ route('marketplace.add') }}";
                const response = await fetch(addRoute, {
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
