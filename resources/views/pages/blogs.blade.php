@extends('layouts.app')
@section('title', 'Blogs')
@section('meta_description', 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity. Learn about our latest projects, events, and updates.')

@section('content')

<style>
    .blog-post {
        background: transparent;
        border-radius: 24px;
        padding: 3rem;
        margin-bottom: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-post:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .blog-header {
        margin-bottom: 2rem;
    }

    .blog-featured-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 16px;
    }

    .blog-title-image {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .blog-title-underline {
        height: 4px;
        width: 100px;
        background: #0ea5e9;
        margin-bottom: 1.5rem;
    }

    .blog-meta-tag {
        display: inline-block;
        background: #f97316;
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .blog-meta {
        font-size: 0.875rem;
        color: #a0a0a0;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .blog-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .blog-content {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #e0e0e0;
    }

    .blog-content p {
        margin-bottom: 1.25rem;
    }

    .blog-content h1, .blog-content h2, .blog-content h3, .blog-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .blog-content h1 {
        font-size: 2rem;
    }

    .blog-content h2 {
        font-size: 1.75rem;
    }

    .blog-content h3 {
        font-size: 1.5rem;
    }

    .blog-content a {
        color: #007bff;
        text-decoration: none;
    }

    .blog-content a:hover {
        text-decoration: underline;
    }

    .blog-content strong {
        font-weight: 600;
    }

    .blog-content ul, .blog-content ol {
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .blog-content li {
        margin-bottom: 0.5rem;
    }
</style>

<section class="bg-dark text-light d-flex align-items-start px-5 py-5" style="min-height: 100vh;">
    <div class="container">
        <div class="row align-items-center justify-content-center mb-5">
            <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">Blog</h2>
            <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                @forelse ($posts as $post)
                    <article class="blog-post" data-aos="fade-up">
                        <div class="blog-meta">
                            @if($post->author)
                                <i class="bi bi-person me-2"></i>{{ $post->author }}
                            @endif
                            @if($post->author && $post->published_at)
                                <span class="mx-2">•</span>
                            @endif
                            @if($post->published_at)
                                <i class="bi bi-calendar3 me-2"></i>{{ $post->published_at->format('F j, Y') }}
                            @endif
                            <span class="mx-3">|</span>
                            <!-- TODO ADD THIS TAG IDK WHAT ITS SUPPOSED TO BE<span class="blog-meta-tag">People</span> --> 
                        </div>
                        
                        <h1 class="blog-title-image">{{ $post->title }}</h1>
                        <div class="blog-title-underline"></div>
                        
                        @if($post->featured_image)
                            <div class="blog-header">
                                <img src="{{ $post->best_featured_image_url }}" 
                                     alt="{{ $post->title }}" 
                                     class="blog-featured-image">
                            </div>
                        @endif
                        
                        <div class="blog-content">
                            {!! $post->content !!}
                        </div>
                    </article>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-newspaper display-1 text-muted"></i>
                        <h3 class="mt-3">No posts yet</h3>
                        <p class="text-muted">Check back soon for updates!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection