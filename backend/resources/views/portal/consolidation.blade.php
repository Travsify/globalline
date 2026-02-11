@extends('layouts.portal')

@section('page_title', 'Consolidation Hub')

@section('content')
<div class="max-w-6xl mx-auto space-y-10">
    <div class="bg-gradient-to-r from-brand-navy to-brand-accent p-12 rounded-[3.5rem] text-white shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-4xl font-heading font-black mb-4 italic">Save up to 40% on Shipping.</h2>
            <p class="text-white/60 text-lg leading-relaxed mb-8">Consolidate multiple packages into a single GlobalLine Master Box. We'll merge your items and ship them as one to reduce volumetric weight costs.</p>
            <div class="flex items-center space-x-4">
                 <button onclick="document.getElementById('consolidationModal').classList.toggle('hidden')" class="bg-brand-gold text-brand-navy px-10 py-4 rounded-2xl font-black shadow-xl hover:scale-105 transition-transform">Start New Consolidation</button>
                 <span class="text-xs font-bold text-white/40 uppercase tracking-widest italic hover:text-brand-gold cursor-pointer transition-colors">How it works &rarr;</span>
            </div>
        </div>
    </div>

    <!-- Active Consolidations -->
    <div class="grid grid-cols-1 gap-8">
        @forelse($consolidations as $con)
        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between group">
            <div class="mb-6 md:mb-0">
                <span class="px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase tracking-widest mb-4 inline-block">{{ $con->status }}</span>
                <h4 class="text-2xl font-heading font-bold text-slate-800">{{ $con->master_tracking_number }}</h4>
                <p class="text-slate-400 text-sm mt-1">Master Box · {{ $con->shipments->count() }} Sub-packages</p>
            </div>
            <div class="flex -space-x-4 mb-6 md:mb-0">
                @foreach($con->shipments->take(3) as $sub)
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 border-4 border-white flex items-center justify-center text-[10px] font-black text-slate-400">Box</div>
                @endforeach
                @if($con->shipments->count() > 3)
                    <div class="w-16 h-16 rounded-2xl bg-brand-gold border-4 border-white flex items-center justify-center text-[10px] font-black text-brand-navy">+{{ $con->shipments->count() - 3 }}</div>
                @endif
            </div>
            <div class="flex items-center space-x-6">
                <div class="text-right">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Est. Weight</p>
                    <p class="text-xl font-heading font-bold text-slate-800">Pending</p>
                </div>
                <button class="bg-slate-50 text-brand-navy p-5 rounded-3xl hover:bg-brand-gold transition-colors">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
        @empty
        <div class="py-24 text-center bg-white rounded-[4rem] border border-dashed border-slate-200">
            <p class="text-slate-400 italic">No active consolidations.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Consolidation Modal -->
<div id="consolidationModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('consolidationModal').classList.add('hidden')"></div>
    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl relative z-10 overflow-hidden">
        <div class="bg-brand-navy p-10 text-white">
            <h3 class="text-3xl font-heading font-black italic">Select Shipments</h3>
            <p class="text-white/60 text-sm mt-2">Pick at least 2 shipments to merge.</p>
        </div>
        <form class="p-10 space-y-8" action="/portal/consolidation" method="POST">
            @csrf
            <div class="max-h-96 overflow-y-auto space-y-4 pr-4">
                @foreach($shipments as $shipment)
                <label class="flex items-center p-6 bg-slate-50 rounded-3xl border-2 border-transparent hover:border-brand-gold cursor-pointer transition-all has-[:checked]:bg-brand-gold/5 has-[:checked]:border-brand-gold">
                    <input type="checkbox" name="shipment_ids[]" value="{{ $shipment->id }}" class="w-6 h-6 rounded-lg text-brand-navy focus:ring-brand-gold border-slate-200">
                    <div class="ml-6 flex-1">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Tracking: {{ $shipment->tracking_number }}</span>
                            <span class="text-sm font-bold text-brand-navy">{{ $shipment->weight }} {{ $shipment->weight_unit }}</span>
                        </div>
                        <p class="text-lg font-heading font-bold text-slate-800">{{ $shipment->origin }} &rarr; {{ $shipment->destination }}</p>
                    </div>
                </label>
                @endforeach
            </div>
            
            <div class="p-6 bg-brand-gold/10 rounded-3xl border border-brand-gold/20">
                <p class="text-xs font-bold text-brand-navy text-center uppercase tracking-widest">Merging packages is final once submitted. We'll re-weigh your master box in China.</p>
            </div>

            <button type="submit" class="w-full bg-brand-navy text-white font-black py-6 rounded-3xl shadow-xl hover:scale-[1.02] transition-all">Submit Consolidation Request</button>
        </form>
    </div>
</div>
@endsection
