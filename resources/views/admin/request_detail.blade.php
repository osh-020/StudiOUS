@extends('layouts.app')

@section('title', 'Document Request Details')

@section('content')
<div class="card">
    <h2>{{ $request->subject }}</h2>
    <p><strong>Request ID:</strong> {{ $request->ticket_id }}</p>
    <p><strong>User:</strong> {{ $request->user->name }}</p>
    <p><strong>Status:</strong> <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $request->status)) }}">{{ $request->status }}</span></p>
    <p><strong>Priority:</strong> {{ $request->priority }}</p>
    <p><strong>Purpose:</strong> {{ $request->purpose }}</p>
    <p><strong>Delivery Method:</strong> {{ ucfirst($request->delivery_method) }}</p>
    <p><strong>Payment Proof:</strong> <a href="{{ asset('storage/' . $request->payment_proof) }}" target="_blank">View file</a></p>
    <p><strong>Created:</strong> {{ $request->created_at->format('M d, Y H:i') }}</p>

    <form method="POST" action="{{ route('admin.requests.updateStatus', $request->id) }}" style="margin-top: 20px; max-width: 320px;">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="status">Update Status</label>
            <select id="status" name="status" required>
                <option value="Open" {{ $request->status == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="In Progress" {{ $request->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Resolved" {{ $request->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>
        <button type="submit" class="btn">Update Status</button>
    </form>
</div>
@endsection
