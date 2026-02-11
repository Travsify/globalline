@extends('layouts.portal')

@section('page_title', 'Global Supplier Payments')

@section('content')
<div class="space-y-10">
    <!-- Header with Balance Summary -->
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-brand-gold/20 rounded-[1.5rem] flex items-center justify-center">
                <svg class="w-8 h-8 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Paid to Suppliers</p>
                <p class="text-3xl font-heading font-bold text-slate-800">$12,840.00</p>
            </div>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('paymentModal').classList.toggle('hidden')" class="bg-brand-navy text-white px-8 py-4 rounded-2xl font-bold hover:bg-brand-accent transition-all flex items-center shadow-lg shadow-brand-navy/10">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Supplier Payment
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Payment History -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-lg font-heading font-bold text-slate-800">Recent Transactions</h3>
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Supplier / Reference</th>
                            <th class="px-8 py-4">Amount</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4">Invoice</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($payments as $payment)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-bold text-slate-800">{{ $payment->supplier_name }}</p>
                                <p class="text-[10px] text-slate-400">ID: SP-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-brand-navy">${{ number_format($payment->amount, 2) }}</p>
                                <p class="text-[10px] text-slate-400">₦{{ number_format($payment->local_amount ?? ($payment->amount * 1500), 2) }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-xs font-bold uppercase">{{ $payment->status }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <a href="#" class="text-brand-navy hover:text-brand-accent">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <p class="text-slate-500 font-medium italic">No payment history yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Info Sidebar -->
        <div class="space-y-8">
            <div class="bg-amber-50 p-8 rounded-[2rem] border border-amber-100 italic text-amber-900 text-sm">
                <div class="flex items-center mb-4 not-italic font-bold text-amber-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    How it works
                </div>
                1. Upload your supplier's proforma invoice.<br>
                2. We provide the equivalent in your local currency.<br>
                3. We execute the wire transfer within 24 hours of payment.
            </div>

            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="font-heading font-bold text-slate-800 text-lg mb-6">Verified Suppliers</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center font-bold text-xs">AS</div>
                        <span class="text-sm font-medium text-slate-600">Alibaba Sourcing Ltd</span>
                    </div>
                     <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center font-bold text-xs">YT</div>
                        <span class="text-sm font-medium text-slate-600">Yiwu Trading Co.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('paymentModal').classList.add('hidden')"></div>
    <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl relative z-10 overflow-hidden">
        <div class="bg-brand-navy p-8 text-white">
            <h3 class="text-2xl font-heading font-bold">New Supplier Payment</h3>
            <p class="text-white/60 text-sm">Send funds directly to your international factory.</p>
        </div>
        <form class="p-8 space-y-6" method="POST" action="/portal/payments">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Supplier Name</label>
                <input type="text" name="supplier_name" placeholder="e.g. Foshan Furniture Co." class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Amount (USD)</label>
                    <input type="number" name="amount" placeholder="0.00" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
                </div>
                <div>
                     <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Bank Swift/BIC</label>
                    <input type="text" name="swift_code" placeholder="Optional" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold">
                </div>
            </div>
             <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Destination Account Number</label>
                <input type="text" name="account_number" placeholder="Enter bank account" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Invoice Upload (Link)</label>
                <input type="url" name="invoice_url" placeholder="Paste link to PDF/Image" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold">
            </div>
            <button type="submit" class="w-full bg-brand-gold text-brand-navy font-bold py-4 rounded-2xl shadow-lg shadow-brand-gold/20 hover:scale-[1.02] transition-transform">Initiate Global Payment</button>
        </form>
    </div>
</div>
@endsection
