@extends('layouts.public')

@section('title', 'Register | Join GlobalLine Enterprise')

@section('content')

    <section class="min-h-screen flex items-center justify-center pt-24 pb-12 bg-brand-navy relative overflow-hidden">
        <!-- Background Imagery -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1494412574744-ff70438f6920?auto=format&fit=crop&w=2000&q=80" 
                 class="w-full h-full object-cover opacity-20 scale-110 contrast-125" alt="Logistics Background">
            <div class="absolute inset-0 bg-gradient-to-tl from-brand-navy via-brand-navy/90 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-md mx-auto">
                
                <!-- Register Card -->
                <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden relative group">
                    <div class="absolute top-0 right-0 w-full h-2 bg-brand-gold"></div>
                    
                    <div class="p-10">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-heading font-black text-brand-navy uppercase tracking-tight italic mb-2">Join the Network</h2>
                            <p class="text-sm text-slate-400 font-medium">Scale your business globally today</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-5">
                            @csrf
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-brand-navy uppercase tracking-widest ml-1">Full Business Name</label>
                                <input type="text" name="name" required autofocus
                                       class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold transition-soft" 
                                       placeholder="Global Exports Ltd.">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-brand-navy uppercase tracking-widest ml-1">Business Email</label>
                                <input type="email" name="email" required
                                       class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold transition-soft" 
                                       placeholder="admin@company.com">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-brand-navy uppercase tracking-widest ml-1">Password</label>
                                    <input type="password" name="password" required
                                           class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold transition-soft" 
                                           placeholder="••••••••">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-brand-navy uppercase tracking-widest ml-1">Confirm</label>
                                    <input type="password" name="password_confirmation" required
                                           class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold transition-soft" 
                                           placeholder="••••••••">
                                </div>
                            </div>

                            <div class="flex items-start ml-1 mt-2">
                                <input type="checkbox" required name="terms" id="terms" class="w-4 h-4 text-brand-gold border-slate-300 rounded focus:ring-brand-gold mt-0.5">
                                <label for="terms" class="ml-3 text-[10px] font-black text-slate-400 uppercase tracking-widest leading-relaxed">
                                    I agree to the <a href="#" class="text-brand-gold hover:underline">Terms of Commerce</a> and <a href="#" class="text-brand-gold hover:underline">Privacy Protocol</a>.
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-brand-navy hover:bg-brand-lightNavy text-brand-gold py-5 rounded-2xl text-sm font-black uppercase tracking-[0.2em] transition-soft shadow-xl italic active:scale-95 mt-4">
                                Create Account
                            </button>
                        </form>

                        <div class="mt-10 pt-8 border-t border-slate-50 text-center">
                            <p class="text-xs text-slate-400 font-medium mb-4">Already an enterprise partner?</p>
                            <a href="{{ route('login') }}" class="text-brand-navy font-black uppercase tracking-widest text-xs border-b border-brand-navy/10 hover:border-brand-navy pb-1 transition-soft italic">Partner Login &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Branding Footer -->
                <div class="mt-8 text-center">
                    <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.5em] italic">Join 12,000+ Global Traders</p>
                </div>
            </div>
        </div>
    </section>

@endsection
