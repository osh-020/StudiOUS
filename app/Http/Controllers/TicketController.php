<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets()->latest()->get();
        return view('user.tickets', compact('tickets'));
    }

    public function create()
    {
        return view('user.create_ticket');
    }

    public function helpdesk()
    {
        $faqs = $this->faqs();
        $faqLinks = array_map(function ($faq) {
            return [
                'id' => $faq['id'],
                'question' => $faq['title'],
                'url' => route('user.helpdesk.faq', ['id' => $faq['id']]),
            ];
        }, $faqs);

        return view('user.helpdesk', compact('faqs', 'faqLinks'));
    }

    public function faqDetail($id)
    {
        $faq = collect($this->faqs())->firstWhere('id', (int) $id);

        abort_if(!$faq, 404);

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
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|in:Login Issue,Payment,Document,Others',
            'priority' => 'required|in:Low,Medium,High',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'category' => $request->category,
            'priority' => $request->priority,
            'description' => $request->description,
        ]);

        return redirect()->route('user.tickets')->with('success', 'Ticket created successfully.');
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
}
