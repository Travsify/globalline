@extends('layouts.public')

@section('title', 'Access the Terminal | GlobalLine Enterprise')

@section('content')
<main class="min-h-screen flex items-stretch overflow-hidden">

    <!-- 1. THE VALUE SIDEBAR (Fixed Left) -->
    <section class="hidden lg:flex lg:w-[45%] bg-navy-dark relative items-center justify-center p-20 overflow-hidden border-r border-white/5">
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-br from-navy-dark via-navy/90 to-navy-dark z-10"></div>
             <!-- Animated Mesh -->
             <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
             <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-amber-brand/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/4"></div>
             <!-- Digital Grid -->
             <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="relative z-20 max-w-lg w-full">
            <div class="mb-16" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full mb-8">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-white/50 uppercase tracking-[0.3em]">System Status: Operational</span>
                </div>
                <h2 class="text-6xl font-bold font-heading text-white mb-8 tracking-tighter leading-[0.9]">
                    The <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-brand via-white to-white/40 italic">Command</span> <br>Center.
                </h2>
                <p class="text-xl text-white/40 leading-relaxed font-medium">
                    Initialize your connection to the global trade engine. One login to manage sourcing, settlements, and logistics.
                </p>
            </div>

            <!-- Social Proof Cards -->
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="200">
                <div class="p-8 bg-white/5 border border-white/10 rounded-[2.5rem] backdrop-blur-3xl group hover:bg-white/[0.08] transition-all">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 bg-amber-brand text-navy-dark rounded-2xl flex items-center justify-center font-black text-2xl group-hover:scale-110 transition-transform">
                            $
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white tracking-tighter">$1.4B+ Managed</p>
                            <p class="text-xs text-white/30 uppercase font-black tracking-widest">Trade Volume 2025</p>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-white/5 border border-white/10 rounded-[2.5rem] backdrop-blur-3xl group hover:bg-white/[0.08] transition-all">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-black text-2xl group-hover:scale-110 transition-transform">
                            220
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white tracking-tighter">Global Nodes</p>
                            <p class="text-xs text-white/30 uppercase font-black tracking-widest">Connected Countries</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quote/Testimonial -->
            <div class="mt-20 pt-12 border-t border-white/5" data-aos="fade-in">
                 <p class="text-white/30 text-sm italic mb-4 leading-relaxed">
                     "GlobalLine isn't just a platform; it's the operating system for our entire supply chain. Faster settlements, better nodes."
                 </p>
                 <div class="flex items-center gap-4">
                      <div class="w-8 h-8 rounded-full bg-slate-700"></div>
                      <div>
                           <p class="text-[10px] font-bold text-white">Chen Wei</p>
                           <p class="text-[8px] text-white/30 uppercase tracking-widest">Director, GZ Manufacturer Hub</p>
                      </div>
                 </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex items-center gap-3 opacity-20">
             <span class="text-[8px] font-black uppercase text-white tracking-[0.5em]">GlobalLine Unified Auth v8.2</span>
        </div>
    </section>

    <!-- 2. THE ACTION HUB (Right Side) -->
    <section class="w-full lg:w-[55%] bg-white flex items-center justify-center p-8 md:p-24 relative overflow-y-auto">
        
        <div class="max-w-md w-full" data-aos="fade-left">
            <!-- Mobile Logo (Shown only on small screens) -->
            <div class="lg:hidden mb-12 flex justify-center">
                 <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-navy-dark rounded-xl flex items-center justify-center shadow-2xl">
                        <svg class="w-6 h-6 text-amber-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                 </a>
            </div>

            <div class="mb-12">
                <h1 class="text-5xl font-bold font-heading text-navy-dark mb-4 tracking-tighter">Welcome <span class="italic text-slate-300">Back.</span></h1>
                <p class="text-slate-400 font-medium leading-relaxed">Enter your enterprise credentials to access the terminal.</p>
            </div>

            @if (session('status'))
                <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-2xl border border-emerald-100 italic">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-8">
                @csrf
                
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Enterprise Email</label>
                    <div class="relative group">
                         <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-brand transition-colors">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                         </div>
                         <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full bg-slate-50 border border-slate-100 rounded-[1.8rem] pl-16 pr-8 py-6 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm @error('email') border-red-500 @enderror" 
                                placeholder="name@company.com">
                    </div>
                    @error('email')
                        <p class="text-[10px] text-red-500 font-bold mt-2 ml-4 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-[10px] font-black text-navy-dark/40 uppercase tracking-[0.3em] ml-1">Secret Key</label>
                        <a href="{{ route('password.request') }}" class="text-[10px] font-black text-amber-brand uppercase tracking-widest hover:underline italic">Lost Access?</a>
                    </div>
                    <div class="relative group">
                         <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-brand transition-colors">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                         </div>
                         <input type="password" name="password" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-[1.8rem] pl-16 pr-8 py-6 text-navy-dark font-bold focus:outline-none focus:border-amber-brand focus:bg-white transition-all shadow-sm" 
                                placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center px-2">
                    <input type="checkbox" name="remember" id="remember" class="w-6 h-6 text-amber-brand border-slate-200 rounded-lg focus:ring-amber-brand/20 transition-all cursor-pointer">
                    <label for="remember" class="ml-4 text-[10px] font-black text-slate-400 uppercase tracking-widest cursor-pointer italic">Keep Segment Authenticated</label>
                </div>

                <button type="submit" class="w-full bg-navy-dark hover:bg-amber-brand hover:text-navy-dark text-white py-8 rounded-[1.8rem] text-xs font-black uppercase tracking-[0.4em] transition-all shadow-3xl italic active:scale-95 group relative overflow-hidden">
                    <span class="relative z-10">Authorize Access &rarr;</span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </button>
            </form>

            <div class="mt-20 pt-12 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-400 font-medium italic mb-8">New to the GlobalLine Ecosystem?</p>
                <a href="{{ route('register') }}" class="group inline-flex items-center gap-4 px-10 py-5 bg-slate-50 text-navy-dark rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-navy-dark hover:text-white transition-all italic border border-slate-100">
                    Create Enterprise Account
                    <span class="group-hover:translate-x-2 transition-transform">&rarr;</span>
                </a>
            </div>

            <div class="mt-16 flex justify-center gap-12 opacity-30 grayscale hover:grayscale-0 transition-all duration-700">
                 <div class="flex flex-col items-center gap-2">
                      <div class="w-8 h-8 rounded-full bg-slate-200"></div>
                      <span class="text-[8px] font-black uppercase tracking-tighter">SOC2 Compliant</span>
                 </div>
                 <div class="flex flex-col items-center gap-2">
                      <div class="w-8 h-8 rounded-full bg-slate-200"></div>
                      <span class="text-[8px] font-black uppercase tracking-tighter">PCI-DSS Ready</span>
                 </div>
            </div>
        </div>

        <!-- Floating Decorative -->
        <div class="absolute top-12 right-12 hidden lg:flex items-center gap-3">
             <span class="text-[9px] font-black italic text-slate-200">Session_ID: {{ substr(md5(time()), 0, 8) }}</span>
             <div class="w-2 h-2 rounded-full bg-slate-100"></div>
        </div>
    </section>

</main>

<style>
    .shadow-3xl {
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.2);
    }
    input::placeholder {
        color: rgba(148, 163, 184, 0.4);
        font-weight: 500;
    }
    input:focus {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
</style>
@endsection
