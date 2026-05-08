@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="hero">
    <div>
        <span class="small-badge">Open University Systems</span>
        <h1>Student Services in One Place.</h1>
        <p>StudiOUS is your central portal for accessing front-line services and tracking your progress in real-time, all from one place.</p>
    </div>
</div>

<div class="card">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
    <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
</div>
@endsection