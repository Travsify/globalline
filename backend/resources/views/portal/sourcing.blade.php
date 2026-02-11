@extends('layouts.portal')

@section('page_title', 'Sourcing & Procurement')

@section('content')
<div class="space-y-10 text-center max-w-4xl mx-auto py-10">
    <div class="w-24 h-24 bg-brand-gold/20 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-12 h-12 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
    </div>
    <h2 class="text-3xl font-heading font-bold text-slate-800">Sourcing Request Hub</h2>
    <p class="text-slate-500">Submit requests for custom manufacturing or bulk procurement from China.</p>
    
    <div class="mt-12 bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100 text-left">
        <h4 class="font-bold text-slate-800 mb-6 px-4">Active Requests</h4>
        <div class="space-y-4">
             @forelse($orders as $order)
                <div class="flex items-center justify-between p-6 bg-slate-50 rounded-[2rem] hover:bg-slate-100 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center font-bold text-slate-400">#{{ $order->id }}</div>
                        <div>
                            <p class="font-bold text-slate-800">{{ $order->product_name }}</p>
                            <p class="text-xs text-slate-400">Qty: {{ $order->quantity }} | {{ $order->status }}</p>
                        </div>
                    </div>
                    <button class="bg-white px-4 py-2 rounded-xl text-xs font-bold text-brand-navy border border-slate-200">Track Progress</button>
                </div>
             @empty
                <div class="py-10 text-center text-slate-400 italic">No sourcing requests yet. Click new request to begin.</div>
             @endforelse
        </div>
        <button class="mt-8 w-full bg-brand-navy text-white font-bold py-4 rounded-2xl shadow-lg shadow-brand-navy/10 hover:scale-[1.01] transition-transform">Create New Sourcing Request</button>
    </div>
</div>
@endsection
