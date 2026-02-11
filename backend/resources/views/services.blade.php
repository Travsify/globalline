<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Services | GlobalLine Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
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
</head>
<body class="antialiased font-sans text-slate-800 bg-white">
    <!-- Navbar (Simplified) -->
    <nav class="fixed w-full z-50 py-4 px-6 md:px-12 flex justify-between items-center bg-brand-navy shadow-lg">
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <div class="w-10 h-10 bg-brand-gold rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.065M15 3.935V5.5A2.5 2.5 0 0012.5 8h-.5a2 2 0 01-2-2 2 2 0 00-2-2 2 2 0 01-2-2V3.935M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-2xl font-bold font-heading text-white tracking-tight">GlobalLine</span>
        </a>
        <div class="hidden md:flex space-x-8 text-white/80 font-medium">
            <a href="{{ url('/') }}" class="hover:text-brand-gold">Home</a>
            <a href="{{ url('/services') }}" class="text-brand-gold font-bold">Services</a>
            <a href="{{ url('/about') }}" class="hover:text-brand-gold">About Us</a>
        </div>
        <a href="/portal/dashboard" class="bg-brand-gold text-brand-navy px-6 py-2 rounded-full font-bold">Portal Access</a>
    </nav>

    <main class="pt-32 pb-24">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center mb-20">
                <h1 class="text-5xl md:text-6xl font-heading font-black text-brand-navy mb-6 tracking-tight">Our Enterprise Solutions</h1>
                <p class="text-xl text-slate-500 leading-relaxed">Integrated logistics, procurement, and financial tools designed for the modern global trader.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Logistics -->
                <div class="bg-slate-50 p-12 rounded-[3rem] border border-slate-100">
                    <div class="w-16 h-16 bg-blue-100 text-brand-navy rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </div>
                    <h3 class="text-3xl font-heading font-bold text-brand-navy mb-6">Global Logistics Hub</h3>
                    <p class="text-slate-600 leading-relaxed mb-6">Our freight network spans the globe, specialized in China-to-Africa, China-to-USA, and emerging Global-to-Global routes.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center text-sm font-bold text-slate-800">
                            <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-3 text-[10px]">&check;</span>
                            Daily Express Air Cargo
                        </li>
                        <li class="flex items-center text-sm font-bold text-slate-800">
                            <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-3 text-[10px]">&check;</span>
                            Full Container & Groupage Sea Freight
                        </li>
                        <li class="flex items-center text-sm font-bold text-slate-800">
                            <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-3 text-[10px]">&check;</span>
                            Automated Consolidation & Repacking
                        </li>
                    </ul>
                </div>

                <!-- Procurement -->
                <div class="bg-brand-gold/5 p-12 rounded-[3rem] border border-brand-gold/10">
                    <div class="w-16 h-16 bg-brand-gold text-brand-navy rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-heading font-bold text-brand-navy mb-6">Manufacturer Sourcing</h3>
                    <p class="text-slate-600 leading-relaxed mb-6">Direct integration with 1688 and Alibaba allows you to purchase at factory prices without the complexity of language or payment barriers.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center text-sm font-bold text-slate-800">
                            <span class="w-6 h-6 bg-brand-gold/20 text-brand-navy rounded-full flex items-center justify-center mr-3 text-[10px]">&check;</span>
                            English-Simplified 1688 Search
                        </li>
                        <li class="flex items-center text-sm font-bold text-slate-800">
                            <span class="w-6 h-6 bg-brand-gold/20 text-brand-navy rounded-full flex items-center justify-center mr-3 text-[10px]">&check;</span>
                            Bespoke Product Sourcing Requests
                        </li>
                    </ul>
                </div>

                <!-- Wallet -->
                <div class="bg-brand-navy p-12 rounded-[3rem] text-white">
                    <div class="w-16 h-16 bg-white/10 text-brand-gold rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-heading font-bold mb-6 italic">Multi-Currency Wallet</h3>
                    <p class="text-white/60 leading-relaxed mb-6">Hold and manage funds in USD, CNY, and NGN. Convert instantly to pay suppliers or settle shipping fees without traditional bank delays.</p>
                    <div class="flex space-x-2">
                         <span class="px-3 py-1 bg-white/10 rounded-full text-[10px] font-bold tracking-widest uppercase">USD</span>
                         <span class="px-3 py-1 bg-white/10 rounded-full text-[10px] font-bold tracking-widest uppercase">CNY</span>
                         <span class="px-3 py-1 bg-white/10 rounded-full text-[10px] font-bold tracking-widest uppercase">NGN</span>
                    </div>
                </div>

                 <!-- Security -->
                <div class="bg-slate-900 p-12 rounded-[3rem] text-white">
                    <div class="w-16 h-16 bg-white/10 text-brand-gold rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-heading font-bold mb-6">Trust & Security</h3>
                    <p class="text-white/60 leading-relaxed mb-6">Enterprise-grade KYC verification and secure escrow payments for total peace of mind in international trade.</p>
                    <a href="/portal/kyc" class="text-brand-gold font-bold text-sm underline decoration-brand-gold/30 hover:decoration-brand-gold transition-all">Complete Verification &rarr;</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-brand-navy text-white/40 py-12 text-center border-t border-white/5">
        <p class="text-xs uppercase font-bold tracking-[0.2em]">&copy; 2026 GlobalLine Logistics Services. Borderless Commerce.</p>
    </footer>
</body>
</html>
