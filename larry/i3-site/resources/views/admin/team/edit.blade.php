@extends('layouts.app')
@section('title', 'Edit Team Member')

@section('content')
<div class="container text-light">
    <h1 class="text-light">Edit Team Member</h1>
    <form method="POST" action="{{ route('admin.team.update', ['team' => $team]) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.team._form')
    </form>
</div>
@endsection
