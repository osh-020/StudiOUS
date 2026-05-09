<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\DocumentRequest;
use App\Models\Message;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Ticket::where('category', '!=', 'Document Request')->count();
        $open = Ticket::where('category', '!=', 'Document Request')->where('status', 'Open')->count();
        $inProgress = Ticket::where('category', '!=', 'Document Request')->where('status', 'In Progress')->count();
        $resolved = Ticket::where('category', '!=', 'Document Request')->where('status', 'Resolved')->count();

        return view('admin.dashboard', compact('total', 'open', 'inProgress', 'resolved'));
    }

    public function tickets(Request $request)
    {
        $query = Ticket::with('user')->where('category', '!=', 'Document Request');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($sort = $request->query('sort')) {
            $query->when($sort === 'oldest', fn ($query) => $query->oldest(), fn ($query) => $query->latest());
        } else {
            $query->latest();
        }

        $tickets = $query->get();

        return view('admin.tickets', compact('tickets'));
    }

    public function requests(Request $request)
    {
        $query = DocumentRequest::with('user');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('subject', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('delivery_method', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT('REQ-', LPAD(id, 5, '0')) like ?", ["%{$search}%"]);
            });
        }

        if ($sort = $request->query('sort')) {
            $query->when($sort === 'oldest', fn ($query) => $query->oldest(), fn ($query) => $query->latest());
        } else {
            $query->latest();
        }

        $requests = $query->get();

        return view('admin.requests', compact('requests'));
    }

    public function showRequest($id)
    {
        $request = DocumentRequest::with('user')->findOrFail($id);
        return view('admin.request_detail', compact('request'));
    }

    public function updateRequestStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Open,In Progress,Pending,Resolved',
        ]);

        $documentRequest = DocumentRequest::findOrFail($id);
        $documentRequest->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Request status updated.');
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

    public function announcement()
    {
        $announcements = Announcement::with('user')->latest()->get();

        return view('admin.announcements', compact('announcements'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcement_images', 'public');
        }

        Announcement::create([
            'title' => $request->title,
            'message' => $request->message,
            'user_id' => Auth::id(),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.announcement')->with('success', 'Announcement posted.');
    }

    public function editAnnouncement(Announcement $announcement)
    {
        return view('admin.announcement_edit', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($announcement->image) {
                Storage::disk('public')->delete($announcement->image);
            }

            $announcement->image = $request->file('image')->store('announcement_images', 'public');
        }

        $announcement->title = $request->title;
        $announcement->message = $request->message;
        $announcement->save();

        return redirect()->route('admin.announcement')->with('success', 'Announcement updated.');
    }

    public function destroyAnnouncement(Announcement $announcement)
    {
        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();

        return redirect()->route('admin.announcement')->with('success', 'Announcement deleted.');
    }
}
