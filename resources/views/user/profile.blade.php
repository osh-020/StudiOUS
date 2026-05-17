@extends('layouts.app')

@section('title', 'Profile')

@section('content')
@php
    $user = auth()->user();
    $deliveryAddress = trim(implode(', ', array_filter([
        $user->street_address,
        $user->barangay,
        $user->city,
        $user->province,
        $user->region,
        $user->postal_code,
    ])));
@endphp

<div style="max-width:1200px; margin:0 auto; padding:24px 16px; display:grid; gap:24px;">
    @if(session('success'))
        <div style="background:#ECFDF5; border-left:4px solid #10B981; padding:18px 24px; border-radius:18px; color:#065F46;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#FEF2F2; border-left:4px solid #DC2626; padding:18px 24px; border-radius:18px; color:#991B1B;">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="display:grid; gap:24px;">
        <div style="background:#FFFFFF; border-radius:24px; box-shadow:0 20px 40px rgba(15, 23, 42, 0.08); padding:28px;">
            <div style="display:flex; flex-wrap:wrap; justify-content:space-between; gap:24px; align-items:flex-start;">
                <div style="display:flex; gap:20px; flex:1; min-width:0;">
                    <div style="width:80px; height:80px; border-radius:999px; background:#EEF2FF; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:30px; color:#0C29D6;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div style="min-width:0;">
                        <span style="display:inline-block; margin-bottom:10px; font-size:0.82rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#0C29D6;">User Profile</span>
                        <h1 style="margin:0 0 6px; font-size:2.1rem; color:#111827; line-height:1.1;">{{ $user->name }}</h1>
                        <p style="margin:0; color:#6B7280; font-size:1rem;">{{ $user->role === 'admin' ? 'Administrator' : 'Student' }}</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center;">
                    <button type="button" onclick="toggleProfileForm()" style="background:#0C29D6; color:white; border:none; border-radius:12px; padding:14px 22px; cursor:pointer; font-weight:700;">Edit Information</button>
                </div>
            </div>

            <div style="display:grid; gap:24px; margin-top:32px;">
                <div style="display:grid; gap:16px; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));">
                    <div>
                        <p style="margin:0 0 8px; color:#111827; font-weight:700;">Contact Information</p>
                        <p style="margin:0; color:#475569; line-height:1.8;">{{ $user->email }}</p>
                        <p style="margin:8px 0 0; color:#475569; line-height:1.8;">{{ $user->phone ?? 'No phone number provided' }}</p>
                    </div>
                    <div>
                        <p style="margin:0 0 8px; color:#111827; font-weight:700;">Delivery Address</p>
                        <p style="margin:0; color:#475569; line-height:1.8;">{{ $deliveryAddress ?: 'No address added yet.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:grid; gap:20px; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));">
            <div style="background:#FFFFFF; border-radius:24px; box-shadow:0 20px 40px rgba(15, 23, 42, 0.08); padding:24px;">
                <span style="display:inline-flex; align-items:center; border-radius:999px; background:#FEE7A2; color:#B45309; font-weight:700; padding:8px 14px; font-size:0.78rem; letter-spacing:0.08em; text-transform:uppercase;">Document Tracker</span>
                <h3 style="margin:18px 0 10px; color:#111827;">My Requests</h3>
                <p style="margin:0 0 18px; color:#475569; line-height:1.7;">Review your most recent document requests and follow up on any updates.</p>
                <a href="{{ route('user.requests') }}" class="link-button outline-button" style="display:inline-flex;">View requests</a>
            </div>
            <div style="background:#FFFFFF; border-radius:24px; box-shadow:0 20px 40px rgba(15, 23, 42, 0.08); padding:24px;">
                <span style="display:inline-flex; align-items:center; border-radius:999px; background:#FEE7A2; color:#B45309; font-weight:700; padding:8px 14px; font-size:0.78rem; letter-spacing:0.08em; text-transform:uppercase;">Ticket Tracker</span>
                <h3 style="margin:18px 0 10px; color:#111827;">My Tickets</h3>
                <p style="margin:0 0 18px; color:#475569; line-height:1.7;">Review your most recent tickets and follow up on any updates from the support staff.</p>
                <a href="{{ route('user.tickets') }}" class="link-button outline-button" style="display:inline-flex;">View tickets</a>
            </div>
        </div>

        <div id="editProfileFormOverlay" onclick="closeProfileDialog(event)" style="display:none; position:fixed; inset:0; z-index:50; background:rgba(15, 23, 42, 0.65); display:none; align-items:center; justify-content:center; padding:24px;">
            <div onclick="event.stopPropagation()" style="width:100%; max-width:920px; background:#FFFFFF; border-radius:28px; box-shadow:0 28px 80px rgba(15, 23, 42, 0.16); padding:28px;">
                <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; flex-wrap:wrap; margin-bottom:24px;">
                    <div>
                        <h2 style="margin:0; font-size:1.5rem; color:#111827;">Edit Information</h2>
                        <p style="margin:8px 0 0; color:#6B7280;">Update your personal details and delivery address.</p>
                    </div>
                    <button type="button" onclick="toggleProfileForm()" style="background:#F3F4F6; color:#111827; border:none; border-radius:12px; padding:12px 18px; cursor:pointer;">Close</button>
                </div>

                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div style="display:grid; gap:18px;">
                        <div style="display:grid; gap:18px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));">
                            <label style="display:block; font-weight:600; color:#111827;">
                                Full Name
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name" style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                            </label>
                            <label style="display:block; font-weight:600; color:#111827;">
                                Phone Number
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number" style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                            </label>
                        </div>

                        <label style="display:block; font-weight:600; color:#111827;">
                            Street Address
                            <input type="text" name="street_address" value="{{ old('street_address', $user->street_address) }}" placeholder="Street name, building, house no." style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                        </label>

                        <label style="display:block; font-weight:600; color:#111827;">
                            Barangay
                            <input type="text" name="barangay" value="{{ old('barangay', $user->barangay) }}" placeholder="Barangay" style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                        </label>

                        <div style="display:grid; gap:18px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
                            <label style="display:block; font-weight:600; color:#111827;">
                                City
                                <input type="text" name="city" value="{{ old('city', $user->city) }}" placeholder="City" style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                            </label>
                            <label style="display:block; font-weight:600; color:#111827;">
                                Province
                                <input type="text" name="province" value="{{ old('province', $user->province) }}" placeholder="Province" style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                            </label>
                            <label style="display:block; font-weight:600; color:#111827;">
                                Region
                                <input type="text" name="region" value="{{ old('region', $user->region) }}" placeholder="Region" style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                            </label>
                            <label style="display:block; font-weight:600; color:#111827;">
                                Postal Code
                                <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" placeholder="Postal code" style="width:100%; margin-top:8px; padding:14px 16px; border-radius:12px; border:1px solid #D1D5DB;" />
                            </label>
                        </div>

                        <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:8px;">
                            <button type="submit" class="link-button">Save</button>
                            <button type="button" onclick="toggleProfileForm()" class="outline-button">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function toggleProfileForm() {
        const overlay = document.getElementById('editProfileFormOverlay');
        if (!overlay) return;
        overlay.style.display = overlay.style.display === 'flex' ? 'none' : 'flex';
    }

    function closeProfileDialog(event) {
        if (event.target.id === 'editProfileFormOverlay') {
            toggleProfileForm();
        }
    }
</script>
@endsection
