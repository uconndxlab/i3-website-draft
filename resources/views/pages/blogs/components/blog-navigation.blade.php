<style>
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
</style>

<div class="blog-navigation">
    <a @if(isset($prevPost) && $prevPost) href="{{ route('blog.show', ['slug' => $prevPost->url_friendly]) }}" @endif
       class="nav-card {{ isset($prevPost) && $prevPost ? '' : 'disabled' }}">
       <div class="icon">
            <i class="bi bi-arrow-left-circle"></i>
        </div>
        <div>
            <span class="label"><i class="bi bi-arrow-left me-2"></i>Previous Post</span>
            <h4>{{ isset($prevPost) && $prevPost ? $prevPost->title : 'No older posts yet' }}</h4>
        </div>
    </a>

    <a @if(isset($nextPost) && $nextPost) href="{{ route('blog.show', ['slug' => $nextPost->url_friendly]) }}" @endif
       class="nav-card {{ isset($nextPost) && $nextPost ? '' : 'disabled' }}">
        <div>
            <span class="label">Next Post<i class="bi bi-arrow-right ms-2"></i></span>
            <h4>{{ isset($nextPost) && $nextPost ? $nextPost->title : 'You\'re all caught up' }}</h4>
        </div>
        <div class="icon">
            <i class="bi bi-arrow-right-circle"></i>
        </div>
    </a>
</div>

