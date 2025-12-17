@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create New Tool</h5>
                    <a href="{{ route('admin.tools.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.tools.store') }}" enctype="multipart/form-data">
                        @include('admin.tools._form')
                        <div class="mt-4 text-end">
                            <button class="btn btn-primary px-4 py-2">
                                <i class="bi bi-save me-2"></i>Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

