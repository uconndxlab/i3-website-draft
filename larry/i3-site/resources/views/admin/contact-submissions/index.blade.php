@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Contact Submissions</h5>
                    <div>
                        <span class="badge bg-primary">{{ $submissions->total() }} total</span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Search by name, email, or message..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bi bi-search"></i> Search
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">All Submissions</option>
                                    <option value="unsent" {{ request('status') === 'unsent' ? 'selected' : '' }}>
                                        Unsent
                                    </option>
                                    <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>
                                        Sent
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-secondary">
                                    Clear
                                </a>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($submissions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message Preview</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($submissions as $submission)
                                        <tr>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $submission->created_at->format('M j, Y') }}<br>
                                                    {{ $submission->created_at->format('g:i A') }}
                                                </small>
                                            </td>
                                            <td>
                                                <strong>{{ $submission->full_name }}</strong>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $submission->email }}">
                                                    {{ $submission->email }}
                                                </a>
                                            </td>
                                            <td>
                                                <div style="max-width: 300px;">
                                                    {{ Str::limit($submission->message, 100) }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($submission->is_sent)
                                                    <span class="badge bg-success">Sent</span>
                                                    <small class="text-muted d-block">
                                                        {{ $submission->sent_at->format('M j, Y g:i A') }}
                                                    </small>
                                                @else
                                                    <span class="badge bg-warning">Unsent</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.contact-submissions.show', $submission) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    
                                                    @if($submission->is_sent)
                                                        <form method="POST" 
                                                              action="{{ route('admin.contact-submissions.mark-unsent', $submission) }}" 
                                                              class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-outline-warning"
                                                                    title="Mark as Unsent">
                                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form method="POST" 
                                                              action="{{ route('admin.contact-submissions.mark-sent', $submission) }}" 
                                                              class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-outline-success"
                                                                    title="Mark as Sent">
                                                                <i class="bi bi-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    <form method="POST" 
                                                          action="{{ route('admin.contact-submissions.destroy', $submission) }}" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this submission?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger">
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
                            {{ $submissions->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <h5 class="mt-3">No submissions found</h5>
                            <p class="text-muted">
                                @if(request()->hasAny(['search', 'status']))
                                    Try adjusting your search or filter criteria.
                                @else
                                    Contact form submissions will appear here.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
