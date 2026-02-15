<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $tickets = $user->supportTickets()->latest()->get();
        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'priority' => 'required|string|in:low,medium,high,urgent',
            'message' => 'required|string',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $ticket = $user->supportTickets()->create([
            'subject' => $validated['subject'],
            'category' => $validated['category'],
            'priority' => $validated['priority'],
            'status' => 'open',
        ]);

        $ticket->messages()->create([
            'user_id' => $user->id,
            'message' => $validated['message'],
            'is_admin' => false,
        ]);

        return response()->json($ticket->load('messages'), 201);
    }

    public function show(SupportTicket $supportTicket)
    {
        if ($supportTicket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($supportTicket->load('messages.user'));
    }

    public function reply(Request $request, SupportTicket $supportTicket)
    {
        if ($supportTicket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $message = $supportTicket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $validated['message'],
            'is_admin' => false,
        ]);

        return response()->json($message);
    }
}
