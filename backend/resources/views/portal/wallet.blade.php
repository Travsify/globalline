@extends('layouts.portal')

@section('page_title', 'Multi-Currency Wallet')

@section('content')
<div class="space-y-12 pb-20 max-w-7xl mx-auto">
    
    <!-- Balance Grid (The Financial Core) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- USD Wallet: The Capital Engine -->
        <div class="bg-brand-navy p-12 rounded-[3.5rem] text-white shadow-2xl relative overflow-hidden group">
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
            <div class="absolute top-0 right-0 w-48 h-48 bg-brand-gold/10 rounded-full -translate-x-1/4 -translate-y-1/4 blur-3xl group-hover:bg-brand-gold/20 transition-soft"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-10">
                    <div class="space-y-1">
                        <span class="text-[10px] font-black text-brand-gold uppercase tracking-[0.3em] italic">Enterprise Vault</span>
                        <p class="text-white/40 text-[8px] font-black uppercase tracking-widest leading-none">Primary Settlement Unit</p>
                    </div>
                    <div class="w-12 h-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center">
                        <span class="text-lg font-black text-brand-gold">$</span>
                    </div>
                </div>
                <h3 class="text-5xl font-heading font-black mb-2 italic tracking-tighter uppercase leading-none">${{ number_format($balances['USD'] ?? 0, 2) }}</h3>
                <p class="text-emerald-400 font-bold uppercase tracking-widest text-[8px] italic">+2.4% vs last session</p>
                
                <div class="mt-12 flex gap-4">
                    <button class="flex-1 bg-brand-gold hover:bg-brand-goldHover text-brand-navy py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl transition-soft italic active:scale-95">Fund Wallet</button>
                    <button class="flex-1 bg-white/5 border border-white/10 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-soft italic active:scale-95">Withdraw</button>
                </div>
            </div>
        </div>

        <!-- CNY Wallet: China Sourcing Node -->
        <div class="bg-white p-12 rounded-[3.5rem] shadow-sm border border-slate-100 group hover:shadow-2xl transition-soft flex flex-col">
             <div class="flex items-center justify-between mb-10">
                <div class="space-y-1">
                    <span class="text-[10px] font-black text-red-500 uppercase tracking-[0.3em] italic">Sourcing Node</span>
                    <p class="text-slate-300 text-[8px] font-black uppercase tracking-widest leading-none">Guangzhou Logistics Settlement</p>
                </div>
                <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center">
                    <span class="text-lg font-black text-red-500">¥</span>
                </div>
            </div>
            <h3 class="text-5xl font-heading font-black text-brand-navy mb-2 italic tracking-tighter uppercase leading-none">¥{{ number_format($balances['CNY'] ?? 0, 2) }}</h3>
            <p class="text-slate-400 font-bold uppercase tracking-widest text-[8px] italic">Verified Merchant Yuan</p>
            <div class="mt-12 mt-auto">
                <button onclick="document.getElementById('convertModal').classList.remove('hidden')" class="w-full bg-slate-50 border border-slate-100 text-brand-navy py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-navy hover:text-brand-gold transition-soft italic active:scale-95">Swap Intel Currency</button>
            </div>
        </div>

        <!-- NGN Wallet: Regional Origin -->
        <div class="bg-white p-12 rounded-[3.5rem] shadow-sm border border-slate-100 group hover:shadow-2xl transition-soft flex flex-col">
             <div class="flex items-center justify-between mb-10">
                <div class="space-y-1">
                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] italic">Local Origin</span>
                    <p class="text-slate-300 text-[8px] font-black uppercase tracking-widest leading-none">Naira Operations Hub</p>
                </div>
                <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center">
                    <span class="text-lg font-black text-emerald-500">₦</span>
                </div>
            </div>
            <h3 class="text-5xl font-heading font-black text-brand-navy mb-2 italic tracking-tighter uppercase leading-none">₦{{ number_format($balances['NGN'] ?? 0, 1) }}</h3>
            <p class="text-slate-400 font-bold uppercase tracking-widest text-[8px] italic">Nigeria Business Liquidity</p>
            <div class="mt-12 mt-auto">
                <button class="w-full bg-slate-50 border border-slate-100 text-brand-navy py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-navy hover:text-brand-gold transition-soft italic active:scale-95">Fund Local Account</button>
            </div>
        </div>
    </div>

    <!-- Currency Swap Modal (Enterprise Protocol) -->
     <div id="convertModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-brand-navy/80 backdrop-blur-md" onclick="document.getElementById('convertModal').classList.add('hidden')"></div>
        <div class="bg-white w-full max-w-xl rounded-[4rem] shadow-2xl relative z-10 overflow-hidden">
            <div class="bg-brand-navy p-12 text-white relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-gold/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
                <h3 class="text-4xl font-heading font-black italic uppercase tracking-tighter leading-none">Currency Swap</h3>
                <p class="text-white/40 font-bold text-[10px] uppercase tracking-[0.3em] mt-2 italic">Automated Market Liquidity Settlement</p>
            </div>
            
            <form class="p-12 space-y-8" action="/portal/wallet/convert" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Source Component</label>
                        <select name="from" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-brand-navy focus:border-brand-gold outline-none transition-soft">
                            <option value="NGN">NGN (Naira)</option>
                            <option value="USD">USD (Dollar)</option>
                            <option value="CNY">CNY (Yuan)</option>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Target Node</label>
                        <select name="to" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-brand-navy focus:border-brand-gold outline-none transition-soft">
                            <option value="CNY">CNY (Yuan)</option>
                            <option value="USD">USD (Dollar)</option>
                            <option value="NGN">NGN (Naira)</option>
                        </select>
                    </div>
                </div>
                
                <div class="space-y-3">
                     <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Execution Amount</label>
                     <div class="relative group">
                         <input type="number" name="amount" placeholder="0.00" 
                                class="w-full text-4xl font-heading font-black bg-slate-50 border-2 border-slate-100 rounded-[2.5rem] px-10 py-10 text-brand-navy placeholder-slate-200 focus:border-brand-gold focus:bg-white outline-none transition-soft group-hover:border-slate-200">
                         <div class="absolute right-10 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-300 uppercase tracking-widest italic group-focus-within:text-brand-gold">UNITS</div>
                     </div>
                </div>

                <div class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-200">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-brand-gold/10 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 ml-5 leading-relaxed italic">
                            <span class="text-brand-navy font-black italic uppercase">Exchange Protocol:</span> GlobalLine proprietary rates apply. Internal settling engine completes swap in <span class="text-brand-navy font-black">&lt; 10s</span>.
                        </p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-brand-navy hover:bg-brand-lightNavy text-brand-gold font-black py-7 rounded-[2.5rem] shadow-2xl transition-soft text-sm uppercase tracking-[0.3em] italic active:scale-[0.98]">
                    Execute Settle Protocol
                </button>
            </form>
        </div>
    </div>

    <!-- Enhanced Asset Table (The Audit Ledger) -->
    <div class="bg-white rounded-[4rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-12 py-10 border-b border-slate-50 flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h3 class="text-2xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">Verified Asset Ledger</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Comprehensive audit trail of cross-border deployments</p>
            </div>
            <button class="bg-slate-50 hover:bg-slate-100 border border-slate-100 text-brand-navy px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-soft italic mt-6 md:mt-0">Extract Intelligence (PDF)</button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-12 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Reference Component</th>
                        <th class="px-12 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Deployment Type</th>
                        <th class="px-12 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Capital Delta</th>
                        <th class="px-12 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Verification Status</th>
                        <th class="px-12 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Deployment Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transactions as $tx)
                    <tr class="hover:bg-slate-50/50 transition-soft group">
                        <td class="px-12 py-8">
                             <p class="text-sm font-black text-brand-navy italic uppercase tracking-tight">TX-{{ strtoupper(substr($tx->id, 0, 10)) }}</p>
                             <p class="text-[9px] font-bold text-slate-300 uppercase mt-1">Hash Verified</p>
                        </td>
                        <td class="px-12 py-8">
                             <div class="flex items-center space-x-3">
                                <span class="w-2 h-2 rounded-full {{ $tx->type == 'credit' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                <span class="text-[10px] font-black text-brand-navy uppercase tracking-widest italic">{{ $tx->type }}</span>
                             </div>
                        </td>
                        <td class="px-12 py-8">
                            <p class="text-lg font-heading font-black italic tracking-tighter {{ $tx->amount > 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                {{ $tx->amount > 0 ? '+' : '' }}{{ number_format($tx->amount, 2) }} <span class="text-[10px] font-bold uppercase">{{ $tx->currency }}</span>
                            </p>
                        </td>
                        <td class="px-12 py-8">
                            <span class="px-5 py-2 bg-brand-gold/10 text-brand-gold border border-brand-gold/20 rounded-full text-[9px] font-black uppercase tracking-[0.2em] italic shadow-sm">{{ $tx->status }}</span>
                        </td>
                        <td class="px-12 py-8 text-[11px] font-black text-brand-navy uppercase italic tracking-tighter">{{ $tx->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-12 py-32 text-center flex flex-col items-center justify-center">
                             <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                             </div>
                             <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] italic">No transaction intel detected in your financial terminal.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@endsection
