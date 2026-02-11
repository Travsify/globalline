@extends('layouts.portal')

@section('page_title', 'Shipment Tracking')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <!-- Search Bar -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-white/10 flex items-center space-x-4">
        <div class="flex-1 flex items-center px-4">
            <svg class="w-6 h-6 text-slate-300 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" value="{{ $tracking_number ?? '' }}" placeholder="Enter Tracking Number (e.g. GL-882941)" class="w-full text-lg font-bold text-slate-800 dark:text-white bg-transparent focus:outline-none">
        </div>
        <button class="bg-brand-navy dark:bg-brand-gold text-white dark:text-brand-navy px-8 py-4 rounded-2xl font-bold hover:bg-brand-accent transition-all shadow-lg">Track Now</button>
    </div>

    @if(isset($shipment))
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Status Vertical Timeline -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-900 p-10 rounded-[3rem] shadow-sm border border-slate-100 dark:border-white/10">
                <h3 class="text-xl font-heading font-bold text-brand-navy dark:text-brand-gold mb-10 italic">Journey Timeline</h3>
                
                <div class="relative">
                    <!-- Vertical Line -->
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-slate-100 dark:bg-white/5"></div>
                    
                    <div class="space-y-12">
                        <!-- Step 4 (Current) -->
                        <div class="relative pl-12">
                            <div class="absolute left-0 w-8 h-8 bg-brand-gold rounded-full flex items-center justify-center border-4 border-white dark:border-slate-900 shadow-lg z-10">
                                <svg class="w-4 h-4 text-brand-navy" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-white">Processing at Sorting Center</h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Package is being prepared for international dispatch.</p>
                                <p class="text-[10px] font-black text-brand-navy dark:text-brand-gold uppercase tracking-widest mt-2">FEB 11, 2026 · 14:30 PM</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative pl-12 opacity-50">
                            <div class="absolute left-0 w-8 h-8 bg-slate-200 rounded-full flex items-center justify-center border-4 border-white z-10"></div>
                            <div>
                                <h4 class="font-bold text-slate-800">Picked up from Supplier</h4>
                                <p class="text-sm text-slate-500 mt-1">Vendor handed over package to GlobalLine Logistics.</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">FEB 10, 2026 · 09:15 AM</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative pl-12 opacity-50">
                            <div class="absolute left-0 w-8 h-8 bg-slate-200 rounded-full flex items-center justify-center border-4 border-white z-10"></div>
                            <div>
                                <h4 class="font-bold text-slate-800">Shipment Created</h4>
                                <p class="text-sm text-slate-500 mt-1">User generated tracking ID and pre-advice notice.</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">FEB 09, 2026 · 18:45 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipment Details Sidebar -->
        <div class="space-y-8">
            <div class="bg-brand-navy p-8 rounded-[2.5rem] text-white shadow-2xl">
                <h4 class="text-xs font-bold text-brand-gold uppercase tracking-[0.2em] mb-6 italic">Package Specs</h4>
                <div class="space-y-6">
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span class="text-white/50 text-xs">Weight</span>
                        <span class="font-bold text-sm">4.20 KG</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span class="text-white/50 text-xs">Dimensions</span>
                        <span class="font-bold text-sm">30x20x15 CM</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span class="text-white/50 text-xs">Total Pieces</span>
                        <span class="font-bold text-sm">1 Box</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-4">
                        <span class="text-white/50 text-xs">Service Type</span>
                        <span class="font-bold text-sm bg-brand-gold text-brand-navy px-2 py-0.5 rounded text-[10px] uppercase">Express Air</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-white/10">
                <h4 class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6 italic">Global Route Information</h4>
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-8 h-8 bg-slate-50 dark:bg-slate-800 rounded-lg flex items-center justify-center text-brand-navy dark:text-brand-gold font-black text-[10px] uppercase">ORG</div>
                    <span class="font-bold text-sm text-slate-800 dark:text-white">Origin Hub</span>
                </div>
                <div class="h-6 border-l-2 border-slate-100 dark:border-white/5 ml-4 mb-4"></div>
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-brand-navy dark:bg-brand-gold rounded-lg flex items-center justify-center text-brand-gold dark:text-brand-navy font-black text-[10px] uppercase italic">DEST</div>
                    <span class="font-bold text-sm text-slate-800 dark:text-white">Global Destination</span>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-32 text-center bg-white rounded-[4rem] border border-dashed border-slate-200">
        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        </div>
        <h3 class="text-2xl font-heading font-black text-slate-800 mb-2 tracking-tight">Enter your Tracking Number</h3>
        <p class="text-emerald-500 font-bold text-sm animate-fade-in uppercase tracking-widest">Global Live System Ready</p>
    </div>
    @endif
</div>
@endsection
