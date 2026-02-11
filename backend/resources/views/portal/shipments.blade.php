@extends('layouts.portal')

@section('page_title', 'My Logistics & Shipments')

@section('content')
<div class="space-y-10">
    <!-- Header Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-2xl font-heading font-bold text-slate-800">Shipment Management</h2>
            <p class="text-slate-500 text-sm">Track, manage, and pre-notify us of your incoming cargo.</p>
        </div>
        <div class="flex items-center gap-4">
            <button onclick="document.getElementById('shipForMeModal').classList.toggle('hidden')" class="bg-brand-navy text-white px-6 py-3 rounded-2xl font-bold hover:bg-brand-accent transition-all flex items-center shadow-lg shadow-brand-navy/10">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ship for Me
            </button>
        </div>
    </div>

    <!-- Stats & Rates -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-white sticky top-0">
                <h3 class="font-heading font-bold text-slate-800">Active Cargo</h3>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-brand-gold rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Real-time Updates</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Package Info</th>
                            <th class="px-8 py-4">Origin &rarr; Dest</th>
                            <th class="px-8 py-4">Weight/Price</th>
                            <th class="px-8 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($shipments as $shipment)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $shipment->tracking_number }}</p>
                                        <span class="px-2 py-0.5 bg-blue-50 text-blue-600 rounded text-[10px] font-bold uppercase">{{ $shipment->status }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-medium text-slate-600">{{ $shipment->origin_country }} &rarr; {{ $shipment->destination_country }}</p>
                                <p class="text-[10px] text-slate-400 italic">Created {{ $shipment->created_at->format('M d, Y') }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-slate-800">{{ $shipment->weight }} kg</p>
                                <p class="text-xs text-brand-navy font-bold">${{ number_format($shipment->price, 2) }}</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <button class="text-slate-400 hover:text-brand-navy transition-colors">
                                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="max-w-xs mx-auto space-y-4">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    </div>
                                    <p class="text-slate-500 font-medium italic">No active shipments found.</p>
                                    <button onclick="document.getElementById('shipForMeModal').classList.toggle('hidden')" class="text-brand-navy text-sm font-bold hover:underline">Notification our team of a package &rarr;</button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Warehouse Addresses -->
            <div class="bg-brand-navy p-8 rounded-[2rem] text-white shadow-xl shadow-brand-navy/20">
                <h3 class="font-heading font-bold text-lg mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Our China Warehouse
                </h3>
                <div class="space-y-4 text-sm bg-white/5 p-4 rounded-2xl border border-white/10">
                    <div>
                        <p class="text-white/40 uppercase font-bold text-[10px] tracking-widest">Receiver Name</p>
                        <p class="font-medium">GlobalLine / {{ auth()->user()->name ?? 'Your Name' }}</p>
                    </div>
                    <div>
                        <p class="text-white/40 uppercase font-bold text-[10px] tracking-widest">Address (Chinese)</p>
                        <p class="font-medium">广州市白云区石马桃溪自编168号201仓 (GlobalLine)</p>
                    </div>
                    <div>
                        <p class="text-white/40 uppercase font-bold text-[10px] tracking-widest">Phone</p>
                        <p class="font-medium">+86 138 2611 2623</p>
                    </div>
                </div>
                <button class="mt-6 w-full py-3 bg-brand-gold text-brand-navy font-bold rounded-2xl hover:scale-105 transition-transform">Copy Full Address</button>
            </div>

            <!-- Rate Calculator Lite -->
            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="font-heading font-bold text-slate-800 text-lg mb-4">Live Rates</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <span class="text-xs font-bold text-slate-500">China &rarr; Lagos (Air)</span>
                        <span class="text-sm font-bold text-brand-navy">$10.50/kg</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <span class="text-xs font-bold text-slate-500">China &rarr; Lagos (Sea)</span>
                        <span class="text-sm font-bold text-brand-navy">$650/CBM</span>
                    </div>
                     <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <span class="text-xs font-bold text-slate-500">Global Express (3 Days)</span>
                        <span class="text-sm font-bold text-brand-navy">$22.00/kg</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ship for Me Modal (Pre-advice) -->
<div id="shipForMeModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('shipForMeModal').classList.add('hidden')"></div>
    <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl relative z-10 overflow-hidden">
        <div class="bg-brand-navy p-8 text-white">
            <h3 class="text-2xl font-heading font-bold">Ship for Me</h3>
            <p class="text-white/60 text-sm">Notify our warehouse team about your incoming package.</p>
        </div>
        <form class="p-8 space-y-6" method="POST" action="/portal/ship-for-me">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tracking Number (from Supplier)</label>
                <input type="text" name="external_tracking" placeholder="e.g. SF12345678" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Item Name</label>
                    <input type="text" name="item_name" placeholder="Sneakers, Electronics..." class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Quantity</label>
                    <input type="number" name="quantity" value="1" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Special Instructions</label>
                <textarea name="notes" placeholder="e.g. Please check for color orange, fragile..." class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold h-24"></textarea>
            </div>
            <button type="submit" class="w-full bg-brand-gold text-brand-navy font-bold py-4 rounded-2xl shadow-lg shadow-brand-gold/20 hover:scale-[1.02] transition-transform">Submit Notification</button>
        </form>
    </div>
</div>
@endsection
