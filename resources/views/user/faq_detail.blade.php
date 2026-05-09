@extends('layouts.app')

@section('title', $faq->question)

@section('content')
<div class="card" style="padding: 32px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 12px; font-size:2rem;">{{ $faq->question }}</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Read the answer to this FAQ below. If you still need help, you can open a ticket or view active tickets.</p>
        </div>
    </div>

    <div style="padding: 24px; background:#ffffff; border-radius: 18px; border:1px solid #E5E7EB;">
        <p style="margin:0; color:#475569; line-height:1.8;">{{ $faq->answer }}</p>
    </div>

    <div style="margin-top:24px;">
        <a href="{{ route('user.helpdesk') }}" class="link-button outline-button">Back to FAQ</a>
    </div>
</div>
@endsection
