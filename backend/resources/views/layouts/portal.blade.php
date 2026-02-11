<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GlobalLine Enterprise Portal')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#0E1B3D',
                            lightNavy: '#162A5B',
                            gold: '#C5A059',
                            goldHover: '#B48E48',
                            slate: '#F8FAFC'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        .sidebar-glass {
            background: linear-gradient(180deg, rgba(14, 27, 61, 1) 0%, rgba(22, 42, 91, 1) 100%);
            border-right: 1px solid rgba(197, 160, 89, 0.1);
        }
        .nav-active {
            background: linear-gradient(90deg, rgba(197, 160, 89, 0.15) 0%, transparent 100%);
            border-left: 3px solid #C5A059;
            color: #C5A059 !important;
        }
        .stat-card-gold {
            background: linear-gradient(135deg, #C5A059 0%, #B48E48 100%);
        }
        .transition-soft { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(14, 27, 61, 0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(197, 160, 89, 0.3); }
    </style>
</head>
<body class="h-full font-sans antialiased text-brand-navy bg-slate-50 overflow-hidden" x-data="{ sidebarOpen: false }">

    <div class="flex h-full">
        
        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-shrink-0 lg:flex-col lg:w-72 sidebar-glass transition-soft relative z-30">
            <!-- Brand Logo -->
            <div class="flex items-center h-24 px-8 mb-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg mr-4">
                    <svg class="w-6 h-6 text-brand-navy" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <div>
                    <span class="block text-xl font-black font-heading text-white tracking-tighter uppercase leading-none">GlobalLine</span>
                    <span class="block text-[8px] font-bold text-brand-gold uppercase tracking-[0.4em] mt-1">Enterprise B2B</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                @php
                    $navItems = [
                        ['name' => 'Intelligence', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2 2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', 'route' => 'portal.dashboard'],
                        ['name' => 'Shipments Hub', 'icon' => 'M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0', 'route' => 'portal.shipments'],
                        ['name' => 'Consolidation', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'route' => 'portal.consolidation'],
                        ['name' => 'Marketplace', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'route' => 'portal.marketplace'],
                        ['name' => 'Sourcing Orders', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'route' => 'portal.sourcing'],
                        ['name' => 'Multi-Wallet', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'route' => 'portal.wallet'],
                        ['name' => 'KYC Trust', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'route' => 'portal.kyc'],
                        ['name' => 'Business Hubs', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0', 'route' => 'portal.addresses'],
                        ['name' => 'Command Support', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'route' => 'portal.support.index'],
                    ];
                @endphp

                <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.3em] px-4 py-4 italic">Core Operations</p>
                
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="{{ request()->is('*'.str_replace('portal.', '', $item['route']).'*') ? 'nav-active' : 'text-white/50 hover:text-brand-gold hover:bg-white/5' }} group flex items-center px-4 py-4 text-sm font-black font-heading uppercase tracking-wide rounded-xl transition-soft">
                        <svg class="mr-3 h-5 w-5 {{ request()->is('*'.str_replace('portal.', '', $item['route']).'*') ? 'text-brand-gold' : 'text-white/20 group-hover:text-brand-gold' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                        </svg>
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-6">
                <div class="bg-brand-gold/10 rounded-2xl p-5 border border-brand-gold/20">
                    <p class="text-[10px] font-black text-brand-gold uppercase tracking-widest mb-1 italic">V4 Support</p>
                    <p class="text-xs text-white/60 font-medium mb-4">Enterprise technical assistance 24/7.</p>
                    <a href="{{ route('portal.support.index') }}" class="block text-center py-2 px-4 rounded-lg bg-brand-gold text-brand-navy text-[10px] font-black uppercase tracking-widest hover:bg-brand-goldHover transition-soft shadow-lg">Help Desk</a>
                </div>
            </div>
        </aside>

        <!-- Main Workspace -->
        <div class="flex-1 flex flex-col h-full bg-slate-50 relative">
            
            <!-- Global Top Header -->
            <header class="h-24 bg-white border-b border-slate-200 flex items-center justify-between px-10 shrink-0">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="lg:hidden mr-4 text-brand-navy">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                    <h1 class="text-2xl font-black font-heading text-brand-navy uppercase tracking-tighter italic">@yield('page_title', 'Enterprise Intelligence')</h1>
                </div>

                <div class="flex items-center space-x-10">
                    <!-- Global Search -->
                    <div class="hidden md:flex items-center bg-slate-100 rounded-xl px-4 py-2 border border-transparent focus-within:border-brand-gold/30 transition-soft w-64 lg:w-96">
                        <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Search Master ID / Container..." class="bg-transparent text-xs font-bold text-brand-navy placeholder-slate-400 focus:outline-none w-full uppercase">
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-6 pr-6 border-r border-slate-200">
                        <button class="text-slate-400 hover:text-brand-navy transition-soft relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute -top-1 -right-1 w-2 h-2 bg-brand-gold rounded-full"></span>
                        </button>
                    </div>

                    <!-- Profile -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-4 focus:outline-none group">
                            <div class="text-right hidden sm:block">
                                <p class="text-xs font-black text-brand-navy uppercase tracking-tighter italic">{{ Auth::user()->name }}</p>
                                <p class="text-[8px] font-bold text-brand-gold uppercase tracking-widest">Global Member</p>
                            </div>
                            <div class="w-12 h-12 bg-brand-navy rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-soft border-2 border-brand-gold/10 group-hover:border-brand-gold/40">
                                <span class="text-brand-gold font-black text-sm uppercase italic">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             class="absolute right-0 mt-4 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 py-3 z-50">
                             <a href="#" class="block px-6 py-3 text-[10px] font-black text-brand-navy hover:text-brand-gold uppercase tracking-widest transition-soft">Profile Intel</a>
                             <a href="#" class="block px-6 py-3 text-[10px] font-black text-brand-navy hover:text-brand-gold uppercase tracking-widest transition-soft border-b border-slate-50 pb-4">Security Keys</a>
                             <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-6 py-4 text-[10px] font-black text-red-500 hover:bg-red-50 uppercase tracking-widest transition-soft italic">Terminate Session</button>
                             </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-10 relative">
                @yield('content')
                
                <!-- Micro Grid Overlay for high-tech feel -->
                <div class="fixed inset-0 pointer-events-none opacity-[0.02]" style="background-image: radial-gradient(circle, #0E1B3D 1px, transparent 1px); background-size: 30px 30px;"></div>
            </main>
        </div>
    </div>

    <!-- Mobile Navigation Layer -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:leave="transition ease-in duration-200" 
         class="fixed inset-0 z-50 lg:hidden" x-cloak>
        <div class="fixed inset-0 bg-brand-navy/60 backdrop-blur-md" @click="sidebarOpen = false"></div>
        <div class="fixed inset-y-0 left-0 w-80 sidebar-glass shadow-2xl flex flex-col pt-8">
            <div class="px-8 mb-10 flex justify-between items-center">
                <span class="text-xl font-black font-heading text-white uppercase italic tracking-tighter">Globalline</span>
                <button @click="sidebarOpen = false" class="text-white/40"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <!-- Duplicated Nav for simplified mobile logic -->
            <nav class="flex-1 px-4 space-y-1">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="text-white/60 block px-4 py-4 text-sm font-black font-heading uppercase tracking-widest italic border-b border-white/5">{{ $item['name'] }}</a>
                @endforeach
            </nav>
        </div>
    </div>

</body>
</html>
