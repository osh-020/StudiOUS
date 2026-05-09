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
    @if($request->scanned_copy)
        <p><strong>Scanned Copy:</strong> <a href="{{ asset('storage/' . $request->scanned_copy) }}" target="_blank">View scanned copy</a></p>
    @endif
    @if($request->rejection_reason)
        <p><strong>Rejection Reason:</strong> {{ $request->rejection_reason }}</p>
    @endif
    <p><strong>Created:</strong> {{ $request->created_at->format('M d, Y H:i') }}</p>

    @php
        $statusLocked = in_array($request->status, ['Rejected', 'Cancelled']);
        $scannedCopyAllowed = in_array($request->status, ['Ready for Release', 'Completed']);
    @endphp

    <form method="POST" action="{{ route('admin.requests.updateStatus', $request->id) }}" enctype="multipart/form-data" style="margin-top: 20px; max-width: 360px;">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="status">Update Status</label>
            <select id="status" name="status" required {{ $statusLocked ? 'disabled' : '' }}>
                <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Processing" {{ $request->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Ready for Release" {{ $request->status == 'Ready for Release' ? 'selected' : '' }}>Ready for Release</option>
                <option value="Completed" {{ $request->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Rejected" {{ $request->status == 'Rejected' ? 'selected' : '' }} disabled>Rejected</option>
                <option value="Cancelled" {{ $request->status == 'Cancelled' ? 'selected' : '' }} disabled>Cancelled</option>
                <option value="Cancellation Requested" {{ $request->status == 'Cancellation Requested' ? 'selected' : '' }} disabled>Cancellation Requested</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="scanned_copy">Upload Scanned Copy</label>
            <input type="file" id="scanned_copy" name="scanned_copy" accept="image/*,.jpg,.jpeg,.png,.pdf" {{ $statusLocked || !$scannedCopyAllowed ? 'disabled' : '' }}>
            <small>{{ $scannedCopyAllowed ? 'Optional scanned copy upload after request approval.' : 'Available only when status is Ready for Release or Completed.' }}</small>
        </div>
        <button type="submit" class="btn" {{ $statusLocked ? 'disabled' : '' }}>Update Status</button>
        @if($statusLocked)
            <p style="margin-top: 12px; color:#6B7280; font-size:0.95rem;">Status is locked because this request is already {{ strtolower($request->status) }}.</p>
        @endif
    </form>
</div>
@endsection
