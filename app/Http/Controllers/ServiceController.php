<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = $this->services();
        return view('user.services', compact('services'));
    }

    public function create($type)
    {
        $service = collect($this->services())->firstWhere('type', $type);
        abort_if(!$service, 404);

        $user = Auth::user();

        return view('user.service_form', compact('service', 'user'));
    }

    public function store(Request $request, $type)
    {
        $service = collect($this->services())->firstWhere('type', $type);
        abort_if(!$service, 404);

        $request->validate([
            'purpose' => 'required|string|max:255',
            'additional_notes' => 'nullable|string|max:1000',
            'delivery_method' => 'required|in:pickup,delivery',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'country' => 'required_if:delivery_method,delivery|string|max:255',
            'region' => 'required_if:delivery_method,delivery|string|max:255',
            'province' => 'required_if:delivery_method,delivery|string|max:255',
            'city' => 'required_if:delivery_method,delivery|string|max:255',
            'barangay' => 'required_if:delivery_method,delivery|string|max:255',
            'postal_code' => 'required_if:delivery_method,delivery|string|max:20',
            'street_details' => 'required_if:delivery_method,delivery|string|max:1000',
        ]);

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $deliveryAddress = trim(implode(', ', array_filter([
            $request->street_details,
            $request->barangay,
            $request->city,
            $request->province,
            $request->region,
            $request->country,
            $request->postal_code,
        ])), ', ');

        $requestModel = DocumentRequest::create([
            'user_id' => Auth::id(),
            'subject' => $service['name'],
            'purpose' => $request->purpose,
            'additional_notes' => $request->additional_notes,
            'delivery_method' => $request->delivery_method,
            'payment_proof' => $path,
            'priority' => 'Medium',
            'status' => 'Pending',
            'country' => $request->country,
            'region' => $request->region,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'postal_code' => $request->postal_code,
            'street_details' => $request->street_details,
            'delivery_address' => $deliveryAddress,
        ]);

        return redirect()->route('user.requests')->with('success', 'Your document request has been submitted successfully. Request ID: ' . $requestModel->ticket_id);
    }

    protected function services(): array
    {
        return [
            [
                'type' => 'tor',
                'name' => 'Transcript of Records (TOR)',
                'fee' => '₱150.00',
                'processing_time' => '3-5 business days',
                'processing_period' => '5 to 10 working days and 10 minutes',
                'requirements' => 'Transfer Credential and Official Receipt',
                'required_docs' => 'Student ID, Payment Receipt',
                'instructions' => 'Submit payment proof and wait for processing.',
                'note' => 'Issuance of OTR for graduate students must comply with the needed requirements before release. For Masters – 6 copies of Thesis Books. For Doctoral – 7 copies of Dissertation Books.',
            ],
            [
                'type' => 'coe',
                'name' => 'Certificate of Enrollment',
                'fee' => '₱50.00',
                'processing_time' => '1-2 business days',
                'processing_period' => '1-2 business days',
                'requirements' => 'Student ID, Payment Receipt',
                'required_docs' => 'Student ID, Payment Receipt',
                'instructions' => 'Digital copy available immediately after approval.',
            ],
            [
                'type' => 'cog',
                'name' => 'Certificate of Grades',
                'fee' => '₱100.00',
                'processing_time' => '2-3 business days',
                'processing_period' => '2-3 business days',
                'requirements' => 'Student ID, Payment Receipt',
                'required_docs' => 'Student ID, Payment Receipt',
                'instructions' => 'Grades for current semester.',
            ],
            [
                'type' => 'diploma',
                'name' => 'Diploma Request',
                'fee' => '₱500.00',
                'processing_time' => '7-10 business days',
                'processing_period' => '15 to 30 working days and 10 minutes',
                'who_may_avail' => 'Graduate Students',
                'requirements' => 'Official Receipt of Diploma',
                'required_docs' => 'Student ID, Payment Receipt, Clearance',
                'instructions' => 'For graduates only.',
            ],
            [
                'type' => 'auth',
                'name' => 'Authentication/Certified True Copy',
                'fee' => '₱200.00',
                'processing_time' => '5-7 business days',
                'processing_period' => '5-7 business days',
                'requirements' => 'Original Document, Student ID, Payment Receipt',
                'required_docs' => 'Original Document, Student ID, Payment Receipt',
                'instructions' => 'Bring original documents for authentication.',
            ],
            [
                'type' => 'gmc',
                'name' => 'Good Moral Certificate',
                'fee' => '₱75.00',
                'processing_time' => '2-3 business days',
                'processing_period' => '2-3 business days',
                'requirements' => 'Student ID, Payment Receipt',
                'required_docs' => 'Student ID, Payment Receipt',
                'instructions' => 'Requires dean\'s approval.',
            ],
        ];
    }
}
