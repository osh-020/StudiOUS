@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:16px; align-items:center; margin-bottom:20px;">
        <h2>Manage Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn">Create User</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td style="white-space:nowrap; display:flex; gap:8px; flex-wrap:wrap;">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary" style="padding:8px 12px;">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?');" style="display:inline-block; margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background:#EF4444;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding: 20px;">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
