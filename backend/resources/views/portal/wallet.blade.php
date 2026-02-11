@extends('layouts.portal')

@section('page_title', 'Wallet & Billing')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <!-- Wallet Card -->
    <div class="bg-brand-navy p-10 rounded-[3rem] text-white shadow-2xl shadow-brand-navy/30 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="text-center md:text-left">
                <p class="text-white/60 text-sm font-medium uppercase tracking-widest mb-2">Available Balance</p>
                <p class="text-5xl font-heading font-bold text-white tracking-tight">${{ number_format($user->wallet_balance ?? 1240.50, 2) }}</p>
                <div class="mt-6 flex items-center gap-3 justify-center md:justify-start">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    <span class="text-xs text-white/60 font-medium">Standard Account Secured</span>
                </div>
            </div>
            <div class="w-full md:w-auto flex flex-col gap-4">
                <button class="bg-brand-gold text-brand-navy px-10 py-4 rounded-2xl font-bold hover:scale-105 transition-all shadow-xl shadow-brand-gold/20">Fund Account</button>
                <button class="bg-white/10 text-white px-10 py-4 rounded-2xl font-bold hover:bg-white/20 transition-all border border-white/10">Withdrawal</button>
            </div>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="space-y-6">
        <h3 class="text-xl font-heading font-bold text-slate-800">Transaction History</h3>
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Date</th>
                            <th class="px-8 py-5">Activity</th>
                            <th class="px-8 py-5">Reference</th>
                            <th class="px-8 py-5 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($transactions as $tx)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6 text-sm text-slate-500">{{ $tx->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 {{ $tx->type == 'credit' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }} rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($tx->type == 'credit')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                            @endif
                                        </svg>
                                    </div>
                                    <p class="font-bold text-slate-800">{{ $tx->description }}</p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-xs font-mono text-slate-400">{{ $tx->reference }}</td>
                            <td class="px-8 py-6 text-right font-bold {{ $tx->type == 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $tx->type == 'credit' ? '+' : '-' }}${{ number_format($tx->amount, 2) }}
                            </td>
                        </tr>
                        @empty
                         <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6 text-sm text-slate-500">Feb 01, 2026</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-50 text-green-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                    </div>
                                    <p class="font-bold text-slate-800">Account Opening Credit</p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-xs font-mono text-slate-400">TXN-998271</td>
                            <td class="px-8 py-6 text-right font-bold text-green-600">+$1,000.00</td>
                        </tr>
                         <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6 text-sm text-slate-500">Feb 05, 2026</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-red-50 text-red-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                    </div>
                                    <p class="font-bold text-slate-800">Shipment Payment GL-9211</p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-xs font-mono text-slate-400">TXN-882114</td>
                            <td class="px-8 py-6 text-right font-bold text-red-600">-$240.00</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center py-4">
                <button class="text-xs font-bold text-slate-400 hover:text-brand-navy tracking-widest uppercase">Load More Transactions</button>
            </div>
        </div>
    </div>
</div>
@endsection
