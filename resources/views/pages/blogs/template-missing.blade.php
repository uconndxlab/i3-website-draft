@extends('layouts.app')

@section('title', $post->title ?? 'Blog Post')
@section('meta_description', 'Read the latest blog from i3, UConn\'s hub of innovation and creativity. Learn about our latest projects, events, and updates.')

@section('content')
<section class="py-5 text-light" style="background: linear-gradient(180deg, #0f2e4b 0%, #101820 100%); min-height: 60vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="p-5 rounded-4 border border-info-subtle" style="background: rgba(15, 46, 75, 0.65); box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35); backdrop-filter: blur(12px);">
                    <div class="mb-4">
                        <span class="badge text-bg-info text-uppercase">Configuration Needed</span>
                    </div>
                    <h1 class="h2 fw-bold mb-3">This post is almost ready.</h1>
                    <p class="lead mb-4">The content for “{{ $post->title }}” is missing. Add post body content in the admin panel so visitors can view it.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-info text-dark">Edit Post Content</a>
                        <a href="{{ route('blog') }}" class="btn btn-outline-light">Back to Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
