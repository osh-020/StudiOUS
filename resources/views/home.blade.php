@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero">
    <div>
        <span class="small-badge">Open University Systems Services</span>
        <h1>Manage support, documents, and announcements in one place.</h1>
        <p>StudiOUS is your central portal for helpdesk tickets, document requests, and the latest campus announcements. Start your request or sign in to track progress immediately.</p>
        <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:24px;">
            <a href="{{ route('login') }}" class="link-button">Login</a>
            <a href="{{ route('register') }}" class="link-button outline-button">Register</a>
        </div>
    </div>
</div>

<div style="margin-top: 30px;">
    <div class="panel-card" style="padding: 28px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px;">
            <div>
                <h3>Why StudiOUS?</h3>
                <p>All your campus service needs are organized under one dashboard, so you can scale from helpdesk support to document requests and announcements without switching systems.</p>
            </div>
            <a href="{{ route('login') }}" class="link-button">Get started</a>
        </div>
    </div>
</div>
@endsection
