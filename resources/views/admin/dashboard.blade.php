@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="card">
    <h2>Dashboard</h2>
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
    </div>
    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:20px;">
        <a href="{{ route('admin.tickets') }}" class="btn">Manage Tickets</a>
        <a href="{{ route('admin.requests') }}" class="btn btn-secondary">Manage Document Requests</a>
    </div>
</div>
@endsection