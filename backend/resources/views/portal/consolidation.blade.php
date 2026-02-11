@extends('layouts.portal')

@section('page_title', 'Consolidation Hub')

@section('content')
<div class="space-y-12 pb-20 max-w-7xl mx-auto">
    
    <!-- Premium Banner: The Master Box Strategy -->
    <div class="bg-brand-navy rounded-[3.5rem] p-16 text-white relative overflow-hidden shadow-2xl shadow-brand-navy/30">
        <!-- Background Accents -->
        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-brand-gold/10 rounded-full -translate-y-1/2 translate-x-1/4 blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-brand-gold/5 rounded-full translate-y-1/2 -translate-x-1/4 blur-[60px]"></div>
        
        <div class="relative z-10 max-w-3xl space-y-8">
            <div class="inline-flex items-center px-4 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></span>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] italic">Logistics Optimization Active</p>
            </div>
            
            <h2 class="text-5xl font-heading font-black tracking-tight leading-tight uppercase italic">Global Consolidation <br><span class="text-brand-gold">Master Hub</span></h2>
            <p class="text-white/60 text-lg font-medium leading-relaxed">Save up to 45% on cross-border logistics by merging diverse packages into a single GlobalLine Master Box. We synchronize your inventory in Guangzhou/Yiwu before international dispatch.</p>
            
            <div class="flex flex-wrap items-center gap-6 pt-4">
                 <button onclick="document.getElementById('consolidationModal').classList.remove('hidden')" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-12 py-5 rounded-[1.8rem] text-xs font-black uppercase tracking-[0.2em] shadow-2xl transition-soft italic transform active:scale-95">Initiate New Merge</button>
                 <a href="#" class="text-xs font-black text-white/40 hover:text-brand-gold uppercase tracking-[0.2em] italic border-b border-white/10 pb-1 transition-soft">Protocol Overview &rarr;</a>
            </div>
        </div>
        
        <!-- Iconography -->
        <div class="absolute right-20 top-1/2 -translate-y-1/2 hidden lg:block opacity-20 transform rotate-12 scale-150">
            <svg class="w-64 h-64 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
    </div>

    <!-- Active Consolidation Ledger -->
    <div class="space-y-8">
        <div class="flex justify-between items-end px-4">
            <div>
                <h3 class="text-2xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">Active Consolidations</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Pending merge verification & final weight audit</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-[8px] font-black text-slate-300 uppercase tracking-[0.4em]">Filter By:</span>
                <button class="px-5 py-2.5 bg-white border border-slate-100 rounded-xl text-[10px] font-black text-brand-navy uppercase tracking-widest shadow-sm">All Merges</button>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8">
            @forelse($consolidations as $con)
            <div class="bg-white p-12 rounded-[3.5rem] shadow-sm border border-slate-100 flex flex-col xl:flex-row xl:items-center justify-between group hover:shadow-2xl transition-soft">
                <div class="mb-10 xl:mb-0 space-y-4">
                    <div class="flex items-center space-x-3">
                        <span class="px-4 py-1.5 bg-brand-gold/10 text-brand-gold border border-brand-gold/20 rounded-full text-[10px] font-black uppercase tracking-widest italic tracking-tighter">{{ $con->status }}</span>
                        <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest italic border-l border-slate-100 pl-3">Started: {{ $con->created_at->format('M d, Y') }}</p>
                    </div>
                    <h4 class="text-3xl font-heading font-black text-brand-navy uppercase italic tracking-tighter leading-none">{{ $con->master_tracking_number }}</h4>
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.2em] italic">Master Freight Component · {{ $con->shipments->count() }} Sub-Nodes</p>
                </div>

                <!-- Sub-items Visualization -->
                <div class="flex -space-x-6 items-center mb-10 xl:mb-0">
                    @foreach($con->shipments->take(4) as $sub)
                        <div class="w-16 h-16 rounded-[1.2rem] bg-slate-50 border-4 border-white shadow-lg flex items-center justify-center text-[10px] font-black text-brand-navy/30 group-hover:scale-110 transition-soft" style="transform: rotate({{ rand(-8, 8) }}deg)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    @endforeach
                    @if($con->shipments->count() > 4)
                        <div class="w-16 h-16 rounded-[1.2rem] bg-brand-gold border-4 border-white shadow-lg flex items-center justify-center text-[10px] font-black text-brand-navy z-10 transition-soft">
                            +{{ $con->shipments->count() - 4 }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center space-x-10">
                    <div class="text-right">
                        <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1 italic">Consolidated Load</p>
                        <p class="text-4xl font-heading font-black text-brand-navy uppercase italic tracking-tighter leading-none">$PENDING</p>
                    </div>
                    <button class="stat-card-gold text-brand-navy p-6 rounded-2xl hover:scale-110 transition-soft shadow-lg">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
            @empty
            <div class="py-32 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-100 flex flex-col items-center justify-center">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] italic">No active logistics merges detected in your terminal.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Premium Consolidation Modal -->
<div id="consolidationModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-6">
    <div class="absolute inset-0 bg-brand-navy/80 backdrop-blur-md" onclick="document.getElementById('consolidationModal').classList.add('hidden')"></div>
    <div class="bg-white w-full max-w-3xl rounded-[4rem] shadow-2xl relative z-10 overflow-hidden group">
        
        <div class="bg-brand-navy p-12 text-white relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-gold/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
            <button onclick="document.getElementById('consolidationModal').classList.add('hidden')" class="absolute top-8 right-8 text-white/40 hover:text-white transition-soft">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="relative z-10">
                <h3 class="text-4xl font-heading font-black italic uppercase tracking-tighter leading-none">Assemble Master Box</h3>
                <p class="text-white/40 font-bold text-[10px] uppercase tracking-[0.3em] mt-4 italic">Selection Portal for Cargo Synchronization</p>
            </div>
        </div>

        <form class="p-12 space-y-10" action="/portal/consolidation" method="POST">
            @csrf
            <div class="space-y-4 max-h-[30rem] overflow-y-auto pr-4 custom-scrollbar">
                @foreach($shipments as $shipment)
                <label class="flex items-center p-8 bg-slate-50 rounded-[2.5rem] border-2 border-transparent hover:border-brand-gold/30 cursor-pointer transition-soft group/item has-[:checked]:bg-brand-gold/5 has-[:checked]:border-brand-gold">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="shipment_ids[]" value="{{ $shipment->id }}" 
                               class="w-7 h-7 rounded-[0.8rem] text-brand-navy focus:ring-brand-gold border-slate-200 bg-white checked:bg-brand-gold transition-soft">
                    </div>
                    
                    <div class="ml-8 flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest italic mb-1">Module ID: {{ $shipment->tracking_number }}</p>
                                <p class="text-lg font-heading font-black text-brand-navy uppercase italic tracking-tighter">{{ $shipment->origin }} &rarr; {{ $shipment->destination }}</p>
                            </div>
                            <div class="text-right">
                                <span class="bg-brand-navy text-brand-gold px-3 py-1 rounded-full text-[9px] font-black uppercase italic tracking-widest shadow-lg">{{ $shipment->weight }} {{ $shipment->weight_unit }}</span>
                                <p class="text-[8px] font-bold text-slate-400 uppercase mt-1 italic">Verified Load</p>
                            </div>
                        </div>
                    </div>
                </label>
                @endforeach
            </div>
            
            <div class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-200">
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-brand-gold/10 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-slate-500 ml-5 leading-relaxed italic">
                        <span class="text-brand-navy font-black">IMPORTANT PROTOCOL:</span> Merging shipments is a final execution. Once nodes are synched, our ground team in the warehouse will initiate physical consolidation for final density audit.
                    </p>
                </div>
            </div>

            <button type="submit" class="w-full bg-brand-navy hover:bg-brand-lightNavy text-brand-gold font-black py-7 rounded-[2rem] shadow-2xl transition-soft text-sm uppercase tracking-[0.3em] italic active:scale-[0.98]">
                Execute Merge Protocol
            </button>
        </form>
    </div>
</div>
@endsection
