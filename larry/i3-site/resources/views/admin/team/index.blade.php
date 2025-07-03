@extends('layouts.app')
@section('title', 'Manage Team')

@section('content')
<h1 class="text-light">Team Members</h1>

<div class="container">
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary mb-3">Add Member</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr><th>Name</th><th>Role</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->role }}</td>
                    <td>
                        <a href="{{ route('admin.team.edit', ['team' => $member]) }}" class="btn btn-sm btn-outline-light">Edit</a>
                        <form action="{{ route('admin.team.destroy', ['team' => $member]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
