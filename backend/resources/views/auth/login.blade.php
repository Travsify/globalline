@extends('layouts.public')

@section('title', 'Login | GlobalLine Enterprise')

@section('content')

    <section class="min-h-screen flex items-center justify-center pt-24 pb-12 bg-brand-navy relative overflow-hidden">
        <!-- Background Imagery -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=80" 
                 class="w-full h-full object-cover opacity-20 scale-110 blur-sm" alt="Logistics Background">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-navy via-brand-navy/90 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-md mx-auto">
                
                <!-- Login Card -->
                <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden relative group">
                    <div class="absolute top-0 left-0 w-full h-2 bg-brand-gold"></div>
                    
                    <div class="p-12">
                        <div class="text-center mb-10">
                            <h2 class="text-3xl font-heading font-black text-brand-navy uppercase tracking-tight italic mb-2">Welcome Back</h2>
                            <p class="text-sm text-slate-400 font-medium">Access your global enterprise dashboard</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-brand-navy uppercase tracking-widest ml-1">Business Email</label>
                                <div class="relative">
                                    <input type="email" name="email" required autofocus
                                           class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold transition-soft" 
                                           placeholder="name@company.com">
                                    @error('email')
                                        <p class="text-[10px] text-red-500 font-bold mt-1 ml-1 uppercase">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between items-center px-1">
                                    <label class="text-[10px] font-black text-brand-navy uppercase tracking-widest">Password</label>
                                    <a href="{{ route('password.request') }}" class="text-[10px] font-black text-brand-gold uppercase tracking-widest hover:underline">Forgot?</a>
                                </div>
                                <input type="password" name="password" required
                                       class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold transition-soft" 
                                       placeholder="••••••••">
                            </div>

                            <div class="flex items-center ml-1">
                                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-brand-gold border-slate-300 rounded focus:ring-brand-gold">
                                <label for="remember" class="ml-3 text-[10px] font-black text-slate-400 uppercase tracking-widest cursor-pointer">Stay Authenticated</label>
                            </div>

                            <button type="submit" class="w-full bg-brand-navy hover:bg-brand-lightNavy text-brand-gold py-5 rounded-2xl text-sm font-black uppercase tracking-[0.2em] transition-soft shadow-xl italic active:scale-95 mt-4">
                                Enter Portal
                            </button>
                        </form>

                        <div class="mt-12 pt-8 border-t border-slate-50 text-center">
                            <p class="text-xs text-slate-400 font-medium mb-4">No enterprise account yet?</p>
                            <a href="{{ route('register') }}" class="text-brand-navy font-black uppercase tracking-widest text-xs border-b border-brand-navy/10 hover:border-brand-navy pb-1 transition-soft italic">Create Account &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Branding Footer -->
                <div class="mt-8 text-center">
                    <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.5em] italic">GlobalLine Professional Series v4.0</p>
                </div>
            </div>
        </div>
    </section>

@endsection
