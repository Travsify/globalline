@extends('layouts.portal')

@section('page_title', 'Enterprise Insights')

@section('content')
<div class="space-y-10">
    <!-- Welcome Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-white/10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                </div>
                <span class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-lg">+2 New</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Active Shipments</p>
            <p class="text-2xl font-heading font-bold text-slate-800 dark:text-white">04</p>
        </div>

        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-white/10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="text-xs font-bold text-slate-400">Total 12</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Sourcing Orders</p>
            <p class="text-2xl font-heading font-bold text-slate-800 dark:text-white">03</p>
        </div>

        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-white/10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <span class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-lg">Last: 2h ago</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Global Payments</p>
            <p class="text-2xl font-heading font-bold text-slate-800 dark:text-white">$4,500.00</p>
        </div>

        <div class="bg-brand-navy p-6 rounded-3xl shadow-xl shadow-brand-navy/10 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full"></div>
            <p class="text-white/60 text-sm font-medium">USD Balance</p>
            <p class="text-3xl font-heading font-bold text-white mt-1">$1,240.50</p>
            <div class="mt-4">
                <a href="{{ route('portal.wallet') }}" class="text-brand-gold text-xs font-bold uppercase tracking-widest flex items-center hover:translate-x-1 transition-transform">
                    Fund Wallet
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="bg-white dark:bg-slate-900 p-8 rounded-[3rem] shadow-sm border border-slate-100 dark:border-white/10">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="text-xl font-heading font-black text-slate-800 dark:text-white italic">Operational Performance</h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Wallet Spending vs Shipping volume</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-3 h-3 bg-brand-navy rounded-full"></span>
                <span class="text-[10px] font-black text-slate-400 uppercase">Spending</span>
                <span class="w-3 h-3 bg-brand-gold rounded-full ml-4"></span>
                <span class="text-[10px] font-black text-slate-400 uppercase">Volume</span>
            </div>
        </div>
        <div class="h-64">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Recent Shipments -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-heading font-bold text-slate-800">Ongoing Logistics</h3>
                <a href="#" class="text-sm font-bold text-brand-navy hover:text-brand-accent">View All</a>
            </div>
            
            <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-white/10 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-white/5">
                        <tr>
                            <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest italic">Global Tracking</th>
                            <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest italic">Route</th>
                            <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest italic">Status</th>
                            <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest italic">ETA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-5">
                                <p class="font-bold text-slate-800 dark:text-white">GL-99320</p>
                                <p class="text-[10px] text-slate-400 font-bold">New York &rarr; Nairobi</p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-[10px] font-black rounded text-slate-500 uppercase tracking-tighter">USA AIR</span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-lg text-xs font-bold uppercase">Departed</span>
                            </td>
                            <td class="px-6 py-5 text-sm text-slate-500 italic">Feb 12</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-5">
                                <p class="font-bold text-slate-800 dark:text-white">GL-82941</p>
                                <p class="text-[10px] text-slate-400 font-bold">Guangzhou &rarr; Lagos</p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-[10px] font-black rounded text-slate-500 uppercase tracking-tighter">CN SEA</span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-lg text-xs font-bold uppercase">In Transit</span>
                            </td>
                            <td class="px-6 py-5 text-sm text-slate-500 italic">Feb 14</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Marketplace Bits -->
        <div class="space-y-8">
            <div class="bg-brand-gold p-8 rounded-[2rem] shadow-xl shadow-brand-gold/10">
                <h3 class="text-brand-navy font-heading font-bold text-lg mb-4 text-center">Need a Quote?</h3>
                <p class="text-brand-navy/60 text-sm text-center mb-6">Calculate estimated shipping costs for your cargo.</p>
                <div class="space-y-4">
                    <input type="text" placeholder="Weight (kg)" class="w-full bg-white/50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-navy">
                    <button class="w-full bg-brand-navy text-white font-bold py-3 rounded-2xl hover:bg-brand-accent transition-colors">Quick Calc</button>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] shadow-sm border border-slate-100 dark:border-white/10">
                <h3 class="text-slate-800 dark:text-white font-heading font-bold text-lg mb-6">Trending in Marketplace</h3>
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl overflow-hidden flex-shrink-0">
                             <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=150&q=80" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Premium Sneakers</p>
                            <p class="text-xs text-brand-navy dark:text-brand-gold font-black italic">$12.50 <span class="text-slate-400 font-normal ml-2">MOQ 5</span></p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('portal.marketplace') }}" class="mt-8 block text-center text-sm font-bold text-slate-400 hover:text-brand-navy transition-colors">Explore Global Sourcing &rarr;</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Wallet Activity',
                    data: [1200, 1900, 1500, 2500, 2200, 3000],
                    borderColor: '#002366',
                    backgroundColor: 'rgba(0, 35, 102, 0.05)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0
                }, {
                    label: 'Shipping Volume',
                    data: [800, 1200, 1000, 1800, 1600, 2400],
                    borderColor: '#FFD700',
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                    borderDash: [5, 5]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { display: false },
                    y: { 
                        display: false,
                        beginAtZero: true 
                    }
                }
            }
        });
    });
</script>
@endsection
