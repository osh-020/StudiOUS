<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\DocumentRequest;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Ticket::where('category', '!=', 'Document Request')->count();
        $open = Ticket::where('category', '!=', 'Document Request')->where('status', 'Open')->count();
        $inProgress = Ticket::where('category', '!=', 'Document Request')->where('status', 'In Progress')->count();
        $resolved = Ticket::where('category', '!=', 'Document Request')->where('status', 'Resolved')->count();
        $closed = Ticket::where('category', '!=', 'Document Request')->where('status', 'Closed')->count();
        $faqCount = Faq::count();
        $userCount = User::count();

        return view('admin.dashboard', compact('total', 'open', 'inProgress', 'resolved', 'closed', 'faqCount', 'userCount'));
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
            'status' => 'required|in:Pending,Processing,Ready for Release,Completed,Rejected,Cancelled,Cancellation Requested',
            'scanned_copy' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $documentRequest = DocumentRequest::findOrFail($id);

        $data = ['status' => $request->status];

        if ($request->hasFile('scanned_copy')) {
            $data['scanned_copy'] = $request->file('scanned_copy')->store('scanned_copies', 'public');
        }

        $documentRequest->update($data);

        return redirect()->back()->with('success', 'Request updated successfully.');
    }

    public function rejectRequest(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $documentRequest = DocumentRequest::findOrFail($id);

        if (in_array($documentRequest->status, ['Rejected', 'Cancelled', 'Completed', 'Ready for Release'])) {
            return redirect()->back()->with('error', 'This request cannot be rejected at this stage.');
        }

        $documentRequest->update([
            'status' => 'Rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->back()->with('success', 'Request rejected successfully.');
    }

    public function acceptCancellation(Request $request, $id)
    {
        $documentRequest = DocumentRequest::findOrFail($id);

        if ($documentRequest->status !== 'Cancellation Requested') {
            return redirect()->back()->with('error', 'This request cannot be accepted for cancellation.');
        }

        $documentRequest->update([
            'status' => 'Cancelled',
        ]);

        return redirect()->back()->with('success', 'Cancellation accepted and request has been cancelled.');
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

        if ($ticket->status === 'Open') {
            $ticket->update(['status' => 'In Progress']);
        }

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
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
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

    public function faqs()
    {
        $faqs = Faq::latest()->get();

        return view('admin.faqs', compact('faqs'));
    }

    public function createFaq()
    {
        return view('admin.faq_edit');
    }

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($request->only(['question', 'answer']));

        return redirect()->route('admin.faqs')->with('success', 'FAQ created successfully.');
    }

    public function editFaq(Faq $faq)
    {
        return view('admin.faq_edit', compact('faq'));
    }

    public function updateFaq(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->only(['question', 'answer']));

        return redirect()->route('admin.faqs')->with('success', 'FAQ updated successfully.');
    }

    public function destroyFaq(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs')->with('success', 'FAQ deleted successfully.');
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($search = $request->query('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->get();

        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.user_edit');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser(User $user)
    {
        return view('admin.user_edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users')->with('success', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
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
