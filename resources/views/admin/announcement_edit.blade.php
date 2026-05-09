@extends('layouts.app')

@section('title', 'Edit Announcement')

@section('content')
<div class="card">
    <h2>Edit Announcement</h2>
    <p style="color:#4B5563; margin-bottom:24px;">Update the announcement content or replace the image.</p>

    <div class="card" style="padding:24px; max-width:760px; margin-top:16px;">
        <form action="{{ route('admin.announcement.update', $announcement) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group" style="margin-bottom:16px;">
                <label for="title">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $announcement->title) }}" required>
            </div>

            <div class="form-group" style="margin-bottom:16px;">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="6" required>{{ old('message', $announcement->message) }}</textarea>
            </div>

            <div class="form-group" style="margin-bottom:16px;">
                <label for="image">Announcement Image</label>
                @if($announcement->image)
                    <div style="margin-bottom:12px;">
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="Current announcement image" style="width:100%; max-width:320px; border-radius:16px; object-fit:cover;">
                    </div>
                @endif
                <input id="image" name="image" type="file" accept="image/*">
                <p style="margin:8px 0 0; color:#64748B;">Upload a new image to replace the current one.</p>
            </div>

            <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
                <button type="submit" class="btn">Save Changes</button>
                <a href="{{ route('admin.announcement') }}" class="btn btn-secondary" style="text-decoration:none;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
