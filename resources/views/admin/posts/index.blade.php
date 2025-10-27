@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Posts</h5>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> New Post
                    </a>
                </div>

                <div class="card-body">
                    @if($posts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Published Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                <strong>{{ $post->title }}</strong>
                                                @if($post->featured_image)
                                                    <br><small class="text-success">Has featured image</small>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $post->author ?? '—' }}
                                            </td>
                                            <td>
                                                @if($post->published)
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Not set' }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.posts.preview', $post) }}" 
                                                       class="btn btn-sm btn-outline-info"
                                                       target="_blank"
                                                       title="Preview post">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.posts.edit', $post) }}" 
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Edit post">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @if($post->published)
                                                        <form action="{{ route('admin.posts.unpublish', $post) }}" 
                                                              method="POST" 
                                                              class="d-inline">
                                                            @csrf
                                                            <button class="btn btn-sm btn-outline-warning" 
                                                                    title="Unpublish"
                                                                    onclick="return confirm('Are you sure you want to unpublish this post?')">
                                                                <i class="bi bi-x-circle"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.posts.publish', $post) }}" 
                                                              method="POST" 
                                                              class="d-inline">
                                                            @csrf
                                                            <button class="btn btn-sm btn-outline-success" 
                                                                    title="Publish">
                                                                <i class="bi bi-check-circle"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.posts.destroy', $post) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-newspaper display-4 text-muted"></i>
                            <h5 class="mt-3">No posts found</h5>
                            <p class="text-muted">Start by creating your first post.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

