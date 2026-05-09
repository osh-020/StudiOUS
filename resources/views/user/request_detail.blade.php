@extends('layouts.app')

@section('title', 'Request Details')

@section('content')
<div style="display:flex; justify-content:center; padding: 32px 16px;">
    <div class="card" style="padding: 32px; width:100%; max-width: 720px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-bottom:24px;">
            <div>
                <h1 style="margin:0 0 8px; font-size:2rem;">{{ $request->subject }}</h1>
                <p style="margin:0; color:#4B5563;">Request ID: {{ $request->ticket_id }}</p>
            </div>
            <div style="display:flex; gap:12px;">
                @if(in_array($request->status, ['Pending', 'Processing']))
                    <form action="{{ route('user.requests.cancel', $request->id) }}" method="POST" onsubmit="return confirm('{{ $request->status === 'Pending' ? 'Cancel this request?' : 'Request cancellation?' }}');">
                        @csrf
                        <button type="submit" class="btn btn-secondary">{{ $request->status === 'Pending' ? 'Cancel Request' : 'Request Cancellation' }}</button>
                    </form>
                @endif
                <a href="{{ route('user.requests') }}" class="btn btn-secondary">Back to Requests</a>
            </div>
        </div>

    <div style="display:grid; gap:18px;">
        <div>
            <p><strong>Status:</strong> <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $request->status)) }}">{{ $request->status }}</span></p>
            <p><strong>Purpose:</strong> {{ $request->purpose }}</p>
            <p><strong>Additional Notes:</strong> {{ $request->additional_notes ?? 'None' }}</p>
            <p><strong>Delivery Method:</strong> {{ ucfirst($request->delivery_method) }}</p>
            <p><strong>Submitted:</strong> {{ $request->created_at->format('M d, Y H:i') }}</p>
        </div>

        @if($request->payment_proof)
            <div>
                <p><strong>Payment Proof:</strong></p>
                <p><a href="{{ asset('storage/' . $request->payment_proof) }}" target="_blank" class="btn btn-secondary">View file</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
