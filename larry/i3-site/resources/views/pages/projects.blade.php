@extends('layouts.app')
@section('title', 'Our Web Design, Web Development, and UX Design Projects')

@section('content')


    <h1 class="page-h1 display-1">Projects</h1>
    <section id="the-stats" class="bg-light text-dark d-flex align-items-center px-5" style="min-height: 90vh;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase text-dark" data-aos="fade-down">The Stats
                </h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
            </div>
            <dl class="row text-center g-5 py-5" data-aos="fade-up">
                <!-- Stat 1 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-code-slash" style="font-size: 3rem;"></i>
                    </dt>
                    <dd>
                        <h2 class="text-dark fw-bold display-5 odometer" data-odometer-final="37" data-aos="odometer">0</h2>
                        <p class="text-muted">Active Projects This Year</p>
                    </dd>
                </div>

                <!-- Stat 2 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-person-workspace" style="font-size: 3rem;"></i>
                    </dt>
                    <dd>
                        <h2 class="text-dark fw-bold display-5 odometer" data-odometer-final="35" data-aos="odometer">0</h2>
                        <p class="text-muted">Different UConn Partners Served (and counting!)</p>
                    </dd>
                </div>

                <!-- Stat 3 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-eye" style="font-size: 3rem;"></i>
                    </dt>
                    <dd>
                        <h2 class="text-dark fw-bold display-5 odometer" data-odometer-final="500000" data-aos="odometer">0
                        </h2>
                        <p class="text-muted">Pageviews per Month</p>
                    </dd>
                </div>

                <!-- Stat 4 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-cup-hot" style="font-size: 3rem;"></i>
                    </dt>
                    <dd>
                        <h2 class="fw-bold display-5 text-dark" data-infinity="true">∞</h2>
                        <p class="text-muted">Cups of Coffee</p>
                    </dd>
                </div>
            </dl>
        </div>
    </section>
    <section class="bg-deep text-light py-5 position-relative d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">In Progress</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
                <!-- Section Heading -->
                <div class=" mb-5" data-aos="fade-down">
                    <p class="lead px-md-5">
                        We’ve got some exciting work in progress right now. From custom websites to mobile apps,
                        we’re building digital experiences that are thoughtful, creative, and built to perform.
                        Our team is deep in design and development, and this is just a sneak peek at what is to come!
                    </p>
                </div>
            </div>


            <!-- Carousel -->
            <div id="onDeckCarousel" class="carousel slide shadow-lg rounded overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://placehold.co/1200x600" class="d-block w-100" alt="Placeholder Image 1">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Placeholder Caption 1</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://placehold.co/1200x600" class="d-block w-100" alt="Placeholder Image 2">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Placeholder Caption 2</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://placehold.co/1200x600" class="d-block w-100" alt="Placeholder Image 3">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Placeholder Caption 3</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#onDeckCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#onDeckCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section id="completed-projects" class=" d-flex px-5" style="min-height: 80vh;">

        <div class="container my-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="mb-3 d-inline-block pb-3 text-uppercase"><span
                            class="border-bottom border-2 pb-3 border-primary">In</span> Production</h2>
                    <p class="lead mb-4" data-aos="fade-down">
                        These are just a few of the many projects we've brought to life for our partners. 
                        Each one is a unique collaboration, blending creativity, strategy, and technical expertise to deliver results that matter. 
                        Explore our portfolio to see how we help UConn achieve its digital goals.
                    </p>
                </div>
                <div class="col-lg-12 d-flex mb-3 justify-content-between align-items-center">
                    <div>
                        <a class="btn rounded-pill me-3 border-0 shadow-none
                            {{ $tag === 'for-all' ? 'bg-white text-dark' : 'bg-transparent text-white border border-white' }}"
                            href="{{ route('projects.tag', ['tag' => 'for-all']) }}">All</a>
                        <a class="btn rounded-pill me-3 shadow-none
                            {{ $tag === 'for-research' ? 'bg-white text-dark' : 'bg-transparent text-white border border-white' }}"
                            href="{{ route('projects.tag', ['tag' => 'for-research']) }}">For Research</a>
                        <a class="btn rounded-pill shadow-none
                            {{ $tag === 'for-uconn' ? 'bg-white text-dark' : 'bg-transparent text-white border border-white' }}"
                            href="{{ route('projects.tag', ['tag' => 'for-uconn']) }}">For UConn</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($items as $project)
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; cursor:pointer;"
                            data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                            <img src="{{ asset('storage/' . $project->thumbnail) }}?v={{ time() }}"
                                alt="{{ $project->title }}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1"
                        aria-labelledby="projectModalLabel{{ $project->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="projectModalLabel{{ $project->id }}">
                                        {{ $project->title }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($project->image)
                                        <img src="{{ asset('storage/' . $project->image) }}?v={{ time() }}"
                                            alt="{{ $project->title }}" class="img-fluid rounded mb-3">
                                    @endif
                                    <p>{{ $project->body }}</p>
                                    @if ($project->link)
                                        <a href="{{ $project->link }}" target="_blank"
                                            class="btn btn-primary mt-2">Visit Project</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.min.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function animateOdometers() {
                document.querySelectorAll('.odometer').forEach(function(el) {
                    if (el.dataset.animated) return;
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        el.dataset.animated = true;
                        if (el.dataset.infinity) {
                            el.innerHTML = '∞';
                        } else {
                            el.innerHTML = 0;
                            setTimeout(() => {
                                el.innerHTML = el.dataset.odometerFinal;
                            }, 300);
                        }
                    }
                });
            }
            window.addEventListener('scroll', animateOdometers);
            animateOdometers();
        });
    </script>


@endsection
