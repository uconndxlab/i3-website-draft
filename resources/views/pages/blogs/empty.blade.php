@extends('layouts.app')

@section('title', 'Blogs')
@section('meta_description', 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity. Learn about our latest projects, events, and updates.')

@section('content')
<style>
    .empty-blog-section {
        position: relative;
        padding: 6rem 0;
        color: #fff;
    }

    .empty-blog-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, #0f2e4b 0%, #0f2e4b 75%, #111 100%);
        z-index: -2;
    }

    .empty-blog-section::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(56, 189, 248, 0.25), transparent 45%),
                    radial-gradient(circle at bottom left, rgba(244, 114, 182, 0.18), transparent 40%);
        z-index: -1;
        opacity: 0.9;
    }

    .no-posts-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 420px;
    }

    .no-posts-card {
        background: rgba(15, 46, 75, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        padding: 3rem 3.5rem;
        max-width: 620px;
        width: 100%;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
        backdrop-filter: blur(12px);
    }

    .no-posts-card .icon {
        font-size: 3.5rem;
        color: #38bdf8;
        margin-bottom: 1.5rem;
    }

    .no-posts-card h1 {
        font-size: clamp(2.25rem, 3vw, 2.75rem);
        font-weight: 700;
        margin-bottom: 1rem;
        color: #fff;
    }

    .no-posts-card p {
        color: rgba(255, 255, 255, 0.78);
        margin-bottom: 2rem;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    .no-posts-card .btn-outline-light {
        border-color: rgba(255, 255, 255, 0.45);
        color: #fff;
        padding: 0.75rem 2.25rem;
        border-radius: 999px;
        transition: all 0.2s ease;
    }

    .no-posts-card .btn-outline-light:hover {
        background: #38bdf8;
        border-color: #38bdf8;
        color: #0f2e4b;
    }
</style>

<section class="empty-blog-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="no-posts-wrapper" data-aos="fade-up" data-aos-delay="150">
                    <div class="no-posts-card text-center">
                        <div class="icon">
                            <i class="bi bi-journals"></i>
                        </div>
                        <h1>Fresh Stories Coming Soon</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
