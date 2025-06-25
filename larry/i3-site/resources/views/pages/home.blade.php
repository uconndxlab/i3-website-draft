@extends('layouts.app')
@section('title', 'Home')

@section('content')

    {{-- Hero --}}
    <section class="hero-section d-flex align-items-center position-relative text-light" style="min-height: 100vh;">
        <div class="container z-2">
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title mb-4">
                    INTERNAL<br>
                    INSIGHTS &<br>
                    INNOVATION
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

                    <div class="d-flex flex-wrap gap-3 mt-4">
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
    <section id="featured-work" class="bg-deep text-light d-flex align-items-center px-5" style="min-height: 100vh;">
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
    <section id="team" class="bg-deep text-light py-5 d-flex flex-column align-items-center">
        <h2 class=" my-5 border-bottom pb-2 border-primary d-inline-block">...by the university.</h2>

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-8">
                    <p class="text-secondary" data-aos="fade-up" data-aos-delay="100">
                        Our team runs on the talent and drive of UConn students. They're some of the brightest minds around, and they bring serious skill, creativity, and hustle to everything we build.
                    </p>
                    <p class="text-secondary" data-aos="fade-up" data-aos-delay="200">
                        We pair that student energy with professional oversight to deliver real, production-grade work. It’s not just busy work. It’s impact, and it’s powering the university every day.
                    </p>
                    <p class="text-secondary" data-aos="fade-up" data-aos-delay="300">
                        Like UConn itself, we thrive on pride, collaboration, and doing work that matters. When you work with us, you’re getting a team that’s smart, capable, and 100% all in.
                    </p>
                    
                    
                </div>
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



    {{-- Contact --}}
    <section id="contact" class="bg-dark text-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="border-bottom pb-2 border-primary d-inline-block">Connect with Us</h2>
                <p class="text-secondary mt-3" data-aos="fade-up" data-aos-delay="100">
                    Have questions or want to collaborate? Reach out to us using the form below.
                </p>
            </div>

            <div class="row g-5 align-items-center" data-aos="fade-up" data-aos-delay="200">
                {{-- Form --}}
                <div class="col-lg-6">
                    <form method="POST" action="#" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="first_name" class="form-control form-field"
                                    placeholder="First Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="last_name" class="form-control form-field"
                                    placeholder="Last Name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control form-field"
                                placeholder="Email Address">
                        </div>
                        <div class="mb-4">
                            <textarea name="message" class="form-control form-field" rows="4" placeholder="Message"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="cta-button">
                                Send Message
                                <span class="icon-circle"><i class="bi bi-send"></i></span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Map --}}
                <div class="col-lg-6">
                    <div class="map-wrapper rounded-4 overflow-hidden shadow">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2891.9302728446855!2d-72.2535986234634!3d41.8078870712384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e653a1816b64c1%3A0x27a96c91bc2cc02e!2sUConn%20Rowe%20Center%20for%20Undergraduate%20Education!5e0!3m2!1sen!2sus!4v1718737693127!5m2!1sen!2sus"
                            width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>

                        <div class="social-links d-flex justify-content-center gap-3 mt-4">
                            <a href="https://www.linkedin.com/school/university-of-connecticut/" target="_blank"
                                class="text-light fs-4">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/UConn" target="_blank" class="text-light fs-4">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
