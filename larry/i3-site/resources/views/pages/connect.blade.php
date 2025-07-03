@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        position: relative;
        overflow: hidden;
        height: 100vh;
    }

    .hero-img-wrapper {
        position: absolute;
        top: -10%;
        left: 0;
        width: 100%;
        height: 120%;
        transform: rotate(-2deg);
        transform-origin: top left;
        z-index: 1;
    }

    .hero-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        height: 100%;
        padding: 2rem;
    }

    .hero-card {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border-radius: 0.75rem;
        padding: 2rem;
        max-width: 500px;
    }

    .hero-card h1 {
        font-size: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hero-card p {
        margin: 1rem 0;
    }

    .hero-button {
        margin-top: 1rem;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background-color: white;
        color: black;
        border: none;
    }

    .hero-button:hover {
        background-color: #eee;
    }

    .hero-icon {
        width: 1.25rem;
        height: 1.25rem;
    }
</style>

<section class="hero-section">
    <div class="hero-img-wrapper">
        <img src="{{ asset('images/hero-placeholder.jpg') }}" alt="Hero background">
    </div>
    <div class="container hero-overlay">
        <div class="hero-card shadow-lg">
            <div class="mb-2 text-muted small">
                <i class="bi bi-geo-alt-fill"></i> Rowe 321
            </div>
            <h1 class="mb-3">Let’s Connect</h1>
            <p>
                All aboard the Rowe Boat! Here at Rowe 321, we're always shipping.
                Conveniently located in the heart of campus (and right by The Beanery), we’re in a great spot for
                students and clients to collaborate. Swing by to check out what we’re working on, hang out on our comfy
                couches, and get a great view of campus!
            </p>
            <button class="hero-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="hero-icon bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555z"/>
                    <path d="M0 4.697v7.104l5.803-3.801L0 4.697zM6.761 8.83 0 13.803V14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.197l-6.761-4.973L8 9.586l-1.239-.757zM16 4.697l-5.803 3.303L16 11.801V4.697z"/>
                </svg>
                Send Us a Message
            </button>
        </div>
    </div>
</section>
@endsection
