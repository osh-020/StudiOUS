@extends('layouts.app')

@section('title', 'My History')

@section('content')
<div class="card" style="padding: 32px;">
    <h1 style="margin:0 0 12px; font-size:2rem;">My History</h1>
    <p style="margin:0 0 24px; color:#4B5563; font-size:1rem; line-height:1.7;">Review your most recent document requests and support tickets in one place.</p>

    <div style="display: grid; gap: 20px; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
        <!-- Document Requests Card -->
        <div class="service-card">
            <span class="small-badge">Document Tracker</span>
            <h3 style="margin-top: 0;">My Requests</h3>
            <p>Review your most recent document requests and follow up on any updates.</p>
            <a href="{{ route('user.requests') }}" class="link-button outline-button">View requests</a>
        </div>

        <!-- Support Tickets Card -->
        <div class="service-card">
            <span class="small-badge">Ticket Tracker</span>
            <h3 style="margin-top: 0;">My Tickets</h3>
            <p>Review your most recent tickets and follow up on any updates from the support staff.</p>
            <a href="{{ route('user.tickets') }}" class="link-button outline-button">View tickets</a>
        </div>
    </div>
</div>
@endsection
