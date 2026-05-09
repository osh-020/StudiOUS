@extends('layouts.app')

@section('title', isset($faq) ? 'Edit FAQ' : 'Create FAQ')

@section('content')
<div class="card">
    <h2>{{ isset($faq) ? 'Edit FAQ' : 'Create FAQ' }}</h2>

    <form method="POST" action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
        @csrf
        @if(isset($faq))
            @method('PATCH')
        @endif

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="question">Question</label>
            <input id="question" name="question" type="text" value="{{ old('question', $faq->question ?? '') }}" required>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="answer">Answer</label>
            <textarea id="answer" name="answer" rows="6" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn">{{ isset($faq) ? 'Update FAQ' : 'Save FAQ' }}</button>
        <a href="{{ route('admin.faqs') }}" class="btn btn-secondary" style="text-decoration:none;">Cancel</a>
    </form>
</div>
@endsection
