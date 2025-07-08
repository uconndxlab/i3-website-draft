@extends('layouts.app')
@section('title', 'Edit Work Item')

@section('content')
<div class="container text-light">
    <h1 class="mb-4">Edit Work Item</h1>
    <form method="POST" action="{{ route('admin.work.update', $work) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.work._form')
    </form>
</div>
@endsection
