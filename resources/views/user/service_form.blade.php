@extends('layouts.app')

@section('title', 'Request ' . $service['name'])

@section('content')
<div class="card" style="padding: 32px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 12px; font-size:2rem;">{{ $service['name'] }}</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Fill out the form and upload your payment proof to request this document.</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 24px;">
        <div style="padding: 24px; background:#F8FAFC; border-radius: 18px; border:1px solid #E5E7EB;">
            @if(!empty($service['who_may_avail']))
                <p><strong>Who may avail:</strong> {{ $service['who_may_avail'] }}</p>
            @endif
            <p><strong>Requirements:</strong> {{ $service['requirements'] }}</p>
            <p><strong>Processing Period:</strong> {{ $service['processing_period'] }}</p>
            @if(!empty($service['note']))
                <p><strong>Note:</strong> {{ $service['note'] }}</p>
            @endif
        </div>
    </div>

    <form action="{{ route('user.services.store', ['type' => $service['type']]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="padding: 24px; background:#FFFFFF; border-radius: 18px; border:1px solid #E5E7EB; margin-bottom: 24px;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; flex-wrap:wrap;">
                <div>
                    <h3 style="margin-top:0;">Delivery Address</h3>
                    <!-- <p style="margin-top:0; color:#4B5563;">This is the delivery address saved in your profile. Edit it from your profile page.</p> -->
                </div>
                <a href="{{ route('user.profile.edit') }}" class="btn btn-secondary" style="margin-top:4px;">Edit Address</a>
            </div>

            <div style="margin-top:18px; display:grid; gap:12px;">
                <div style="color:#111827;">{{ old('street_details', $user->address ?? auth()->user()->address) ?: 'Not provided' }}</div>
                <!-- <div style="color:#111827;"><strong>Barangay:</strong> {{ old('barangay', $user->barangay ?? auth()->user()->barangay) ?: 'Not provided' }}</div>
                <div style="color:#111827;"><strong>City:</strong> {{ old('city', $user->city ?? auth()->user()->city) ?: 'Not provided' }}</div>
                <div style="color:#111827;"><strong>Province:</strong> {{ old('province', $user->province ?? auth()->user()->province) ?: 'Not provided' }}</div>
                <div style="color:#111827;"><strong>Region:</strong> {{ old('region', $user->region ?? auth()->user()->region) ?: 'Not provided' }}</div>
                <div style="color:#111827;"><strong>Country:</strong> {{ old('country', $user->country ?? auth()->user()->country) ?: 'Not provided' }}</div>
                <div style="color:#111827;"><strong>Postal Code:</strong> {{ old('postal_code', $user->postal_code ?? auth()->user()->postal_code) ?: 'Not provided' }}</div> -->
            </div>

            <input type="hidden" name="country" value="{{ old('country', $user->country ?? auth()->user()->country) }}">
            <input type="hidden" name="region" value="{{ old('region', $user->region ?? auth()->user()->region) }}">
            <input type="hidden" name="province" value="{{ old('province', $user->province ?? auth()->user()->province) }}">
            <input type="hidden" name="city" value="{{ old('city', $user->city ?? auth()->user()->city) }}">
            <input type="hidden" name="barangay" value="{{ old('barangay', $user->barangay ?? auth()->user()->barangay) }}">
            <input type="hidden" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? auth()->user()->postal_code) }}">
            <input type="hidden" name="street_details" value="{{ old('street_details', $user->address ?? auth()->user()->address) }}">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        <div style="padding: 24px; background:#ffffff; border-radius: 18px; border:1px solid #E5E7EB;">
            <h3 style="margin-top:0;">Request Form</h3>
                <div class="form-group">
                    <label for="purpose">Purpose of Request</label>
                    <input type="text" id="purpose" name="purpose" required style="margin-bottom: 1.5rem;">
                </div>
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="delivery_method">Delivery Method</label>
                    <select id="delivery_method" name="delivery_method" required>
                        <option value="delivery" selected>Delivery to Address</option>
                        <option value="pickup">Pickup</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="payment_proof">Upload Proof of Payment</label>
                    <input type="file" id="payment_proof" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required>
                    <small>Allowed formats: JPG, PNG, PDF. Max size: 2MB</small>
                </div>
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="additional_notes">Additional Notes</label>
                    <textarea id="additional_notes" name="additional_notes" rows="4" placeholder="Optional notes or special instructions"></textarea>
                </div>
                <button type="submit" class="btn">Submit Request</button>
        </div>

        <div style="padding: 24px; background:#F8FAFC; border-radius: 18px; border:1px solid #E5E7EB;">
            <h3 style="margin-top:0;">Payment Instructions</h3>
            <p><strong>Amount: {{ $service['fee'] }} </strong></p>
            <p><strong>Service:</strong> {{ $service['name'] }}</p>
            <ol>
                <li>Click the link to go to the LandBank Link.Biz Portal.</li>
                <li>Select PSU - Lingayen as the Merchant.</li>
                <li>Pay the exact amount: <strong>{{ $service['fee'] }}</strong></li>
                <li>Save a screenshot or download the official receipt.</li>
                <li>Upload the proof of payment and submit your request.</li>
            </ol>
            <p><strong>Official Payment Link:</strong> <a href="https://www.lbp-eservices.com/egps/portal/Merchants.jsp" target="_blank">Click Here to Pay</a></p>
            <p><em>Note: Keep your reference number safe for tracking.</em></p>
        </div>
    </div>
    </form>
</div>
@endsection