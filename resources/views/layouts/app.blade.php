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
            padding: 110px 0 0 0;
        }
        .container {
            max-width: 1200px;
            margin: 10px auto 0 auto;
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
            background: linear-gradient(90deg, #FEDF46 0%, #0C29D6 100%);
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
            display: flex;
            align-items: center;
        }

        .brand-logo {
            height: 48px;
            width: auto;
            display: block;
            margin-top: 5px;
            padding: 0;
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
        <div class="brand">
            <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;color: inherit; text-decoration: none;">
                <img src="{{ asset('images/logo.png') }}" alt="StudiOUS Portal" class="brand-logo">
            </a>
        </div>
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
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') || request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('user.services') }}" class="{{ request()->routeIs('user.services*') || request()->routeIs('user.tickets*') || request()->routeIs('user.requests*') ? 'active' : '' }}">Requests</a>
                    <a href="{{ route('user.helpdesk') }}" class="{{ request()->routeIs('user.helpdesk*') ? 'active' : '' }}">Helpdesk</a>
                    <a href="{{ route('announcement') }}" class="{{ request()->routeIs('announcement') ? 'active' : '' }}">Announcements</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                @endif
            @else
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('user.helpdesk') }}" class="{{ request()->routeIs('user.helpdesk*') ? 'active' : '' }}">Helpdesk</a>
                <a href="{{ route('announcement') }}" class="{{ request()->routeIs('announcement') ? 'active' : '' }}">Announcements</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            @endif
        </div>
        <div class="user-info">
            @if(auth()->check())
                <a href="{{ route('user.profile.edit') }}" title="Profile" style="display:inline-flex;align-items:center;color:white;margin-right:8px;text-decoration:none;">
                    <span style="display:inline-flex;width:36px;height:36px;border-radius:9999px;background:rgba(255,255,255,0.15);align-items:center;justify-content:center;font-weight:600;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: white; text-decoration: underline; cursor: pointer; padding: 8px 12px; border-radius: 6px; transition: background-color 0.3s;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color: white; text-decoration: underline; padding: 8px 12px; border-radius: 6px; transition: background-color 0.3s;">Login</a>
            @endif
        </div>
    </nav>
    
    <!-- Breadcrumbs removed -->
    <div class="container">
        @if(session('success'))
            <div class="card" style="background: #D1FAE5; color: #065F46;">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
    <!-- Floating Chatbot Widget -->
    <div id="chatbot-widget" style="position:fixed;bottom:32px;right:32px;z-index:9999;">
        <div id="chatbot-toggle" style="background:white;border-radius:50%;box-shadow:0 2px 8px rgba(0,0,0,0.15);width:64px;height:64px;display:flex;align-items:center;justify-content:center;cursor:pointer;">
            <img src="{{ asset('images/chatbot_icon.png') }}" alt="Chatbot" style="width:40px;height:40px;">
        </div>
        <div id="chatbot-window" style="display:none;flex-direction:column;position:absolute;bottom:80px;right:0;width:340px;max-width:90vw;background:white;border-radius:18px;box-shadow:0 8px 32px rgba(0,0,0,0.18);padding:0;overflow:hidden;">
            <div style="background:#0C29D6;color:white;padding:16px 20px;font-weight:600;font-size:1.1rem;display:flex;align-items:center;justify-content:space-between;">
                <span>Ask StudiOUS</span>
                <span id="chatbot-close" style="cursor:pointer;font-size:1.3rem;">&times;</span>
            </div>
            <div id="chatbot-messages" style="flex:1;min-height:180px;max-height:260px;overflow-y:auto;padding:16px 16px 0 16px;background:#F8FAFC;"></div>
            <form id="chatbot-form" style="display:flex;gap:8px;padding:12px 16px 16px 16px;background:#F8FAFC;">
                <input id="chatbot-input" type="text" placeholder="Type your question..." autocomplete="off" style="flex:1;padding:10px 12px;border-radius:8px;border:1px solid #D1D5DB;">
                <button type="submit" style="background:#0C29D6;color:white;border:none;border-radius:8px;padding:0 18px;font-weight:600;">Send</button>
            </form>
        </div>
    </div>
    <script>
    // FAQ keyword/answer pairs
    const faqs = [
        { keywords: ['what is studious', 'about studious'], answer: 'StudiOUS is a Digital Student Service Management System designed for PSU-OUS to help students access administrative and support services online through a centralized portal.' },
        { keywords: ['submit', 'service request', 'how to request', 'ticket form'], answer: 'Log in to your account, go to the Helpdesk page, open the ticket form, choose a category, describe your issue, and submit the ticket.' },
        { keywords: ['track', 'status', 'my request', 'my ticket'], answer: 'Go to My Tickets or My Requests to see the status of your tickets and document requests. You can also view ticket details for updates and replies.' },
    ];

    // Widget logic
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotMessages = document.getElementById('chatbot-messages');

    chatbotToggle.onclick = () => {
        chatbotWindow.style.display = chatbotWindow.style.display === 'flex' ? 'none' : 'flex';
    };
    chatbotClose.onclick = () => {
        chatbotWindow.style.display = 'none';
    };
    chatbotForm.onsubmit = function(e) {
        e.preventDefault();
        const userMsg = chatbotInput.value.trim();
        if (!userMsg) return;
        appendMessage('You', userMsg, true);
        chatbotInput.value = '';
        setTimeout(() => {
            const response = getFaqResponse(userMsg);
            appendMessage('StudiOUS Bot', response, false);
        }, 400);
    };
    function appendMessage(sender, text, isUser) {
        const msgDiv = document.createElement('div');
        msgDiv.style.marginBottom = '10px';
        msgDiv.style.textAlign = isUser ? 'right' : 'left';
        msgDiv.innerHTML = `<span style="display:inline-block;padding:10px 14px;border-radius:14px;max-width:80%;background:${isUser ? '#0C29D6;color:white;' : '#F3F4F6;color:#222;'};margin-bottom:2px;">${text}</span>`;
        chatbotMessages.appendChild(msgDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }
    function getFaqResponse(msg) {
        const lower = msg.toLowerCase();
        for (const faq of faqs) {
            if (faq.keywords.some(k => lower.includes(k))) {
                return faq.answer;
            }
        }
        return "Sorry, I couldn't find an answer. Please try rephrasing or visit the Helpdesk page.";
    }
    </script>
</body>
</html>


