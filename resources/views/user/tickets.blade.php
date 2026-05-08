@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
<div class="card">
    <h2>My Tickets</h2>
    <a href="{{ route('user.tickets.create') }}" class="btn">Create New Ticket</a>
    @foreach($tickets as $ticket)
        <div class="card">
            <h3>{{ $ticket->subject }}</h3>
            <p>Status: <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $ticket->status)) }}">{{ $ticket->status }}</span></p>
            <p>Created: {{ $ticket->created_at->format('M d, Y') }}</p>
            <a href="{{ route('user.tickets.show', $ticket->id) }}" class="btn btn-secondary">View Details</a>
        </div>
    @endforeach
</div>
@endsection