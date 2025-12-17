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
                    <h5 class="mb-0">Tools</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createToolModal">
                        <i class="bi bi-plus"></i> New Tool
                    </button>
                </div>

                <div class="card-body">
                    @if($tools->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tools as $tool)
                                        <tr>
                                            <td>
                                                @if($tool->best_thumbnail_url)
                                                    <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->alt_text ?? 'Tool image' }}" style="max-width: 100px; max-height: 100px; object-fit: cover;" class="img-thumbnail">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ Str::limit($tool->description, 50) ?? 'No description' }}</strong>
                                            </td>
                                            <td>
                                                @if($tool->link)
                                                    <a href="{{ $tool->link }}" target="_blank" class="text-decoration-none">
                                                        <i class="bi bi-link-45deg"></i> View Link
                                                    </a>
                                                @else
                                                    <span class="text-muted">No link</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($tool->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $tool->created_at->format('M j, Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.tools.edit', $tool) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.tools.destroy', $tool) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this tool?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger">
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
                        <div class="d-flex justify-content-center">
                            {{ $tools->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-tools display-4 text-muted"></i>
                            <h5 class="mt-3">No tools found</h5>
                            <p class="text-muted">Start by creating your first tool.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Tool Modal -->
<div class="modal fade" id="createToolModal" tabindex="-1" aria-labelledby="createToolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createToolModalLabel">Create New Tool</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.tools.store') }}" enctype="multipart/form-data" id="createToolForm">
                @csrf
                <div class="modal-body">
                    @if($errors->any() && !session('success'))
                        <div class="alert alert-danger">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @include('admin.tools._form', ['tool' => null])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Create Tool
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Keep modal open if there are validation errors
    @if($errors->any() && !session('success'))
        const createModal = new bootstrap.Modal(document.getElementById('createToolModal'));
        createModal.show();
    @endif
});
</script>
@endpush
@endsection