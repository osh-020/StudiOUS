<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StudiOUS Portal')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFFFF;
            color: #333;
            margin: 0;
            padding: 72px 0 0 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #0C29D6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #0A23B8;
        }
        .btn-secondary {
            background-color: #FEDF46;
            color: #333;
        }
        .btn-secondary:hover {
            background-color: #E6C944;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: 500;
        }
        .status-open { background-color: #E5E7EB; color: #374151; }
        .status-processing { background-color: #3B82F6; color: white; }
        .status-in-progress { background-color: #3B82F6; color: white; }
        .status-pending { background-color: #F59E0B; color: white; }
        .status-ready-for-release { background-color: #06B6D4; color: white; }
        .status-completed { background-color: #10B981; color: white; }
        .status-rejected { background-color: #EF4444; color: white; }
        .status-cancelled { background-color: #6B7280; color: white; }
        .status-cancellation-requested { background-color: #F97316; color: white; }
        .status-resolved { background-color: #10B981; color: white; }
        .status-closed { background-color: #8B5CF6; color: white; }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 95%;
            padding: 10px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
        }
        .message {
            background: #F3F4F6;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .message.admin {
            background: #0C29D6;
            color: white;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table thead {
            background-color: #F3F4F6;
            border-bottom: 2px solid #D1D5DB;
        }
        .table thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #374151;
        }
        .table tbody tr {
            border-bottom: 1px solid #E5E7EB;
            transition: background-color 0.2s;
        }
        .table tbody tr:hover {
            background-color: #F9FAFB;
        }
        .table tbody td {
            padding: 15px;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: #0C29D6;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }
        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .navbar .nav-links {
            display: flex;
            align-items: center;
        }
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .navbar .brand {
            font-weight: 600;
            font-size: 1.2em;
        }
        .hero {
            display: grid;
            gap: 20px;
            padding: 40px;
            border-radius: 20px;
            background: linear-gradient(135deg, #0C29D6 0%, #3061FF 55%, #1E50FF 100%);
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(12, 41, 214, 0.16);
        }
        .hero h1 {
            margin: 0 0 10px;
            font-size: 2.5rem;
            line-height: 1.05;
        }
        .hero p {
            margin: 0;
            color: rgba(255,255,255,0.88);
        }
        .action-grid,
        .service-grid,
        .stats-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        .service-card,
        .announcement-card,
        .stat-card,
        .panel-card {
            background: #FFFFFF;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            padding: 24px;
        }
        .card-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            margin-bottom: 30px;
        }
        .service-card h3,
        .announcement-card h3,
        .stat-card h3,
        .panel-card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.05rem;
        }
        .service-card p,
        .announcement-card p,
        .panel-card p {
            color: #4B5563;
            line-height: 1.7;
            margin-bottom: 16px;
        }
        .service-card .small-badge {
            margin-bottom: 18px;
        }
        .service-card .link-button,
        .service-card .outline-button {
            width: fit-content;
        }
        .small-badge {
            display: inline-flex;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            background: #EEF2FF;
            color: #3730A3;
            margin-bottom: 12px;
        }
        .link-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 12px;
            background: #0C29D6;
            color: white;
            text-decoration: none;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        .link-button:hover {
            background: #0A23B8;
            transform: translateY(-1px);
            color: white;
        }
        .outline-button {
            border: 1px solid rgba(15, 23, 42, 0.1);
            background: white;
            color: #0C29D6;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="brand"><a style="color: inherit; text-decoration: none;">StudiOUS Portal</a></div>
        <div class="nav-links">
            @if(auth()->check())
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.tickets') }}" class="{{ request()->routeIs('admin.tickets*') ? 'active' : '' }}">All Tickets</a>
                    <a href="{{ route('admin.requests') }}" class="{{ request()->routeIs('admin.requests*') ? 'active' : '' }}">All Requests</a>
                    <a href="{{ route('admin.faqs') }}" class="{{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">FAQs</a>
                    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">Users</a>
                    <a href="{{ route('admin.announcement') }}" class="{{ request()->routeIs('admin.announcement*') ? 'active' : '' }}">Announcements</a>
                @else
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('user.services') }}" class="{{ request()->routeIs('user.services*') || request()->routeIs('user.tickets*') || request()->routeIs('user.requests*') ? 'active' : '' }}">Requests</a>
                    <a href="{{ route('user.helpdesk') }}" class="{{ request()->routeIs('user.helpdesk*') ? 'active' : '' }}">Helpdesk</a>
                    <a href="{{ route('announcement') }}" class="{{ request()->routeIs('announcement') ? 'active' : '' }}">Announcements</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                @endif
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
        <div class="user-info">
            @if(auth()->check())
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: white; text-decoration: underline; cursor: pointer; padding: 8px 12px; border-radius: 6px; transition: background-color 0.3s;">Logout</button>
                </form>
            @endif
        </div>
    </nav>
    
    <!-- Breadcrumb Navigation -->
    @if(auth()->check())
    <div style="background: #F8FAFC; padding: 10px 20px; border-bottom: 1px solid #E2E8F0; font-size: 0.9em;">
        <span style="color: #64748B;">
            @if(auth()->user()->isAdmin())
                Admin /
                @if(request()->routeIs('admin.dashboard'))
                    Dashboard
                @elseif(request()->routeIs('admin.tickets'))
                    All Tickets
                @elseif(request()->routeIs('admin.requests'))
                    Document Requests
                @elseif(request()->routeIs('admin.faqs') || request()->routeIs('admin.faqs.*'))
                    FAQs
                @elseif(request()->routeIs('admin.users') || request()->routeIs('admin.users.*'))
                    Users
                @elseif(request()->routeIs('admin.announcement'))
                    Announcements
                @elseif(request()->routeIs('admin.tickets.show'))
                    Ticket Details
                @else
                    Dashboard
                @endif
            @else
                @if(request()->routeIs('dashboard'))
                    Dashboard
                @elseif(request()->routeIs('user.tickets'))
                    Requests / My Tickets
                @elseif(request()->routeIs('user.tickets.create'))
                    Requests / Create New Ticket
                @elseif(request()->routeIs('user.tickets.show'))
                    Requests / Ticket Details
                @elseif(request()->routeIs('user.services'))
                    Documents
                @elseif(request()->routeIs('user.services.create'))
                    Documents / Request Form
                @elseif(request()->routeIs('user.helpdesk'))
                    Helpdesk
                @elseif(request()->routeIs('user.helpdesk.faq'))
                    Helpdesk / FAQ
                @elseif(request()->routeIs('announcement'))
                    Announcement
                @elseif(request()->routeIs('about'))
                    About
                @else
                    Dashboard
                @endif
            @endif
        </span>
    </div>
    @endif
    <div class="container">
        @if(session('success'))
            <div class="card" style="background: #D1FAE5; color: #065F46;">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>


