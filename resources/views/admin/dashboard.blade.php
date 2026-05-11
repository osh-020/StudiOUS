@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1 style="margin-bottom: 1rem;">Dashboard</h1>
<div class="card">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; margin-bottom:1rem;">
        <h2 style="margin:0;">All Tickets</h2>
        <a href="{{ route('admin.tickets') }}" class="btn">Manage Tickets</a>
    </div>
    <div style="display: flex; gap: 20px;">
        <div class="card" style="flex: 1;">
            <h3>Total Tickets</h3>
            <p style="font-size: 2em;">{{ $total }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Open</h3>
            <p style="font-size: 2em; color: #6B7280;">{{ $open }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>In Progress</h3>
            <p style="font-size: 2em; color: #0C29D6;">{{ $inProgress }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Resolved</h3>
            <p style="font-size: 2em; color: #10B981;">{{ $resolved }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Closed</h3>
            <p style="font-size: 2em; color: #8B5CF6;">{{ $closed }}</p>
        </div>
    </div>
    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:20px;">
    </div>
</div>

<div class="card" style="margin-top:24px;">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; margin-bottom:1rem;">
        <h2 style="margin:0;">All Requests</h2>
        <a href="{{ route('admin.requests') }}" class="btn">Manage Document Requests</a>
    </div>
    <div style="display: flex; gap: 20px;">
        <div class="card" style="flex: 1;">
            <h3>Total Requests</h3>
            <p style="font-size: 2em;">{{ $totalRequests }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Pending</h3>
            <p style="font-size: 2em; color: #F59E0B;">{{ $pendingRequests }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>In Progress</h3>
            <p style="font-size: 2em; color: #0C29D6;">{{ $processingRequests }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Open</h3>
            <p style="font-size: 2em; color: #6B7280;">{{ $openRequests }}</p>
        </div>
        <div class="card" style="flex: 1;">
            <h3>Resolved</h3>
            <p style="font-size: 2em; color: #10B981;">{{ $resolvedRequests }}</p>
        </div>
    </div>
</div>

<div class="card" style="margin-top:24px;">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; margin-bottom:1rem;">
        <h2 style="margin:0;">Quick Actions</h2>
        <p style="margin:0; color:#6B7280;">Jump directly to common admin tasks</p>
    </div>
    <div style="display:flex; gap:20px; flex-wrap:wrap;">
        <a href="{{ route('admin.faqs') }}" class="card" style="flex:1; min-width:220px; padding:1.5rem; text-decoration:none; color:inherit; border:1px solid #E5E7EB; box-shadow:0 1px 3px rgba(0,0,0,.08); border-radius:1rem; transition:transform .15s ease, box-shadow .15s ease;">
            <h3>Manage FAQs</h3>
            <p style="margin:0.75rem 0 0; color:#4B5563;">Create, edit, and organize frequently asked questions.</p>
            <span class="btn" style="margin-top:1rem; display:inline-block;">Go to FAQs</span>
        </a>
        <a href="{{ route('admin.users') }}" class="card" style="flex:1; min-width:220px; padding:1.5rem; text-decoration:none; color:inherit; border:1px solid #E5E7EB; box-shadow:0 1px 3px rgba(0,0,0,.08); border-radius:1rem; transition:transform .15s ease, box-shadow .15s ease;">
            <h3>Manage Users</h3>
            <p style="margin:0.75rem 0 0; color:#4B5563;">View and manage admin and user accounts.</p>
            <span class="btn" style="margin-top:1rem; display:inline-block;">Go to Users</span>
        </a>
        <a href="{{ route('admin.announcement') }}" class="card" style="flex:1; min-width:220px; padding:1.5rem; text-decoration:none; color:inherit; border:1px solid #E5E7EB; box-shadow:0 1px 3px rgba(0,0,0,.08); border-radius:1rem; transition:transform .15s ease, box-shadow .15s ease;">
            <h3>Manage Announcements</h3>
            <p style="margin:0.75rem 0 0; color:#4B5563;">Publish and update announcements for users.</p>
            <span class="btn" style="margin-top:1rem; display:inline-block;">Go to Announcements</span>
        </a>
    </div>
</div>
@endsection