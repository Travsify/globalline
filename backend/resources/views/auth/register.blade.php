@extends('layouts.public')

@section('title', 'Register | Join GlobalLine Enterprise')

@section('content')

    <section class="min-h-screen flex items-stretch">
        <!-- Left Side: Hero Visualization (Register Version) -->
        <div class="hidden lg:flex lg:w-1/2 bg-brand-navy relative items-center justify-center overflow-hidden p-24">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1494412574744-ff70438f6920?auto=format&fit=crop&w=1200&q=80" 
                     class="w-full h-full object-cover opacity-20 contrast-125" alt="Global Trade">
                <div class="absolute inset-0 bg-gradient-to-br from-brand-navy via-brand-navy/60 to-transparent"></div>
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:30px_30px]"></div>
            </div>

            <div class="relative z-10 text-center max-w-lg">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-brand-gold/20 border border-brand-gold/30 rounded-full mb-8">
                    <span class="w-1.5 h-1.5 bg-brand-gold rounded-full animate-ping"></span>
                    <span class="text-[9px] font-black text-brand-gold uppercase tracking-[0.3em] italic">Open Enrollment v5.0</span>
                </div>
                <h2 class="text-5xl font-black text-white leading-tight mb-8 tracking-tighter uppercase italic">
                    Join the <br><span class="text-blue-400 italic">Enterprise Network.</span>
                </h2>
                <p class="text-white/40 text-lg font-medium italic leading-relaxed">
                    Unlock factory-direct sourcing, multi-currency settlements, and global logistics nodes in one unified terminal.
                </p>
                
                <div class="mt-16 grid grid-cols-3 gap-8 grayscale opacity-40">
                    <div class="text-center">
                        <p class="text-3xl font-black text-white mb-1">12K+</p>
                        <p class="text-[8px] font-black uppercase text-white/30 tracking-widest">Traders</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-white mb-1">4.8K+</p>
                        <p class="text-[8px] font-black uppercase text-white/30 tracking-widest">Factories</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-white mb-1">24/7</p>
                        <p class="text-[8px] font-black uppercase text-white/30 tracking-widest">Settlements</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 md:p-12 lg:p-24 relative overflow-y-auto">
            <div class="max-w-xl w-full py-12">
                <div class="mb-10">
                    <h1 class="text-4xl font-black text-brand-navy tracking-tighter uppercase italic mb-4">Establish <span class="text-brand-gold">Identity.</span></h1>
                    <p class="text-slate-400 font-medium italic">Begin your journey into high-velocity global trade.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Contact Name</label>
                            <input type="text" name="name" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.2rem] px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="John Doe">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Phone Number</label>
                            <input type="text" name="phone" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.2rem] px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="+234 ...">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Enterprise Email</label>
                        <input type="email" name="email" required
                               class="w-full bg-slate-50 border border-slate-100 rounded-[1.2rem] px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                               placeholder="admin@company.com">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Business Name</label>
                            <input type="text" name="business_name" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.2rem] px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="Global Exports Ltd.">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Business Track</label>
                            <select name="business_type" required
                                    class="w-full bg-slate-50 border border-slate-100 rounded-[1.2rem] px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm appearance-none">
                                <option value="importer">Importer / Retailer</option>
                                <option value="manufacturer">Manufacturer</option>
                                <option value="logistics">Logistics Provider</option>
                                <option value="retailer">Wholesaler</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Password</label>
                            <input type="password" name="password" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.2rem] px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="••••••••">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-brand-navy uppercase tracking-[0.3em] ml-1 italic">Confirm Security</label>
                            <input type="password" name="password_confirmation" required
                                   class="w-full bg-slate-50 border border-slate-100 rounded-[1.2rem] px-6 py-4 text-brand-navy font-bold focus:outline-none focus:border-brand-gold focus:bg-white transition-all shadow-sm" 
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-start ml-2 pt-2">
                        <input type="checkbox" required name="terms" id="terms" class="w-5 h-5 text-brand-gold border-slate-200 rounded-lg focus:ring-brand-gold mt-1">
                        <label for="terms" class="ml-4 text-[10px] font-black text-slate-400 uppercase tracking-widest leading-relaxed italic">
                            I verify that all information provided is accurate and I agree to the <a href="{{ route('legal') }}" class="text-brand-gold hover:underline">Global Trade Protocol</a>.
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-brand-navy hover:bg-brand-gold hover:text-brand-navy text-white py-6 rounded-[1.5rem] text-xs font-black uppercase tracking-[0.3em] transition-all shadow-3xl italic active:scale-95 group relative overflow-hidden mt-4">
                        <span class="relative z-10 uppercase">Initialize Enterprise Identity &rarr;</span>
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </button>
                </form>

                <div class="mt-12 pt-8 border-t border-slate-50 text-center">
                    <p class="text-xs text-slate-400 font-medium italic mb-6">Already possess a GlobalLine Identity?</p>
                    <a href="{{ route('login') }}" class="inline-block bg-slate-50 text-brand-navy px-10 py-4 rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-brand-navy hover:text-white transition-all italic">Authenticate Partner Access</a>
                </div>
            </div>
            
            <!-- Global Node ID -->
            <div class="absolute top-12 right-12 flex items-center gap-3">
                <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest italic">AuthServer: 0x92f</span>
                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
            </div>
        </div>
    </section>

@endsection
