@extends('layouts.portal')

@section('content')
<div class="px-8 py-10 max-w-6xl mx-auto">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter">Profile <span class="text-brand-gold">Intelligence</span></h1>
        <p class="text-white/40 font-medium mt-2">Manage your global account identity and security protocols.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Left: Profile & Metadata -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Account Info -->
            <div class="bg-white/5 border border-white/10 p-12 rounded-[3.5rem] backdrop-blur-2xl">
                <h2 class="text-xl font-black text-white uppercase italic tracking-widest mb-10 pb-4 border-b border-white/5">Primary Identity</h2>
                <form action="#" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Full Legal Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" 
                                   class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-brand-gold outline-none transition-soft font-bold">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Secure Email</label>
                            <input type="email" value="{{ $user->email }}" disabled
                                   class="w-full bg-white/5 border border-white/5 rounded-2xl px-6 py-4 text-white/30 outline-none font-bold cursor-not-allowed">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Contact Phone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" 
                               class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-brand-gold outline-none transition-soft font-bold">
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-12 py-4 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] transition-soft shadow-2xl active:scale-95 italic">
                            Commit Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Vault -->
            <div class="bg-white/5 border border-white/10 p-12 rounded-[3.5rem] backdrop-blur-2xl">
                <h2 class="text-xl font-black text-white uppercase italic tracking-widest mb-10 pb-4 border-b border-white/5">Security Vault</h2>
                <form action="#" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Target Password</label>
                        <input type="password" name="password" placeholder="••••••••"
                               class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-brand-gold outline-none transition-soft font-bold">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Confirm Encryption</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                               class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-brand-gold outline-none transition-soft font-bold">
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="bg-white/10 hover:bg-white/20 text-white px-12 py-4 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] transition-soft shadow-2xl active:scale-95 italic">
                            Update Cipher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Status and Quick Actions -->
        <div class="space-y-12">
            <!-- KYC Status Node -->
            <div class="bg-brand-gold p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
                <span class="text-[10px] font-black text-brand-navy/40 uppercase tracking-[0.3em] block mb-4 italic">Verification Protocol</span>
                @if($verification && $verification->status == 'verified')
                    <h3 class="text-3xl font-heading font-black text-brand-navy uppercase italic tracking-tighter mb-4">Node Verified</h3>
                    <p class="text-brand-navy/60 text-sm font-bold italic mb-8">Your account is fully synchronized with global logistics standards.</p>
                @else
                    <h3 class="text-3xl font-heading font-black text-brand-navy uppercase italic tracking-tighter mb-4">Pending Sync</h3>
                    <p class="text-brand-navy/60 text-sm font-bold italic mb-8">Complete your KYC to unlock higher settlement limits.</p>
                    <a href="{{ route('portal.kyc') }}" class="inline-block bg-brand-navy text-brand-gold px-8 py-3 rounded-xl font-black uppercase tracking-widest text-[10px] transition-soft hover:scale-105 italic">Complete KYC</a>
                @endif
            </div>

            <!-- Preferences -->
            <div class="bg-white/5 border border-white/10 p-10 rounded-[3rem] backdrop-blur-md">
                <h3 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 italic">Global Preferences</h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-white/60">Email Intel</span>
                        <div class="w-12 h-6 bg-brand-gold/20 rounded-full relative cursor-pointer">
                            <div class="absolute right-1 top-1 w-4 h-4 bg-brand-gold rounded-full shadow-md"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-white/60">SMS Notifications</span>
                        <div class="w-12 h-6 bg-white/5 rounded-full relative cursor-pointer">
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white/20 rounded-full shadow-md"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-white/60">Two-Factor Auth</span>
                        <div class="w-12 h-6 bg-white/5 rounded-full relative cursor-pointer border border-white/10">
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white/10 rounded-full shadow-md"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="p-10 border border-red-500/20 rounded-[3rem] bg-red-500/5">
                <h3 class="text-xs font-black text-red-500/40 uppercase tracking-[0.3em] mb-4 italic">Protocol Termination</h3>
                <p class="text-[10px] text-white/30 font-medium mb-6">Permanently disable and wipe all intelligence data linked to this node.</p>
                <button class="text-red-500 text-[10px] font-black uppercase tracking-widest italic hover:underline">Self Destruct &rarr;</button>
            </div>
        </div>
    </div>
</div>
@endsection
