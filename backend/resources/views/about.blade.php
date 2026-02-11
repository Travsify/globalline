<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us | GlobalLine Logistics</title>
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
            <a href="{{ url('/services') }}" class="hover:text-brand-gold">Services</a>
            <a href="{{ url('/about') }}" class="text-brand-gold font-bold">About Us</a>
        </div>
        <a href="/portal/dashboard" class="bg-brand-gold text-brand-navy px-6 py-2 rounded-full font-bold">Portal Access</a>
    </nav>

    <main class="pt-32 pb-24">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-24">
                <span class="inline-block px-4 py-1 bg-brand-gold/10 text-brand-navy rounded-full text-[10px] font-black uppercase tracking-widest mb-6 italic">Our Mission</span>
                <h1 class="text-5xl md:text-7xl font-heading font-black text-brand-navy mb-8 tracking-tight italic">Borderless Commerce <br>For Everyone.</h1>
                <p class="text-xl text-slate-500 leading-relaxed max-w-3xl mx-auto">GlobalLine was born from a simple observation: international trade is too complex. We're here to fix that by merging logistics, technology, and finance into one seamless ecosystem.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center mb-32">
                <div>
                    <h2 class="text-3xl font-heading font-bold text-brand-navy mb-6 italic">The Vision</h2>
                    <p class="text-slate-600 leading-relaxed mb-6">We envision a world where a small business in Lagos can source directly from a factory in Guangzhou with the same ease as buying from a local shop. No hidden fees, no language barriers, and no shipping delays.</p>
                    <div class="p-8 bg-slate-50 rounded-[2rem] border-l-4 border-brand-gold">
                        <p class="italic text-brand-navy font-bold">"Efficiency is the ultimate currency of global trade. We build the rails so you can run the race."</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="aspect-square bg-slate-100 rounded-[2rem] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
                    </div>
                    <div class="aspect-square bg-brand-navy rounded-[2rem] flex items-center justify-center p-8 text-center">
                        <p class="text-white font-heading font-black text-2xl tracking-tighter uppercase italic">24h <br><span class="text-brand-gold uppercase not-italic text-xs font-bold tracking-widest">Payments</span></p>
                    </div>
                    <div class="aspect-square bg-brand-gold rounded-[2rem] flex items-center justify-center p-8 text-center text-brand-navy">
                        <p class="font-heading font-black text-2xl tracking-tighter uppercase italic">Global <br><span class="text-brand-navy uppercase not-italic text-xs font-bold tracking-widest">Reach</span></p>
                    </div>
                    <div class="aspect-square bg-slate-100 rounded-[2rem] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="bg-brand-navy p-16 rounded-[4rem] text-center text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-brand-gold/5 blur-3xl rounded-full translate-y-1/2"></div>
                <h2 class="text-4xl font-heading font-bold mb-8 relative z-10 italic">Ready to scale your business?</h2>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 relative z-10">
                    <a href="/register" class="bg-brand-gold text-brand-navy px-10 py-4 rounded-2xl font-black italic uppercase tracking-widest shadow-xl">Join GlobalLine</a>
                    <a href="/portal/dashboard" class="text-white/60 font-bold hover:text-white transition-colors">Enterprise Access &rarr;</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-brand-navy text-white/40 py-12 text-center border-t border-white/5">
        <p class="text-xs uppercase font-bold tracking-[0.2em]">&copy; 2026 GlobalLine Logistics Services. Innovating Borders.</p>
    </footer>
</body>
</html>
