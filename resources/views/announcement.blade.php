@extends('layouts.app')

@section('title', 'Announcements')

@section('content')
<div class="card" style="padding: 32px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 12px; font-size:2rem;">Announcements</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Stay updated with the latest news and service announcements from StudiOUS.</p>
        </div>
    </div>
    <div style="padding: 24px; background:#ffffff; border-radius: 18px; border:1px solid #E5E7EB;">
        <p style="margin:0; color:#475569; line-height:1.8;">There are no new announcements right now. Check back later for updates, policies, and service alerts.</p>
    </div>
</div>
@endsection
