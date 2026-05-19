@extends('layouts.app')

@section('title', 'Document Request Details')

@section('content')
<a href="{{ route('admin.requests') }}" class="btn btn-secondary" style="margin-bottom: 16px; display: inline-block; min-width: 80px; text-align: center;">Back</a>
<div class="card">
    <h2>{{ $request->subject }}</h2>
    <p><strong>Request ID:</strong> {{ $request->ticket_id }}</p>
    <p><strong>User:</strong> {{ $request->user->name }}</p>
    <p><strong>Program:</strong> {{ $request->user->program ?? 'Not specified' }}</p>
    <p><strong>Status:</strong> <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $request->status)) }}">{{ $request->status }}</span></p>
    <p><strong>Priority:</strong> {{ $request->priority }}</p>
    <p><strong>Purpose:</strong> {{ $request->purpose }}</p>
    <p><strong>Delivery Method:</strong> {{ ucfirst($request->delivery_method) }}</p>

    @if($request->delivery_method === 'delivery')
        <div style="background:#F8FAFC; border-radius:8px; padding:16px; border:1px solid #E5E7EB; margin:16px 0;">
            <p style="margin:0 0 8px 0;"><strong>Delivery Address:</strong></p>
            @php
                $address = [];
                if ($request->street_details) $address[] = $request->street_details;
                if ($request->barangay) $address[] = $request->barangay;
                if ($request->city) $address[] = $request->city;
                if ($request->province) $address[] = $request->province;
                if ($request->region) $address[] = $request->region;
                if ($request->country) $address[] = $request->country;
                if ($request->postal_code) $address[] = $request->postal_code;
                $fullAddress = !empty($address) ? implode(', ', $address) : 'Not provided';
            @endphp
            <p style="margin:0; color:#475569;">{{ $fullAddress }}</p>
        </div>
    @endif

    <p><strong>Payment Proof:</strong> <a href="{{ asset('storage/' . $request->payment_proof) }}" target="_blank">View file</a></p>
    @if($request->scanned_copy)
        <p><strong>Scanned Copy:</strong> <a href="{{ asset('storage/' . $request->scanned_copy) }}" target="_blank">View scanned copy</a></p>
    @endif
    @if($request->rejection_reason)
        <p><strong>Rejection Reason:</strong> {{ $request->rejection_reason }}</p>
    @endif
    <p><strong>Created:</strong> {{ $request->created_at->format('M d, Y H:i') }}</p>

    @php
        $scannedCopyAllowed = in_array($request->status, ['Ready for Release', 'Completed']);
    @endphp

    <form method="POST" action="{{ route('admin.requests.updateStatus', $request->id) }}" enctype="multipart/form-data" style="margin-top: 20px; max-width: 360px;">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="status">Update Status</label>
            <select id="status" name="status" required>
                <option value="Pending" {{ $request->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Processing" {{ $request->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Ready for Release" {{ $request->status == 'Ready for Release' ? 'selected' : '' }}>Ready for Release</option>
                <option value="Completed" {{ $request->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="scanned_copy">Upload Scanned Copy</label>
            <input type="file" id="scanned_copy" name="scanned_copy" accept="image/*,.jpg,.jpeg,.png,.pdf" {{ !$scannedCopyAllowed ? 'disabled' : '' }}>
            <small>{{ $scannedCopyAllowed ? 'Optional scanned copy upload after request approval.' : 'Available only when status is Ready for Release or Completed.' }}</small>
        </div>
        <button type="submit" class="btn">Update Status</button>
    </form>
</div>
@endsection
