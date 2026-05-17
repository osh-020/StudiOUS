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
            background-color: #F8FAFF;
            color: #111827;
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
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.08);
            padding: 20px;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #F8B803;
            color: #0F2E72;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #E6A700;
        }
        .btn-secondary {
            background-color: #0C29D6;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #0A23B8;
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
            background: linear-gradient(90deg, #F8B803 0%, #0C29D6 55%, #0A23B8 100%);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 16px rgba(12, 41, 214, 0.16);
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
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 1.2em;
        }
        .navbar .brand img {
            display: block;
            height: 40px;
            width: auto;
        }
        .hero {
            display: grid;
            gap: 20px;
            padding: 40px;
            border-radius: 20px;
            background: linear-gradient(135deg, #0A2B6B 0%, #1751D0 50%, #0C29D6 100%);
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
            color: rgba(255,255,255,0.92);
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
            background: transparent;
            border: 1px solid #F8B803;
            color: #ffffff;
            mix-blend-mode: difference;
            margin-bottom: 12px;
        }
        .link-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 12px;
            background: #F8B803;
            color: #0F2E72;
            text-decoration: none;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        .link-button:hover {
            background: #DFA500;
            transform: translateY(-1px);
            color: #0F2E72;
        }
        .outline-button {
            border: 1px solid #F8B803;
            background: white;
            color: #0C29D6;
            font-weight: 600;
        }
        .chat-widget {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 1100;
            max-width: 360px;
            width: min(100%, 360px);
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }
        .chat-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 18px;
            border-radius: 999px;
            border: none;
            background: #0C29D6;
            color: white;
            font-weight: 700;
            box-shadow: 0 14px 40px rgba(12, 41, 214, 0.2);
            cursor: pointer;
        }
        .chat-toggle:hover {
            background: #0A23B8;
        }
        .chat-panel {
            width: 100%;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
            border: 1px solid rgba(15, 23, 42, 0.08);
            overflow: hidden;
            transform-origin: bottom right;
            opacity: 1;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
        .chat-panel.closed {
            opacity: 0;
            transform: scale(0.96);
            pointer-events: none;
            height: 0;
            overflow: hidden;
        }
        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            background: #0C29D6;
            color: white;
        }
        .chat-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
        }
        .chat-subtitle {
            margin: 4px 0 0;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9rem;
            line-height: 1.4;
        }
        .chat-close {
            border: none;
            background: transparent;
            color: white;
            font-size: 1.5rem;
            line-height: 1;
            cursor: pointer;
            padding: 0;
        }
        .chat-messages {
            max-height: 320px;
            overflow-y: auto;
            padding: 18px 20px 0;
            display: grid;
            gap: 12px;
            background: #F8FAFC;
        }
        .chat-message {
            display: inline-flex;
            flex-direction: column;
            gap: 6px;
            padding: 14px 16px;
            border-radius: 16px;
            font-size: 0.95rem;
            line-height: 1.5;
            max-width: 100%;
        }
        .chat-message.bot {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            color: #111827;
        }
        .chat-message.user {
            align-self: flex-end;
            background: #0C29D6;
            color: white;
        }
        .chat-input-row {
            display: flex;
            gap: 10px;
            padding: 16px 20px 20px;
            background: #ffffff;
        }
        .chat-input-row input {
            flex: 1;
            min-width: 0;
            border: 1px solid #E5E7EB;
            border-radius: 999px;
            padding: 12px 16px;
            font-size: 0.95rem;
        }
        .chat-input-row button {
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            background: #0C29D6;
            color: white;
            cursor: pointer;
            font-weight: 700;
        }
        .chat-input-row button:hover {
            background: #0A23B8;
        }
        .chat-footer {
            padding: 0 20px 20px;
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="brand">
            <a href="{{ url('/') }}" style="color: inherit; text-decoration: none;">
                <img src="{{ asset('assets/images/header_logo.png') }}" alt="PSU-StudiOUS logo" style="height:48px; width:auto;" />
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
        <div class="user-info" style="display:flex; align-items:center; gap:8px;">
            @if(auth()->check())
                <a href="{{ route('user.profile') }}" style="display:inline-flex; align-items:center; padding: 8px; border-radius: 8px; background: rgba(255,255,255,0.08);">
                    <img src="{{ asset('assets/images/profile_icon.png') }}" alt="Profile" style="width:22px; height:22px; display:block;" />
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
                    Home
                @elseif(request()->routeIs('user.tickets'))
                    My History / My Tickets
                @elseif(request()->routeIs('user.tickets.show'))
                    My History / Ticket Details
                @elseif(request()->routeIs('user.requests'))
                    My History / My Requests
                @elseif(request()->routeIs('user.requests.show'))
                    My History / Request Details
                @elseif(request()->routeIs('user.history'))
                    My History
                @elseif(request()->routeIs('user.services'))
                    Requests
                @elseif(request()->routeIs('user.services.create'))
                    Requests / Request Form
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

    <div id="chat-widget" class="chat-widget">
        <button id="chat-toggle" class="chat-toggle" type="button" aria-expanded="false">
            <img src="{{ asset('assets/images/bot.png') }}" alt="Chatbot" style="width:22px; height:22px; display:inline-block; margin-right:8px;" />
            <span>Need help?</span>
        </button>

        <div id="chat-panel" class="chat-panel closed" aria-hidden="true">
            <div class="chat-header">
                <div>
                    <div class="chat-title">FAQ Assistant</div>
                    <div class="chat-subtitle">Quick answers for student support.</div>
                </div>
                <button id="chat-close" class="chat-close" type="button" aria-label="Close chat">×</button>
            </div>
            <div id="chat-messages" class="chat-messages">
                <div class="chat-message bot">Hi there! Ask me about the FAQ or support options. For full details, click "Go to FAQ."</div>
            </div>
            <div class="chat-input-row">
                <input id="chat-input" type="text" placeholder="Type your question..." aria-label="Chat question input" />
                <button id="chat-send" type="button">Send</button>
            </div>
            <div class="chat-footer">
                <a href="{{ route('user.helpdesk') }}" class="outline-button">Go to FAQ</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatToggle = document.getElementById('chat-toggle');
            const chatClose = document.getElementById('chat-close');
            const chatPanel = document.getElementById('chat-panel');
            const chatInput = document.getElementById('chat-input');
            const chatSend = document.getElementById('chat-send');
            const chatMessages = document.getElementById('chat-messages');

            const openChat = function () {
                chatPanel.classList.remove('closed');
                chatPanel.setAttribute('aria-hidden', 'false');
                chatToggle.setAttribute('aria-expanded', 'true');
                chatInput.focus();
            };

            const closeChat = function () {
                chatPanel.classList.add('closed');
                chatPanel.setAttribute('aria-hidden', 'true');
                chatToggle.setAttribute('aria-expanded', 'false');
            };

            const addMessage = function (content, type = 'bot') {
                const message = document.createElement('div');
                message.className = 'chat-message ' + type;
                message.innerHTML = content;
                chatMessages.appendChild(message);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            };

            const getResponse = function (text) {
                const question = text.trim().toLowerCase();
                const faqLinks = window.chatFaqLinks || [];

                if (!question) {
                    return 'Please type anything you want help with, for example "How do I submit a ticket?"';
                }

                const faqMatch = faqLinks.find((faq) => faq.question.toLowerCase().includes(question) || question.includes(faq.question.toLowerCase()) || faq.question.toLowerCase().split(' ').some((word) => question.includes(word)));
                if (faqMatch) {
                    return 'I found a related FAQ: <strong>' + faqMatch.question + '</strong>. <a href="' + faqMatch.url + '" style="color:#0C29D6; text-decoration:underline;">Open the answer</a>';
                }

                const keywordAnswers = [
                    { keywords: ['ticket', 'submit', 'create', 'support'], answer: 'To submit a request, visit the Helpdesk page and use the Create Ticket form with your issue details.' },
                    { keywords: ['faq', 'question', 'answer'], answer: 'The FAQ section on the Helpdesk page has common answers for students. Use the search box there.' },
                    { keywords: ['login', 'password', 'account'], answer: 'Login and account issues are best handled through the ticket form on the Helpdesk page.' },
                    { keywords: ['document', 'enrollment', 'request'], answer: 'Document requests can be created from the request form. If you need help, open a ticket and choose the correct category.' },
                ];

                for (const item of keywordAnswers) {
                    if (item.keywords.some((keyword) => question.includes(keyword))) {
                        return item.answer;
                    }
                }

                return 'I am here to help with student support and FAQ questions. Please try a simple request like "How do I create a ticket?" or visit the Helpdesk page.';
            };

            const sendQuestion = function () {
                const value = chatInput.value.trim();
                if (!value) {
                    return;
                }
                addMessage(value, 'user');
                addMessage(getResponse(value), 'bot');
                chatInput.value = '';
            };

            chatToggle.addEventListener('click', function () {
                if (chatPanel.classList.contains('closed')) {
                    openChat();
                } else {
                    closeChat();
                }
            });

            chatClose.addEventListener('click', function () {
                closeChat();
            });

            chatSend.addEventListener('click', sendQuestion);
            chatInput.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    sendQuestion();
                }
            });
        });
    </script>
</body>
</html>


