@extends('layouts.public')

@section('title', 'Access the Terminal | GlobalLine Enterprise')

@section('content')
<main class="min-h-screen flex items-stretch overflow-hidden">

    <!-- 1. THE VALUE SIDEBAR (Fixed Left) -->
    <section class="hidden lg:flex lg:w-[45%] bg-navy-dark relative items-center justify-center p-20 overflow-hidden border-r border-white/10">
        <div class="absolute inset-0 z-0 text-white/5 font-black text-[20vw] select-none pointer-events-none -rotate-12 translate-y-1/4">
            GATEWAY
        </div>
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-br from-navy-dark via-navy/95 to-navy-dark z-10"></div>
             <!-- Animated Mesh -->
             <div class="absolute top-0 right-0 w-[1000px] h-[1000px] bg-blue-600/20 rounded-full blur-[160px] -translate-y-1/2 translate-x-1/2"></div>
             <div class="absolute bottom-0 left-0 w-[800px] h-[800px] bg-amber-brand/10 rounded-full blur-[140px] translate-y-1/2 -translate-x-1/4"></div>
        </div>

        <div class="relative z-20 max-w-xl w-full">
            <div class="mb-20" data-aos="fade-right">
                <div class="inline-flex items-center gap-3 px-6 py-3 bg-white/5 border border-white/10 rounded-full mb-10 backdrop-blur-md">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_15px_rgba(52,211,153,0.5)] animate-pulse"></span>
                    <span class="platform-label">Node Cluster: Optimal</span>
                </div>
                <h2 class="text-7xl md:text-8xl font-bold font-heading text-white mb-10 tracking-tighter leading-[0.85]">
                    Enter the <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand via-white to-white/40 italic">Apex.</span>
                </h2>
                <p class="mb-10 leading-relaxed italic border-l-4 border-amber-brand pl-8 platform-body text-white/60">
                    Your portal to high-velocity trade settlements and global logistics nodes.
                </p>
            </div>

            <!-- Enhanced Value Propositon Grid -->
            <div class="grid grid-cols-1 gap-8" data-aos="fade-up" data-aos-delay="200">
                <div class="p-10 bg-white/5 border border-white/10 rounded-[3rem] backdrop-blur-3xl group hover:bg-white/[0.08] transition-all hover:-translate-y-2 duration-500">
                    <div class="flex items-center gap-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-amber-brand to-amber-light text-navy-dark rounded-[2rem] flex items-center justify-center font-black text-4xl shadow-2xl opacity-90 group-hover:opacity-100">
                            $
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-white tracking-tighter">$1.4B+ Volume</p>
                            <p class="mt-1 text-white/40 platform-label">Managed Trade Equity</p>
                        </div>
                    </div>
                </div>

                <div class="p-10 bg-white/5 border border-white/10 rounded-[3rem] backdrop-blur-3xl group hover:bg-white/[0.08] transition-all hover:-translate-y-2 duration-500">
                    <div class="flex items-center gap-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-[2rem] flex items-center justify-center font-black text-4xl shadow-2xl opacity-90 group-hover:opacity-100">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <div>
                            <p class="text-4xl font-bold text-white tracking-tighter">220 Nodes</p>
                            <p class="mt-1 text-white/40 platform-label">Connected Global Hubs</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-20 flex items-center gap-6" data-aos="fade-in">
                 <div class="flex -space-x-4">
                      <div class="w-12 h-12 rounded-full border-2 border-navy-dark bg-slate-700 shadow-xl"></div>
                      <div class="w-12 h-12 rounded-full border-2 border-navy-dark bg-slate-600 shadow-xl text-white flex items-center justify-center font-black text-[10px]">+12K</div>
                 </div>
                 <p class="text-white/40 text-sm font-bold uppercase tracking-widest italic">Join 12,000+ Verified Enterprise Partners</p>
            </div>
        </div>
    </section>

    <!-- 2. THE ACTION HUB (Right Side) -->
    <section class="w-full lg:w-[55%] bg-white flex items-center justify-center p-8 md:p-24 relative overflow-y-auto">
        <div class="max-w-lg w-full" data-aos="fade-left">
            
            <div class="mb-16">
                <span class="mb-6 block text-amber-brand platform-label">Secure Authentication</span>
                <h1 class="text-6xl md:text-7xl font-bold font-heading text-navy-dark mb-6 tracking-tighter leading-tight">Welcome <br><span class="italic text-slate-300">Terminal.</span></h1>
                <p class="leading-relaxed border-l-2 border-slate-100 pl-6 italic platform-body text-slate-500">Enter your enterprise key to initialize connection.</p>
            </div>

            @if (session('status'))
                <div class="mb-10 p-6 bg-emerald-50 text-emerald-800 text-sm font-bold rounded-3xl border border-emerald-100 shadow-sm flex items-center gap-4">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-10">
                @csrf
                
                <div class="space-y-4">
                    <label class="ml-2 text-navy-dark/30 platform-label">Enterprise Email Identifier</label>
                    <div class="relative group">
                         <div class="absolute inset-y-0 left-0 pl-8 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-brand transition-colors">
                              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                         </div>
                         <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] pl-20 pr-8 py-8 text-xl text-navy-dark font-black focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-input @error('email') border-red-500 @enderror placeholder:text-slate-200 platform-body" 
                                placeholder="name@company.com">
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 font-black mt-3 ml-6 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center px-4">
                        <label class="text-navy-dark/30 platform-label">Encrypted Secret Key</label>
                        <a href="{{ route('password.request') }}" class="text-amber-brand hover:text-navy-dark transition-colors italic platform-label">Bypass Key?</a>
                    </div>
                    <div class="relative group">
                         <div class="absolute inset-y-0 left-0 pl-8 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-brand transition-colors">
                              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                         </div>
                         <input type="password" name="password" required
                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] pl-20 pr-8 py-8 text-xl text-navy-dark font-black focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-input placeholder:text-slate-200 platform-body" 
                                placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center px-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" id="remember" class="sr-only peer">
                        <div class="w-14 h-8 bg-slate-100 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-amber-brand"></div>
                        <span class="ml-4 text-slate-400 italic platform-label">Maintain Active Session</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-navy-dark hover:bg-amber-brand hover:text-navy-dark text-white py-10 rounded-[2.5rem] transition-all shadow-btn italic active:scale-[0.98] group relative overflow-hidden platform-label">
                    <span class="relative z-10 flex items-center justify-center gap-4">
                        Authorize Connection
                        <svg class="w-6 h-6 group-hover:translate-x-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </button>
            </form>

            <div class="mt-24 pt-16 border-t-2 border-slate-50 text-center">
                <p class="text-slate-400 italic mb-10 tracking-wide platform-body">New to the High-Velocity Network?</p>
                <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center px-16 py-6 text-navy-dark transition-all duration-300 bg-white border-2 border-slate-100 rounded-3xl hover:bg-navy-dark hover:text-white hover:border-navy-dark shadow-sm platform-label">
                    <span>Initialize Node Identity</span>
                </a>
            </div>

            <div class="mt-20 flex justify-center gap-16 grayscale opacity-40 hover:grayscale-0 transition-all duration-1000">
                 <div class="flex flex-col items-center gap-3">
                      <div class="w-12 h-12 rounded-3xl bg-slate-100 flex items-center justify-center">
                          <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L10 1.55l7.834 3.35a1 1 0 01.666.945V10c0 5.825-3.817 10.26-8.5 11.54a.994.994 0 01-.5 0C4.817 20.26 1 15.825 1 10V5.845a1 1 0 01.666-.945zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                      </div>
                      <span class="text-[9px] font-black uppercase tracking-tighter">Enterprise SOC2</span>
                 </div>
                 <div class="flex flex-col items-center gap-3">
                      <div class="w-12 h-12 rounded-3xl bg-slate-100 flex items-center justify-center">
                          <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                      </div>
                      <span class="text-[9px] font-black uppercase tracking-tighter">PCI-DSS Vaulted</span>
                 </div>
            </div>
        </div>

        <div class="absolute top-16 right-16 hidden lg:flex items-center gap-4">
             <div class="flex flex-col items-end">
                 <span class="text-[10px] font-black text-slate-200">Terminal ID: CLSTR-82A</span>
                 <span class="text-[8px] font-bold text-slate-100 italic uppercase opacity-50">Local Auth Protocol v8.4.2</span>
             </div>
             <div class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
        </div>
    </section>

</main>

<style>
    .shadow-input {
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.03);
    }
    .shadow-btn {
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.3);
    }
    input:focus {
        box-shadow: 0 20px 40px -10px rgba(245, 158, 11, 0.1);
    }
</style>
@endsection
