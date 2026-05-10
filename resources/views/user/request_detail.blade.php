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
                    <form action="{{ route('user.requests.cancel', $request->id) }}" method="POST" onsubmit="return confirm('{{ $request->status === 'Pending' ? 'Cancel this request?' : 'Request cancellation?' }}');" style="display:inline;">
                        @csrf
                        <button type="submit" style="background-color: #EF4444; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; transition: background-color 0.3s;">{{ $request->status === 'Pending' ? 'Cancel Request' : 'Request Cancellation' }}</button>
                    </form>
                @endif
                <a href="{{ route('user.requests') }}" style="background-color: #6B7280; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; transition: background-color 0.3s;">Back to Requests</a>
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
                <p><a href="{{ asset('storage/' . $request->payment_proof) }}" target="_blank" style="background-color: #0C29D6; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; transition: background-color 0.3s;">View Payment Proof</a></p>
            </div>
        @endif

        @if($request->scanned_copy)
            <div>
                <p><strong>Scanned Copy:</strong></p>
                <p><a href="{{ asset('storage/' . $request->scanned_copy) }}" target="_blank" style="background-color: #10B981; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; transition: background-color 0.3s;">Download Document</a></p>
            </div>
        @elseif(in_array($request->status, ['Ready for Release', 'Completed']))
            <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; padding: 16px;">
                <p style="margin: 0; color: #166534;"><strong>Scanned Copy:</strong> Document will be available once the admin uploads the digital/scanned copy.</p>
            </div>
        @endif
    </div>
</div>
@endsection
