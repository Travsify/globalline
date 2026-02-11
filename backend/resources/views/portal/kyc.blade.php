@extends('layouts.portal')

@section('page_title', 'Identity Verification')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <div class="bg-white p-12 rounded-[3.5rem] shadow-sm border border-slate-100 flex flex-col md:flex-row items-center space-x-10">
        <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center mb-6 md:mb-0">
            @if($verification && $verification->status == 'verified')
                <svg class="w-16 h-16 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L9.03 9.069a2.42 2.42 0 002.504 0l6.863-4.17A2.422 2.422 0 0019.25 2.5a2.43 2.43 0 00-1.875-1.12L10.51 1.03a2.431 2.431 0 00-1.02 0l-6.864.35A2.422 2.422 0 00.75 2.5a2.43 2.43 0 001.416 2.4zM2 6.13a2.422 2.422 0 00-.75 1.121v7.24a2.425 2.425 0 002.42 2.42h12.66a2.425 2.425 0 002.42-2.42V7.251a2.422 2.422 0 00-.75-1.12l-7.311 4.44a1.233 1.233 0 01-1.378 0L2 6.13z" clip-rule="evenodd"></path></svg>
            @else
                <svg class="w-16 h-16 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
            @endif
        </div>
        <div>
            <h3 class="text-3xl font-heading font-black text-brand-navy mb-2 tracking-tight italic">Tiered KYC Verification</h3>
            <p class="text-slate-500 text-sm">Secure your account and unlock higher transaction limits for supplier payments. Verified accounts get 0% processing fees on wire transfers.</p>
            <div class="mt-4 flex items-center space-x-4">
                <span class="px-4 py-1.5 bg-slate-50 text-slate-500 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $verification->status ?? 'Unverified' }}</span>
                <span class="text-xs font-bold text-brand-navy cursor-pointer hover:text-brand-accent transition-colors">Learn about Tier 2 Limits &rarr;</span>
            </div>
        </div>
    </div>

    @if(!$verification || $verification->status != 'verified')
    <div class="bg-white p-12 rounded-[3.5rem] shadow-sm border border-slate-100">
        <h4 class="text-xl font-heading font-black text-slate-800 mb-8">Submit Identification</h4>
        <form action="/portal/kyc" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                     <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">ID Type</label>
                    <select name="id_type" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-brand-gold">
                        <option value="NIN">National Identification Number (NIN)</option>
                        <option value="Passport">International Passport</option>
                        <option value="BVN">Bank Verification Number (BVN)</option>
                        <option value="DL">Driver's License</option>
                    </select>
                </div>
                <div>
                     <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">ID Number</label>
                    <input type="text" name="id_number" placeholder="Enter number..." class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-brand-gold" required>
                </div>
            </div>
            
            <div class="border-2 border-dashed border-slate-100 rounded-[2rem] p-12 text-center hover:border-brand-gold transition-colors cursor-pointer group">
                <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Click to upload document photo</p>
                <p class="text-[10px] text-slate-300 mt-2 italic">Support JPG, PNG or PDF (Max 5MB)</p>
            </div>

            <button type="submit" class="w-full bg-brand-navy text-white font-black py-6 rounded-3xl shadow-xl hover:scale-[1.02] transition-all">Submit for Verification</button>
        </form>
    </div>
    @else
    <div class="bg-emerald-50 p-12 rounded-[3.5rem] border border-emerald-100 text-center">
        <h4 class="text-2xl font-heading font-black text-emerald-800 mb-2 italic">Verification Complete!</h4>
        <p class="text-emerald-600 font-bold mb-6">Your account is fully verified for Tier 1 Enterprise operations.</p>
        <div class="inline-flex items-center space-x-2 text-xs font-black text-emerald-700 uppercase tracking-widest">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span>Merchant ID Active: {{ auth()->id() ?? '100293' }}</span>
        </div>
    </div>
    @endif

    <!-- Trust Seals -->
    <div class="flex flex-wrap items-center justify-center gap-10 opacity-30 grayscale">
        <img src="https://identitypass.com/static/logo-dark-64bf9971.svg" class="h-6">
        <span class="text-sm font-black uppercase tracking-widest">SSL Secured</span>
        <span class="text-sm font-black uppercase tracking-widest">Swift Verified</span>
    </div>
</div>
@endsection
