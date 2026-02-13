@extends('layouts.public')

@section('title', 'Join the Network | GlobalLine Enterprise Onboarding')

@section('content')
<main class="min-h-screen flex items-stretch overflow-hidden">

    <!-- 1. THE ONBOARDING SIDEBAR (Fixed Left) -->
    <section class="hidden lg:flex lg:w-[45%] bg-navy-dark relative items-center justify-center p-20 overflow-hidden border-r border-white/5">
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy-dark to-navy z-10"></div>
             <!-- Animated Mesh -->
             <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] bg-blue-600/5 rounded-full blur-[140px]"></div>
             <div class="absolute top-0 left-0 w-full h-full opacity-[0.05]" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 60px 60px;"></div>
        </div>

        <div class="relative z-20 max-w-lg w-full">
            <div class="mb-16" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-brand/10 border border-amber-brand/20 rounded-full mb-8">
                    <span class="w-2 h-2 rounded-full bg-amber-brand animate-ping"></span>
                    <span class="text-[10px] font-bold text-amber-brand uppercase tracking-[0.3em]">Network Slot Available</span>
                </div>
                <h2 class="text-6xl font-bold font-heading text-white mb-8 tracking-tighter leading-[0.9]">
                    Join the <span class="italic text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-white">Global</span> <br>Collective.
                </h2>
                <p class="text-xl text-white/40 leading-relaxed font-medium">
                    Unlock factory-direct sourcing, instant trade finance, and a physical network in 220+ countries. 
                </p>
            </div>

            <!-- Feature Grid -->
            <div class="grid grid-cols-1 gap-6" data-aos="fade-up" data-aos-delay="200">
                <div class="flex gap-6 p-6 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-3xl group hover:border-white/20 transition-all">
                     <div class="w-12 h-12 bg-blue-600/20 text-blue-400 rounded-2xl flex items-center justify-center shrink-0">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-1.343 3-3s-1.343-3-3-3m0 12c-1.657 0-3-1.343-3-3s1.343-3 3-3m0 0V3m0 0l3 3m-3-3l-3 3"></path></svg>
                     </div>
                     <div>
                          <p class="text-white font-bold mb-1">Direct Factory Links</p>
                          <p class="text-xs text-white/30 leading-relaxed">Verified CN/Dubai factory nodes at your fingertips.</p>
                     </div>
                </div>

                <div class="flex gap-6 p-6 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-3xl group hover:border-white/20 transition-all">
                     <div class="w-12 h-12 bg-amber-brand/20 text-amber-brand rounded-2xl flex items-center justify-center shrink-0">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                     </div>
                     <div>
                          <p class="text-white font-bold mb-1">Instant Settlement</p>
                          <p class="text-xs text-white/30 leading-relaxed">Pay suppliers in RMB/USD with zero-latency rails.</p>
                     </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="mt-16 flex items-center gap-12" data-aos="fade-in">
                 <div>
                      <p class="text-4xl font-bold text-white tracking-tighter">4.8K+</p>
                      <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.3em]">Active Manufacturers</p>
                 </div>
                 <div class="w-px h-12 bg-white/5"></div>
                 <div>
                      <p class="text-4xl font-bold text-white tracking-tighter">12K+</p>
                      <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.3em]">Verified Enterprises</p>
                 </div>
            </div>
        </div>
    </section>

    <!-- 2. THE ONBOARDING FORM (Right Side) -->
    <section class="w-full lg:w-[55%] bg-white flex items-center justify-center p-8 md:p-16 lg:p-24 relative overflow-y-auto">
        
        <div class="max-w-2xl w-full" data-aos="fade-left">
            <div class="mb-12">
                <h1 class="text-5xl font-bold font-heading text-navy-dark mb-4 tracking-tighter">Establish <span class="italic text-slate-300">Identity.</span></h1>
                <p class="text-slate-400 font-medium leading-relaxed">Fill in your enterprise details to initialize your node.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Contact Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] px-8 py-5 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm @error('name') border-red-500 @enderror" 
                               placeholder="John Doe">
                        @error('name')
                            <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Mobile Terminal</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] px-8 py-5 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm @error('phone') border-red-500 @enderror" 
                               placeholder="+234 ...">
                        @error('phone')
                            <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Enterprise Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] px-8 py-5 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm @error('email') border-red-500 @enderror" 
                           placeholder="admin@company.com">
                    @error('email')
                        <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Business Identity</label>
                        <input type="text" name="business_name" value="{{ old('business_name') }}" required
                               class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] px-8 py-5 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm @error('business_name') border-red-500 @enderror" 
                               placeholder="Global Exports Ltd.">
                        @error('business_name')
                             <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Primary Trade Track</label>
                        <div class="relative">
                             <select name="business_type" required
                                     class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] px-8 py-5 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm appearance-none">
                                 <option value="importer">Importer / E-commerce</option>
                                 <option value="manufacturer">Factory / Manufacturer</option>
                                 <option value="logistics">Logistics Hub</option>
                                 <option value="retailer">Bulk Wholesaler</option>
                             </select>
                             <div class="absolute inset-y-0 right-6 flex items-center pointer-events-none text-slate-300">
                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Secure Secret</label>
                        <input type="password" name="password" required
                               class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] px-8 py-5 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm @error('password') border-red-500 @enderror" 
                               placeholder="••••••••">
                        @error('password')
                            <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Confirm Secret</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full bg-slate-50 border border-slate-100 rounded-[1.5rem] px-8 py-5 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm" 
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-start px-2 py-4">
                    <input type="checkbox" required name="terms" id="terms" class="w-6 h-6 text-amber-brand border-slate-200 rounded-lg focus:ring-amber-brand/20 transition-all cursor-pointer mt-1">
                    <label for="terms" class="ml-4 text-[10px] font-black text-slate-400 uppercase tracking-widest leading-relaxed cursor-pointer italic">
                        I certify that all information is accurate and I agree to the <a href="{{ route('legal') }}" class="text-amber-brand hover:underline">Global Trade Protocol</a>.
                    </label>
                </div>

                <button type="submit" class="w-full bg-navy-dark hover:bg-amber-brand hover:text-navy-dark text-white py-8 rounded-[1.8rem] text-xs font-black uppercase tracking-[0.4em] transition-all shadow-3xl italic active:scale-95 group relative overflow-hidden">
                    <span class="relative z-10">Initialize Enterprise Node &rarr;</span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </button>
            </form>

            <div class="mt-16 pt-10 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-400 font-medium italic mb-6">Already possess a GlobalLine Identity?</p>
                <a href="{{ route('login') }}" class="group inline-flex items-center gap-4 px-10 py-5 bg-slate-50 text-navy-dark rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-navy-dark hover:text-white transition-all italic border border-slate-100">
                    Authenticate Partner Access
                    <span class="group-hover:translate-x-2 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- System ID Decor -->
        <div class="absolute top-12 right-12 hidden lg:flex items-center gap-3">
             <span class="text-[9px] font-black italic text-slate-200 uppercase tracking-widest">Enrollment_Channel: 0x82A</span>
             <div class="w-2 h-2 rounded-full bg-amber-brand animate-ping"></div>
        </div>
    </section>

</main>

<style>
    .shadow-3xl {
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.2);
    }
    input::placeholder, select::placeholder {
        color: rgba(148, 163, 184, 0.4);
        font-weight: 500;
    }
    input:focus, select:focus {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    /* Hide default select arrow in some browsers */
    select::-ms-expand { display: none; }
</style>
@endsection
