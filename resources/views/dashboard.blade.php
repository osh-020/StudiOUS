@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero" style="background: linear-gradient(135deg, #0C29D6 0%, #1E50FF 55%, #2F74FF 100%);">
    <div>
        <span class="small-badge">Welcome back</span>
        <h1>Hi {{ auth()->user()->name }}, your campus services are ready.</h1>
        <p>Use this page to access helpdesk support, submit document requests, and stay updated with announcements.</p>
    </div>
</div>

<div class="action-grid">
    <div class="service-card">
        <span class="small-badge">Service</span>
        <h3>Document Request</h3>
        <p>Open a new request for academic documents and track its progress from one centralized place.</p>
        <a href="{{ route('user.services') }}" class="link-button outline-button">Start request</a>
    </div>
    <div class="service-card">
        <span class="small-badge">Support</span>
        <h3>Helpdesk</h3>
        <p>Need help with account access, enrollment, or other issues? Browse the FAQ and decide whether to create a ticket or view active requests.</p>
        <a href="{{ route('user.helpdesk') }}" class="link-button outline-button">Open Helpdesk</a>
    </div>
    <div class="service-card">
        <span class="small-badge">Document Tracker</span>
        <h3>My Requests</h3>
        <p>Review your most recent document requests and follow up on any updates.</p>
        <a href="{{ route('user.requests') }}" class="link-button outline-button">View requests</a>
    </div>
    <div class="service-card">
        <span class="small-badge">Ticket Tracker</span>
        <h3>My Tickets</h3>
        <p>Review your most recent tickets and follow up on any updates from the support staff.</p>
        <a href="{{ route('user.tickets') }}" class="link-button outline-button">View tickets</a>
    </div>
</div>

<div id="announcements" class="panel-card" style="margin-top:24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div>
            <h3>Announcements</h3>
            <p>Check the latest campus news and updates from the admin team.</p>
        </div>
                <a href="{{ route('announcement') }}" class="link-button">View announcements</a>
    </div>

    @if($announcements->isEmpty())
        <div class="service-grid" style="margin-top:18px;">
            <div style="border-left: 4px solid #0C29D6; padding-left: 18px;">
                <p style="margin:0; color:#475569;">No announcements have been posted yet.</p>
            </div>
        </div>
    @else
        <div class="service-grid" style="margin-top:18px;">
            @foreach($announcements as $announcement)
                <div style="border-left: 4px solid #0C29D6; padding-left: 18px;">
                    <p style="margin:0; color: #0C29D6; font-weight: 600;">{{ $announcement->created_at->format('F d, Y') }} • {{ $announcement->user?->name ? $announcement->user->name : 'Admin' }}</p>
                    <h3 style="margin: 8px 0 4px;">{{ $announcement->title }}</h3>
                    @if($announcement->image)
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement image" style="width:100%; max-width:100%; border-radius:16px; margin:12px 0; object-fit:cover; display:block;">
                    @endif
                    <p style="margin:0; color:#475569; white-space:pre-line;">{{ $announcement->message }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
