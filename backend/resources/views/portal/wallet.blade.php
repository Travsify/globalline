@extends('layouts.portal')

@section('page_title', 'Multi-Currency Wallet')

@section('content')
<div class="max-w-6xl mx-auto space-y-10">
    <!-- Balance Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- USD Wallet -->
        <div class="bg-brand-navy p-10 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-8">
                    <span class="text-xs font-bold text-brand-gold uppercase tracking-[0.2em] italic">Business Wallet</span>
                    <svg class="w-8 h-8 text-white/20" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                </div>
                <h3 class="text-5xl font-heading font-black mb-2">${{ number_format($balances['USD'] ?? 0, 2) }}</h3>
                <p class="text-white/40 font-bold uppercase tracking-widest text-[10px]">Primary USD Balance</p>
                
                <div class="mt-10 flex gap-4">
                    <button class="flex-1 bg-brand-gold text-brand-navy py-3 rounded-2xl font-black text-xs hover:scale-105 transition-transform">Fund Wallet</button>
                    <button class="flex-1 bg-white/10 text-white py-3 rounded-2xl font-black text-xs hover:bg-white/20 transition-all italic">Withdraw</button>
                </div>
            </div>
        </div>

        <!-- CNY Wallet -->
        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 group">
             <div class="flex items-center justify-between mb-8">
                <span class="text-xs font-bold text-red-500 uppercase tracking-[0.2em] italic">China Sourcing</span>
                <span class="text-red-100 font-black text-2xl uppercase">CNY</span>
            </div>
            <h3 class="text-5xl font-heading font-black text-slate-800 mb-2">¥{{ number_format($balances['CNY'] ?? 0, 2) }}</h3>
            <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Merchant Yuan Balance</p>
            <div class="mt-10">
                <button onclick="document.getElementById('convertModal').classList.remove('hidden')" class="w-full bg-slate-50 text-slate-800 py-3 rounded-2xl font-black text-xs hover:bg-slate-100 transition-all border border-slate-100">Swap Currency</button>
            </div>
        </div>

        <!-- NGN Wallet -->
        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 group">
             <div class="flex items-center justify-between mb-8">
                <span class="text-xs font-bold text-emerald-500 uppercase tracking-[0.2em] italic">Local Source</span>
                <span class="text-emerald-100 font-black text-2xl uppercase">NGN</span>
            </div>
            <h3 class="text-5xl font-heading font-black text-slate-800 mb-2">₦{{ number_format($balances['NGN'] ?? 0, 2) }}</h3>
            <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Nigerian Naira Balance</p>
            <div class="mt-10">
                <button class="w-full bg-slate-50 text-slate-800 py-3 rounded-2xl font-black text-xs hover:bg-slate-100 transition-all border border-slate-100">Fund Account</button>
            </div>
        </div>
    </div>

    <!-- Conversion Modal -->
     <div id="convertModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('convertModal').classList.add('hidden')"></div>
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl relative z-10 overflow-hidden">
            <div class="bg-brand-navy p-8 text-white">
                <h3 class="text-2xl font-heading font-bold italic">Currency Swap</h3>
                <p class="text-white/60 text-sm">Convert balances instantly at market rates.</p>
            </div>
            <form class="p-8 space-y-6" action="/portal/wallet/convert" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">From</label>
                        <select name="from" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm font-bold">
                            <option value="NGN">NGN (Naira)</option>
                            <option value="USD">USD (Dollar)</option>
                            <option value="CNY">CNY (Yuan)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">To</label>
                        <select name="to" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm font-bold">
                            <option value="CNY">CNY (Yuan)</option>
                            <option value="USD">USD (Dollar)</option>
                            <option value="NGN">NGN (Naira)</option>
                        </select>
                    </div>
                </div>
                <div>
                     <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Amount to Swap</label>
                    <input type="number" name="amount" placeholder="0.00" class="w-full text-3xl font-heading font-black bg-slate-50 border-none rounded-2xl px-5 py-5 focus:ring-2 focus:ring-brand-gold">
                </div>
                <div class="p-4 bg-blue-50 rounded-2xl flex items-center space-x-4 border border-blue-100">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-[10px] text-blue-700 font-bold leading-tight uppercase tracking-widest">GlobalLine internal rates apply. Conversions are settled in 10s.</p>
                </div>
                <button type="submit" class="w-full bg-brand-gold text-brand-navy font-black py-5 rounded-2xl shadow-xl shadow-brand-gold/20 hover:scale-[1.02] transition-transform">Complete Conversion</button>
            </form>
        </div>
    </div>

    <!-- Enhanced Transaction Table -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center">
            <h3 class="text-xl font-heading font-bold text-slate-800">Transaction History</h3>
            <button class="text-xs font-bold text-brand-navy hover:text-brand-accent transition-colors italic border-b-2 border-brand-gold pb-1 uppercase tracking-widest">Export All (PDF)</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Reference</th>
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Type</th>
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Amount</th>
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transactions as $tx)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-10 py-6 text-xs font-bold text-slate-400 italic">TX-{{ strtoupper(substr($tx->id, 0, 8)) }}</td>
                        <td class="px-10 py-6">
                            <span class="text-sm font-bold text-slate-800">{{ ucfirst($tx->type) }}</span>
                        </td>
                        <td class="px-10 py-6">
                            <span class="text-sm font-black {{ $tx->amount > 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                {{ $tx->amount > 0 ? '+' : '' }}{{ number_format($tx->amount, 2) }} {{ $tx->currency }}
                            </span>
                        </td>
                        <td class="px-10 py-6">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $tx->status }}</span>
                        </td>
                        <td class="px-10 py-6 text-xs text-slate-400 font-bold uppercase tracking-widest">{{ $tx->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-10 py-20 text-center text-slate-400 italic">No transactions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
