@extends('layouts.app')

@section('title', 'Helpdesk')

@section('content')
<div class="card" style="padding: 32px;">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:nowrap; gap:20px; margin-bottom:24px;">
        <div style="min-width:0; flex:1;">
            <h1 style="margin:0 0 12px; font-size:2rem;">HelpDesk</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Submit and track your support concerns easily. Search our FAQ to see if your question has already been answered before creating a new ticket.</p>
        </div>
        <a href="{{ route('user.tickets') }}" class="btn" style="white-space:nowrap; margin-top:4px;">View My Tickets</a>
    </div>

    <div style="position:relative; margin-bottom: 26px;">
        <label for="faq-search" style="display:block; margin-bottom:10px; font-weight:600; color:#374151;">How can we help you?</label>
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="position:relative; width:100%;">
                <input id="faq-search" class="form-group" type="search" placeholder="Search frequently asked questions..." autocomplete="off" style="width:100%; padding:16px 18px; border-radius: 16px; border: 1px solid #D1D5DB; font-size:1rem; box-shadow:none;" />
                <div id="faq-suggestions" style="position:absolute; top:100%; left:0; width:100%; margin-top:0; background:#ffffff; border:1px solid #E5E7EB; border-radius: 0 0 16px 16px; box-shadow:0 20px 50px rgba(15,23,42,0.08); z-index:10; display:none; max-height:320px; overflow:auto;"></div>
            </div>
        </div>
    </div>

    <div style="padding: 26px; background:#ffffff; border-radius: 18px; border:1px solid #E5E7EB; margin-bottom:24px;">
        <h2 style="margin-top:0; margin-bottom:18px;">Create Ticket</h2>

        <form method="POST" action="{{ route('user.tickets.store') }}">
            @csrf

            <div style="display:grid; gap:18px;">
                <div style="display:grid; gap:8px;">
                    <label for="subject">Subject</label>
                    <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required class="form-group" style="width:100%; padding:14px 16px; border-radius:16px; border:1px solid #D1D5DB; box-sizing:border-box;" />
                </div>

                <div style="display:grid; gap:8px; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:16px;">
                    <div style="display:grid; gap:8px;">
                        <label for="category">Category</label>
                        <select id="category" name="category" required class="form-group" style="width:100%; padding:14px 16px; border-radius:16px; border:1px solid #D1D5DB; box-sizing:border-box;">
                            <option value="">Select category</option>
                            <option value="Login Issue" {{ old('category') === 'Login Issue' ? 'selected' : '' }}>Login Issue</option>
                            <option value="Payment" {{ old('category') === 'Payment' ? 'selected' : '' }}>Payment</option>
                            <option value="Document" {{ old('category') === 'Document' ? 'selected' : '' }}>Document</option>
                            <option value="Others" {{ old('category') === 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>

                    <div style="display:grid; gap:8px;">
                        <label for="priority">Priority</label>
                        <select id="priority" name="priority" required class="form-group" style="width:100%; padding:14px 16px; border-radius:16px; border:1px solid #D1D5DB; box-sizing:border-box;">
                            <option value="Low" {{ old('priority') === 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Medium" {{ old('priority') === 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="High" {{ old('priority') === 'High' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>
                </div>

                <div style="display:grid; gap:8px;">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" required class="form-group" style="width:100%; padding:14px 16px; border-radius:16px; border:1px solid #D1D5DB; box-sizing:border-box;">{{ old('description') }}</textarea>
                </div>

                @if ($errors->any())
                    <div style="padding:16px; background:#FEF3F2; border:1px solid #FECACA; border-radius:12px; color:#B91C1C;">
                        <strong>Whoops! Something went wrong.</strong>
                        <ul style="margin:10px 0 0; padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn" style="padding: 14px 22px; width:max-content;">Submit Ticket</button>
            </div>
        </form>
    </div>

    <div style="padding: 24px; background:#ffffff; border-radius: 18px; border:1px solid #E5E7EB;">
        <h2 style="margin-top:0;">Frequently Asked Questions (FAQ)</h2>
        <div style="display:grid; gap:18px; margin-top:18px;">
            @foreach($faqs as $faq)
                <div>
                    <a href="{{ route('user.helpdesk.faq', ['id' => $faq->id]) }}" style="font-weight:600; color:#0C29D6; text-decoration:none;">{{ $faq->question }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>


<script>
    const faqs = @json($faqLinks);
    const searchInput = document.getElementById('faq-search');
    const suggestions = document.getElementById('faq-suggestions');

    const renderSuggestion = (faq) => {
        const item = document.createElement('a');
        item.href = faq.url;
        item.style.display = 'block';
        item.style.width = '100%';
        item.style.textAlign = 'left';
        item.style.padding = '16px 18px';
        item.style.borderBottom = '1px solid #F3F4F6';
        item.style.background = 'transparent';
        item.style.color = '#0C29D6';
        item.style.textDecoration = 'none';
        item.style.cursor = 'pointer';
        item.onmouseover = () => item.style.background = '#F8FAFC';
        item.onmouseout = () => item.style.background = 'transparent';
        item.innerHTML = '<strong>' + faq.question + '</strong><div style="color:#6B7280; margin-top:4px;">Click to view answer</div>';
        return item;
    };

    const updateSuggestions = (query) => {
        const trimmed = query.trim().toLowerCase();
        suggestions.innerHTML = '';

        if (!trimmed) {
            suggestions.style.display = 'none';
            return;
        }

        const matches = faqs.filter(({ question }) => {
            return question.toLowerCase().includes(trimmed);
        });

        if (!matches.length) {
            suggestions.style.display = 'block';
            suggestions.innerHTML = '<div style="padding:16px 18px; color:#6B7280;">No matching FAQ found. Try another keyword.</div>';
            return;
        }

        matches.forEach((faq, index) => {
            const suggestionItem = renderSuggestion(faq);
            if (index === matches.length - 1) {
                suggestionItem.style.borderBottom = 'none';
            }
            suggestions.appendChild(suggestionItem);
        });

        suggestions.style.display = 'block';
    };

    searchInput.addEventListener('input', (event) => {
        updateSuggestions(event.target.value);
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('#faq-suggestions') && event.target !== searchInput) {
            suggestions.style.display = 'none';
        }
    });
</script>
@endsection