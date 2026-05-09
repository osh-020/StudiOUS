@extends('layouts.app')

@section('title', 'Manage FAQs')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:16px; align-items:center; margin-bottom:20px;">
        <h2>Manage FAQs</h2>
        <a href="{{ route('admin.faqs.create') }}" class="btn">Create FAQ</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($faqs as $faq)
                <tr>
                    <td>{{ $faq->question }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($faq->answer, 120) }}</td>
                    <td>{{ $faq->created_at->format('M d, Y') }}</td>
                    <td style="white-space:nowrap; display:flex; gap:8px; flex-wrap:wrap;">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-secondary" style="padding:8px 12px;">Edit</a>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Delete this FAQ?');" style="display:inline-block; margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background:#EF4444;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding: 20px;">No FAQs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
