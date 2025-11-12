@extends('layouts.app')

@php
    $pageTitle = isset($post) ? $post->title : 'Blogs';
    $metaDesc = isset($post) ? ($post->subheader ?: 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity.') : 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity. Learn about our latest projects, events, and updates.';
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDesc)

@if(isset($post))
    @section('og_title')
        {{ $post->title }}
    @endsection

    @section('og_description')
        {{ $post->subheader ?: 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity.' }}
    @endsection

    @section('og_image')
        {{ $post->best_featured_image_url ?? '' }}
    @endsection

    @section('twitter_title')
        {{ $post->title }}
    @endsection

    @section('twitter_description')
        {{ $post->subheader ?: 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity.' }}
    @endsection

    @section('twitter_image')
        {{ $post->best_featured_image_url ?? '' }}
    @endsection

@push('meta')
    @php
        $ogTitle = trim((string) view()->yieldContent('og_title'));
        $ogDescription = trim((string) view()->yieldContent('og_description'));
        $ogImageRaw = trim((string) view()->yieldContent('og_image'));
        $ogImage = $ogImageRaw ? (filter_var($ogImageRaw, FILTER_VALIDATE_URL) ? $ogImageRaw : url($ogImageRaw)) : null;
        
        $ogImageType = 'image/jpeg';
        if ($ogImage) {
            $extension = strtolower(pathinfo(parse_url($ogImage, PHP_URL_PATH), PATHINFO_EXTENSION));
            $imageTypes = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'webp' => 'image/webp',
                'gif' => 'image/gif',
            ];
            $ogImageType = $imageTypes[$extension] ?? 'image/jpeg';
        }
        
        $blogUrl = url(route('blog.show', $post->url_friendly, false));
    @endphp
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ $blogUrl }}">
    <meta property="og:title" content="{{ e($ogTitle) }}">
    <meta property="og:description" content="{{ e($ogDescription) }}">
    <meta property="og:site_name" content="i3 - Internal Insights & Innovation">
    <meta property="og:locale" content="en_US">
    @if($ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:secure_url" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ e($ogTitle) }}">
    <meta property="og:image:type" content="{{ $ogImageType }}">
    @endif
    @if($post->published_at)
    <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    @endif
    @if($post->author)
    <meta property="article:author" content="{{ e($post->author) }}">
    @endif
    @if(is_array($post->tags) && count($post->tags))
        @foreach($post->tags as $tag)
    <meta property="article:tag" content="{{ e($tag) }}">
        @endforeach
    @endif

    @php
        $twitterTitle = trim((string) view()->yieldContent('twitter_title'));
        $twitterDescription = trim((string) view()->yieldContent('twitter_description'));
        $twitterImageRaw = trim((string) view()->yieldContent('twitter_image'));
        // Ensure absolute URL for images
        $twitterImage = $twitterImageRaw ? (filter_var($twitterImageRaw, FILTER_VALIDATE_URL) ? $twitterImageRaw : url($twitterImageRaw)) : null;
    @endphp
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $blogUrl }}">
    <meta name="twitter:title" content="{{ e($twitterTitle) }}">
    <meta name="twitter:description" content="{{ e($twitterDescription) }}">
    @if($twitterImage)
    <meta name="twitter:image" content="{{ $twitterImage }}">
    <meta name="twitter:image:alt" content="{{ e($twitterTitle) }}">
    @endif

    <!-- Additional Meta -->
    <link rel="canonical" href="{{ $blogUrl }}">
@endpush
@endif

@section('content')

<style>

    .blog-post {
        background: transparent;
        padding: 3rem;
        margin-bottom: 3rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .blog-header {
        position: relative;
        margin-bottom: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .blog-featured-image {
        max-width: 100%;
        height: auto;
        max-height: clamp(400px, 60vh, 700px);
        object-fit: contain;
        border-radius: 16px;
        position: relative;
        z-index: 2;
        transform: translate(10px, -10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        background-color: transparent;
        display: block;
        margin: 0 auto;
    }

    /* Outline square effect behind the image */
    .blog-header::after {
        content: '';
        position: absolute;
        border: 4px solid #fff;
        border-radius: 16px;
        z-index: 1;
        pointer-events: none;
    }

    @media (max-width: 992px) {
        .blog-featured-image {
            max-height: clamp(300px, 50vh, 500px);
            transform: translate(6px, -6px);
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.28);
        }

        .blog-header::after {
            border-width: 3px;
            border-radius: 14px;
        }
    }

    @media (max-width: 576px) {
        .blog-featured-image {
            max-height: 400px;
            transform: none;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        /* Hide decorative outline on very small screens to avoid overflow */
        .blog-header::after {
            display: none;
        }
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
        position: relative;
    }


    /* These styles right here will be the actual style of 
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

    
    /* Prevent images from being too small on large screens */
    @media (min-width: 768px) {
        .blog-content img {
            min-width: 25%;
        }
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

    .blog-navigation {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        justify-content: center;
        margin: 4rem 0 3rem;
    }

    .blog-navigation .nav-card {
        flex: 1 1 260px;
        max-width: 340px;
        background: rgba(15, 46, 75, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 18px;
        padding: 1.75rem;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.25);
    }

    .blog-navigation .nav-card:hover {
        transform: translateY(-4px);
        border-color: rgba(56, 189, 248, 0.5);
        box-shadow: 0 18px 36px rgba(56, 189, 248, 0.25);
    }

    .blog-navigation .nav-card.disabled {
        opacity: 0.45;
        cursor: not-allowed;
        pointer-events: none;
        border-color: rgba(255, 255, 255, 0.08);
        box-shadow: none;
    }

    .blog-navigation .nav-card span.label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: rgba(255, 255, 255, 0.6);
        display: block;
        margin-bottom: 0.5rem;
    }

    .blog-navigation .nav-card h4 {
        font-size: 1.15rem;
        font-weight: 600;
        margin: 0;
        color: #fff;
    }

    .blog-navigation .nav-card .icon {
        font-size: 1.4rem;
        color: #38bdf8;
    }

    .decorative-blog-text {
        position: fixed;
        left: -3.5vw;
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
        z-index: 100;
    }

    .style-container {
        width: 100vw;
        height: calc(100% + 2rem + clamp(260px, 55vh, 560px)/2); /* 2rem for footer*/
        background-color: #0f2e4b;
        background: linear-gradient(to bottom, #0f2e4b 0%, #0f2e4b 80%, #111111 100%);
        position: absolute;
        bottom: -2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
    }

    .style-container2 {
        width: 100vw;
        height:100px;
        background-color: #0f2e4b;
        position: absolute;
        bottom: calc(100% + clamp(260px, 55vh, 560px)/2);
        left: 50%;  
        height: 100vh;
        transform: translateX(-50%);
        background: 
            radial-gradient(circle, rgba(255, 255, 255, 0.2) 1.5px, transparent 1.5px),
            linear-gradient(180deg, #051a29 0%, #030a0f 100%);
        background-size: 50px 50px, 100% 100%;
        z-index: -1;
        mask-image: linear-gradient(180deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.8) 20%, rgba(0, 0, 0, 0) 75%);
        -webkit-mask-image: linear-gradient(180deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.8) 20%, rgba(0, 0, 0, 0) 75%);
    }

</style>

<section class=" text-light d-flex align-items-start px-5 py-5">
    
    <div class="decorative-blog-text">BLOG POST</div>
    <div class="container">
        <div class="row align-items-center justify-content-center mb-5">
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                
                @if($post ?? null)
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
                        
                        
                        <h1 class="blog-title-image">{{ $post->title }}</h1>
                        @if($post->subheader)
                            <p class="blog-subheader text-muted">{{ $post->subheader }}</p>
                        @endif
                        @if($post->featured_image && $post->best_featured_image_url)
                        <div class="blog-title-underline"></div>

                        <div class="blog-header" id="blog-header">
                            <img src="{{ $post->best_featured_image_url }}" 
                                    alt="{{ $post->title }}" 
                                    class="blog-featured-image"
                                    id="blog-featured-image">
                        </div>
                        @endif
                        <div class="blog-content">
                            @hasSection('blog-content')
                                @yield('blog-content')
                            @else
                                {!! $post->content !!}
                            @endif
                            <div class="style-container"></div>
                            <div class="style-container2"></div>
                        </div>
                    </article>

                    {{-- Navigation --}}
                    <div class="blog-navigation">
                        <a @if($prevPost) href="{{ route('blog.show', ['slug' => $prevPost->url_friendly]) }}" @endif
                           class="nav-card {{ $prevPost ? '' : 'disabled' }}">
                           <div class="icon">
                                <i class="bi bi-arrow-left-circle"></i>
                            </div>
                            <div>
                                <span class="label"><i class="bi bi-arrow-left me-2"></i>Previous Post</span>
                                <h4>{{ $prevPost->title ?? 'No older posts yet' }}</h4>
                            </div>
                            
                        </a>

                        <a @if($nextPost) href="{{ route('blog.show', ['slug' => $nextPost->url_friendly]) }}" @endif
                           class="nav-card {{ $nextPost ? '' : 'disabled' }}">
                            <div>
                                <span class="label">Next Post<i class="bi bi-arrow-right ms-2"></i></span>
                                <h4>{{ $nextPost->title ?? 'You’re all caught up' }}</h4>
                            </div>
                            <div class="icon">
                                <i class="bi bi-arrow-right-circle"></i>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    // IT really does seem silly that this is needed but it is as far as I cant tell
    // for osme reasons on weird size devices the outline goes wacko mode
    //Bit of a hack but it works for now
    function sizeImageOutline() {
        const img = document.getElementById('blog-featured-image');
        const header = document.getElementById('blog-header');
        
        if (!img || !header) return;
        
        const updateOutline = () => {
            const imgWidth = img.offsetWidth;
            const imgHeight = img.offsetHeight;
            
            if (imgWidth && imgHeight) {
                const isMobile = window.innerWidth <= 992;
                const offset = isMobile ? 6 : 10;
                
                const headerRect = header.getBoundingClientRect();
                const imgRect = img.getBoundingClientRect();
                const imgLeft = imgRect.left - headerRect.left;
                const imgTop = imgRect.top - headerRect.top;
                
                const outlineLeft = imgLeft - offset;
                const outlineTop = imgTop + offset;
                
                const style = document.createElement('style');
                style.textContent = `
                    .blog-header::after {
                        width: ${imgWidth}px !important;
                        height: ${imgHeight}px !important;
                        top: ${outlineTop}px !important;
                        left: ${outlineLeft}px !important;
                    }
                `;
                
                const oldStyle = document.getElementById('dynamic-outline-style');
                if (oldStyle) oldStyle.remove();
                
                style.id = 'dynamic-outline-style';
                document.head.appendChild(style);
            }
        };
        
        if (img.complete) {
            updateOutline();
        } else {
            img.addEventListener('load', updateOutline);
        }
        
        window.addEventListener('resize', updateOutline);
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', sizeImageOutline);
    } else {
        sizeImageOutline();
    }
</script>

@endsection