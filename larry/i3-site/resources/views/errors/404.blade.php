@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="bg-deep-gradient text-light d-flex flex-column align-items-center justify-content-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="py-5">
                    {{-- Large 404 text --}}
                    <div class="display-1 fw-bold mb-4" style="font-size: 8rem; line-height: 1; opacity: 0.9;" data-aos="fade-down">
                        404
                    </div>
                    
                    {{-- Error message --}}
                    <h1 class="display-4 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                        Page Not Found
                    </h1>
                    
                    <p class="lead mb-5 opacity-75" data-aos="fade-up" data-aos-delay="200">
                        Sorry, the page you are looking for doesn't exist or has been moved. 
                        Let's get you back on track.
                    </p>
                </div>
            </div>
        </div>

        {{-- Action buttons --}}
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                    {{-- Home button --}}
                    <a href="{{ route('home') }}" class="btn btn-outline-light px-4 py-3">
                        <i class="bi bi-house-door me-2"></i>
                        Go to Homepage
                    </a>
                    
                    {{-- Go back button --}}
                    <button onclick="history.back()" class="btn btn-outline-light px-4 py-3">
                        <i class="bi bi-arrow-left me-2"></i>
                        Go Back
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-opacity-100:hover {
        opacity: 1 !important;
        transition: opacity 0.3s ease;
    }
</style>
@endsection