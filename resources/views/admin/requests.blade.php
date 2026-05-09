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
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Processing" {{ request('status') === 'Processing' ? 'selected' : '' }}>Processing</option>
                    <option value="Ready for Release" {{ request('status') === 'Ready for Release' ? 'selected' : '' }}>Ready for Release</option>
                    <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="Cancellation Requested" {{ request('status') === 'Cancellation Requested' ? 'selected' : '' }}>Cancellation Requested</option>
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
                    <td>
                        <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                            <a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-secondary">View</a>
                            @if($request->status === 'Cancellation Requested')
                                <button type="button" class="btn btn-primary reject-request-button" data-action="accept" data-id="{{ $request->id }}" data-request-id="{{ $request->ticket_id }}" data-document="{{ $request->subject }}" data-user="{{ $request->user->name }}" data-status="{{ $request->status }}" data-created="{{ $request->created_at->format('M d, Y') }}">Accept</button>
                            @elseif(in_array($request->status, ['Pending', 'Processing']))
                                <button type="button" class="btn btn-danger reject-request-button" data-action="reject" data-id="{{ $request->id }}" data-request-id="{{ $request->ticket_id }}" data-document="{{ $request->subject }}" data-user="{{ $request->user->name }}" data-status="{{ $request->status }}" data-created="{{ $request->created_at->format('M d, Y') }}">Reject</button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding: 20px;">No document requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div id="reject-overlay" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,0.72); z-index:50; align-items:center; justify-content:center; padding:24px;">
        <div style="background:#FFFFFF; border-radius:24px; width:100%; max-width:560px; padding:28px; position:relative; box-shadow:0 24px 70px rgba(15,23,42,0.18);">
            <button type="button" id="reject-overlay-close" style="position:absolute; right:18px; top:18px; background:transparent; border:none; font-size:1.5rem; color:#111827; cursor:pointer;">&times;</button>
            <h3 id="reject-overlay-title" style="margin-top:0;">Reject Document Request</h3>
            <p id="reject-overlay-description" style="color:#475569;">Confirm rejection when the request is invalid. Add the reason below and then choose Reject or Cancel.</p>
            <div style="margin-top:18px; border:1px solid #E5E7EB; border-radius:16px; padding:18px; background:#F8FAFC;">
                <p style="margin:0 0 8px;"><strong>Request ID:</strong> <span id="reject-overlay-request-id"></span></p>
                <p style="margin:0 0 8px;"><strong>Document:</strong> <span id="reject-overlay-document"></span></p>
                <p style="margin:0 0 8px;"><strong>User:</strong> <span id="reject-overlay-user"></span></p>
                <p style="margin:0; color:#475569;"><strong>Status:</strong> <span id="reject-overlay-status"></span> · <strong>Created:</strong> <span id="reject-overlay-created"></span></p>
            </div>
            <form id="reject-request-form" method="POST" action="" style="margin-top:20px;">
                @csrf
                <div id="reject-reason-group" class="form-group" style="margin-bottom:16px;">
                    <label for="rejection_reason">Reason for invalid request</label>
                    <textarea id="rejection_reason" name="rejection_reason" rows="4" style="width:100%; min-height:120px; border-radius:12px; border:1px solid #CBD5E1; padding:12px; resize:vertical;"></textarea>
                </div>
                <div style="display:flex; justify-content:flex-end; gap:12px; flex-wrap:wrap;">
                    <button type="button" class="btn btn-secondary" id="reject-overlay-cancel">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="reject-overlay-submit">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const search = document.getElementById('search');
        const form = document.getElementById('admin-request-search-form');
        const overlay = document.getElementById('reject-overlay');
        const overlayClose = document.getElementById('reject-overlay-close');
        const overlayCancel = document.getElementById('reject-overlay-cancel');
        const rejectForm = document.getElementById('reject-request-form');
        const rejectRequestId = document.getElementById('reject-overlay-request-id');
        const rejectDocument = document.getElementById('reject-overlay-document');
        const rejectUser = document.getElementById('reject-overlay-user');
        const rejectStatus = document.getElementById('reject-overlay-status');
        const rejectCreated = document.getElementById('reject-overlay-created');
        const rejectionReason = document.getElementById('rejection_reason');
        const rejectButtons = document.querySelectorAll('.reject-request-button');
        const rejectActionBase = '{{ url('admin/requests') }}';
        const rejectReasonGroup = document.getElementById('reject-reason-group');
        const rejectSubmit = document.getElementById('reject-overlay-submit');
        const overlayTitle = document.getElementById('reject-overlay-title');
        const overlayDescription = document.getElementById('reject-overlay-description');

        if (search) {
            let timeoutId = null;
            search.addEventListener('input', function () {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    form.submit();
                }, 500);
            });
        }

        rejectButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const requestId = button.dataset.id;
                rejectRequestId.textContent = button.dataset.requestId;
                rejectDocument.textContent = button.dataset.document;
                rejectUser.textContent = button.dataset.user;
                rejectStatus.textContent = button.dataset.status;
                rejectCreated.textContent = button.dataset.created;
                const action = button.dataset.action || 'reject';
                rejectRequestId.textContent = button.dataset.requestId;
                rejectDocument.textContent = button.dataset.document;
                rejectUser.textContent = button.dataset.user;
                rejectStatus.textContent = button.dataset.status;
                rejectCreated.textContent = button.dataset.created;
                rejectionReason.value = '';
                rejectionReason.required = action === 'reject';

                if (action === 'accept') {
                    overlayTitle.textContent = 'Accept Cancellation Request';
                    overlayDescription.textContent = 'Are you sure you want to accept this cancellation request? The request will be marked as cancelled.';
                    rejectReasonGroup.style.display = 'none';
                    rejectSubmit.textContent = 'Accept';
                    rejectSubmit.classList.remove('btn-danger');
                    rejectSubmit.classList.add('btn');
                    rejectForm.action = rejectActionBase + '/' + requestId + '/accept';
                } else {
                    overlayTitle.textContent = 'Reject Document Request';
                    overlayDescription.textContent = 'Confirm rejection when the request is invalid. Add the reason below and then choose Reject or Cancel.';
                    rejectReasonGroup.style.display = 'block';
                    rejectSubmit.textContent = 'Reject';
                    rejectSubmit.classList.remove('btn');
                    rejectSubmit.classList.add('btn-danger');
                    rejectForm.action = rejectActionBase + '/' + requestId + '/reject';
                }

                overlay.style.display = 'flex';
            });
        });

        const closeOverlay = function () {
            overlay.style.display = 'none';
        };

        if (overlayClose) {
            overlayClose.addEventListener('click', closeOverlay);
        }

        if (overlayCancel) {
            overlayCancel.addEventListener('click', closeOverlay);
        }

        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeOverlay();
            }
        });
    });
</script>
@endsection
