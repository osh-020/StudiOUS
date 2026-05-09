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

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        <div style="padding: 24px; background:#ffffff; border-radius: 18px; border:1px solid #E5E7EB;">
            <h3 style="margin-top:0;">Request Form</h3>
            <form action="{{ route('user.services.store', ['type' => $service['type']]) }}" method="POST" enctype="multipart/form-data">
                @csrf
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
            </form>
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
</div>
@endsection