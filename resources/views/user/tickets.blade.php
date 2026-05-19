@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-secondary" style="margin-bottom: 16px; display: inline-block; min-width: 80px; text-align: center;">Back</a>
<div class="card" style="padding:32px;">
    <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:20px; align-items:flex-end; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 12px; font-size:2rem;">My Tickets</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Search and manage your helpdesk tickets with a dedicated ticket list.</p>
        </div>
        <a href="{{ route('user.helpdesk') }}" class="btn">Create New Ticket</a>
    </div>

    <form method="GET" action="{{ route('user.tickets') }}" style="display:flex; flex-wrap:wrap; gap:16px; align-items:flex-end; margin-bottom:24px;">
        <div class="form-group" style="flex:1; min-width:220px;">
            <label for="search">Search tickets</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search by ticket ID or subject">
        </div>
        <div style="flex:0 0 auto;">
            <button type="submit" class="btn">Search</button>
        </div>
        <div style="flex:0 0 auto;">
            <a href="{{ route('user.tickets') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    @if($tickets->isEmpty())
        <div class="card" style="background:#F8FAFC; border:1px solid #E5E7EB;">
            <p style="margin:0; color:#475569;">No tickets match your search. Try a different keyword.</p>
        </div>
    @else
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Subject</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_id }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->category }}</td>
                            <td><span class="status-badge status-{{ strtolower(str_replace(' ', '-', $ticket->status)) }}">{{ $ticket->status }}</span></td>
                            <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                            <td><a href="{{ route('user.tickets.show', $ticket->id) }}" class="btn btn-secondary">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection