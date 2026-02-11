@extends('layouts.portal')

@section('page_title', 'Address Book')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-heading font-bold text-slate-800">My Addresses</h2>
            <p class="text-slate-500 text-sm">Manage your shipping destinations and billing sources.</p>
        </div>
        <button onclick="document.getElementById('addressModal').classList.toggle('hidden')" class="bg-brand-navy text-white px-6 py-3 rounded-2xl font-bold hover:bg-brand-accent transition-all flex items-center shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Address
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($addresses as $address)
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border {{ $address->is_default ? 'border-brand-gold shadow-brand-gold/10' : 'border-slate-100' }} relative group">
            @if($address->is_default)
            <span class="absolute top-4 right-8 bg-brand-gold text-brand-navy text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">Default</span>
            @endif
            
            <h4 class="text-xs font-bold text-brand-navy uppercase tracking-widest mb-4">{{ $address->label }}</h4>
            <p class="text-lg font-heading font-bold text-slate-800 mb-2">{{ $address->recipient_name }}</p>
            <div class="space-y-1 text-slate-500 text-sm">
                <p>{{ $address->street }}</p>
                <p>{{ $address->city }}, {{ $address->zip_code }}</p>
                <p class="font-bold text-slate-800">{{ $address->country }}</p>
            </div>
            <p class="mt-4 text-xs font-bold text-slate-400">{{ $address->phone }}</p>
            
            <div class="mt-8 pt-6 border-t border-slate-50 flex gap-4">
                <button class="text-xs font-bold text-slate-400 hover:text-brand-navy transition-colors">Edit Address</button>
                <button class="text-xs font-bold text-slate-400 hover:text-red-500 transition-colors">Delete</button>
            </div>
        </div>
        @empty
        <div class="col-span-2 py-20 text-center bg-white rounded-[3rem] border border-dashed border-slate-200">
             <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
            </div>
            <p class="text-slate-500 font-medium italic">Your address book is empty.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Address Modal -->
<div id="addressModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('addressModal').classList.add('hidden')"></div>
    <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl relative z-10 overflow-hidden">
        <div class="bg-brand-navy p-8 text-white">
            <h3 class="text-2xl font-heading font-bold">New Address</h3>
            <p class="text-white/60 text-sm">Add a shipping destination to your account.</p>
        </div>
        <form class="p-8 space-y-6" action="/portal/addresses" method="POST">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Address Label</label>
                <input type="text" name="label" placeholder="e.g. Home, Office" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                     <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Recipient Name</label>
                    <input type="text" name="recipient_name" placeholder="Full name" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
                </div>
                <div>
                     <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Phone</label>
                    <input type="tel" name="phone" placeholder="Phone number" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
                </div>
            </div>
            <div>
                 <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Street Address</label>
                <input type="text" name="street" placeholder="Enter house no. & street" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
            </div>
             <div class="grid grid-cols-2 gap-4">
                <div>
                     <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">City</label>
                    <input type="text" name="city" placeholder="City" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
                </div>
                <div>
                     <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Country</label>
                    <input type="text" name="country" placeholder="Country" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-brand-gold" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-brand-gold text-brand-navy font-bold py-4 rounded-2xl shadow-lg shadow-brand-gold/20 hover:scale-[1.02] transition-transform">Save Address</button>
        </form>
    </div>
</div>
@endsection
