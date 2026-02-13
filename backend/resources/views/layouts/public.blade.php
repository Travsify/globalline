<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GlobalLine | Global Shipping & Freight Solutions')</title>
    <meta name="description" content="GlobalLine Logistics provides fast, reliable global shipping solutions. Express air freight, ocean cargo, road transport, and warehousing services across 220+ countries." />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-background text-foreground antialiased font-sans selection:bg-amber-brand selection:text-navy" x-data="{ mobileMenu: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Header / Nav -->
    <nav class="fixed w-full z-50 transition-all duration-300 border-b border-transparent" 
         :class="{ 'bg-background/80 backdrop-blur-md border-white/5 py-3': scrolled, 'bg-transparent py-6': !scrolled }">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-brand to-amber-light rounded-xl flex items-center justify-center shadow-lg shadow-amber-brand/20 group-hover:scale-105 transition-transform">
                    <svg class="w-6 h-6 text-navy-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold font-heading text-white leading-none tracking-tight">GlobalLine</span>
                    <span class="text-[10px] font-bold text-amber-brand uppercase tracking-[0.3em]">Logistics</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden lg:flex items-center gap-8">
                <div class="flex items-center gap-8 text-sm font-medium text-white/80">
                    <a href="{{ url('/') }}" class="hover:text-amber-brand transition-colors">Home</a>
                    <a href="{{ route('marketplace.index') }}" class="hover:text-amber-brand transition-colors">Marketplace</a>
                    <a href="{{ url('/services') }}" class="hover:text-amber-brand transition-colors">Services</a>
                    <a href="{{ route('pricing') }}" class="hover:text-amber-brand transition-colors">Pricing</a>
                    <a href="{{ url('/about') }}" class="hover:text-amber-brand transition-colors">Company</a>
                </div>
                
                <div class="h-6 w-px bg-white/10"></div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('portal.dashboard') }}" class="bg-amber-brand hover:bg-amber-light text-navy-dark px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition-all hover:shadow-lg hover:shadow-amber-brand/20">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-amber-brand text-xs font-bold uppercase tracking-wider transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-white/10 hover:bg-white/20 border border-white/10 text-white px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider transition-all backdrop-blur-sm">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Toggle -->
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-white p-2 hover:text-amber-brand transition-colors">
                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden absolute top-full left-0 w-full bg-navy/95 backdrop-blur-xl border-t border-white/5 py-4 px-6 shadow-2xl" x-cloak>
            <div class="flex flex-col gap-4">
                <a href="{{ url('/') }}" class="text-white font-medium py-2 border-b border-white/5">Home</a>
                <a href="{{ route('marketplace.index') }}" class="text-white font-medium py-2 border-b border-white/5">Marketplace</a>
                <a href="{{ url('/services') }}" class="text-white font-medium py-2 border-b border-white/5">Services</a>
                <a href="{{ route('pricing') }}" class="text-white font-medium py-2 border-b border-white/5">Pricing</a>
                <a href="{{ url('/about') }}" class="text-white font-medium py-2 border-b border-white/5">Company</a>
                
                <div class="flex flex-col gap-3 mt-4">
                    @auth
                        <a href="{{ route('portal.dashboard') }}" class="bg-amber-brand text-navy-dark text-center py-3 rounded-lg font-bold uppercase tracking-wider">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white text-center py-3 font-bold border border-white/10 rounded-lg">Login</a>
                        <a href="{{ route('register') }}" class="bg-amber-brand text-navy-dark text-center py-3 rounded-lg font-bold uppercase tracking-wider">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy-dark text-white pt-20 pb-10 border-t border-white/5 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px] -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-amber-brand/5 rounded-full blur-[100px] translate-y-1/3 pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand Column -->
                <div class="space-y-6">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-brand to-amber-light rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-navy-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold font-heading">GlobalLine</span>
                    </a>
                    <p class="text-white/50 text-sm leading-relaxed">
                        The operating system for global trade. Connecting manufacturers to markets with speed, transparency, and reliability.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-amber-brand hover:text-navy-dark transition-all">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-amber-brand hover:text-navy-dark transition-all">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 font-heading">Solutions</h4>
                    <ul class="space-y-4 text-sm text-white/60">
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Air Freight</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Ocean Cargo</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Customs Brokerage</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Warehousing</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6 font-heading">Company</h4>
                    <ul class="space-y-4 text-sm text-white/60">
                        <li><a href="#" class="hover:text-amber-brand transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Partner Program</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6 font-heading">Legal</h4>
                    <ul class="space-y-4 text-sm text-white/60">
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-amber-brand transition-colors">Compliance</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/40">
                <p>&copy; 2026 GlobalLine Logistics. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        System Operational
                    </span>
                    <span>v2.4.0</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>
