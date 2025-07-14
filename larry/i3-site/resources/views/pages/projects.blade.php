@extends('layouts.app')
@section('title', 'Our Web Design, Web Development, and UX Design Projects')

@section('content')


    <h1 class="page-h1">Projects</h1>
    <section id="the-stats" class="bg-light text-dark d-flex align-items-center px-5 py-5" style="min-height: 90vh;" data-bs-theme="light">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase text-dark" data-aos="fade-down">The Stats
                </h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
            </div>

            <div class="text-dark text-center mx-auto aos-init aos-animate my-4" style="max-width: 600px;"
                data-aos="fade-up">
                <p class="text-dark">
                    We take pride in our work and the impact it has on the UConn community. Here are some
                    stats that might give you a sense for just how varied our workload is.
                </p>
            </div>

            <div class="row d-flex justify-content-center mb-5">
                <div class="col-md-10 offset-md-1">
                    <x-heatmap />
                </div>
            </div>

            <dl class="row text-center g-5 py-5" data-aos="fade-up" >
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

            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-outline-dark shadow-none" href="#in-progress">
                    See What We're Working On
                    <i class="bi bi-arrow-down ms-2"></i>
                </a>
            </div>
        </div>
    </section>
    <section id="in-progress" class="bg-deep-gradient text-light py-5 position-relative d-flex align-items-center"
        style="min-height: 100vh;">
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">In Progress</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>


            <div class="text-light text-center mx-auto aos-init aos-animate my-4" style="max-width: 600px;"
                data-aos="fade-up">
                <p>
                    We've got some exciting work in progress right now. We find ourselves working on all sorts of things for
                    all sorts of people at UConn.
                    We love learning about what makes UConn tick, and we're always looking for ways to help.
                </p>
            </div>


            <!-- Carousel -->
            <div id="onDeckCarousel" class="carousel slide overflow-hidden" style="padding-bottom:55px;"
                data-bs-ride="carousel" data-bs-theme="light">
                <div class="carousel-inner">
                    @php
                        $inProgressProjects = collect([
                            (object) [
                                'title' => '2025 Honeycrisp Improvements',
                                'client' => 'OVPR',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => '2025 RIF Improvements',
                                'client' => 'OVPR',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'V2 of the Outreach & Engagement Database',
                                'client' => 'Outreach & Engagement',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Botantical Conservatory Website & Database',
                                'client' => 'UConn EEB',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Impact.uconn.edu: Aurora Migration',
                                'client' => 'BPIR',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Farm2School Data Collection Tool',
                                'client' => 'CT Fresh Ed',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Sourcery 2025 Launch',
                                'client' => 'Greenhouse Studios',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Lincus V2',
                                'client' => "Provost's Office",
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'CT Children with Incarcerated Parents Initiative',
                                'client' => 'IMRP',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Project #ESSY Data Collection/Processing Tool',
                                'client' => 'CSCH',
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Centers & Institutes Data Repository',
                                'client' => "Provost's Office",
                                'status' => 'Development',
                            ],
                            (object) [
                                'title' => 'Research Space Planning Dashboard',
                                'client' => "Provost's Office",
                                'status' => 'Development',
                            ],
                        ]);

                        $chunks = $inProgressProjects->chunk(4);
                    @endphp
                    @foreach ($chunks as $chunkIndex => $projects)
                        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                            <div class="row g-4 justify-content-center px-3 py-4">
                                @foreach ($projects as $project)
                                    <div class="col-md-3 col-12">
                                        <div class="card h-100 shadow bg-dark text-white" data-aos="fade-up"
                                            data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $project->title }}</h5>
                                                <p class="card-text mb-2">
                                                    {{ $project->client ?? 'N/A' }}
                                                </p>
                                                <span class="badge bg-warning text-dark align-self-start">
                                                    {{ $project->status ?? 'In Progress' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Indicators (dots) -->
                <div class="carousel-indicators mt-4">
                    @foreach ($chunks as $chunkIndex => $projects)
                        <button type="button" data-bs-target="#onDeckCarousel" data-bs-slide-to="{{ $chunkIndex }}"
                            class="{{ $chunkIndex === 0 ? 'active' : '' }}"
                            aria-current="{{ $chunkIndex === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $chunkIndex + 1 }}"></button>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <a class="btn btn-outline-light shadow-none" href="#completed-projects">
                    See Our Completed Projects
                    <i class="bi bi-arrow-down ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section id="completed-projects" class="bg-dark-gradient d-flex px-5 py-5" style="min-height: 80vh;">

        <div class="container my-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="mb-3 d-inline-block pb-3 text-uppercase"><span
                            class="border-bottom border-2 pb-3 border-primary">In</span> Production</h2>
                    <p class="my-4" data-aos="fade-down">
                        In addition to our many in-progress projects, we're proud of our varied portfolio of completed,
                        in-production projects.
                        Each one of these projects represents a collaboration with a UConn partner, new lessons learned, new
                        value created, and a new student learning experience.
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
                                    @if ($project->thumbnail)
                                        <img src="{{ asset('storage/' . $project->thumbnail) }}?v={{ time() }}"
                                            alt="{{ $project->title }}" class="img-fluid rounded mb-3">
                                    @endif
                                    <p>{!! $project->body !!}</p>
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
