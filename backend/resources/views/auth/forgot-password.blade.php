@extends('layouts.public')

@section('title', 'Recover Account | GlobalLine Enterprise')

@section('content')

    <section class="min-h-screen flex items-center justify-center pt-24 pb-12 bg-brand-navy relative overflow-hidden">
        <!-- Background Imagery -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=2000&q=80" 
                 class="w-full h-full object-cover opacity-10 blur-md scale-110" alt="Logistics Background">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-md mx-auto">
                
                <!-- Forgot Password Card -->
                <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden relative group">
                    <div class="absolute top-0 right-0 w-full h-2 bg-brand-gold"></div>
                    
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-8">
                             <svg class="w-10 h-10 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        </div>

                        <h2 class="text-3xl font-heading font-black text-brand-navy uppercase tracking-tight italic mb-3">Recover Access</h2>
                        <p class="text-sm text-slate-400 font-medium mb-10 leading-relaxed">Enter your registered email and we'll send you a secure recovery link.</p>

                        <form method="POST" action="#" class="space-y-6">
                            @csrf
                            <div class="space-y-2 text-left">
                                <label class="text-[10px] font-black text-brand-navy uppercase tracking-widest ml-1">Account Email</label>
                                <input type="email" name="email" required autofocus
                                       class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold transition-soft" 
                                       placeholder="you@company.com">
                            </div>

                            <button type="submit" class="w-full bg-brand-navy hover:bg-brand-lightNavy text-brand-gold py-5 rounded-2xl text-sm font-black uppercase tracking-[0.2em] transition-soft shadow-xl italic active:scale-95 mt-4">
                                Send Reset Link
                            </button>
                        </form>

                        <div class="mt-12 pt-8 border-t border-slate-50 text-center">
                            <a href="{{ route('login') }}" class="text-brand-navy font-black uppercase tracking-widest text-xs border-b border-brand-navy/10 hover:border-brand-navy pb-1 transition-soft italic">&larr; Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
