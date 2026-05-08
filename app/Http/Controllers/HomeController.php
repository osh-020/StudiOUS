<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
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

        return view('dashboard', compact('ticketCount', 'openCount', 'resolvedCount', 'pendingCount', 'latestTickets'));
    }

    public function announcement()
    {
        return view('announcement');
    }

    public function about()
    {
        return view('about');
    }
}
