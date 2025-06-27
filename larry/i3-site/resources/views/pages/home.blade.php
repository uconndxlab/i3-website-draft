@extends('layouts.app')
@section('title', 'Mobile Apps, Web Apps, UX Design, Web Development, and Web Design')

@section('content')

    {{-- Hero --}}
    <section class="hero-section d-flex align-items-center position-relative text-light" style="min-height: 80vh;">
        <div class="container z-2">
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title mb-4">
                    Internal<br>
                    Insights &<br>
                    Innovation
                </h1>

                <div id="move-text-wrap">
                    <span class="move-text">We</span>
                    <span id="move-text">Do Nerd</span>
                    <span id="move-text-2">Stuff</span>
                    <span id="forUconn" class="move-text">for UConn.</span>
                </div>
            </div>
        </div>
    </section>

    {{-- What We Do --}}
    <section id="what-we-do" class="bg-deep text-light d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3" data-aos="fade-down"><span class="border-bottom border-2 pb-3 border-primary">What</span> We Do</h2>
            <div class="row align-items-top g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <p class="text-light">
                        The Internal Insights & Innovation (i3) team provides custom software development, web design,
                        and other digital services in support of improving UConn’s business processes, academic operations,
                        and research enterprise.
                    </p>
                    <p class="text-light">
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

                <div class="col-lg-5" data-aos="fade-left">
                    @php
                        $directions = ['from-left', 'from-right', 'from-top', 'from-bottom'];
                    @endphp

                    <div class="row">
                        @foreach ([['label' => 'Web Design', 'icon' => 'laptop', 'class' => 'web-design-color'],
                                ['label' => 'UX Design', 'icon' => 'pencil', 'class' => 'ux-design-color'],
                                ['label' => 'App Development', 'icon' => 'phone', 'class' => 'app-development-color'],
                                ['label' => 'Digital Services for Research', 'icon' => 'beaker', 'class' => 'tech-support-color'],
                                ['label' => 'Digital Consulting', 'icon' => 'chat-dots', 'class' => 'digital-consulting-color'],
                                ['label' => 'Custom Tech Solutions', 'icon' => 'tools', 'class' => 'custom-tech-solutions-color']
                                ] as $badge)
                            <div class="col-md-6 mb-3">
                                <div class="service-badge text-light px-3 py-2 rounded-pill shadow-sm {{ $badge['class'] }}"
                                    data-aos="fade" data-aos-duration="1200" data-aos-delay="{{ rand(100, 500) }}"
                                    data-aos-easing="ease-out-back" data-aos-once="true">
                                    <i class="bi bi-{{ $badge['icon'] }} me-2"></i> {{ $badge['label'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="for-uconn" class="bg-dark text-light d-flex align-items-center px-5" style="min-height: 100vh;">
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
    <section id="team" class="bg-teal text-light d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center" data-aos="fade-down">BY THE UNIVERSITY</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
            </div>

            <div class="row py-4 text-center">
                <div class="col-lg-6 offset-3" data-aos="fade-up">
                    <p class="text-light">
                        Our team runs on the talent and drive of UConn students. They're some of the brightest minds around, and they bring serious skill, creativity, and hustle to everything we build.
                    </p>
                    <p class="text-light">
                        We pair that student energy with professional oversight to deliver real, production-grade work. It’s not just busy work. It’s impact, and it’s powering the university every day.
                    </p>
                    <p class="text-light">
                        Like UConn itself, we thrive on pride, collaboration, and doing work that matters. When you work with us, you’re getting a team that’s smart, capable, and 100% all in.
                    </p>

                    <div class="btn display-btn btn-arrow-slide">
                        <a href="#" class="btn-arrow-slide-cont btn-arrow-slide-cont--white" style="width:200px">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text"> View Our Team </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
