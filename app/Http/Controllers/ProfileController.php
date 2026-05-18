<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'street_details' => ['required', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if ($data['email'] !== $user->email) {
            $request->validate(['email' => 'unique:users,email']);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->country = $data['country'];
        $user->region = $data['region'];
        $user->province = $data['province'];
        $user->city = $data['city'];
        $user->barangay = $data['barangay'];
        $user->postal_code = $data['postal_code'];
        $user->address = trim(implode(', ', array_filter([
            $data['street_details'],
            $data['barangay'],
            $data['city'],
            $data['province'],
            $data['region'],
            $data['country'],
            $data['postal_code'],
        ])), ', ');
        $user->street_name = null;
        $user->building = null;
        $user->house_number = null;

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if (!empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return redirect()->route('user.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
