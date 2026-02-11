<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GlobalLine | Customer Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#002366',
                            gold: '#FFD700',
                            accent: '#0D47A1'
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
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full font-sans antialiased text-slate-900 overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-full">
        <!-- Desktop Sidebar -->
        <aside class="hidden lg:flex lg:flex-shrink-0 lg:flex-col lg:w-72 lg:bg-brand-navy lg:border-r lg:border-white/10 lg:pt-5 lg:pb-4 lg:overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-6 mb-10">
                <div class="w-10 h-10 bg-brand-gold rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.065M15 3.935V5.5A2.5 2.5 0 0012.5 8h-.5a2 2 0 01-2-2 2 2 0 00-2-2 2 2 0 01-2-2V3.935M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="ml-3 text-2xl font-bold font-heading text-white tracking-tight">GlobalLine</span>
            </div>
            <nav class="mt-5 flex-1 px-4 space-y-1">
                @php
                    $navItems = [
                        ['name' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'route' => 'portal.dashboard'],
                        ['name' => 'My Shipments', 'icon' => 'M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0', 'route' => 'portal.shipments'],
                        ['name' => 'Tracking', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', 'route' => 'tracking'],
                        ['name' => 'Consolidation', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'route' => 'consolidation'],
                        ['name' => 'Infinity Marketplace', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'route' => 'portal.marketplace'],
                        ['name' => 'Sourcing Orders', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'route' => 'portal.sourcing'],
                        ['name' => 'Supplier Payments', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'route' => 'portal.payments'],
                        ['name' => 'Wallet & Billing', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'route' => 'portal.wallet'],
                        ['name' => 'Identity Check', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'route' => 'kyc'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="{{ request()->routeIs($item['route']) ? 'bg-white/10 text-brand-gold' : 'text-white/60 hover:bg-white/5 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs($item['route']) ? 'text-brand-gold' : 'text-white/40 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                        </svg>
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </nav>
            <div class="px-4 mt-auto">
                <div class="bg-white/5 rounded-2xl p-4 border border-white/10 mb-4">
                    <p class="text-xs text-white/40 uppercase font-bold tracking-widest mb-1">Your Balance</p>
                    <p class="text-xl font-heading font-bold text-white">$1,240.50</p>
                    <a href="{{ route('portal.wallet') }}" class="mt-3 block text-center py-2 px-4 rounded-xl bg-brand-gold text-brand-navy text-xs font-bold hover:scale-105 transition-transform">Fund Wallet</a>
                </div>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Mobile Header -->
            <header class="lg:hidden bg-brand-navy px-4 py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-brand-gold rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.065M15 3.935V5.5A2.5 2.5 0 0012.5 8h-.5a2 2 0 01-2-2 2 2 0 00-2-2 2 2 0 01-2-2V3.935M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <button @click="sidebarOpen = true" class="text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </header>

            <!-- Top Desktop Header -->
            <header class="hidden lg:flex items-center justify-between px-10 py-6 bg-white border-b border-slate-200">
                <h1 class="text-xl font-heading font-bold text-slate-800">@yield('page_title', 'Dashboard')</h1>
                <div class="flex items-center space-x-6">
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="text-slate-400 hover:text-brand-navy dark:hover:text-brand-gold transition-colors focus:outline-none">
                        <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>

                    <!-- Notification Center -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="relative text-slate-400 hover:text-brand-navy dark:hover:text-brand-gold transition-colors focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-white dark:border-brand-navy rounded-full flex items-center justify-center text-[10px] text-white font-bold">2</span>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-3 w-80 bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-100 dark:border-white/10 z-50 overflow-hidden" x-cloak>
                            <div class="px-6 py-4 border-b border-slate-50 dark:border-white/5 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                                <span class="text-sm font-bold text-slate-800 dark:text-white">Notifications</span>
                                <span class="text-[10px] bg-brand-gold/20 text-brand-navy dark:text-brand-gold px-2 py-1 rounded font-bold">2 NEW</span>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                <a href="#" class="block px-6 py-4 hover:bg-slate-50 dark:hover:bg-white/5 border-b border-slate-50 dark:border-white/5 transition-colors">
                                    <p class="text-xs font-bold text-slate-800 dark:text-white">Shipment GL-82941 Updated</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Cargo has arrived at Guangzhou warehouse.</p>
                                    <p class="text-[10px] text-brand-navy dark:text-brand-gold font-bold mt-2 uppercase tracking-widest">2 MINS AGO</p>
                                </a>
                                <a href="#" class="block px-6 py-4 hover:bg-slate-50 transition-colors">
                                    <p class="text-xs font-bold text-slate-800">Supplier Payment Verified</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Your payment to Alibaba Sourcing has been processed.</p>
                                    <p class="text-[10px] text-brand-navy font-bold mt-2 uppercase tracking-widest">1 HOUR AGO</p>
                                </a>
                            </div>
                            <a href="#" class="block text-center py-4 text-xs font-bold text-slate-400 hover:text-brand-navy dark:hover:text-brand-gold bg-slate-50/50 dark:bg-slate-800/50">View all notifications &rarr;</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 pl-6 border-l border-slate-200 dark:border-white/10">
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-800 dark:text-white">{{ auth()->user()->name ?? 'Guest User' }}</p>
                            <p class="text-xs text-slate-400">Premium Account</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-brand-navy dark:bg-brand-gold flex items-center justify-center text-brand-gold dark:text-brand-navy font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                        </div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-6 lg:p-10">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlays (Alpine.js) -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-50 lg:hidden" x-cloak>
        <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" @click="sidebarOpen = false"></div>
        <div class="fixed inset-y-0 left-0 w-full max-w-xs bg-brand-navy shadow-xl overflow-y-auto">
            <!-- Mobile Nav Content Same as Desktop -->
             <div class="flex items-center justify-between px-6 py-6 border-b border-white/10">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-brand-gold rounded-lg flex items-center justify-center">
                         <svg class="w-5 h-5 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.065M15 3.935V5.5A2.5 2.5 0 0012.5 8h-.5a2 2 0 01-2-2 2 2 0 00-2-2 2 2 0 01-2-2V3.935M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="ml-3 text-xl font-bold font-heading text-white">GlobalLine</span>
                </div>
                <button @click="sidebarOpen = false" class="text-white/60">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <!-- ... duplicated nav items ... -->
        </div>
    </div>
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

            // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>
