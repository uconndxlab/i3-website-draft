@extends('layouts.app')
@section('title', 'Blogs')
@section('meta_description', 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity. Learn about our latest projects, events, and updates.')

@section('content')

<style>
    /* Background gradient and dot pattern */
    .bg-dark-gradient-dots {
        background: 
            radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
            linear-gradient(180deg, #051a29 0%, #030a0f 100%);
        background-size: 40px 40px, 100% 100%;
        background-position: 0 0, 0 0;
        min-height: 100vh;
    }

    .blog-post {
        background: transparent;
        padding: 3rem;
        margin-bottom: 3rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }


    .blog-header {
        position: relative;
        margin-bottom: 2rem;
    }

    .blog-featured-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 16px;
        position: relative;
        z-index: 2;
        transform: translate(10px, -10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Outline square effect behind the image */
    .blog-header::after {
        content: '';
        position: absolute;
        top: 10px;
        left: -10px;
        width: 100%;
        height: 400px;
        border: 4px solid #fff;
        border-radius: 16px;
        z-index: 1;
    }

    .blog-title-image {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .blog-subheader {
        font-size: 1.25rem;
        font-weight: 400;
        margin-bottom: 1rem;
        opacity: 0.8;
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
        color: #fff;
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
        margin-bottom: 2rem;
    }


    /* THese styles right here will be the actual style of 
    your blog content so the actual text in your post will be styled like this
    This is something we should most likely mess with to make look good*/
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

    .decorative-blog-text {
        position: fixed;
        left: -10%;
        top: 60%;
        transform: translateY(-50%) rotate(-90deg);
        transform-origin: center center;
        font-size: clamp(2rem, 5vw, 5rem);
        font-weight: 900;
        color: transparent;
        -webkit-text-stroke: 2px rgba(255, 255, 255, 0.1);
        text-stroke: 2px rgba(255, 255, 255, 0.1);
        letter-spacing: 0.1em;
        white-space: nowrap;
        z-index: 0;
        pointer-events: none;
        width: clamp(150px, 30vw, 400px);
        text-align: center;
    }
</style>

<section class="bg-dark-gradient-dots text-light d-flex align-items-start px-5 py-5">
    <div class="decorative-blog-text">BLOG POST</div>
    <div class="container">
        <div class="row align-items-center justify-content-center mb-5">
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                @forelse ($posts as $post)
                    <article class="blog-post" data-aos="fade-up">
                        <div class="blog-meta">
                            @if($post->author)
                                {{ $post->author }}
                            @endif
                            @if($post->author && $post->published_at)
                                <span class="mx-2">•</span>
                            @endif
                            @if($post->published_at)
                                {{ $post->published_at->format('F j, Y') }}
                            @endif
                            @if($post->author || $post->published_at)
                                    <span class="mx-2">•</span>
                                @endif
                            @if(is_array($post->tags) && count($post->tags))
                                
                                @foreach($post->tags as $tag)
                                    <span class="blog-meta-tag" style="background-color: {{ \App\Enums\PostTag::from($tag)->color() }}">{{ $tag }}</span>
                                @endforeach
                            @endif
                        </div>
                        
                        @php
                            $imagePosition = $post->image_position ?? 'before_content';
                            $shouldShowImage = $imagePosition !== 'no_image' && $post->featured_image;
                        @endphp
                        
                        {{-- Image before title --}}
                        @if($shouldShowImage && $imagePosition === 'before_title')
                            <div class="blog-header">
                                <img src="{{ $post->best_featured_image_url }}" 
                                     alt="{{ $post->title }}" 
                                     class="blog-featured-image">
                            </div>
                        @endif
                        
                        <h1 class="blog-title-image">{{ $post->title }}</h1>
                        @if($post->subheader)
                            <p class="blog-subheader text-muted">{{ $post->subheader }}</p>
                        @endif
                        <div class="blog-title-underline"></div>
                        
                        {{-- Image before content --}}
                        @if($shouldShowImage && $imagePosition === 'before_content')
                            <div class="blog-header">
                                <img src="{{ $post->best_featured_image_url }}" 
                                     alt="{{ $post->title }}" 
                                     class="blog-featured-image">
                            </div>
                        @endif
                        
                        <div class="blog-content">
                            {!! $post->content !!}
                        </div>
                        
                        {{-- Image after content --}}
                        @if($shouldShowImage && $imagePosition === 'after_content')
                            <div class="blog-header">
                                <img src="{{ $post->best_featured_image_url }}" 
                                     alt="{{ $post->title }}" 
                                     class="blog-featured-image">
                            </div>
                        @endif
                        
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