@extends('layouts.public')

@section('title', 'Login | GlobalLine Enterprise')

@section('content')

    <section class="min-h-screen flex items-stretch">
        <!-- Left Side: Hero Visualization -->
        <div class="hidden lg:flex lg:w-1/2 bg-brand-navy relative items-center justify-center overflow-hidden p-24">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80" 
                     class="w-full h-full object-cover opacity-20 grayscale" alt="Logistics Flow">
                <div class="absolute inset-0 bg-gradient-to-t from-brand-navy via-brand-navy/60 to-transparent"></div>
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:30px_30px]"></div>
            </div>

            <div class="relative z-10 text-center max-w-lg">
                <div class="w-20 h-20 bg-brand-gold rounded-full flex items-center justify-center mx-auto mb-10 shadow-4xl animate-pulse">
                    <svg class="w-10 h-10 text-brand-navy" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                </div>
                <h2 class="text-5xl font-black text-white leading-tight mb-8 tracking-tighter uppercase italic">
                    The Global <br><span class="text-brand-gold italic">Control Center.</span>
                </h2>
                <p class="text-white/40 text-lg font-medium italic leading-relaxed">
                    Access your unified terminal for sourcing, settlements, and global logistics nodes.
                </p>
            </div>
            
            <div class="absolute bottom-12 left-12 flex items-center gap-4">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] italic">Node_Status: Systems_Optimal</span>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 md:p-24 relative">
            <div class="max-w-md w-full">
                <div class="mb-12">
                    <h1 class="text-4xl font-black text-brand-navy tracking-tighter uppercase italic mb-4">Initialize <span class="text-brand-gold">Access.</span></h1>
                    <p class="text-slate-400 font-medium italic">Enter your enterprise credentials to connect.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Enterprise Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none transition-colors group-focus-within:text-brand-gold">
                                <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" required autofocus
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] pl-16 pr-8 py-5 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="name@company.com">
                        </div>
                        @error('email')
                            <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 uppercase italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Secret Key</label>
                            <a href="{{ route('password.request') }}" class="text-[10px] font-black text-brand-gold uppercase tracking-widest hover:underline italic">Lost Access?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none transition-colors group-focus-within:text-brand-gold">
                                <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" name="password" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] pl-16 pr-8 py-5 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center ml-2">
                        <input type="checkbox" name="remember" id="remember" class="w-5 h-5 text-brand-gold border-slate-200 rounded-lg focus:ring-brand-gold">
                        <label for="remember" class="ml-4 text-[10px] font-black text-slate-400 uppercase tracking-widest cursor-pointer italic">Keep Session Secure</label>
                    </div>

                    <button type="submit" class="w-full bg-brand-navy hover:bg-brand-gold hover:text-brand-navy text-white py-6 rounded-[1.5rem] text-xs font-black uppercase tracking-[0.3em] transition-all shadow-3xl italic active:scale-95 group relative overflow-hidden">
                        <span class="relative z-10 uppercase">Authenticate Pipeline &rarr;</span>
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </button>
                </form>

                <div class="mt-16 pt-10 border-t border-slate-50 text-center">
                    <p class="text-xs text-slate-400 font-medium italic mb-6">New to GlobalLine Unified Sourcing?</p>
                    <a href="{{ route('register') }}" class="inline-block bg-slate-50 text-brand-navy px-10 py-4 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-brand-navy hover:text-white transition-all italic">Create Enterprise Identity</a>
                </div>
            </div>
            
            <!-- Floating Decorative -->
            <div class="absolute top-12 right-12 w-12 h-12 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center opacity-40">
                <span class="text-[8px] font-black italic">v5.2</span>
            </div>
        </div>
    </section>

@endsection
