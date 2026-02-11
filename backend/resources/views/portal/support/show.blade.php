@extends('layouts.portal')

@section('content')
<div class="px-8 py-10 max-w-5xl mx-auto">
    <!-- Header -->
    <div class="mb-12 flex justify-between items-end">
        <div>
            <a href="{{ route('portal.support.index') }}" class="text-brand-gold text-[10px] font-black uppercase tracking-[0.3em] mb-4 inline-block hover:underline italic">&larr; Fleet Overview</a>
            <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter">{{ $ticket->subject }}</h1>
            <div class="mt-4 flex items-center space-x-6">
                <span class="text-[9px] font-black text-white/40 uppercase tracking-widest italic">ID: #TKT-{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</span>
                <span class="text-[9px] font-black text-white/40 uppercase tracking-widest italic">Category: {{ $ticket->category }}</span>
                <span class="flex items-center space-x-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span class="text-[10px] font-black text-white uppercase tracking-widest italic">{{ $ticket->status }}</span>
                </span>
            </div>
        </div>
        <div class="bg-white/5 border border-white/10 px-6 py-3 rounded-2xl">
            <span class="text-[9px] font-black text-white/30 uppercase tracking-[0.3em] block mb-1">Priority</span>
            <span class="text-xs font-black text-brand-gold uppercase italic tracking-widest">{{ $ticket->priority }}</span>
        </div>
    </div>

    <!-- Message Thread -->
    <div class="space-y-10 mb-16">
        @foreach($ticket->messages as $msg)
        <div class="flex @if($msg->is_admin) justify-start @else justify-end @endif">
            <div class="max-w-[80%] @if($msg->is_admin) bg-white/5 border border-white/10 @else bg-brand-gold @endif p-8 rounded-[3rem] @if($msg->is_admin) rounded-tl-none @else rounded-tr-none @endif shadow-2xl relative">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-[9px] font-black @if($msg->is_admin) text-brand-gold @else text-brand-navy @endif uppercase tracking-[0.2em] italic">
                        {{ $msg->is_admin ? 'GlobalLine Agent' : 'Mission Control (You)' }}
                    </span>
                    <span class="text-[8px] font-bold @if($msg->is_admin) text-white/20 @else text-brand-navy/40 @endif uppercase">
                        {{ $msg->created_at->diffForHumans() }}
                    </span>
                </div>
                <div class="text-lg @if($msg->is_admin) text-white/80 @else text-brand-navy @endif font-medium leading-relaxed italic">
                    {!! nl2br(e($msg->message)) !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Reply Box -->
    <div class="mt-20">
        <div class="text-center mb-8">
            <div class="w-12 h-px bg-white/10 mx-auto"></div>
        </div>
        
        <form action="{{ route('portal.support.reply', $ticket->id) }}" method="POST" class="bg-white/5 border border-white/10 p-10 rounded-[4rem] backdrop-blur-2xl">
            @csrf
            <div class="space-y-4">
                <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-6">Next Transmission</label>
                <textarea name="message" required rows="4" placeholder="Type your response here..."
                          class="w-full bg-white/5 border border-white/10 rounded-[2.5rem] px-10 py-8 text-white focus:border-brand-gold outline-none transition-soft font-medium leading-relaxed italic"></textarea>
            </div>
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-12 py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-xs transition-soft shadow-2xl active:scale-95 italic">
                    Push Satellite Reply
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
