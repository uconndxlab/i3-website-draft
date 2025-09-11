@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Authorized NetID Details</h5>
                    <div>
                        <a href="{{ route('admin.authorized-netids.edit', $authorizedNetid) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('admin.authorized-netids.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">NetID:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge bg-info fs-6">{{ $authorizedNetid->netid }}</span>
                                </dd>

                                <dt class="col-sm-4">Name:</dt>
                                <dd class="col-sm-8">{{ $authorizedNetid->name ?? '-' }}</dd>

                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8">
                                    @if($authorizedNetid->email)
                                        <a href="mailto:{{ $authorizedNetid->email }}">{{ $authorizedNetid->email }}</a>
                                    @else
                                        -
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Status:</dt>
                                <dd class="col-sm-8">
                                    @if($authorizedNetid->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Created:</dt>
                                <dd class="col-sm-8">{{ $authorizedNetid->created_at->format('F j, Y \a\t g:i A') }}</dd>

                                <dt class="col-sm-4">Updated:</dt>
                                <dd class="col-sm-8">{{ $authorizedNetid->updated_at->format('F j, Y \a\t g:i A') }}</dd>
                            </dl>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <form method="POST" 
                              action="{{ route('admin.authorized-netids.destroy', $authorizedNetid) }}" 
                              class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this authorized NetID? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete NetID
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
