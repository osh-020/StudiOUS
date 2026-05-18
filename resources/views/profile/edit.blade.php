@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="card" style="width:auto;margin:0 auto;">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div style="background:#D1FAE5;color:#065F46;padding:10px;border-radius:8px;margin-bottom:12px;">{{ session('success') }}</div>
    @endif
    
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="card" style="display:flex;gap:20px;align-items:center;padding:20px;margin-bottom:20px;flex-wrap:wrap;">
            <div style="display:flex;flex-direction:column;align-items:center;gap:12px;">
                <div style="width:120px;height:120px;border-radius:9999px;overflow:hidden;background:#E5E7EB;display:flex;align-items:center;justify-content:center;">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <span style="font-size:2rem;color:#6B7280;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                </div>
                <label for="profile_photo" style="cursor:pointer;color:#0C29D6;font-weight:600;">Add / Change Profile Picture</label>
                <input type="file" name="profile_photo" id="profile_photo" accept="image/*" style="display:none;">
                @error('profile_photo') <div style="color:#dc2626;font-size:0.9rem;">{{ $message }}</div> @enderror
            </div>

            <div style="flex:1;min-width:220px;">
                <div style="font-size:1.25rem;font-weight:700;margin-bottom:6px;">{{ $user->name }}</div>
                <div style="color:#6B7280;">{{ $user->email }}</div>
            </div>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
            @error('name') <div style="color:#dc2626;">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
            @error('email') <div style="color:#dc2626;">{{ $message }}</div> @enderror
        </div>
</div>
        <!-- <div class="form-group">
            <label for="password">New Password <small style="color:#6B7280;">(leave blank to keep current)</small></label>
            <input type="password" name="password" id="password">
            @error('password') <div style="color:#dc2626;">{{ $message }}</div> @enderror
        </div> -->
<div class="card" style="width:auto;margin:15px 0 auto;">
    <!-- Document & Ticket Tracker Cards (moved from history) -->
        <div style="display: grid; gap: 20px; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); margin-top: 24px; margin-bottom: 24px;">
            <!-- Document Requests Card -->
            <div class="service-card">
                <span class="small-badge">Document Tracker</span>
                <h3 style="margin-top: 0;">My Requests</h3>
                <p>Review your most recent document requests and follow up on any updates.</p>
                <a href="{{ route('user.requests') }}" class="link-button outline-button">View requests</a>
            </div>

            <!-- Support Tickets Card -->
            <div class="service-card">
                <span class="small-badge">Ticket Tracker</span>
                <h3 style="margin-top: 0;">My Tickets</h3>
                <p>Review your most recent tickets and follow up on any updates from the support staff.</p>
                <a href="{{ route('user.tickets') }}" class="link-button outline-button">View tickets</a>
            </div>
</div>
</div>    

        <div class="card" style="background:#F8FAFC;margin-top:24px;">
            <h3 style="margin-top:0;">Address Information</h3>
        
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}">
                @error('country') <div style="color:#dc2626;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="region">Region</label>
                <input type="text" name="region" id="region" value="{{ old('region', $user->region) }}">
                @error('region') <div style="color:#dc2626;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="province">Province</label>
                <input type="text" name="province" id="province" value="{{ old('province', $user->province) }}">
                @error('province') <div style="color:#dc2626;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}">
                @error('city') <div style="color:#dc2626;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="barangay">Barangay</label>
                <input type="text" name="barangay" id="barangay" value="{{ old('barangay', $user->barangay) }}">
                @error('barangay') <div style="color:#dc2626;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
                @error('postal_code') <div style="color:#dc2626;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="street_details">Street / Building / House No.</label>
                <input type="text" name="street_details" id="street_details" value="{{ old('street_details', $user->address) }}" placeholder="House No., Building, Street Name">
                @error('street_details') <div style="color:#dc2626;">{{ $message }}</div> @enderror
            </div>
        

        <div style="margin-top:12px;display:flex;gap:12px;flex-wrap:wrap;">
            <button class="btn" type="submit">Save Changes</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
