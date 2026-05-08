@extends('layouts.app')

@section('title', 'Request a Service')

@section('content')
<div class="card" style="padding: 32px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 12px; font-size:2rem;">Request a Service</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Select the document or service you need. Each option includes processing fees and request instructions.</p>
        </div>
    </div>

    <div class="service-grid" style="grid-template-columns: repeat(3, minmax(0, 1fr));">
        @foreach($services as $service)
            <div class="service-card">
                <div class="small-badge">Document</div>
                <h3>{{ $service['name'] }}</h3>
                <p><strong>Fee:</strong> {{ $service['fee'] }}</p>
                <p>{{ $service['instructions'] }}</p>
                <a href="{{ route('user.services.create', ['type' => $service['type']]) }}" class="link-button">Request This</a>
            </div>
        @endforeach
    </div>
</div>
@endsection