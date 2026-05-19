@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="card">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="program">Program</label>
            <select id="program" name="program" required>
                <option value="">Select your program</option>
                <option value="DOCTOR OF EDUCATION major in EDUCATIONAL MANAGEMENT">DOCTOR OF EDUCATION major in EDUCATIONAL MANAGEMENT</option>
                <option value="MASTER OF ARTS IN EDUCATION major in EDUCATION MANAGEMENT">MASTER OF ARTS IN EDUCATION major in EDUCATION MANAGEMENT</option>
                <option value="MASTER OF ARTS IN EDUCATION major in INSTRUCTIONAL LEADERSHIP">MASTER OF ARTS IN EDUCATION major in INSTRUCTIONAL LEADERSHIP</option>
                <option value="MASTER IN DEVELOPMENT MANAGEMENT major in PUBLIC MANAGEMENT">MASTER IN DEVELOPMENT MANAGEMENT major in PUBLIC MANAGEMENT</option>
                <option value="MASTER of SCIENCE IN FISHERIES">MASTER of SCIENCE IN FISHERIES</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection