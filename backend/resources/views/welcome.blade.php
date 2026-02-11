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
            <a href="#features" class="hover:text-brand-gold transition-colors">Features</a>
            <a href="#how-it-works" class="hover:text-brand-gold transition-colors">How it Works</a>
            <a href="#contact" class="hover:text-brand-gold transition-colors">Support</a>
        </div>
        <a href="/admin" class="bg-brand-gold text-brand-navy px-6 py-2.5 rounded-full font-bold shadow-xl shadow-brand-gold/20 hover:scale-105 transition-transform">Get Started</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-20 px-6 md:px-12 relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-gold/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-24 -left-24 w-72 h-72 bg-white/5 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 text-white z-10">
                <span class="inline-block px-4 py-1.5 mb-6 rounded-full bg-white/10 text-brand-gold text-sm font-bold border border-white/20 uppercase tracking-widest">Global Logistics Redefined</span>
                <h1 class="text-5xl md:text-7xl font-heading font-bold leading-tight mb-8">
                    Ship Anything, <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-gold to-yellow-200">Anywhere.</span>
                </h1>
                <p class="text-lg md:text-xl text-white/80 mb-10 leading-relaxed max-w-xl font-light">
                    Join thousands of businesses and individuals sending packages to over 200 countries with real-time tracking and premium reliability.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <button class="bg-brand-gold text-brand-navy px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl hover:shadow-brand-gold/30 hover:-translate-y-1 transition-all">Download App</button>
                    <button class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z"></path></svg>
                        Watch Demo
                    </button>
                </div>
            </div>
            <!-- Interactive Card Preview -->
            <div class="md:w-1/2 mt-16 md:mt-0 relative flex justify-center">
                <div class="glass p-8 rounded-[2rem] border-white/20 shadow-2xl relative z-10 w-full max-w-md transform rotate-2 hover:rotate-0 transition-transform duration-500">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <p class="text-white/60 text-xs uppercase tracking-widest font-bold">Estimated Delivery</p>
                            <p class="text-white text-lg font-heading font-bold">Feb 14, 2026</p>
                        </div>
                        <div class="bg-brand-gold/20 p-3 rounded-2xl">
                            <svg class="w-6 h-6 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-4 h-4 rounded-full bg-brand-gold mt-1.5 mr-4 shadow-lg shadow-brand-gold/50"></div>
                            <div>
                                <p class="text-white font-bold">Lagos, Nigeria</p>
                                <p class="text-white/50 text-sm">Package received at facility</p>
                            </div>
                        </div>
                        <div class="h-10 border-l border-dashed border-white/20 ml-2"></div>
                        <div class="flex items-start">
                            <div class="w-4 h-4 rounded-full bg-white/20 mt-1.5 mr-4"></div>
                            <div>
                                <p class="text-white/60 font-bold">London, UK</p>
                                <p class="text-white/50 text-sm">Destination destination</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-white/10 flex justify-between items-center">
                        <span class="text-white font-bold leading-none">Tracking: GL-882941</span>
                        <span class="bg-brand-gold text-brand-navy px-3 py-1 rounded-lg text-xs font-bold uppercase">In Transit</span>
                    </div>
                </div>
                <!-- Mini Stats Card -->
                <div class="absolute -bottom-10 -right-5 md:-right-10 bg-white p-6 rounded-3xl shadow-2xl z-20 flex items-center space-x-4 animate-bounce hover:pause">
                    <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Delivered</p>
                        <p class="text-brand-navy font-heading font-bold text-xl">1.2M+ Units</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-brand-navy font-heading text-4xl md:text-5xl font-bold mb-4">Everything You Need To Move Global</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Stop worrying about customs, tariffs, or missing packages. We've built an infrastructure designed for speed and clarity.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl hover:-translate-y-2 transition-transform duration-300 border border-slate-100 group">
                <div class="w-16 h-16 bg-brand-navy rounded-2xl flex items-center justify-center mb-8 group-hover:bg-brand-gold transition-colors duration-300">
                    <svg class="w-8 h-8 text-white group-hover:text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-heading font-bold mb-4 text-brand-navy">Fast Shipping</h3>
                <p class="text-slate-500 leading-relaxed">Air and sea freight options optimized for your budget. Door-to-door delivery in as little as 3 business days.</p>
            </div>
            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl hover:-translate-y-2 transition-transform duration-300 border border-slate-100 group">
                <div class="w-16 h-16 bg-brand-navy rounded-2xl flex items-center justify-center mb-8 group-hover:bg-brand-gold transition-colors duration-300">
                    <svg class="w-8 h-8 text-white group-hover:text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-2xl font-heading font-bold mb-4 text-brand-navy">Secured Payments</h3>
                <p class="text-slate-500 leading-relaxed">Integrated wallet system allows you to pay in your local currency while we handle international wire transfers.</p>
            </div>
            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl hover:-translate-y-2 transition-transform duration-300 border border-slate-100 group">
                <div class="w-16 h-16 bg-brand-navy rounded-2xl flex items-center justify-center mb-8 group-hover:bg-brand-gold transition-colors duration-300">
                    <svg class="w-8 h-8 text-white group-hover:text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-heading font-bold mb-4 text-brand-navy">China Sourcing</h3>
                <p class="text-slate-500 leading-relaxed">Buy directly from top manufacturers in China. We handle the pickup, inspection, and international shipping.</p>
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
                        <li><a href="#" class="hover:text-brand-gold">About Us</a></li>
                        <li><a href="#" class="hover:text-brand-gold">Our Vision</a></li>
                        <li><a href="#" class="hover:text-brand-gold">Contact</a></li>
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
