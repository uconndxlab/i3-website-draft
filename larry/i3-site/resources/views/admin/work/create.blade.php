@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create New Work Item</h5>
                    <a href="{{ route('admin.work.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.work.store') }}" enctype="multipart/form-data">
                        @include('admin.work._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
