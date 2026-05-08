@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="card" style="padding: 32px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 12px; font-size:2rem;">About StudiOUS</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Learn more about the StudiOUS portal and how it helps you manage requests, helpdesk support, and campus service information.</p>
        </div>
    </div>
    <div style="padding: 24px; background:#ffffff; border-radius: 18px; border:1px solid #E5E7EB;">
        <p style="margin:0 0 12px; color:#475569; line-height:1.8;">StudiOUS is designed to help students submit support requests, track ticket progress, and stay informed with announcements in one centralized platform.</p>
        <p style="margin:0; color:#475569; line-height:1.8;">If you need help using the system, please visit the Helpdesk page or create a new ticket for support.</p>
    </div>
</div>
@endsection
