@extends('layouts.app')
@section('title', 'Manage Work Items')

@section('content')
<div class="container">
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <h1 class="mb-4">Work Items</h1>

    <a href="{{ route('admin.work.create') }}" class="btn btn-primary mb-3">New Work Item</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        <a href="{{ route('admin.work.edit', $item) }}" class="btn btn-sm btn-outline-light">Edit</a>
                        <form action="{{ route('admin.work.destroy', $item) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this item?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
</div>
@endsection
