@extends('layouts.portal')

@section('content')
<div class="px-8 py-10 max-w-4xl mx-auto">
    <div class="mb-12">
        <a href="{{ route('portal.support.index') }}" class="text-brand-gold text-[10px] font-black uppercase tracking-[0.3em] mb-4 inline-block hover:underline italic">&larr; Return to Fleet</a>
        <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter">Open <span class="text-brand-gold">Inquiry</span></h1>
        <p class="text-white/40 font-medium mt-2">Initialize a direct conduit to our headquarters for resolution.</p>
    </div>

    <form action="{{ route('portal.support.store') }}" method="POST" class="space-y-8 bg-white/5 border border-white/10 p-12 rounded-[3.5rem] backdrop-blur-2xl">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-3">
                <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Objective / Subject</label>
                <input type="text" name="subject" required placeholder="Brief title of your inquiry" 
                       class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-brand-gold outline-none transition-soft font-bold">
            </div>

            <div class="space-y-3">
                <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Department / Category</label>
                <select name="category" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-brand-gold outline-none transition-soft font-bold appearance-none">
                    <option value="general" class="bg-brand-navy">General Inquiry</option>
                    <option value="logistics" class="bg-brand-navy">Logistics & Shipping</option>
                    <option value="sourcing" class="bg-brand-navy">Product Sourcing</option>
                    <option value="payment" class="bg-brand-navy">Payments & Wallet</option>
                    <option value="account" class="bg-brand-navy">Account Security</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-3">
                <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Operational Priority</label>
                <div class="flex space-x-4">
                    @foreach(['low', 'normal', 'high', 'urgent'] as $prio)
                    <label class="flex-1">
                        <input type="radio" name="priority" value="{{ $prio }}" @if($prio == 'normal') checked @endif class="hidden peer">
                        <div class="text-center py-3 border border-white/10 rounded-xl cursor-pointer text-[10px] font-black uppercase text-white/40 peer-checked:bg-white/10 peer-checked:text-brand-gold peer-checked:border-brand-gold/40 transition-soft italic tracking-widest">
                            {{ $prio }}
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-3">
            <label class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] ml-2">Direct Intel / Message</label>
            <textarea name="message" required rows="6" placeholder="Describe your issue or request in detail..."
                      class="w-full bg-white/5 border border-white/10 rounded-3xl px-8 py-6 text-white focus:border-brand-gold outline-none transition-soft font-medium leading-relaxed"></textarea>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-brand-gold hover:bg-brand-goldHover text-brand-navy py-6 rounded-2xl font-black uppercase tracking-[0.3em] text-sm shadow-2xl transition-soft active:scale-95 italic">
                Initialize Transmission
            </button>
        </div>
    </form>
</div>
@endsection
