@extends('layouts.app')
@section('title', 'Blogs')

@section('content')
<h1 class="page-h1 display-1" style="z-index:0">Blog</h1>

<section class="py-5">
    <div class="container">
    <form method="GET" action="{{ route('blogs') }}" id="blog-filter-form">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div class="filter-container">
                        <a href="{{ route('blogs', ['sort' => $sort ?? 'newest']) }}" 
                           class="blog-filter-btn {{ (!isset($filterTag) || $filterTag === 'all') ? 'active' : '' }}">
                            All
                        </a>
                        @foreach(\App\Enums\PostTag::all() as $tag)
                            <a href="{{ route('blogs', ['tag' => $tag, 'sort' => $sort ?? 'newest']) }}" 
                               class="blog-filter-btn {{ (isset($filterTag) && $filterTag === $tag) ? 'active' : '' }}"
                               style="background-color: {{ \App\Enums\PostTag::from($tag)->color() }}">
                                {{ $tag }}
                            </a>
                        @endforeach
                    </div>
                    <div class="sort-container">
                        <label for="sort-select" class="text-white-50 me-2" style="font-size: 0.95rem;">Sort by:</label>
                        <select id="sort-select" name="sort" class="blog-sort-select" onchange="this.form.submit()">
                            <option value="newest" {{ (isset($sort) && $sort === 'newest') || !isset($sort) ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ isset($sort) && $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                        @if(isset($filterTag) && $filterTag !== 'all')
                            <input type="hidden" name="tag" value="{{ $filterTag }}">
                        @endif
                    </div>
                </div>
            </form>
        @if($posts->isEmpty())
            <div class="text-center py-5">
                <p class="text-white-50">No blog posts available at this time.</p>
            </div>
        @else
            
            <div class="row g-4 py-4" id="blog-posts-container">
                @foreach($posts as $post)
                    <div class="col-12 col-md-6 col-lg-4 blog-post-item" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $loop->index * 100 }}">
                        <article class="blog-card h-100">
                            <a href="{{ route('blog.show', $post->url_friendly) }}" class="text-decoration-none">
                                <div class="blog-card-image-wrapper">
                                    @if($post->best_featured_image_url)
                                        <img src="{{ $post->best_featured_image_url }}" 
                                             alt="{{ $post->title }}" 
                                             class="blog-card-image"
                                             loading="lazy">
                                    @else
                                        <div class="blog-card-image-placeholder">
                                            <i class="bi bi-file-text" style="font-size: 3rem; opacity: 0.3;"></i>
                                        </div>
                                    @endif
                                    <div class="blog-card-overlay"></div>
                                </div>
                                <div class="blog-card-content">
                                    <div class="blog-card-meta">
                                        @if($post->published_at)
                                            <time class="blog-card-date" datetime="{{ $post->published_at->toIso8601String() }}">
                                                {{ $post->published_at->format('M j, Y') }}
                                            </time>
                                        @endif
                                        @if($post->author)
                                            <span class="blog-card-author">{{ $post->author }}</span>
                                        @endif
                                    </div>
                                    <h2 class="blog-card-title">{{ $post->title }}</h2>
                                    @if($post->subheader)
                                        <p class="blog-card-subheader">{{ $post->subheader }}</p>
                                    @endif
                                    @if($post->tags && count($post->tags) > 0)
                                        <div class="blog-card-tags">
                                            @foreach(array_slice($post->tags, 0, 3) as $tag)
                                                <span class="blog-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </article>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
    .blog-card {
        background: #1a1a1a;
        border-radius: 1rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5);
    }

    .blog-card a {
        display: flex;
        flex-direction: column;
        height: 100%;
        color: inherit;
    }

    .blog-card-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 aspect ratio */
        overflow: hidden;
        background: #222;
    }

    .blog-card-image,
    .blog-card-image-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-card-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%);
        color: #fff;
    }

    .blog-card:hover .blog-card-image {
        transform: scale(1.1);
    }

    .blog-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(0deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .blog-card:hover .blog-card-overlay {
        opacity: 1;
    }

    .blog-card-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-card-meta {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        margin-bottom: 0.75rem;
        font-size: 0.875rem;
        color: #aaa;
        flex-wrap: wrap;
    }

    .blog-card-date {
        color: #888;
    }

    .blog-card-author {
        color: #888;
        position: relative;
    }

    .blog-card-author::before {
        content: '•';
        margin-right: 0.75rem;
        color: #555;
    }

    .blog-card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.75rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .blog-card:hover .blog-card-title {
        color: var(--light-blue, #4DB3FF);
    }

    .blog-card-subheader {
        color: #ccc;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .blog-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #333;
    }

    .blog-tag {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: rgba(77, 179, 255, 0.15);
        color: var(--light-blue, #4DB3FF);
        border-radius: 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        border: 1px solid rgba(77, 179, 255, 0.3);
        transition: all 0.3s ease;
    }

    .blog-card:hover .blog-tag {
        background: rgba(77, 179, 255, 0.25);
        border-color: rgba(77, 179, 255, 0.5);
    }

    .filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        align-items: center;
        margin-bottom: 2rem;
    }

    .blog-filter-btn {
        display: inline-block;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        border: 2px solid transparent;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #333;
        font-size: 0.95rem;
        text-decoration: none;
    }

    .blog-filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .blog-filter-btn.active {
        border-color: white;
        box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    .blog-post-item {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .sort-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .blog-sort-select {
        background-color: #333;
        color: white;
        border: 2px solid transparent;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        outline: none;
    }

    .blog-sort-select:hover {
        background-color: #3a3a3a;
        border-color: rgba(255, 255, 255, 0.2);
    }

    .blog-sort-select:focus {
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1);
    }

    @media (max-width: 768px) {
        .blog-card-title {
            font-size: 1.25rem;
        }

        .blog-card-content {
            padding: 1.25rem;
        }

        .filter-container {
            gap: 0.5rem;
        }

        .blog-filter-btn {
            padding: 0.4rem 1rem;
            font-size: 0.875rem;
        }

        .sort-container {
            width: 100%;
            justify-content: space-between;
        }

        .blog-sort-select {
            flex: 1;
            max-width: 200px;
        }
    }
</style>


@endsection