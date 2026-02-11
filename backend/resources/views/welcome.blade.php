<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GlobalLine | Premier International Logistics & Shipping</title>
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
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #002366 0%, #0D47A1 100%);
        }
    </style>
</head>
<body class="antialiased font-sans text-slate-800 bg-[#F0F4F8]">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass border-b border-white/10 py-4 px-6 md:px-12 flex justify-between items-center bg-brand-navy/80">
        <div class="flex items-center space-x-2">
            <div class="w-10 h-10 bg-brand-gold rounded-xl flex items-center justify-center shadow-lg shadow-brand-gold/20">
                <svg class="w-6 h-6 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.065M15 3.935V5.5A2.5 2.5 0 0012.5 8h-.5a2 2 0 01-2-2 2 2 0 00-2-2 2 2 0 01-2-2V3.935M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-2xl font-bold font-heading text-white tracking-tight">GlobalLine</span>
        </div>
        <div class="hidden md:flex space-x-8 text-white/80 font-medium">
            <a href="{{ url('/') }}" class="hover:text-brand-gold transition-colors">Home</a>
            <a href="{{ url('/services') }}" class="hover:text-brand-gold transition-colors">Services</a>
            <a href="{{ url('/about') }}" class="hover:text-brand-gold transition-colors">About Us</a>
            <a href="#contact" class="hover:text-brand-gold transition-colors">Support</a>
        </div>
        <a href="/admin" class="bg-brand-gold text-brand-navy px-6 py-2.5 rounded-full font-bold shadow-xl shadow-brand-gold/20 hover:scale-105 transition-transform">Get Started</a>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-brand-navy pt-40 pb-56 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-brand-gold/5 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-1/3 h-1/2 bg-blue-500/10 blur-[100px] rounded-full -translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center max-w-5xl">
            <span class="inline-block px-4 py-2 bg-brand-gold/10 border border-brand-gold/20 text-brand-gold rounded-full text-xs font-bold uppercase tracking-[0.2em] mb-8 animate-fade-in italic">Multi-Currency Wallet · Global Logistics · Manufacturer Sourcing</span>
            <h1 class="text-6xl md:text-8xl font-heading font-black text-white leading-tight mb-8">Move Cargo. <br><span class="text-brand-gold italic">Scale Globally.</span></h1>
            <p class="text-xl text-white/50 leading-relaxed mb-12 max-w-3xl mx-auto">The vertically integrated ecosystem for global commerce. Ship from anywhere, source directly from factories, and manage your enterprise funds in USD, CNY, or NGN.</p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-16">
                <!-- App Store Badge -->
                <a href="#" class="w-48 h-14 bg-black border border-white/20 rounded-xl flex items-center px-4 hover:border-brand-gold transition-colors group">
                    <svg class="w-8 h-8 text-white group-hover:text-brand-gold transition-colors" fill="currentColor" viewBox="0 0 384 512"><path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/></svg>
                    <div class="ml-3 text-left">
                        <p class="text-[10px] text-white/60 font-medium uppercase tracking-tighter text-left">Download on the</p>
                        <p class="text-lg text-white font-bold leading-tight -mt-1 font-heading">App Store</p>
                    </div>
                </a>
                <!-- Play Store Badge -->
                <a href="#" class="w-48 h-14 bg-black border border-white/20 rounded-xl flex items-center px-4 hover:border-brand-gold transition-colors group">
                    <svg class="w-8 h-8 text-white group-hover:text-brand-gold transition-colors" fill="currentColor" viewBox="0 0 512 512"><path d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L325.3 277.7 104.6 499z"/></svg>
                    <div class="ml-3 text-left">
                        <p class="text-[10px] text-white/60 font-medium uppercase tracking-tighter text-left">Get it on</p>
                        <p class="text-lg text-white font-bold leading-tight -mt-1 font-heading">Google Play</p>
                    </div>
                </a>
            </div>

            <!-- Global Tracking Bar -->
            <div class="max-w-3xl mx-auto relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-brand-gold to-brand-accent rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] p-3 shadow-2xl">
                    <div class="flex-1 flex items-center px-6">
                        <svg class="w-6 h-6 text-slate-300 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Track Package (e.g. GL-82941)" class="w-full h-12 text-slate-800 font-bold focus:outline-none placeholder-slate-300">
                    </div>
                    <button class="bg-brand-navy text-white px-10 py-4 rounded-2xl font-bold hover:bg-brand-accent transition-all whitespace-nowrap shadow-xl">Track Shipment</button>
                    <div class="w-px bg-slate-100 mx-2 hidden md:block"></div>
                    <a href="/portal/dashboard" class="hidden md:flex items-center px-6 text-brand-navy font-bold hover:text-brand-accent transition-colors">
                        Enterprise Access &rarr;
                    </a>
                </div>
            </div>

            <div class="mt-10 flex items-center justify-center space-x-8 text-white/30">
                <div class="flex items-center space-x-2 font-bold uppercase tracking-widest text-[10px]">
                    <svg class="w-4 h-4 text-brand-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>1688 Verified</span>
                </div>
                <div class="flex items-center space-x-2 font-bold uppercase tracking-widest text-[10px]">
                    <svg class="w-4 h-4 text-brand-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>Alibaba Partner</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Services Grid v2 -->
    <section id="features" class="py-32 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl md:text-5xl font-heading font-black text-brand-navy mb-6 tracking-tight">One Robust System.<br>Total Global Control.</h2>
                <div class="w-20 h-1.5 bg-brand-gold mx-auto rounded-full mb-8"></div>
                <p class="text-slate-500 text-lg">We've bridged the gap between Chinese manufacturing and the global market with four core pillars of excellence.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Air Logistics -->
                <div class="group p-10 bg-slate-50 rounded-[3rem] border border-transparent hover:border-brand-gold/30 hover:bg-white hover:shadow-2xl hover:shadow-brand-gold/5 transition-all duration-500">
                    <div class="w-16 h-16 bg-blue-50 text-brand-navy rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-brand-navy mb-4">Express Air</h3>
                    <p class="text-slate-500 leading-relaxed mb-8">Daily flights from Guangzhou & Shenzhen. Delivery in 5-7 business days with GL-Tracking.</p>
                    <a href="/portal/dashboard" class="text-sm font-bold text-brand-navy flex items-center group-hover:translate-x-2 transition-transform">Get Started <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>

                <!-- Sea Logistics -->
                <div class="group p-10 bg-slate-50 rounded-[3rem] border border-transparent hover:border-brand-gold/30 hover:bg-white hover:shadow-2xl hover:shadow-brand-gold/5 transition-all duration-500">
                    <div class="w-16 h-16 bg-blue-50 text-brand-navy rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-brand-navy mb-4">Cargo Sea</h3>
                    <p class="text-slate-500 leading-relaxed mb-8">Cost-effective groupage and full-container solutions for heavy machinery and bulk orders.</p>
                    <a href="/portal/dashboard" class="text-sm font-bold text-brand-navy flex items-center group-hover:translate-x-2 transition-transform">Ship Bulk <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>

                <!-- Procurement -->
                <div class="group p-10 bg-brand-gold/5 rounded-[3rem] border border-brand-gold/10 hover:bg-white hover:shadow-2xl hover:shadow-brand-gold/5 transition-all duration-500">
                    <div class="w-16 h-16 bg-brand-gold text-brand-navy rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-brand-navy mb-4">Procurement</h3>
                    <p class="text-slate-500 leading-relaxed mb-8">Direct 1688, Taobao & Tmall sourcing. Our team in China buys, inspects, and consolidates for you.</p>
                    <a href="/portal/marketplace" class="text-sm font-bold text-brand-navy flex items-center group-hover:translate-x-2 transition-transform">Start Sourcing <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>

                <!-- Global Payment -->
                <div class="group p-10 bg-slate-50 rounded-[3rem] border border-transparent hover:border-brand-gold/30 hover:bg-white hover:shadow-2xl hover:shadow-brand-gold/5 transition-all duration-500">
                    <div class="w-16 h-16 bg-blue-50 text-brand-navy rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-brand-navy mb-4">Wire Transfers</h3>
                    <p class="text-slate-500 leading-relaxed mb-8">Securely pay factories in Yuan or USD. Swift wire transfers completed within 24 hours.</p>
                    <a href="/portal/payments" class="text-sm font-bold text-brand-navy flex items-center group-hover:translate-x-2 transition-transform">Learn More <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 bg-brand-navy text-white px-6 md:px-12 relative overflow-hidden">
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-brand-gold/5 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/2">
                    <h2 class="text-4xl md:text-5xl font-heading font-bold mb-8">Simple Steps to Your Shipment</h2>
                    <div class="space-y-12">
                        <div class="flex items-start space-x-6">
                            <div class="text-4xl font-heading font-bold text-brand-gold">01</div>
                            <div>
                                <h4 class="text-2xl font-bold mb-2">Create Account</h4>
                                <p class="text-white/60">Sign up on our mobile app or web portal and link your wallet.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-6">
                            <div class="text-4xl font-heading font-bold text-brand-gold">02</div>
                            <div>
                                <h4 class="text-2xl font-bold mb-2">Book Shipment</h4>
                                <p class="text-white/60">Enter origin and destination details to get an instant quote and tracking ID.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-6">
                            <div class="text-4xl font-heading font-bold text-brand-gold">03</div>
                            <div>
                                <h4 class="text-2xl font-bold mb-2">Track & Receive</h4>
                                <p class="text-white/60">Monitor your package across borders and receive it right at your door.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Visual Element -->
                <div class="md:w-1/2 flex justify-center">
                   <div class="relative w-full max-w-sm">
                        <div class="absolute inset-0 bg-brand-gold blur-3xl opacity-20 animate-pulse"></div>
                        <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80" 
                             class="rounded-[3rem] shadow-2xl relative z-10 border-8 border-white/5" 
                             alt="Logistics">
                   </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-brand-gold">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-brand-navy">
            <div>
                <p class="text-5xl font-heading font-bold mb-2">200+</p>
                <p class="font-bold opacity-70">Countries Served</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2">50k+</p>
                <p class="font-bold opacity-70">Happy Clients</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2">12M+</p>
                <p class="font-bold opacity-70">Packages Moved</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2">24/7</p>
                <p class="font-bold opacity-70">Expert Support</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 px-6 md:px-12 max-w-3xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-brand-navy font-heading text-4xl font-bold mb-4">Have Questions?</h2>
            <p class="text-slate-500">Our logistics experts are ready to help you navigate international shipping.</p>
        </div>
        
        <form class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="text" name="name" placeholder="Full Name" required class="w-full bg-white px-6 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-navy transition-all">
                <input type="email" name="email" placeholder="Email Address" required class="w-full bg-white px-6 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-navy transition-all">
            </div>
            <input type="text" name="subject" placeholder="Subject" required class="w-full bg-white px-6 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-navy transition-all">
            <textarea name="message" rows="5" placeholder="Your Message" required class="w-full bg-white px-6 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-navy transition-all"></textarea>
            <button type="submit" class="w-full bg-brand-navy text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-brand-accent transition-all">Send Message</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-navy text-white py-20 px-6 md:px-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between border-b border-white/10 pb-12">
            <div class="mb-12 md:mb-0 max-w-sm">
                 <div class="flex items-center space-x-2 mb-8">
                    <div class="w-8 h-8 bg-brand-gold rounded-lg flex items-center justify-center font-bold text-brand-navy uppercase">G</div>
                    <span class="text-2xl font-bold font-heading">GlobalLine</span>
                </div>
                <p class="text-white/40 leading-relaxed mb-8">Removing borders and simplifying global commerce for everyone, everywhere.</p>
                <div class="flex space-x-4">
                    <div class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-brand-gold hover:border-brand-gold transition-colors cursor-pointer"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></div>
                    <div class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-brand-gold hover:border-brand-gold transition-colors cursor-pointer"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.054 1.805.249 2.227.412.56.217.96.477 1.38.897.42.42.68.82.897 1.38.163.422.358 1.057.412 2.227.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.054 1.17-.249 1.805-.412 2.227-.217.56-.477.96-.897 1.38-.42.42-.82.68-1.38.897-.422.163-1.057.358-2.227.412-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.054-1.805-.249-2.227-.412-.56-.217-.96-.477-1.38-.897-.42-.42-.68-.82-.897-1.38-.163-.422-.358-1.057-.412-2.227-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.054-1.17.249-1.805.412-2.227.217-.56.477-.96.897-1.38.42-.42.82-.68 1.38-.897.422-.163 1.057-.358 2.227-.412 1.266-.058 1.646-.07 4.85-.07zM12 0c-3.259 0-3.667.014-4.947.072-1.277.057-2.148.258-2.911.554-.788.306-1.457.715-2.122 1.38-.665.665-1.074 1.334-1.38 2.122-.296.763-.497 1.634-.554 2.911-.059 1.28-.073 1.688-.073 4.947s.014 3.667.072 4.947c.057 1.277.258 2.148.554 2.911.306.788.715 1.457 1.38 2.122.665.665 1.334 1.074 2.122 1.38.763.296 1.634.497 2.911.554 1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.277-.057 2.148-.258 2.911-.554.788-.306 1.457-.715 2.122-1.38.665-.665 1.074-1.334 1.38-2.122.296-.763.497-1.634.554-2.911.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.057-1.277-.258-2.148-.554-2.911-.306-.788-.715-1.457-1.38-2.122-.665-.665-1.334-1.074-2.122-1.38-.763-.296-1.634-.497-2.911-.554-1.28-.058-1.688-.072-4.947-.072zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/></svg></div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-12 mt-12 md:mt-0 font-medium">
                <div>
                    <h5 class="text-white mb-6 font-heading font-bold">Company</h5>
                    <ul class="space-y-4 text-white/50">
                        <li><a href="{{ url('/about') }}" class="hover:text-brand-gold">About Us</a></li>
                        <li><a href="{{ url('/services') }}" class="hover:text-brand-gold">Our Services</a></li>
                        <li><a href="#contact" class="hover:text-brand-gold">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white mb-6 font-heading font-bold">Resources</h5>
                    <ul class="space-y-4 text-white/50">
                        <li><a href="#" class="hover:text-brand-gold">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-brand-gold">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-brand-gold">Billing</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-10 text-center text-white/20 text-sm font-bold tracking-widest uppercase">
            &copy; 2026 GlobalLine Logistics Services. All Rights Reserved.
        </div>
    </footer>
</body>
</html>
