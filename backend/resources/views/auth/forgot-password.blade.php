@extends('layouts.public')

@section('title', 'Recover Access | GlobalLine Enterprise')

@section('content')

    <section class="min-h-screen flex items-stretch">
        <!-- Left Side: Hero Visualization -->
        <div class="hidden lg:flex lg:w-1/2 bg-brand-navy relative items-center justify-center overflow-hidden p-24">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1200&q=80" 
                     class="w-full h-full object-cover opacity-10 blur-sm grayscale" alt="Recovery">
                <div class="absolute inset-0 bg-gradient-to-t from-brand-navy via-brand-navy/60 to-transparent"></div>
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:30px_30px]"></div>
            </div>

            <div class="relative z-10 text-center max-w-lg">
                <div class="w-24 h-24 bg-white/5 border border-white/10 rounded-[2rem] flex items-center justify-center mx-auto mb-10">
                    <svg class="w-12 h-12 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <h2 class="text-5xl font-black text-white leading-tight mb-8 tracking-tighter uppercase italic">
                    Key <br><span class="text-brand-gold italic">Recovery.</span>
                </h2>
                <p class="text-white/30 text-lg font-medium italic leading-relaxed">
                    Your enterprise credentials are protected by 256-bit encryption. Reset is secure and instant.
                </p>
            </div>
            
            <div class="absolute bottom-12 left-12 flex items-center gap-4">
                <div class="w-2 h-2 rounded-full bg-brand-gold animate-pulse"></div>
                <span class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em] italic">Sec_Protocol: Active</span>
            </div>
        </div>

        <!-- Right Side: Recovery Form -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 md:p-24 relative">
            <div class="max-w-md w-full">
                <div class="mb-12">
                    <h1 class="text-4xl font-black text-brand-navy tracking-tighter uppercase italic mb-4">Reset <span class="text-brand-gold">Access.</span></h1>
                    <p class="text-slate-400 font-medium italic leading-relaxed">Enter the email associated with your enterprise identity. We'll dispatch a secure recovery link to your inbox.</p>
                </div>

                @if (session('status'))
                    <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                            <p class="text-sm text-emerald-700 font-bold italic">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.request') }}" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Registered Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none transition-colors group-focus-within:text-brand-gold">
                                <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" required autofocus
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] pl-16 pr-8 py-5 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="you@company.com">
                        </div>
                        @error('email')
                            <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 uppercase italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-brand-navy hover:bg-brand-gold hover:text-brand-navy text-white py-6 rounded-[1.5rem] text-xs font-black uppercase tracking-[0.3em] transition-all shadow-3xl italic active:scale-95 group relative overflow-hidden">
                        <span class="relative z-10 uppercase">Dispatch Recovery Key &rarr;</span>
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </button>
                </form>

                <div class="mt-16 pt-10 border-t border-slate-50 text-center">
                    <a href="{{ route('login') }}" class="inline-block bg-slate-50 text-brand-navy px-10 py-4 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-brand-navy hover:text-white transition-all italic">&larr; Return to Authentication</a>
                </div>
            </div>
        </div>
    </section>

@endsection
