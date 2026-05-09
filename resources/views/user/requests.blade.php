@extends('layouts.app')

@section('title', 'My Requests')

@section('content')
<div class="card" style="padding: 32px;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 12px; font-size:2rem;">My Requests</h1>
            <p style="margin:0; color:#4B5563; font-size:1rem; line-height:1.7;">Track all of your document requests in one place. Use search and status filtering to find a request quickly.</p>
        </div>
        <a href="{{ route('user.services') }}" class="btn">New Document Request</a>
    </div>

    <form method="GET" action="{{ route('user.requests') }}" id="request-search-form" style="display:flex; flex-wrap:wrap; gap:16px; align-items:flex-end; margin-bottom:24px;">
        <div class="form-group" style="flex:1; min-width:220px;">
            <label for="search">Search request</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search by request ID, subject, or purpose">
        </div>
        <div class="form-group" style="min-width:220px;">
            <label for="status">Status</label>
            <select id="status" name="status">
                @foreach($statusOptions as $option)
                    <option value="{{ $option === 'All' ? '' : $option }}" {{ $option === 'All' ? (request()->filled('status') ? '' : 'selected') : (request('status') === $option ? 'selected' : '') }}>{{ $option }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" style="min-width:220px;">
            <label for="sort">Sort</label>
            <select id="sort" name="sort">
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
            </select>
        </div>
        <a href="{{ route('user.requests') }}" class="btn" style="background-color: #6B7280;">Reset</a>
    </form>

    @if($requests->isEmpty())
        <div class="card" style="background:#F8FAFC; border:1px solid #E5E7EB;">
            <p style="margin:0; color:#475569;">No document requests match your search or filter. Try a different keyword or status.</p>
        </div>
    @else
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Delivery</th>
                        <th>Submitted</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->ticket_id }}</td>
                            <td>{{ $request->subject }}</td>
                            <td><span class="status-badge status-{{ strtolower(str_replace(' ', '-', $request->status)) }}">{{ $request->status }}</span></td>
                            <td>{{ ucfirst($request->delivery_method ?? 'N/A') }}</td>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td><a href="{{ route('user.tickets.show', $request->id) }}" class="btn btn-secondary">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const status = document.getElementById('status');
        const sort = document.getElementById('sort');
        const search = document.getElementById('search');
        const form = document.getElementById('request-search-form');

        if (status) {
            status.addEventListener('change', function () {
                form.submit();
            });
        }

        if (sort) {
            sort.addEventListener('change', function () {
                form.submit();
            });
        }

        if (search) {
            let timeoutId = null;
            search.addEventListener('input', function () {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    form.submit();
                }, 500);
            });
        }
    });
</script>
@endsection
