@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Authorized NetIDs</h5>
                    <div>
                        <a href="{{ route('admin.authorized-netids.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add NetID
                        </a>
                        <span class="badge bg-secondary ms-2">{{ $authorizedNetids->total() }} total</span>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($authorizedNetids->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-person-x text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">No authorized NetIDs found</h5>
                            <p class="text-muted">Add your first authorized NetID to get started.</p>
                            <a href="{{ route('admin.authorized-netids.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Add NetID
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>NetID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($authorizedNetids as $netid)
                                        <tr>
                                            <td class="fw-bold">{{ $netid->netid }}</td>
                                            <td>{{ $netid->name ?? '-' }}</td>
                                            <td>{{ $netid->email ?? '-' }}</td>
                                            <td>
                                                @if($netid->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $netid->created_at->format('M j, Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.authorized-netids.show', $netid) }}" 
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.authorized-netids.edit', $netid) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form method="POST" 
                                                          action="{{ route('admin.authorized-netids.destroy', $netid) }}" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this authorized NetID?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
                            {{ $authorizedNetids->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
