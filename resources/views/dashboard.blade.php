@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero" style="background: linear-gradient(135deg, #0C29D6 0%, #1E50FF 55%, #2F74FF 100%);">
    <div>
        @if(auth()->check())
            <span class="small-badge">Welcome back</span>
            <h1>Hi {{ auth()->user()->name }}, your campus services are ready.</h1>
            <p>Use this page to access helpdesk support, submit document requests, and stay updated with announcements.</p>
        @else
            <span class="small-badge">Open University Systems</span>
            <h1>Student Services in One Place.</h1>
            <p>StudiOUS is your central portal for accessing front-line services and tracking your progress in real-time, all from one place.</p>
        @endif
    </div>
</div>

<div class="action-grid">
    <div class="service-card">
        <span class="small-badge">Service</span>
        <h3>Document Request</h3>
        <p>Open a new request for academic documents and track its progress from one centralized place.</p>
        @if(auth()->check())
            <a href="{{ route('user.services') }}" class="link-button outline-button">Start request</a>
        @else
            <a href="#" onclick="showLoginModal()" class="link-button outline-button">Start request</a>
        @endif
    </div>
    <div class="service-card">
        <span class="small-badge">Support</span>
        <h3>Helpdesk</h3>
        <p>Need help with account access, enrollment, or other issues? Browse the FAQ and decide whether to create a ticket or view active requests.</p>
        <a href="{{ route('user.helpdesk') }}" class="link-button outline-button">Open Helpdesk</a>
    </div>
    @if(auth()->check())
    <!-- History navigation moved to the profile page -->
    @endif
</div>

<div id="announcements" class="panel-card" style="margin-top:24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div>
            <h3>Announcements</h3>
            <p>Check the latest campus news and updates from the admin team.</p>
        </div>
                <a href="{{ route('announcement') }}" class="link-button">View announcements</a>
    </div>

    @if($announcements->isEmpty())
        <div class="service-grid" style="margin-top:18px;">
            <div style="border-left: 4px solid #0C29D6; padding-left: 18px;">
                <p style="margin:0; color:#475569;">No announcements have been posted yet.</p>
            </div>
        </div>
    @else
        <div class="service-grid" style="margin-top:18px;">
            @foreach($announcements as $announcement)
                <div style="border-left: 4px solid #0C29D6; padding-left: 18px;">
                    <p style="margin:0; color: #0C29D6; font-weight: 600;">{{ $announcement->created_at->format('F d, Y') }} • {{ $announcement->user?->name ? $announcement->user->name : 'Admin' }}</p>
                    <h3 style="margin: 8px 0 4px;">{{ $announcement->title }}</h3>
                    @if($announcement->image)
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement image" style="width:100%; max-width:100%; border-radius:16px; margin:12px 0; object-fit:cover; display:block;">
                    @endif
                    <p style="margin:0; color:#475569; white-space:pre-line;">{{ $announcement->message }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Login Modal -->
<div id="loginModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); max-width: 400px; width: 90%;">
        <h3 style="margin-top: 0; color: #333;">Login Required</h3>
        <p style="color: #666; margin-bottom: 20px;">You need to be logged in to submit a document request. Please log in to continue.</p>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
            <button onclick="closeLoginModal()" style="background: #6B7280; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">Back</button>
            <a href="{{ route('login') }}" style="background: #0C29D6; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; display: inline-block;">Login</a>
        </div>
    </div>
</div>

<script>
function showLoginModal() {
    document.getElementById('loginModal').style.display = 'block';
}

function closeLoginModal() {
    document.getElementById('loginModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    var modal = document.getElementById('loginModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

@endsection
