@extends('layouts.app')

@section('title', 'Manage Tickets')

@section('content')
<div class="card">
    <h2>Manage Tickets</h2>
    <form method="GET" action="{{ route('admin.tickets') }}" id="admin-ticket-search-form" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end;">
            <div class="form-group" style="min-width:180px;">
                <label for="status">Status</label>
                <select id="status" name="status" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Resolved" {{ request('status') === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="form-group" style="min-width:180px;">
                <label for="priority">Priority</label>
                <select id="priority" name="priority" onchange="this.form.submit()">
                    <option value="">All Priority</option>
                    <option value="Low" {{ request('priority') === 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ request('priority') === 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ request('priority') === 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            <div class="form-group" style="min-width:180px;">
                <label for="sort">Sort</label>
                <select id="sort" name="sort" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </div>
            <a href="{{ route('admin.tickets') }}" class="btn" style="background-color: #6B7280;">Reset</a>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Subject</th>
                <th>User</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->user?->name ?? $ticket->email ?? 'Guest' }}</td>
                    <td><span class="status-badge status-{{ strtolower(str_replace(' ', '-', $ticket->status)) }}">{{ $ticket->status }}</span></td>
                    <td>{{ $ticket->priority }}</td>
                    <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                    <td><a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-secondary">View</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection