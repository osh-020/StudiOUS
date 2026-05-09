@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
<div class="card">
    <h2>Create New Ticket</h2>
    <form method="POST" action="{{ route('user.tickets.store') }}">
        @csrf
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="Login Issue">Login Issue</option>
                <option value="Payment">Payment</option>
                <option value="Document">Document</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="priority">Priority</label>
            <select id="priority" name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn">Create Ticket</button>
    </form>
</div>
@endsection