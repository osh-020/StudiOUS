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
