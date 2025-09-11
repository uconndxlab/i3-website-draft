@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<div class="bg-teal-gradient text-light d-flex flex-column align-items-center py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="py-5">
                    {{-- <i class="bi bi-check-circle-fill text-success display-1 mb-4" data-aos="fade-down"></i> --}}
                    <h1 class="display-4 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                        Thank You!
                    </h1>
                    <p class="lead mb-5" data-aos="fade-up" data-aos-delay="200">
                        Your message has been successfully submitted. We appreciate you reaching out to us and will get back to you soon!
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="300">
                <div class="position-relative mb-4">
                    <div class="card-outline"></div>
                    <div class="card-content p-5 rounded-3 text-center">
                        <i class="bi bi-house-door display-6 mb-4"></i>
                        <h5 class="fw-bold mb-3">Back to Home</h5>
                        <p class="mb-4">
                            Explore more about i3 and discover what we're all about.
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-outline-light">
                            Go Home
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="400">
                <div class="position-relative mb-4">
                    <div class="card-outline"></div>
                    <div class="card-content p-5 rounded-3 text-center">
                        <i class="bi bi-people display-6 mb-4"></i>
                        <h5 class="fw-bold mb-3">Connect with Us</h5>
                        <p class="mb-4">
                            Learn more about opportunities and ways to get involved with i3.
                        </p>
                        <a href="{{ route('connect') }}" class="btn btn-outline-light">
                            Connect Page
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize AOS (Animate On Scroll) if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    }
</script>
@endsection
