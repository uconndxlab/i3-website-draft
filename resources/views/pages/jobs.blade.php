@extends('layouts.app')
@section('title', 'Jobs')
@section('meta_description', 'Join the i3 team! We\'re hiring talented individuals to help build digital solutions for the UConn community.')

@section('content')
    <h1 class="page-h1 display-1">Jobs</h1>

    <section class="bg-teal-gradient text-light">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">Open Positions</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>

            <div class="text-light text-center mx-auto aos-init aos-animate my-4" style="max-width: 700px;"
                data-aos="fade-up">
                <p class="fs-5">
We're hiring for 2026! i3 is a small, agile team building digital solutions that actually get used across UConn. We offer hybrid work, high autonomy, and the chance to work directly with faculty and administrators on projects that matter. Whether you're looking to grow your technical skills or take on leadership, there's room to do both here.


                </p>
            </div>

            <div class="row mt-5 g-5 justify-content-center">
                <!-- Web Application Developer Card -->
                <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="position-relative mb-4">
                        <div class="card-outline"></div>
                        <div class="card-content p-4 rounded-3">
                            <i class="bi bi-code-slash display-5 mb-3 text-light"></i>
                            <h3 class="fw-bold mt-3 fs-4">Web Application Developer</h3>
                            <p class="mb-4">
                                Join a fast-paced, collaborative team building custom Laravel-based 
                                web applications. Ideal for developers who enjoy working across projects, 
                                communicating with stakeholders, and using modern tools including 
                                AI-assisted development workflows.
                            </p>
                            <div class="btn display-btn btn-arrow-slide">
                                <a href="{{ route('jobs.web-dev') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                                    <span class="btn-arrow-slide-circle" aria-hidden="true">
                                        <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                                    </span>
                                    <span class="btn-arrow-slide-text">Learn More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Junior Digital Project Specialist Card -->
                <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="position-relative mb-4">
                        <div class="card-outline"></div>
                        <div class="card-content p-4 rounded-3">
                            <i class="bi bi-kanban display-5 mb-3 text-light"></i>
                            <h3 class="fw-bold mt-3 fs-4">Junior Digital Project Specialist</h3>
                            <p class="mb-4">
                                A versatile role combining WordPress development, project coordination, 
                                QA testing, and digital support. Perfect for early-career professionals 
                                seeking hands-on experience across web development and application delivery.
                            </p>
                            <div class="btn display-btn btn-arrow-slide">
                                <a href="{{ route('jobs.project-specialist') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                                    <span class="btn-arrow-slide-circle" aria-hidden="true">
                                        <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                                    </span>
                                    <span class="btn-arrow-slide-text">Learn More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-dark text-light py-5">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center mb-4">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">Why Work at i3?</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>

            <div class="row g-4 mt-3">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center p-4">
                        <i class="bi bi-lightbulb display-4 text-light mb-3"></i>
                        <h4>Innovative Projects</h4>
                        <p class="text-light opacity-75">Work on cutting-edge digital solutions that serve the UConn community and beyond.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center p-4">
                        <i class="bi bi-people display-4 text-light mb-3"></i>
                        <h4>Collaborative Culture</h4>
                        <p class="text-light opacity-75">Join a supportive team environment where ideas are valued and growth is encouraged.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center p-4">
                        <i class="bi bi-graph-up-arrow display-4 text-light mb-3"></i>
                        <h4>Professional Growth</h4>
                        <p class="text-light opacity-75">Develop your skills with real-world projects and mentorship from experienced professionals.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <p class="fs-5 mb-4">Have questions about working at i3?</p>
                <div class="btn display-btn btn-arrow-slide">
                    <a href="{{ route('connect') }}#contact" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                            <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text">Get in Touch</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
