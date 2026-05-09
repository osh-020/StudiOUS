@extends('layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')

@section('content')
<div class="card">
    <h2>{{ isset($user) ? 'Edit User' : 'Create User' }}</h2>

    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}">
        @csrf
        @if(isset($user))
            @method('PATCH')
        @endif

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user" {{ old('role', $user->role ?? '') === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" {{ isset($user) ? '' : 'required' }}>
            @if(isset($user))
                <small style="display:block; color:#6B7280; margin-top:6px;">Leave blank to keep current password.</small>
            @endif
        </div>

        <button type="submit" class="btn">{{ isset($user) ? 'Update User' : 'Create User' }}</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary" style="text-decoration:none;">Cancel</a>
    </form>
</div>
@endsection
