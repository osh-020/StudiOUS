@extends('layouts.app')

@section('title', 'Manage Announcements')

@section('content')
<div class="card">
    <h2>Announcements</h2>
    <p style="color:#4B5563; margin-bottom:24px;">Post new announcements and manage existing notices for students.</p>

    <div style="display:flex; flex-direction:column; gap:24px; margin-bottom:24px;">
        <div style="min-width:320px;">
            <div class="card" style="padding:24px;">
                <h3 style="margin-top:0;">Create New Announcement</h3>
                <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-bottom:16px;">
                        <label for="title">Title</label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom:16px;">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:16px;">
                        <label for="image">Announcement Image</label>
                        <input id="image" name="image" type="file" accept="image/*">
                    </div>
                    <button type="submit" class="btn">Publish Announcement</button>
                </form>
            </div>
        </div>

        <div style="min-width:320px;">
            <div class="card" style="padding:24px;">
                <h3 style="margin-top:0;">Posted Announcements</h3>
                @if($announcements->isEmpty())
                    <p style="color:#475569;">No announcements have been posted yet.</p>
                @else
                    <div style="display:grid; gap:20px; margin-top:16px;">
                        @foreach($announcements as $announcement)
                            <div style="padding:18px; border:1px solid #E5E7EB; border-radius:18px; background:#F9FAFB;">
                                <div style="display:flex; justify-content:space-between; gap:12px; align-items:flex-start;">
                                    <div style="flex:1; min-width:0;">
                                        <h4 style="margin:0 0 8px;">{{ $announcement->title }}</h4>
                                        @if($announcement->image)
                                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement image" style="width:100%; max-width:360px; border-radius:16px; margin-bottom:14px; object-fit:cover;">
                                        @endif
                                        <p style="margin:0 0 8px; color:#475569; white-space:pre-line;">{{ $announcement->message }}</p>
                                        <small style="color:#64748B;">Posted by {{ $announcement->user?->name ?? 'Admin' }} on {{ $announcement->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <div style="display:flex; gap:8px; flex-direction:column; align-items:flex-end;">
                                        <a href="{{ route('admin.announcement.edit', $announcement) }}" class="btn" style="padding:8px 12px; background:#0C29D6;">Edit</a>
                                        <form action="{{ route('admin.announcement.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Delete this announcement?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary" style="padding:8px 12px;">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
