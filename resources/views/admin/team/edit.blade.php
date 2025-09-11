@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Team Member</h5>
                    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.team.update', ['team' => $team]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.team._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
