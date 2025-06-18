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

                <p class="hero-subtext fs-5">
                    We <span class="text-accent">develop</span>
                    <span class="text-accent-light">apps</span> for
                    <span class="fw-bold">UConn.</span>
                </p>

                <a href="#what-we-do"
                    class="scroll-btn btn btn-outline-light btn-lg rounded-pill px-4 mt-4 d-inline-flex align-items-center gap-2"
                    data-aos="fade-up" data-aos-delay="300">
                    <span>Can you be more specific?</span>
                    <i class="bi bi-arrow-down"></i>
                </a>
            </div>
        </div>

        {{-- Background dots --}}
        <div class="starfield position-absolute top-0 start-0 w-100 h-100 z-0"></div>
    </section>



    {{-- What We Do --}}
    <section id="what-we-do" class="bg-deep text-light d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="mb-3 border-bottom pb-2 border-primary d-inline-block">Web design, digital tools, app
                        development and more...</h2>
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

                    @php
                        $directions = ['from-left', 'from-right', 'from-top', 'from-bottom'];
                    @endphp

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        @foreach ([['label' => 'Web Design', 'icon' => 'laptop', 'color' => 'primary'], ['label' => 'UX Design', 'icon' => 'pencil', 'color' => 'success'], ['label' => 'App Development', 'icon' => 'phone', 'color' => 'warning'], ['label' => 'Tech Support for Sponsored Research', 'icon' => 'beaker', 'color' => 'info'], ['label' => 'Digital Consulting', 'icon' => 'chat-dots', 'color' => 'danger'], ['label' => 'Custom Tech Solutions', 'icon' => 'tools', 'color' => 'secondary']] as $badge)
                            <div class="service-badge bg-{{ $badge['color'] }} text-{{ $badge['color'] === 'warning' ? 'dark' : 'light' }} px-3 py-2 rounded-pill shadow-sm
                            {{ $directions[rand(0, 3)] }}"
                                data-aos="fade" data-aos-duration="1200" data-aos-delay="{{ rand(100, 500) }}"
                                data-aos-easing="ease-out-back" data-aos-once="true">
                                <i class="bi bi-{{ $badge['icon'] }} me-2"></i> {{ $badge['label'] }}
                            </div>
                        @endforeach
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

                <div class="text-center mt-5">
                    <a href="#featured-work"
                        class="scroll-btn btn btn-outline-light btn-lg rounded-pill px-4 d-inline-flex align-items-center gap-2"
                        data-aos="fade-up" data-aos-delay="300">
                        <span>Prove it!</span>
                        <i class="bi bi-arrow-down"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>
    <section id="featured-work" class="bg-dark text-light d-flex flex-column align-items-center">
        <h2 class="my-5 border-bottom pb-2 border-primary d-inline-block">...for the university...</h2>        
        <div class="featured-collage" data-aos="fade-up" data-aos-duration="1000">
            @foreach ($featuredWork as $item)
                <div class="collage-tile" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}">

                    <div class="tile-overlay">
                        <div class="tile-card">
                            <h5 class="tile-title">{{ $item->title }}</h5>
                            <a href="{{ route('work.show', $item) }}" class="btn btn-sm btn-outline-light mt-2">
                                View Project
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex gap-3 my-3">
            <a href="#featured-work"
                class="btn btn-outline-light btn-lg rounded-pill px-4 d-inline-flex align-items-center gap-2">
                <span>See More Work</span>
                <i class="bi bi-arrow-right"></i>
            </a>
            <a href="#team" class="btn btn-outline-light btn-lg rounded-pill px-4 d-inline-flex align-items-center gap-2">
                <span>Meet Our Team</span>
                <i class="bi bi-arrow-down"></i>
            </a>
        </div>
    </section>





    {{-- Team --}}
    <section id="team" class="bg-deep text-light py-5 d-flex flex-column align-items-center">
        <h2 class=" my-5 border-bottom pb-2 border-primary d-inline-block">...by the university.</h2>
    
        <div class="container">
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
                        <button type="submit"
                            class="btn btn-outline-light rounded-pill px-4 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-send"></i>
                            <strong>Send Message</strong>
                        </button>
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
                                <a href="https://www.linkedin.com/school/university-of-connecticut/" target="_blank" class="text-light fs-4">
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
