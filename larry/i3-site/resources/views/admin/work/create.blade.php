@extends('layouts.app')
@section('title', 'New Work Item')

@section('content')
<div class="container text-light">
    <h1 class="mb-4">Create New Work Item</h1>
    <form method="POST" action="{{ route('admin.work.store') }}" enctype="multipart/form-data">
        @include('admin.work._form')
    </form>
</div>
@endsection
