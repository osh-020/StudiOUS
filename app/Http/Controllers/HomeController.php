<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->take(1)->get();

        return view('dashboard', compact('announcements'));
    }

    public function dashboard()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $ticketCount = Auth::user()->tickets()->count();
        $openCount = Auth::user()->tickets()->where('status', 'Open')->count();
        $resolvedCount = Auth::user()->tickets()->where('status', 'Resolved')->count();
        $pendingCount = Auth::user()->tickets()->where('status', 'Pending')->count();
        $latestTickets = Auth::user()->tickets()->latest()->take(3)->get();
        $announcements = Announcement::latest()->take(1)->get();

        return view('dashboard', compact('ticketCount', 'openCount', 'resolvedCount', 'pendingCount', 'latestTickets', 'announcements'));
    }

    public function profile()
    {
        $requests = Auth::user()->documentRequests()->latest()->take(5)->get();
        $tickets = Auth::user()->tickets()->where('category', '!=', 'Document Request')->latest()->take(5)->get();
        $announcement = Announcement::latest()->first();

        return view('user.profile', compact('requests', 'tickets', 'announcement'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'street_address' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:50',
        ]);

        Auth::user()->update($validated);

        return redirect()->route('user.profile')->with('success', 'Your profile has been updated.');
    }

    public function announcement()
    {
        $announcements = Announcement::latest()->get();

        return view('announcement', compact('announcements'));
    }

    public function about()
    {
        return view('about');
    }
}
