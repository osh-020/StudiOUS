<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Ticket::count();
        $open = Ticket::where('status', 'Open')->count();
        $inProgress = Ticket::where('status', 'In Progress')->count();
        $resolved = Ticket::where('status', 'Resolved')->count();

        return view('admin.dashboard', compact('total', 'open', 'inProgress', 'resolved'));
    }

    public function tickets(Request $request)
    {
        $query = Ticket::with('user');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->latest()->get();

        return view('admin.tickets', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user', 'messages.sender')->findOrFail($id);
        return view('admin.ticket_detail', compact('ticket'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($id);

        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Reply sent.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Open,In Progress,Pending,Resolved',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated.');
    }
}
