@extends('layouts.app')

@section('title', 'Manage Tickets')

@section('content')
<div class="card">
    <h2>Manage Tickets</h2>
    <form method="GET" action="{{ route('admin.tickets') }}" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 10px;">
            <select name="status">
                <option value="">All Status</option>
                <option value="Open">Open</option>
                <option value="In Progress">In Progress</option>
                <option value="Pending">Pending</option>
                <option value="Resolved">Resolved</option>
            </select>
            <select name="priority">
                <option value="">All Priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
            <button type="submit" class="btn">Filter</button>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
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
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->user->name }}</td>
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