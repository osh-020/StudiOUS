@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')
<div class="card">
    <h2>{{ $ticket->subject }}</h2>
    <p><strong>User:</strong> {{ $ticket->user->name }}</p>
    <p><strong>Category:</strong> {{ $ticket->category }}</p>
    <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
    <p><strong>Status:</strong> <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $ticket->status)) }}">{{ $ticket->status }}</span></p>
    <p><strong>Description:</strong> {{ $ticket->description }}</p>
    <p><strong>Created:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}</p>

    <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket->id) }}" style="margin-top: 20px;">
        @csrf
        <div class="form-group">
            <label for="status">Update Status</label>
            <select id="status" name="status" required>
                <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Pending" {{ $ticket->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>
        <button type="submit" class="btn">Update Status</button>
    </form>
</div>

<div class="card">
    <h3>Conversation</h3>
    @foreach($ticket->messages as $message)
        <div class="message {{ $message->sender->isAdmin() ? 'admin' : '' }}">
            <strong>{{ $message->sender->name }}:</strong> {{ $message->message }}
            <small>{{ $message->created_at->format('M d, Y H:i') }}</small>
        </div>
    @endforeach

    <form method="POST" action="{{ route('admin.tickets.reply', $ticket->id) }}">
        @csrf
        <div class="form-group">
            <label for="message">Reply</label>
            <textarea id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn">Send Reply</button>
    </form>
</div>
@endsection