<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->supportTickets()->latest()->get();
        return view('portal.support.index', compact('tickets'));
    }

    public function create()
    {
        return view('portal.support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string',
            'priority' => 'required|string',
            'message' => 'required|string',
        ]);

        $ticket = SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'category' => $request->category,
            'priority' => $request->priority,
            'status' => 'open',
        ]);

        SupportMessage::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_admin' => false,
        ]);

        return redirect()->route('portal.support.show', $ticket->id)->with('success', 'Support ticket created successfully.');
    }

    public function show($id)
    {
        $ticket = Auth::user()->supportTickets()->with('messages.user')->findOrFail($id);
        return view('portal.support.show', compact('ticket'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Auth::user()->supportTickets()->findOrFail($id);

        SupportMessage::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_admin' => false,
        ]);

        $ticket->update(['status' => 'open']); // Re-open if it was pending/resolved

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
