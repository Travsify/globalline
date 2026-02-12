<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GlobalLine | Global Sourcing & Logistics Simplified')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#0E1B3D',
                            lightNavy: '#1A2B56',
                            gold: '#C5A059',
                            goldHover: '#B38E47',
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
        .glass-nav {
            background: rgba(14, 27, 61, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(197, 160, 89, 0.1);
        }
        .hero-overlay {
            background: linear-gradient(to right, rgba(14, 27, 61, 0.9) 0%, rgba(14, 27, 61, 0.4) 100%);
        }
        .gold-outline-text {
            -webkit-text-stroke: 1px #C5A059;
            color: transparent;
        }
        .transition-soft { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        [x-cloak] { display: none !important; }
    </style>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased font-sans text-brand-navy bg-white selection:bg-brand-gold selection:text-white" x-data="{ mobileMenu: false }">

    <!-- Header / Nav -->
    <nav class="fixed w-full z-50 glass-nav transition-soft">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg group-hover:scale-105 transition-soft">
                    <svg class="w-7 h-7 text-brand-navy" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <div>
                    <span class="block text-xl font-black font-heading text-white tracking-tight uppercase leading-none">Globalline</span>
                    <span class="block text-[10px] font-bold text-brand-gold uppercase tracking-[0.3em] mt-0.5">Logistics</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden lg:flex items-center space-x-10 text-white/90 font-semibold tracking-wide text-sm">
                <a href="{{ url('/') }}" class="hover:text-brand-gold transition-soft @if(Request::is('/')) text-brand-gold @endif">Home</a>
                <a href="{{ route('marketplace.index') }}" class="hover:text-brand-gold transition-soft @if(Request::is('marketplace*')) text-brand-gold @endif">Marketplace</a>
                <a href="{{ url('/services') }}" class="hover:text-brand-gold transition-soft @if(Request::is('services')) text-brand-gold @endif">Services</a>
                <a href="{{ url('/how-it-works') }}" class="hover:text-brand-gold transition-soft @if(Request::is('how-it-works')) text-brand-gold @endif">How It Works</a>
                <a href="{{ url('/about') }}" class="hover:text-brand-gold transition-soft @if(Request::is('about')) text-brand-gold @endif">About Us</a>
                <a href="{{ url('/contact') }}" class="hover:text-brand-gold transition-soft @if(Request::is('contact')) text-brand-gold @endif">Contact</a>
            </div>

            <!-- CTA -->
            <div class="hidden lg:block">
                @auth
                    <a href="{{ route('portal.dashboard') }}" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-8 py-3 rounded-xl font-black text-xs tracking-widest uppercase shadow-xl transition-soft active:scale-95 italic">
                        Terminal Dashboard
                    </a>
                @else
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('login') }}" class="text-white/80 hover:text-brand-gold text-xs font-black uppercase tracking-widest transition-soft italic">Login</a>
                        <a href="{{ route('register') }}" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-8 py-3 rounded-xl font-black text-xs tracking-widest uppercase shadow-xl transition-soft active:scale-95 italic">
                            Get Started
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Toggle -->
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-white p-2">
                <svg x-show="!mobileMenu" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenu" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 -translate-y-4" 
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-brand-navy border-t border-white/5 py-4 px-6 space-y-4" x-cloak>
            <a href="{{ url('/') }}" class="block text-white font-bold py-2">Home</a>
            <a href="{{ url('/services') }}" class="block text-white font-bold py-2">Services</a>
            <a href="{{ url('/how-it-works') }}" class="block text-white font-bold py-2">How It Works</a>
            <a href="{{ url('/about') }}" class="block text-white font-bold py-2">About Us</a>
            <a href="{{ url('/contact') }}" class="block text-white font-bold py-2">Contact</a>
            
            @auth
                <a href="{{ route('portal.dashboard') }}" class="block bg-brand-gold text-brand-navy text-center py-4 rounded-xl font-black uppercase tracking-widest italic">Go to Portal</a>
            @else
                <a href="{{ route('login') }}" class="block text-white text-center py-4 font-bold border border-white/10 rounded-xl">Login</a>
                <a href="{{ route('register') }}" class="block bg-brand-gold text-brand-navy text-center py-4 rounded-xl font-black uppercase tracking-widest italic">Get Started</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-brand-navy pt-24 pb-12 text-white overflow-hidden relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
                <div class="col-span-1 lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="w-10 h-10 bg-brand-gold rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-brand-navy" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-black font-heading tracking-tighter uppercase italic">Globalline</span>
                    </div>
                    <p class="text-white/50 text-sm leading-relaxed mb-8">
                        Simplifying global sourcing and logistics. We bridge the gap between global manufacturers and your doorstep with enterprise speed and precision.
                    </p>
                    <div class="flex space-x-4">
                        <!-- Socials -->
                        <a href="#" class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-gold transition-soft">
                             <span class="text-[8px] font-black italic">TW</span>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-brand-gold transition-soft">
                             <span class="text-[8px] font-black italic">LN</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-brand-gold font-bold uppercase tracking-[0.2em] text-xs mb-8">Navigation</h4>
                    <ul class="space-y-4 text-sm text-white/60 font-medium">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition-soft">Home Feed</a></li>
                        <li><a href="{{ url('/services') }}" class="hover:text-white transition-soft">Operational Services</a></li>
                        <li><a href="{{ url('/how-it-works') }}" class="hover:text-white transition-soft">Protocol Manual</a></li>
                        <li><a href="{{ url('/about') }}" class="hover:text-white transition-soft">Identity</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-brand-gold font-bold uppercase tracking-[0.2em] text-xs mb-8">Support & Legal</h4>
                    <ul class="space-y-4 text-sm text-white/60 font-medium">
                        <li><a href="{{ route('tracking') }}" class="hover:text-white transition-soft">Track Intel</a></li>
                        <li><a href="{{ url('/faq') }}" class="hover:text-white transition-soft">Intelligence Base (FAQ)</a></li>
                        <li><a href="#" class="hover:text-white transition-soft">Terms of Engagement</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-white transition-soft">Direct Conduit</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-brand-gold font-bold uppercase tracking-[0.2em] text-xs mb-8">Global Reach</h4>
                    <p class="text-sm text-white/60 leading-relaxed mb-6 italic">
                        Serving over 120 countries with dedicated hubs in Guangzhou, Lagos, and New York.
                    </p>
                    <div class="py-4 border-t border-white/10">
                        <div class="flex items-center space-x-2">
                             <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                             <p class="text-[10px] font-black uppercase tracking-widest text-brand-gold">Global Nodes: Online</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center">
                <p class="text-[10px] font-bold text-white/20 uppercase tracking-[0.3em] mb-4 md:mb-0">&copy; 2026 Globalline Logistics. Professional Series.</p>
                <div class="flex space-x-8 text-[10px] font-black uppercase tracking-widest text-white/40">
                    <span>CNY / USD / NGN</span>
                    <span>Global Nodes Active</span>
                    <span>Frontier Verified</span>
                </div>
            </div>
        </div>

        <!-- Abstract BG Decoration -->
        <div class="absolute bottom-0 right-0 w-1/3 h-1/2 bg-brand-gold/5 blur-[120px] rounded-full translate-x-1/2 translate-y-1/2"></div>
    </footer>

</body>
</html>
