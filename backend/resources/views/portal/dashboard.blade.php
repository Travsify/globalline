@extends('layouts.portal')

@section('page_title', 'Enterprise Intelligence')

@section('content')
<div class="space-y-12 pb-20">
    
    <!-- Hero Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Active Shipments -->
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 group hover:shadow-xl transition-soft">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-slate-50 border border-slate-100 text-brand-navy rounded-2xl flex items-center justify-center group-hover:bg-brand-navy group-hover:text-brand-gold transition-soft">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"></path></svg>
                </div>
                <span class="text-[10px] font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-widest italic">Live Tracking</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 border-l-2 border-brand-gold pl-2 uppercase tracking-[0.2em] mb-2 italic">Active Freight</p>
            <p class="text-4xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">04</p>
        </div>

        <!-- Sourcing Collective (Dynamic Sync) -->
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 group hover:shadow-xl transition-soft relative overflow-hidden">
            @if(count($cart) > 0)
                <div class="absolute top-0 right-0 p-4">
                    <span class="flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-gold opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-gold"></span>
                    </span>
                </div>
            @endif
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-slate-50 border border-slate-100 text-brand-navy rounded-2xl flex items-center justify-center group-hover:bg-brand-navy group-hover:text-brand-gold transition-soft">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Inventory Grid</p>
            </div>
            <p class="text-[10px] font-black text-slate-400 border-l-2 border-brand-gold pl-2 uppercase tracking-[0.2em] mb-2 italic">Collective Cart</p>
            <p class="text-4xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">{{ count($cart) }} <span class="text-slate-300 text-lg">Nodes</span></p>
            @if(count($cart) > 0)
                <a href="{{ route('portal.marketplace') }}" class="mt-4 block text-[9px] font-bold text-brand-gold uppercase tracking-widest hover:underline italic">Settle Synchronized Items &rarr;</a>
            @endif
        </div>

        <!-- Global Payments -->
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 group hover:shadow-xl transition-soft">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-slate-50 border border-slate-100 text-brand-navy rounded-2xl flex items-center justify-center group-hover:bg-brand-navy group-hover:text-brand-gold transition-soft">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <span class="text-[10px] font-black text-brand-gold bg-brand-gold/5 px-3 py-1 rounded-full uppercase tracking-widest italic">Verified B2B</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 border-l-2 border-brand-gold pl-2 uppercase tracking-[0.2em] mb-2 italic">Total CapEx</p>
            <p class="text-4xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">$8.4K</p>
        </div>

        <!-- Wallet Balance Card -->
        <div class="stat-card-gold rounded-[2.5rem] p-8 shadow-2xl shadow-brand-gold/20 relative overflow-hidden group">
            <div class="absolute inset-0 bg-brand-navy/5 opacity-0 group-hover:opacity-100 transition-soft"></div>
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-[40px]"></div>
            
            <p class="text-[10px] font-black text-brand-navy/60 uppercase tracking-[0.3em] mb-2 italic">Operating Capital</p>
            <p class="text-4xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">$1,240.50</p>
            
            <div class="mt-8 flex items-center space-x-3">
                <a href="{{ route('portal.wallet') }}" class="bg-brand-navy text-brand-gold px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-soft shadow-lg">Load Funds</a>
                <button class="w-10 h-10 bg-white/20 border border-white/30 text-brand-navy rounded-xl flex items-center justify-center hover:bg-white/40 transition-soft">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Chart Section -->
        <div class="lg:col-span-2 bg-white p-12 rounded-[3.5rem] shadow-sm border border-slate-100 flex flex-col">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                <div>
                    <h3 class="text-2xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">Operational Velocity</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Cross-Border Transaction vs Freight Volume (6M)</p>
                </div>
                <div class="flex items-center space-x-6 mt-6 md:mt-0">
                    <div class="flex items-center">
                        <span class="w-2.5 h-2.5 bg-brand-navy rounded-full mr-2"></span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">CapEx</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-2.5 h-2.5 bg-brand-gold rounded-full mr-2"></span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Cargo Volume</span>
                    </div>
                </div>
            </div>
            
            <div class="h-80 w-full relative">
                <canvas id="velocityChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="bg-white p-10 rounded-[3.5rem] shadow-sm border border-slate-100">
            <h4 class="text-sm font-black text-brand-navy uppercase tracking-[0.3em] mb-8 italic">System Intel</h4>
            
            <div class="space-y-8">
                <!-- Activity Item -->
                <div class="flex space-x-5 group cursor-pointer">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center shrink-0 group-hover:border-brand-gold/30 transition-soft">
                        <svg class="w-5 h-5 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-brand-navy uppercase tracking-tight italic">Shipment Verified</p>
                        <p class="text-[10px] text-slate-400 font-medium leading-relaxed mt-1">GL-82941 has cleared Customs at Guangzhou Terminal.</p>
                        <p class="text-[8px] font-bold text-brand-gold uppercase tracking-widest mt-2">12 MINS AGO</p>
                    </div>
                </div>

                <div class="flex space-x-5 group cursor-pointer">
                    <div class="w-12 h-12 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center shrink-0 group-hover:border-emerald-300 transition-soft">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-brand-navy uppercase tracking-tight italic">Currency Exchange</p>
                        <p class="text-[10px] text-slate-400 font-medium leading-relaxed mt-1">Converted $400 USD to 2,850 CNY for Factory 1688.</p>
                        <p class="text-[8px] font-bold text-brand-gold uppercase tracking-widest mt-2">1 HOUR AGO</p>
                    </div>
                </div>

                <div class="flex space-x-5 group cursor-pointer opacity-50 contrast-50">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center shrink-0 transition-soft">
                        <svg class="w-5 h-5 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-brand-navy uppercase tracking-tight italic">New Sourcing Order</p>
                        <p class="text-[10px] text-slate-400 font-medium leading-relaxed mt-1">Submitted inquiry for "Industrial LED Units" (500 units).</p>
                        <p class="text-[8px] font-bold text-brand-gold uppercase tracking-widest mt-2">6 HOURS AGO</p>
                    </div>
                </div>
            </div>

            <a href="#" class="mt-12 block text-center text-[10px] font-black text-brand-navy hover:text-brand-gold uppercase tracking-[0.2em] italic border-t border-slate-50 pt-8 transition-soft">Audit Full Logs &rarr;</a>
        </div>
    </div>

    <!-- Logistics Master Table -->
    <div class="bg-white rounded-[3.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-12 py-10 flex flex-col md:flex-row justify-between items-start md:items-center border-b border-slate-50">
            <div>
                <h3 class="text-2xl font-heading font-black text-brand-navy uppercase italic tracking-tighter">Global Logistics Ledger</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Real-time tracking for active AIR & SEA routes</p>
            </div>
            <div class="flex items-center space-x-4 mt-6 md:mt-0">
                <button class="bg-slate-50 hover:bg-slate-100 text-brand-navy px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-soft">Export CSV</button>
                <button class="bg-brand-navy hover:bg-brand-lightNavy text-brand-gold px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-soft shadow-xl italic">New Shipment</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-12 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Tracking ID</th>
                        <th class="px-12 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Cargo Origin</th>
                        <th class="px-12 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Method</th>
                        <th class="px-12 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Current Node</th>
                        <th class="px-12 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">ETA Status</th>
                        <th class="px-12 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="hover:bg-slate-50/50 transition-soft group">
                        <td class="px-12 py-8">
                            <p class="text-sm font-black text-brand-navy italic uppercase tracking-tight">GL-99320</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase mt-1">M-Box-228</p>
                        </td>
                        <td class="px-12 py-8">
                            <div class="flex items-center space-x-3">
                                <span class="text-lg">🇺🇸</span>
                                <p class="text-[10px] font-black text-brand-navy uppercase italic tracking-widest">New York Hub</p>
                            </div>
                        </td>
                        <td class="px-12 py-8">
                            <span class="px-4 py-1.5 bg-brand-gold/10 text-brand-gold border border-brand-gold/20 rounded-full text-[10px] font-black uppercase tracking-widest italic tracking-tighter shadow-sm">Express Air</span>
                        </td>
                        <td class="px-12 py-8">
                            <p class="text-[10px] font-black text-brand-navy uppercase italic tracking-widest">Departed Terminal</p>
                            <div class="w-24 h-1 bg-slate-100 rounded-full mt-2 overflow-hidden">
                                <div class="w-2/3 h-full bg-brand-gold rounded-full"></div>
                            </div>
                        </td>
                        <td class="px-12 py-8 text-[11px] font-black text-brand-navy uppercase italic tracking-tighter">Feb 18, 2026</td>
                        <td class="px-12 py-8">
                            <button class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-300 group-hover:text-brand-navy group-hover:bg-white group-hover:shadow-lg group-hover:scale-110 transition-soft">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-soft group">
                        <td class="px-12 py-8">
                            <p class="text-sm font-black text-brand-navy italic uppercase tracking-tight">GL-82941</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase mt-1">L-Pack-512</p>
                        </td>
                        <td class="px-12 py-8">
                            <div class="flex items-center space-x-3">
                                <span class="text-lg">🇨🇳</span>
                                <p class="text-[10px] font-black text-brand-navy uppercase italic tracking-widest">Guangzhou Hub</p>
                            </div>
                        </td>
                        <td class="px-12 py-8">
                            <span class="px-4 py-1.5 bg-slate-50 text-slate-400 border border-slate-100 rounded-full text-[10px] font-black uppercase tracking-widest italic tracking-tighter shadow-sm">Marine Cargo</span>
                        </td>
                        <td class="px-12 py-8">
                            <p class="text-[10px] font-black text-brand-navy uppercase italic tracking-widest">In Customs Clearing</p>
                            <div class="w-24 h-1 bg-slate-100 rounded-full mt-2 overflow-hidden">
                                <div class="w-full h-full bg-emerald-500 rounded-full"></div>
                            </div>
                        </td>
                        <td class="px-12 py-8 text-[11px] font-black text-brand-navy uppercase italic tracking-tighter">Apr 12, 2026</td>
                        <td class="px-12 py-8">
                            <button class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-300 group-hover:text-brand-navy group-hover:bg-white group-hover:shadow-lg group-hover:scale-110 transition-soft">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('velocityChart').getContext('2d');
        
        // Custom gradient for CapEx
        const gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
        gradientBlue.addColorStop(0, 'rgba(14, 27, 61, 0.2)');
        gradientBlue.addColorStop(1, 'rgba(14, 27, 61, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB'],
                datasets: [{
                    label: 'OpEx Spending',
                    data: [1800, 3200, 2400, 4800, 4200, 5600],
                    borderColor: '#0E1B3D',
                    backgroundColor: gradientBlue,
                    fill: true,
                    tension: 0.5,
                    borderWidth: 5,
                    pointRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0E1B3D',
                    pointBorderWidth: 3,
                    pointHoverRadius: 8
                }, {
                    label: 'Freight Units',
                    data: [1200, 1800, 1500, 2200, 1900, 3100],
                    borderColor: '#C5A059',
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.5,
                    borderWidth: 4,
                    borderDash: [8, 8],
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { 
                            font: { family: 'Outfit', weight: '900', size: 10 },
                            color: '#0E1B3D',
                            padding: 20
                        }
                    },
                    y: { 
                        display: false,
                        grid: { display: false },
                        beginAtZero: true 
                    }
                }
            }
        });
    });
</script>
@endsection
