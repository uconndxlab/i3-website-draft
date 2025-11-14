@extends('layouts.app')

@php
    $defaultDescription = 'Read the latest blog from i3, UConn\'s hub of innovation and creativity.';
    $pageTitle = isset($post) ? $post->title : 'Blog';
    $metaDesc = isset($post) 
        ? ($post->subheader ?: $defaultDescription) 
        : $defaultDescription . ' Learn about our latest projects, events, and updates.';
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDesc)

@if(isset($post))
@section('meta')
    @include('pages.blogs.components.blog-meta', ['post' => $post, 'defaultDescription' => $defaultDescription])
@endsection
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
        font-size: clamp(1.75rem, 5vw, 3rem);
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .blog-subheader {
        font-size: clamp(1rem, 2.5vw, 1.25rem);
        font-weight: 400;
        margin-bottom: 1rem;
        opacity: 0.8;
        line-height: 1.4;
    }

    .blog-title-underline {
        height: 4px;
        width: 100px;
        background: #0ea5e9;
        margin-bottom: 4rem;
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


    /* 
    These styles right here will be the actual style of 
    your blog content so the actual text in your post will be styled like this
    This is something we should most likely mess with to make look good
    (I dont wanna mess with it anymore :( CSSad
    */
    .blog-content p:not(.blog-image-caption) {
        margin-bottom: 1.25rem;
        font-size: 1.25rem;
    }

    @media (max-width: 991px) {
        .blog-content {
            font-size: 1rem;
        }
        
        .blog-content p:not(.blog-image-caption) {
            font-size: 1.0625rem;
        }
    }

    .blog-content h1, .blog-content h2, .blog-content h3, .blog-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .blog-content h1 {
        font-size: 2.5rem;
    }

    .blog-content h2 {
        
        padding-top: 4rem;
        font-size: 2rem;
    }

    .blog-content h3 {
        font-size: 1.5rem;
    }

    @media (min-width: 768px) {
        .blog-content img {
            min-width: 25%;
        }
    }

    @media (max-width: 575px) {
        .blog-content img {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            margin: 1.5rem 0 !important;
            float: none !important;
        }
        
        .blog-content .float-lg-start,
        .blog-content .float-lg-end {
            float: none !important;
        }
        
        .blog-content div[style*="width"] {
            width: 100% !important;
            max-width: 100% !important;
        }
        
        .blog-content .me-lg-4,
        .blog-content .ms-lg-4 {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        
        .blog-image-with-caption {
            float: none !important;
            width: 100% !important;
            max-width: 100% !important;
            margin-right: 0 !important;
            margin-bottom: 1.5rem !important;
        }
    }

    @media (min-width: 576px) and (max-width: 991px) {
        .blog-content img {
            max-width: 100% !important;
            height: auto !important;
        }
        
        .blog-content img[style*="width"] {
            max-width: 50% !important;
        }
        
        .blog-content .float-lg-start {
            float: left !important;
            margin-right: 1rem !important;
            margin-bottom: 1rem !important;
        }
        
        .blog-content .float-lg-end {
            float: right !important;
            margin-left: 1rem !important;
            margin-bottom: 1rem !important;
        }
        
        .blog-content div[style*="width"] {
            max-width: 50% !important;
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

    .blog-image-with-caption {
        float: left;
        max-width: 100%;
        margin-right: 1.5rem;
        margin-bottom: 1rem;
    }

    .blog-image-caption {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 0.75rem;
        line-height: 1.5;
        font-style: italic;
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

    @media (max-width: 992px) {
        .decorative-blog-text {
            display: none;
        }
    }

    @media (max-width: 991px) {
        .container {
            max-width: 100% !important;
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
        
        section.px-5 {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
        
        .blog-post {
            padding: 1rem !important;
        }
        
        .blog-content {
            max-width: 100%;
        }
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
            radial-gradient(circle, rgba(255, 255, 255, 0.35) 2px, transparent 2px),
            linear-gradient(180deg, #051a29 0%, #030a0f 100%);
        background-size: 50px 50px, 100% 100%;
        z-index: -1;
        mask-image: linear-gradient(180deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.8) 20%, rgba(0, 0, 0, 0) 75%);
        -webkit-mask-image: linear-gradient(180deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.8) 20%, rgba(0, 0, 0, 0) 75%);
    }

    @media (min-width: 1200px) {
        .style-container2 {
            background: 
                radial-gradient(circle, rgba(255, 255, 255, 0.4) 2.5px, transparent 2.5px),
                linear-gradient(180deg, #051a29 0%, #030a0f 100%);
            background-size: 60px 60px, 100% 100%;
        }
    }

    @media (min-width: 1600px) {
        .style-container2 {
            background: 
                radial-gradient(circle, rgba(255, 255, 255, 0.45) 3px, transparent 3px),
                linear-gradient(180deg, #051a29 0%, #030a0f 100%);
            background-size: 70px 70px, 100% 100%;
        }
    }

</style>

<section class=" text-light d-flex align-items-start px-5 py-5">
    
    <div class="decorative-blog-text">BLOG POST</div>
    <div class="container">
        <div class="row align-items-center justify-content-center mb-5">
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-10">
                
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
                            @yield('blog-content')
                            <div class="style-container"></div>
                            <div class="style-container2"></div>
                        </div>
                    </article>

                    {{-- Navigation --}}
                    @include('pages.blogs.components.blog-navigation', ['prevPost' => $prevPost, 'nextPost' => $nextPost])
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