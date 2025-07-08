@extends('layouts.app')
@section('title', 'Add Team Member')

@section('content')
<div class="container">
    <h1 class="text-light">Add Team Member</h1>
    <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data">
        @include('admin.team._form')
    </form>
</div>
@endsection
