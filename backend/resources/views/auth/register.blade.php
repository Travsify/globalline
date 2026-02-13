@extends('layouts.public')

@section('title', 'Join the Network | GlobalLine Enterprise Onboarding')

@section('content')
<main class="min-h-screen flex items-stretch overflow-hidden">

    <!-- 1. THE ONBOARDING SIDEBAR (Fixed Left) -->
    <section class="hidden lg:flex lg:w-[45%] bg-navy-dark relative items-center justify-center p-20 overflow-hidden border-r border-white/10">
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy-dark to-navy z-10"></div>
             <!-- Animated Mesh -->
             <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1000px] h-[1000px] bg-blue-600/5 rounded-full blur-[140px]"></div>
             <!-- Digital Grid -->
             <div class="absolute inset-0 opacity-[0.05]" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 80px 80px;"></div>
        </div>

        <div class="relative z-20 max-w-xl w-full">
            <div class="mb-16" data-aos="fade-right">
                <div class="inline-flex items-center gap-3 px-6 py-3 bg-amber-brand/10 border border-amber-brand/20 rounded-full mb-10 backdrop-blur-md">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-brand shadow-[0_0_15px_rgba(245,158,11,0.5)] animate-ping"></span>
                    <span class="text-xs font-black text-amber-brand uppercase tracking-[0.4em]">Capacity Check: Verified</span>
                </div>
                <h2 class="text-7xl md:text-8xl font-bold font-heading text-white mb-10 tracking-tighter leading-[0.85]">
                    The <span class="italic text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-white">Propeller</span> <br>Hub.
                </h2>
                <p class="text-2xl text-white/40 leading-relaxed font-bold italic border-l-4 border-blue-500 pl-8">
                    Your enterprise entry into the most advanced global trade infrastructure.
                </p>
            </div>

            <div class="mb-12">
                 <p class="text-white font-black uppercase tracking-[0.3em] text-xs mb-8">What you secure today:</p>
                 <!-- What You Get Grid -->
                 <div class="grid grid-cols-1 gap-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex gap-8 p-8 bg-white/5 border border-white/10 rounded-[2.5rem] backdrop-blur-3xl group hover:border-blue-500/50 transition-all duration-500 hover:-translate-y-1">
                         <div class="w-16 h-16 bg-blue-600/20 text-blue-400 rounded-3xl flex items-center justify-center shrink-0 shadow-2xl">
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-1.343 3-3s-1.343-3-3-3m0 12c-1.657 0-3-1.343-3-3s1.343-3 3-3m0 0V3m0 0l3 3m-3-3l-3 3"></path></svg>
                         </div>
                         <div>
                              <p class="text-2xl font-bold text-white mb-2 tracking-tight">Factory-Direct Terminal</p>
                              <p class="text-sm text-white/30 leading-relaxed font-medium">Bypass middlemen. Connect directly to verified manufacturing nodes in CN, TR, and UAE.</p>
                         </div>
                    </div>

                    <div class="flex gap-8 p-8 bg-white/5 border border-white/10 rounded-[2.5rem] backdrop-blur-3xl group hover:border-amber-brand/50 transition-all duration-500 hover:-translate-y-1">
                         <div class="w-16 h-16 bg-amber-brand/20 text-amber-brand rounded-3xl flex items-center justify-center shrink-0 shadow-2xl">
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                         </div>
                         <div>
                              <p class="text-2xl font-bold text-white mb-2 tracking-tight">Zero-Latency Pay</p>
                              <p class="text-sm text-white/30 leading-relaxed font-medium">Settlements in RMB & USD executed on high-frequency rails with real-time conversion.</p>
                         </div>
                    </div>
                 </div>
            </div>

            <!-- Social Proof -->
            <div class="mt-20 pt-12 border-t border-white/5 flex items-center gap-12" data-aos="fade-in">
                 <div>
                      <p class="text-5xl font-bold text-white tracking-tighter">4.8K+</p>
                      <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] mt-1 italic">Vetted Factories</p>
                 </div>
                 <div class="w-px h-16 bg-white/5"></div>
                 <div class="flex flex-col">
                      <div class="flex -space-x-3 mb-3">
                           <div class="w-10 h-10 rounded-full border-2 border-navy-dark bg-slate-700"></div>
                           <div class="w-10 h-10 rounded-full border-2 border-navy-dark bg-blue-600 flex items-center justify-center text-white text-[8px] font-black">+12K</div>
                      </div>
                      <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] italic">Enterprise Scale</p>
                 </div>
            </div>
        </div>
    </section>

    <!-- 2. THE ONBOARDING FORM (Right Side) -->
    <section class="w-full lg:w-[55%] bg-white flex items-center justify-center p-8 md:p-16 lg:p-24 relative overflow-y-auto">
        
        <div class="max-w-2xl w-full" data-aos="fade-left">
            <div class="mb-16">
                <span class="text-blue-600 font-black uppercase tracking-[0.5em] text-[10px] mb-6 block">Identity Protocol Initialize</span>
                <h1 class="text-6xl md:text-7xl font-bold font-heading text-navy-dark mb-6 tracking-tighter leading-tight">Join the <br><span class="italic text-slate-300">Network.</span></h1>
                <p class="text-slate-500 font-bold text-lg leading-relaxed border-l-2 border-slate-100 pl-8 italic">Begin your journey into high-velocity global trade infrastructure.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-xs font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-2">Contact Principal</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-7 text-xl text-navy-dark font-black focus:outline-none focus:border-blue-500 focus:bg-white transition-all shadow-input @error('name') border-red-500 @enderror placeholder:text-slate-200" 
                               placeholder="Full Name">
                        @error('name')
                            <p class="text-xs text-red-500 font-black mt-3 ml-6 italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-xs font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-2">Mobile Terminal</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-7 text-xl text-navy-dark font-black focus:outline-none focus:border-blue-500 focus:bg-white transition-all shadow-input @error('phone') border-red-500 @enderror placeholder:text-slate-200" 
                               placeholder="+234 ...">
                        @error('phone')
                            <p class="text-xs text-red-500 font-black mt-3 ml-6 italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="text-xs font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-2">Enterprise Email ID</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-7 text-xl text-navy-dark font-black focus:outline-none focus:border-blue-500 focus:bg-white transition-all shadow-input @error('email') border-red-500 @enderror placeholder:text-slate-200" 
                           placeholder="admin@company.com">
                    @error('email')
                        <p class="text-xs text-red-500 font-black mt-3 ml-6 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-xs font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-2">Registered Business</label>
                        <input type="text" name="business_name" value="{{ old('business_name') }}" required
                               class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-7 text-xl text-navy-dark font-black focus:outline-none focus:border-blue-500 focus:bg-white transition-all shadow-input @error('business_name') border-red-500 @enderror placeholder:text-slate-200" 
                               placeholder="Company Ltd">
                    </div>

                    <div class="space-y-4">
                        <label class="text-xs font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-2">Trade Specialization</label>
                        <div class="relative">
                             <select name="business_type" required
                                     class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-7 text-xl text-navy-dark font-black focus:outline-none focus:border-blue-500 focus:bg-white transition-all shadow-input appearance-none cursor-pointer">
                                 <option value="importer">Importer / E-commerce</option>
                                 <option value="manufacturer">Factory Partner</option>
                                 <option value="logistics">Logistics Provider</option>
                                 <option value="retailer">Wholesale Distributor</option>
                             </select>
                             <div class="absolute inset-y-0 right-10 flex items-center pointer-events-none text-slate-300">
                                  <svg class="w-6 h-6 border-l-2 border-slate-100 pl-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-xs font-black text-navy-dark/30 uppercase tracking-[0.3em] ml-2">Secret Key</label>
                        <input type="password" name="password" required
                               class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-7 text-xl text-navy-dark font-black focus:outline-none focus:border-blue-500 focus:bg-white transition-all shadow-input @error('password') border-red-500 @enderror placeholder:text-slate-200" 
                               placeholder="••••••••">
                    </div>

                    <div class="space-y-4">
                        <label class="text-xs font-black text-navy-dark/30 uppercase tracking-[0.3em] ml-2">Confirm Secret</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-7 text-xl text-navy-dark font-black focus:outline-none focus:border-blue-500 focus:bg-white transition-all shadow-input placeholder:text-slate-200" 
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-start px-4 py-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" required name="terms" id="terms" class="sr-only peer">
                        <div class="w-14 h-8 bg-slate-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ml-6 text-xs font-black text-slate-400 uppercase tracking-widest leading-relaxed italic cursor-pointer">
                            Accept the <a href="{{ route('legal') }}" class="text-blue-600 hover:text-navy-dark transition-colors">Global Trade Protocol</a>.
                        </span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-navy-dark hover:bg-blue-600 text-white py-12 rounded-[2.5rem] text-sm font-black uppercase tracking-[0.5em] transition-all shadow-btn italic active:scale-[0.98] group relative overflow-hidden">
                    <span class="relative z-10 flex items-center justify-center gap-6">
                        Initialize Enterprise Node
                        <svg class="w-8 h-8 group-hover:translate-x-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </button>
            </form>

            <div class="mt-20 pt-16 border-t-2 border-slate-50 text-center">
                <p class="text-sm text-slate-400 font-bold italic mb-8">Already possess a GlobalLine Identity?</p>
                <a href="{{ route('login') }}" class="group inline-flex items-center gap-6 px-16 py-6 bg-slate-50 text-navy-dark rounded-3xl font-black uppercase tracking-widest text-xs hover:bg-navy-dark hover:text-white transition-all italic border-2 border-slate-100">
                    Authenticate Account Access
                    <span class="group-hover:translate-x-3 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Global Deployment ID -->
        <div class="absolute top-16 right-16 hidden lg:flex items-center gap-6">
             <div class="flex flex-col items-end">
                 <span class="text-[10px] font-black text-slate-200">Global Node: 0x82A</span>
                 <span class="text-[8px] font-bold text-slate-100 italic uppercase opacity-50">Enrollment Channel Alpha</span>
             </div>
             <div class="w-4 h-4 rounded-full bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.6)] animate-pulse"></div>
        </div>
    </section>

</main>

<style>
    .shadow-input {
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.03);
    }
    .shadow-btn {
        box-shadow: 0 35px 70px -15px rgba(15, 23, 42, 0.4);
    }
    input:focus, select:focus {
        box-shadow: 0 20px 50px -10px rgba(59, 130, 246, 0.1);
    }
    select::-ms-expand { display: none; }
</style>
@endsection
