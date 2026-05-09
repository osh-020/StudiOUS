@extends('layouts.app')

@section('title', 'Manage Document Requests')

@section('content')
<div class="card">
    <h2>Manage Document Requests</h2>
    <form method="GET" action="{{ route('admin.requests') }}" id="admin-request-search-form" style="margin-bottom: 20px;">
        <div style="display:flex; flex-wrap:wrap; gap:10px; align-items:flex-end;">
            <div class="form-group" style="min-width:220px;">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search ID, subject, or purpose">
            </div>
            <div class="form-group" style="min-width:180px;">
                <label for="status">Status</label>
                <select id="status" name="status" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Resolved" {{ request('status') === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>
            <div class="form-group" style="min-width:180px;">
                <label for="priority">Priority</label>
                <select id="priority" name="priority" onchange="this.form.submit()">
                    <option value="">All Priority</option>
                    <option value="Low" {{ request('priority') === 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ request('priority') === 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ request('priority') === 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            <div class="form-group" style="min-width:180px;">
                <label for="sort">Sort</label>
                <select id="sort" name="sort" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </div>
            <a href="{{ route('admin.requests') }}" class="btn" style="background-color: #6B7280;">Reset</a>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Document</th>
                <th>User</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Delivery</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr>
                    <td>{{ $request->ticket_id }}</td>
                    <td>{{ $request->subject }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td><span class="status-badge status-{{ strtolower(str_replace(' ', '-', $request->status)) }}">{{ $request->status }}</span></td>
                    <td>{{ $request->priority }}</td>
                    <td>{{ ucfirst($request->delivery_method ?? 'N/A') }}</td>
                    <td>{{ $request->created_at->format('M d, Y') }}</td>
                    <td><a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-secondary">View</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding: 20px;">No document requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const search = document.getElementById('search');
        const form = document.getElementById('admin-request-search-form');

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
