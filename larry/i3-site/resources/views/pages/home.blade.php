@extends('layouts.app')
@section('title', 'Home')

@section('content')

    {{-- Hero --}}
    <section class="hero-section d-flex align-items-center position-relative text-light" style="min-height: 100vh;">
        <div class="container z-2">
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title mb-4">
                    Internal<br>
                    Insights &<br>
                    Innovation
                </h1>

                <div id="move-text-wrap">
                    <span class="move-text">We</span>
                    <span id="move-text"></span>
                    <span id="move-text-2"></span>
                    <span id="forUconn" class="move-text">for UConn.</span>
                </div>
            </div>
        </div>

        
    </section>



    {{-- What We Do --}}
    <section id="what-we-do" class="bg-deep text-light d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3" data-aos="fade-down"><span class="border-bottom border-2 pb-3 border-primary">WHAT</span> WE DO</h2>
            <div class="row align-items-top g-5">
                <div class="col-lg-6" data-aos="fade-right">
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

                    <div class="btn display-btn btn-arrow-slide">
                      <a href="#" class="btn-arrow-slide-cont btn-arrow-slide-cont--white" style="width:190px">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                          <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> Our Projects </span>
                      </a>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    @php
                        $directions = ['from-left', 'from-right', 'from-top', 'from-bottom'];
                    @endphp

                    <div class="d-flex flex-wrap gap-3">
                        @foreach ([['label' => 'Web Design', 'icon' => 'laptop', 'class' => 'web-design-color'],
                                ['label' => 'UX Design', 'icon' => 'pencil', 'class' => 'ux-design-color'],
                                ['label' => 'App Development', 'icon' => 'phone', 'class' => 'app-development-color'],
                                ['label' => 'Tech Support for Sponsored Research', 'icon' => 'beaker', 'class' => 'tech-support-color'],
                                ['label' => 'Digital Consulting', 'icon' => 'chat-dots', 'class' => 'digital-consulting-color'],
                                ['label' => 'Custom Tech Solutions', 'icon' => 'tools', 'class' => 'custom-tech-solutions-color']
                                ] as $badge)
                            <div class="service-badge text-light px-3 py-2 rounded-pill shadow-sm {{ $badge['class'] }}
                            {{ $directions[rand(0, 3)] }}"
                                data-aos="fade" data-aos-duration="1200" data-aos-delay="{{ rand(100, 500) }}"
                                data-aos-easing="ease-out-back" data-aos-once="true">
                                <i class="bi bi-{{ $badge['icon'] }} me-2"></i> {{ $badge['label'] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="for-uconn" class="bg-deep text-light d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 d-flex justify-content-center position-relative" data-aos="fade-right">
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

                <div class="col-lg-6" data-aos="fade-left">
                                <h2 class="mb-3 d-inline-block pb-3" data-aos="fade-down"><span class="border-bottom border-2 pb-3 border-primary">FOR</span> THE UNIVERSITY</h2>

                    <p class="text-secondary">
                        We work directly with faculty, staff, and researchers to understand real needs and build tools that solve real problems. Sometimes that means shipping quick fixes. Other times it means digging into legacy systems or designing something from scratch. Either way, we stay close to the work, iterate fast, and make sure what we deliver actually helps.                    </p>
                    <p class="text-secondary">
                        We're here to help UConn work smarter. That means replacing expensive vendor tools when we can, streamlining operations, and applying custom technology to reduce friction and improve outcomes. Whether it's administrative processes or research infrastructure, we build with the goal of making the university stronger.
                    </p>

                    <div class="btn display-btn btn-arrow-slide">
                      <a href="#" class="btn-arrow-slide-cont btn-arrow-slide-cont--white" style="width:170px">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                          <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> Our Story </span>
                      </a>
                    </div>
                </div>

                
            </div>
        </div>
    </section>

    {{-- Team --}}
    <section id="team" class="bg-deep text-light d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center" data-aos="fade-down">BY THE UNIVERSITY</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
            </div>

            <div class="row py-4">
                <div class="team-carousel d-flex overflow-auto gap-4 px-3 pb-4" data-aos="fade-up">
                    @foreach ($teamMembers as $index => $member)
                        <div class="team-tile position-relative flex-shrink-0 rounded-4 overflow-hidden shadow"
                            style="width: 220px; height: 300px;" style="--wiggle-index: {{ $index }}">
                            @if ($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" class="w-100 h-100 object-fit-cover">
                            @endif

                            <div class="overlay px-3 py-2">
                                <h6 class="mb-0">{{ $member->name }}</h6>
                                <p class="small text-white-50 mb-1">{{ $member->role }}</p>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($member->tags ?? [] as $tag)
                                        <span class="badge bg-primary text-uppercase small">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- CTA Tile --}}
                    <div class="team-tile cta-tile d-flex flex-column justify-content-center align-items-center text-center flex-shrink-0 rounded-4 shadow border border-light"
                        style="width: 220px; height: 300px;">
                        <a href="{{ route('team') }}" class="text-white text-decoration-none px-3 py-2">
                            <h6 class="mb-2">View Full Team</h6>
                            <span class="badge bg-light text-dark">{{ $totalTeamMembers }} Members</span>
                            <div class="mt-2 text-primary small"><i class="bi bi-arrow-right-circle text-light"></i></div>
                        </a>
                    </div>
                </div>

                
            </div>
        </div>
    </section>


@endsection
