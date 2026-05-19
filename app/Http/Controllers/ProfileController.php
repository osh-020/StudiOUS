<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'country' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'street_details' => ['required', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->country = $data['country'];
        $user->region = $data['region'];
        $user->province = $data['province'];
        $user->city = $data['city'];
        $user->barangay = $data['barangay'];
        $user->postal_code = $data['postal_code'];
        $user->street_details = $data['street_details'];

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        return redirect()->route('user.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
