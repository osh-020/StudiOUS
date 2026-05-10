<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->tickets()
            ->where('category', '!=', 'Document Request');

        if ($search = $request->query('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('subject', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT('TKT-', LPAD(id, 5, '0')) like ?", ["%{$search}%"]);
            });
        }

        $tickets = $query->latest()->get();

        return view('user.tickets', compact('tickets'));
    }

    public function requests(Request $request)
    {
        $query = Auth::user()->documentRequests();

        if ($search = $request->query('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('subject', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('delivery_method', 'like', "%{$search}%")
                    ->orWhere('id', $search)
                    ->orWhereRaw("CONCAT('REQ-', LPAD(id, 5, '0')) like ?", ["%{$search}%"]);
            });
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        if ($sort = $request->query('sort')) {
            $query->when($sort === 'oldest', fn ($query) => $query->oldest(), fn ($query) => $query->latest());
        } else {
            $query->latest();
        }

        $requests = $query->get();
        $statusOptions = ['All', 'Pending', 'Processing', 'Ready for Release', 'Completed', 'Rejected', 'Cancelled', 'Cancellation Requested'];

        return view('user.requests', compact('requests', 'statusOptions'));
    }

    public function showRequest($id)
    {
        $request = Auth::user()->documentRequests()->findOrFail($id);

        return view('user.request_detail', compact('request'));
    }

    public function cancelRequest(Request $request, $id)
    {
        $documentRequest = Auth::user()->documentRequests()->findOrFail($id);

        if ($documentRequest->status === 'Pending') {
            $documentRequest->update(['status' => 'Cancelled']);
            return redirect()->back()->with('success', 'Request has been cancelled.');
        } elseif ($documentRequest->status === 'Processing') {
            $documentRequest->update(['status' => 'Cancellation Requested']);
            return redirect()->back()->with('success', 'Cancellation request submitted. Admin will review it.');
        }

        return redirect()->back()->with('error', 'Cannot cancel this request at this stage.');
    }

    public function helpdesk()
    {
        $faqs = Faq::latest()->get();
        $faqLinks = $faqs->map(function ($faq) {
            return [
                'id' => $faq->id,
                'question' => $faq->question,
                'url' => route('user.helpdesk.faq', ['id' => $faq->id]),
            ];
        })->toArray();

        return view('user.helpdesk', compact('faqs', 'faqLinks'));
    }

    public function faqDetail($id)
    {
        $faq = Faq::findOrFail($id);

        return view('user.faq_detail', compact('faq'));
    }

    protected function faqs(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'What is StudiOUS?',
                'answer' => 'StudiOUS is a Digital Student Service Management System designed for PSU-OUS to help students access administrative and support services online through a centralized platform.',
            ],
            [
                'id' => 2,
                'title' => 'What services can I request through the system?',
                'answer' => 'Students can submit requests for academic documents, certifications, and other student-related services provided by PSU-OUS.',
            ],
            [
                'id' => 3,
                'title' => 'How do I submit a service request?',
                'answer' => 'Log in to your account, go to the Service Requests section, select the type of request, upload the required documents, and submit the request.',
            ],
            [
                'id' => 4,
                'title' => 'How can I track my request?',
                'answer' => 'You can monitor the status of your request through the dashboard under My Requests. Possible statuses include Pending, Under Review, Processing, Ready for Release, Completed, and Rejected.',
            ],
            [
                'id' => 5,
                'title' => 'How will I know if there are updates to my request?',
                'answer' => 'The system will send notifications whenever your request status changes or when additional information is needed.',
            ],
        ];
    }

    public function store(Request $request)
    {
        $rules = [
            'subject' => 'required|string|max:255',
            'category' => 'required|in:Login Issue,Payment,Document,Others',
            'priority' => 'required|in:Low,Medium,High',
            'description' => 'required|string',
        ];

        if (! Auth::check()) {
            $rules['email'] = 'required|email';
        }

        $request->validate($rules);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'email' => Auth::check() ? null : $request->email,
            'subject' => $request->subject,
            'category' => $request->category,
            'priority' => $request->priority,
            'description' => $request->description,
        ]);

        return redirect()->route('user.helpdesk')->with('success', 'Ticket created successfully. Your Ticket ID: ' . $ticket->ticket_id);
    }

    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $messages = $ticket->messages()->with('sender')->orderBy('created_at')->get();
        return view('user.ticket_detail', compact('ticket', 'messages'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Reply sent.');
    }

    public function history()
    {
        $requests = Auth::user()->documentRequests()->latest()->get();
        $tickets = Auth::user()->tickets()->where('category', '!=', 'Document Request')->latest()->get();

        return view('user.history', compact('requests', 'tickets'));
    }
}
