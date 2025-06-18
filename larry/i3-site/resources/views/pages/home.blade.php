@extends('layouts.app')
@section('title', 'Home')

@section('content')

    {{-- Hero --}}
    <section class="hero-section d-flex align-items-center justify-content-center text-light position-relative"
        style="min-height: 100vh;">
        <div class="container text-center position-relative z-2">
            <h1 class="display-1 fw-bold text-outline mb-0" data-aos="fade-up" data-aos-duration="1200">
                INTERNAL<br>
                INSIGHTS &<br>
                INNOVATION
            </h1>

            <div class="mt-4">
                <a href="#what-we-do"
                    class="btn btn-outline-light btn-lg d-flex align-items-center justify-content-center gap-2"
                    data-aos="fade-up" data-aos-delay="300">
                    What we Do
                    <i class="bi bi-arrow-down"></i>
                </a>
            </div>
        </div>
        <div class="starfield position-absolute top-0 start-0 w-100 h-100 z-1"></div>
    </section>

    {{-- What We Do --}}
    <section id="what-we-do" class="bg-deep text-light d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="fw-bold mb-3 border-bottom pb-2 border-primary d-inline-block">What We Do</h2>
                    <p class="text-secondary">
                        The Internal Insights & Innovation (i3) team provides custom software development, web design,
                        and other digital services in support of improving UConn’s business processes, academic operations,
                        and research enterprise.
                    </p>
                    <p class="text-secondary">
                        We’re not trying to reinvent the wheel—sometimes, we just help our colleagues find the wheel and use
                        it,
                        making the most of the tools already available at UConn. But when the wheel doesn’t fit the task,
                        we step in with a lean, agile approach—building, testing, and refining solutions that adapt to the
                        university’s evolving needs.
                    </p>

                    <p class="text-secondary">
                        Our work is driven by a commitment to collaboration, innovation, and the pursuit of excellence in
                        everything we do.
                        We believe that by working together, we can create solutions that not only meet the needs of today
                        but also anticipate the challenges of tomorrow.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <div class="service-badge bg-primary text-light px-3 py-2 rounded-pill shadow-sm" data-aos="fade-up"
                            data-aos-duration="800" data-aos-delay="{{ rand(100, 500) }}">
                            <i class="bi bi-laptop me-2"></i> Web Design
                        </div>
                        <div class="service-badge bg-success text-light px-3 py-2 rounded-pill shadow-sm" data-aos="fade-up"
                            data-aos-duration="800" data-aos-delay="{{ rand(100, 500) }}">
                            <i class="bi bi-pencil me-2"></i> UX Design
                        </div>
                        <div class="service-badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm" data-aos="fade-up"
                            data-aos-duration="800" data-aos-delay="{{ rand(100, 500) }}">
                            <i class="bi bi-phone me-2"></i> App Development
                        </div>
                        <div class="service-badge bg-info text-light px-3 py-2 rounded-pill shadow-sm" data-aos="fade-up"
                            data-aos-duration="800" data-aos-delay="{{ rand(100, 500) }}">
                            <i class="bi bi-beaker me-2"></i> Technology Support for Sponsored Research
                        </div>
                        <div class="service-badge bg-danger text-light px-3 py-2 rounded-pill shadow-sm" data-aos="fade-up"
                            data-aos-duration="800" data-aos-delay="{{ rand(100, 500) }}">
                            <i class="bi bi-chat-dots me-2"></i> Digital Consulting
                        </div>
                        <div class="service-badge bg-secondary text-light px-3 py-2 rounded-pill shadow-sm"
                            data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ rand(100, 500) }}">
                            <i class="bi bi-tools me-2"></i> Custom Technology Solutions
                        </div>
                    </div>



                </div>

                <div class="col-lg-6 d-flex justify-content-center position-relative" data-aos="fade-left">
                    <div class="position-relative text-center" style="width: 240px; height: 240px;">
                        <div
                            class="rounded-circle border border-2 border-light w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                            <div class="fs-2 fw-bold text-accent">30+</div>
                            <div class="text-secondary small">Grant-funded projects</div>
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle bg-light rounded-circle"
                            style="width: 20px; height: 20px;"></div>
                    </div>



                </div>

                <div class="col-12 text-center mt-5" data-aos="fade-up" data-aos-delay="200">
                    <a href="#featured-work" class="btn btn-outline-light btn-lg d-flex align-items-center justify-content-center gap-2">
                        View Our Work
                        <i class="bi bi-arrow-down"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- Featured Work --}}
    <section id="featured-work" class="bg-dark text-light d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">
            <h2 class="fw-bold text-center mb-5" data-aos="fade-up">For the University...</h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" data-aos="fade-up" data-aos-delay="100">
                @forelse($featuredWork as $item)
                    <div class="col">
                        <div class="card bg-secondary text-light h-100 shadow-sm border-0">
                            @if ($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top"
                                    alt="{{ $item->title }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                                <p class="card-text small text-muted">{{ Str::limit($item->excerpt, 100) }}</p>
                                <a href="{{ route('work.show', $item) }}" class="mt-auto btn btn-outline-light btn-sm">View
                                    Project</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No work items found.</p>
                @endforelse

                <div class="col">
                    <div class="d-flex align-items-center justify-content-center bg-transparent border border-light rounded-4 h-100 shadow-sm text-light hover-bg-white"
                        style="min-height: 200px;">
                        <a href="#" class="text-light text-decoration-none fw-bold fs-5 d-flex align-items-center gap-2 hover-text-dark">
                            View All Work
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                <a href="#team" class="btn btn-outline-light btn-lg d-flex align-items-center justify-content-center gap-2">
                    Meet Our Team
                    <i class="bi bi-arrow-down"></i>
                </a>
            </div>

        </div>
    </section>

    {{-- Team --}}
    <section id="team" class="bg-deep text-light d-flex align-items-center position-relative" style="min-height: 100vh;">
        <div class="container">
            <h2 class="fw-bold text-center mb-4" data-aos="zoom-in">By the University</h2>
            <div class="text-center mb-5" data-aos="zoom-in" data-aos-delay="100">
                <a href="{{ route('team') }}" class="btn btn-outline-light">Our Team</a>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" data-aos="fade-up" data-aos-delay="200">
                @foreach ($teamMembers as $member)
                    <div class="col">
                        <div class="team-card bg-secondary rounded-4 shadow text-white position-relative h-100">
                            <div class="team-card-inner position-relative w-100 h-100">
                                @if ($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}"
                                        class="img-fluid w-100 h-100 rounded-4" style="object-fit: cover;">
                                @endif
                                <div class="p-3 text-center">
                                    <h6 class="fw-bold mb-1">{{ $member->name }}</h6>
                                    <p class="small text-muted mb-0">{{ $member->role }}</p>
                                    <button class="btn btn-outline-light btn-sm mt-2" data-bs-toggle="modal"
                                        data-bs-target="#memberModal{{ $member->id }}">Learn More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="memberModal{{ $member->id }}" tabindex="-1"
                        aria-labelledby="memberModalLabel{{ $member->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-secondary text-light">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="memberModalLabel{{ $member->id }}">{{ $member->name }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Role:</strong> {{ $member->role }}</p>
                                    <p>{{ $member->bio }}</p>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($member->tags ?? [] as $tag)
                                            <span class="badge bg-primary">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
