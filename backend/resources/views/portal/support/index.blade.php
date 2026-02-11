@extends('layouts.portal')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-12">
        <div>
            <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter">Command <span class="text-brand-gold">Support</span></h1>
            <p class="text-white/40 font-medium mt-2">Manage your active technical and logistics inquiries.</p>
        </div>
        <a href="{{ route('portal.support.create') }}" class="bg-brand-gold hover:bg-brand-goldHover text-brand-navy px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-soft shadow-2xl active:scale-95 italic">
            Open New Ticket
        </a>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white/5 border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-md">
            <span class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] italic">Open Tickets</span>
            <p class="text-4xl font-black text-white mt-4 italic tracking-tighter">{{ $tickets->where('status', 'open')->count() }}</p>
        </div>
        <div class="bg-white/5 border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-md">
            <span class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] italic">Resolved</span>
            <p class="text-4xl font-black text-brand-gold mt-4 italic tracking-tighter">{{ $tickets->where('status', 'resolved')->count() }}</p>
        </div>
        <div class="bg-white/5 border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-md">
            <span class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] italic">Avg Response</span>
            <p class="text-4xl font-black text-white mt-4 italic tracking-tighter">4.2h</p>
        </div>
    </div>

    <!-- Ticket List -->
    <div class="bg-white/5 border border-white/10 rounded-[3.5rem] overflow-hidden backdrop-blur-2xl">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/5 bg-white/5">
                    <th class="px-10 py-8 text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Ticket ID</th>
                    <th class="px-10 py-8 text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Subject</th>
                    <th class="px-10 py-8 text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Priority</th>
                    <th class="px-10 py-8 text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Status</th>
                    <th class="px-10 py-8 text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Created</th>
                    <th class="px-10 py-8 text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($tickets as $ticket)
                <tr class="group hover:bg-white/[0.02] transition-colors cursor-pointer" onclick="window.location.href='{{ route('portal.support.show', $ticket->id) }}';">
                    <td class="px-10 py-8">
                        <span class="text-xs font-black text-brand-gold italic">#TKT-{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-10 py-8">
                        <div>
                            <p class="text-white font-bold mb-1">{{ $ticket->subject }}</p>
                            <span class="text-[9px] font-black text-white/30 uppercase tracking-widest">{{ $ticket->category }}</span>
                        </div>
                    </td>
                    <td class="px-10 py-8">
                        <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-[9px] font-black text-white/60 uppercase tracking-widest italic @if($ticket->priority == 'high' || $ticket->priority == 'urgent') border-red-500/30 text-red-500 @endif">
                            {{ $ticket->priority }}
                        </span>
                    </td>
                    <td class="px-10 py-8">
                        <span class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full @if($ticket->status == 'open') bg-emerald-500 animate-pulse @elseif($ticket->status == 'resolved') bg-brand-gold @else bg-white/20 @endif"></span>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest italic">{{ $ticket->status }}</span>
                        </span>
                    </td>
                    <td class="px-10 py-8">
                        <span class="text-[10px] font-bold text-white/40 uppercase">{{ $ticket->created_at->format('M d, Y') }}</span>
                    </td>
                    <td class="px-10 py-8">
                        <a href="{{ route('portal.support.show', $ticket->id) }}" class="text-brand-gold text-[10px] font-black uppercase tracking-widest italic hover:underline">View Thread &rarr;</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-10 py-24 text-center">
                        <div class="max-w-xs mx-auto">
                            <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-8 h-8 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-white/40 font-bold italic">No active support tickets found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
