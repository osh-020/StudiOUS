@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')
<div class="card">
    <p style="margin-bottom: 1rem;"><strong style="font-size: 1.1rem; color: #0066cc;">Ticket ID: {{ $ticket->ticket_id }}</strong></p>
    <h2>{{ $ticket->subject }}</h2>
    <p><strong>Category:</strong> {{ $ticket->category }}</p>
    <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
    <p><strong>Status:</strong> <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $ticket->status)) }}">{{ $ticket->status }}</span></p>
    <p><strong>Description:</strong> {{ $ticket->description }}</p>
    <p><strong>Created:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}</p>
</div>

<div class="card">
    <h3>Conversation</h3>
    @foreach($messages as $message)
        <div class="message {{ $message->sender->isAdmin() ? 'admin' : '' }}" style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px;">
            <div style="flex:1;">
                <strong>{{ $message->sender->name }}:</strong> {{ $message->message }}
            </div>
            <small style="white-space:nowrap; color:inherit; opacity:0.8;">{{ $message->created_at->format('M d, Y H:i') }}</small>
        </div>
    @endforeach

    <form method="POST" action="{{ route('user.tickets.reply', $ticket->id) }}">
        @csrf
        <div class="form-group">
            <label for="message">Reply</label>
            <textarea id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn">Send Reply</button>
    </form>
</div>
@endsection