@extends('layouts.app')
@section('title', 'Work')
@section('meta_description', 'Explore our diverse portfolio of web design, web development, and UX design projects at
    i3. See how we create innovative digital solutions for the UConn community.')

@section('content')

    <section id = "into" style="background-color: #111111!important;">
        <div class = "container pt-5">
            <h1 class="page-h1">Work</h1>
           

            <div class="row justify-content-center py-5 pb-4">
                <div class="col-md-6">
                    <p class="text-center mb-0">
                        Our team takes great pride in creating bespoke solutions that make people's lives better. From
                        producing innovative tools that solve complex problems for the university to developing cutting-edge
                        products for principal investigators, we love biting into big challenges. Have a great idea but not
                        sure where to start? We can help you with that, too.
                    </p>
                </div>
            </div>

            <!-- LINKS TOOLS AND SERVICES -->
            <div class="row justify-content-center mb-5">
                <div class="text-center d-flex flex-md-row flex-column align-items-center justify-content-center gap-4">
                    <!-- TOOLS LINKS -->
                    <div class="btn display-btn btn-arrow-slide">
                        <a href="{{ route('work.tools') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text">Tools</span>
                        </a>
                    </div>
                    <!-- SERVICES LINKS -->
                    <div class="btn display-btn btn-arrow-slide">
                        <a href="{{ route('work.services') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text">Services</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center py-5">
                <h2 class="mb-3 d-inline-block pb-3 text-center text-uppercase"><span
                        class="border-bottom border-2 pb-3 border-primary">Featured Work</span></h2>
            </div>


            <!-- Featured Carousel - SwiperJS with Coverflow -->
            <div class="pb-5 mb-5">
                <div class="col-md-10 mx-auto">
                    <div class="swiper featuredSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($featured as $index => $item)
                                <div class="swiper-slide" data-bs-target="#projectModal{{ $item->id }}" data-bs-toggle="modal" aria-hidden="true">
                                    @if (!empty($item->best_thumbnail_url))
                                        <img src="{{ $item->best_thumbnail_url }}" alt="{{ $item->title }}"
                                            class="featured-image">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination dots -->
                        <div class="swiper-pagination d-block position-relative top-0 mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--PRE EXSITING NEW HEADER 12/2/25-->
    <section id="the-stats" class="bg-light text-dark d-flex align-items-center px-5 py-5"
        style="min-height: 90vh;"data-bs-theme="light">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase text-dark" data-aos="fade-down">The Stats
                </h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>

            <div class="text-dark text-center mx-auto aos-init aos-animate my-4" style="max-width: 600px;"
                data-aos="fade-up">
                <p class="text-dark">
                    We take pride in our work and the impact it has on the UConn community. Here are some
                    stats that might give you a sense for just how varied our workload is.
                </p>
            </div>



            <dl class="row text-center g-5 py-5" data-aos="fade-up">
                <!-- Stat 1 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-code-slash" style="font-size: 3rem;" aria-hidden="true"></i>
                    </dt>
                    <dd>
                        <h3 class="text-dark fw-bold display-5 odometer text-nowrap" data-odometer-final="37" data-aos="odometer">0</h3>
                        <p class="text-muted">Active Projects This Year</p>
                    </dd>
                </div>

                <!-- Stat 2 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-person-workspace" style="font-size: 3rem;" aria-hidden="true"></i>
                    </dt>
                    <dd>
                        <h3 class="text-dark fw-bold display-5 odometer  text-nowrap" data-odometer-final="35" data-aos="odometer">0</h3>
                        <p class="text-muted">Different UConn Partners Served (and counting!)</p>
                    </dd>
                </div>

                <!-- Stat 3 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-eye" style="font-size: 3rem;" aria-hidden="true"></i>
                    </dt>
                    <dd>
                        <h3 class="text-dark fw-bold display-5 odometer text-nowrap" data-odometer-final="500000" data-aos="odometer">0
                        </h3>
                        <p class="text-muted">Pageviews per Month</p>
                    </dd>
                </div>

                <!-- Stat 4 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-cup-hot" style="font-size: 3rem;" aria-hidden="true"></i>
                    </dt>
                    <dd>
                        <h3 class="fw-bold display-5 text-dark text-nowrap" data-infinity="true">∞</h3>
                        <p class="text-muted">Cups of Coffee</p>
                    </dd>
                </div>
            </dl>

            <div class="row d-flex justify-content-center mb-5">
                <div class="col-xl-10 offset-xl-1">
                    <x-heatmap />
                </div>
                <div class="text-muted small text-center mt-3" data-aos="fade-up">
                    <em>
                        Note: this doesn't include repositories outside our core organization (of which there are a few),
                        nor
                        does it include projects that don't have repositories!
                    </em>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-center align-items-center">
                <div class="btn display-btn btn-arrow-slide btn-arrow-slide--down">
                    <a href="#completed-projects" class="btn-arrow-slide-cont btn-arrow-slide-cont--blue">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                            <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> See Our Completed Projects </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="completed-projects" class="bg-dark-gradient d-flex px-5 py-5 " style="min-height: 80vh;">

        <div class="container my-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="mb-3 d-inline-block pb-3 text-uppercase"><span
                            class="border-bottom border-2 pb-3 border-primary">Launched</span> </h2>
                    <p class="my-4" data-aos="fade-down">
                        In addition to our many in-progress projects, we're proud of our varied portfolio of completed,
                        launched projects.
                        Each one of these projects represents a collaboration with a UConn partner, new lessons learned, new
                        value created, and a new student learning experience.
                    </p>
                </div>

            </div>
            <div class="row" id="project-grid">
                <div class="col-lg-12 d-flex mb-3 justify-content-between align-items-center">
                    <div>
                        <a class="btn rounded-pill me-3 border-0 shadow-none
                        {{ $tag === 'for-all' ? 'bg-white text-dark' : 'bg-transparent text-white border border-white' }}"
                            hx-get="{{ route('projects.tag', ['tag' => 'for-all', '#completed-projects']) }}"
                            hx-target="#project-grid" hx-swap="innerHTML" hx-push-url="true" hx-select="#project-grid"
                            href="{{ route('projects.tag', ['tag' => 'for-all', '#completed-projects']) }}">All</a>
                        <a class="btn rounded-pill me-3 shadow-none
                        {{ $tag === 'for-research' ? 'bg-white text-dark' : 'bg-transparent text-white border border-white' }}"
                            hx-get="{{ route('projects.tag', ['tag' => 'for-research', '#completed-projects']) }}"
                            hx-target="#project-grid" hx-swap="innerHTML" hx-push-url="true" hx-select="#project-grid"
                            href="{{ route('projects.tag', ['tag' => 'for-research', '#completed-projects']) }}">For
                            Research</a>
                        <a class="btn rounded-pill shadow-none
                        {{ $tag === 'for-uconn' ? 'bg-white text-dark' : 'bg-transparent text-white border border-white' }}"
                            hx-get="{{ route('projects.tag', ['tag' => 'for-uconn', '#completed-projects']) }}"
                            hx-target="#project-grid" hx-swap="innerHTML" hx-push-url="true" hx-select="#project-grid"
                            href="{{ route('projects.tag', ['tag' => 'for-uconn', '#completed-projects']) }}">For
                            UConn</a>
                    </div>
                </div>
                @foreach ($items as $project)
                    <div class="col-12 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="#projectModal{{ $project->id }}" data-bs-toggle="modal"
                            data-bs-target="#projectModal{{ $project->id }}"
                            title="View details for {{ $project->title }}"
                            aria-label="View details for {{ $project->title }}"
                            style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; cursor:pointer; display:block;">
                            <img src="{{ $project->best_thumbnail_url }}?v={{ time() }}"
                                alt="{{ $project->title }}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
                        </a>
                    </div>

                    <x-work-modal :project="$project" />
                @endforeach
                @if ($items->isEmpty())
                    <div class="col-12 text-center pt-5">
                        <p class="text-muted fst-italic">No projects found for this tag.</p>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <style>
        .btn-circle-white {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ffffff;
            color: #111111;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            padding: 0;
        }

        .btn-circle-white:hover {
            background-color: #f0f0f0;
            transform: scale(1.1);
            color: #111111;
        }

        .btn-circle-white i {
            font-size: 1.5rem;
            font-weight: 1000;
            line-height: 1;
            color: #111111;
        }

        .featured-heading {
            position: relative;
            display: inline-block;
            padding-bottom: 0.5rem;
        }

        /* The blue dash below the feature header */
        .featured-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background-color: #4DB3FF;
        }

        /* SwiperJS Featured Carousel Styles */
        .featuredSwiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 80px;
            overflow: visible;
        }

        .featuredSwiper .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 500px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .featuredSwiper .swiper-slide:hover {
            transform: scale(1.02);
        }

        .featuredSwiper .swiper-slide img {
            display: block;
            width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .featuredSwiper .swiper-pagination {
            bottom: 20px;
        }

        .featuredSwiper .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            transition: all 0.3s ease;
        }

        .featuredSwiper .swiper-pagination-bullet-active {
            background: #4DB3FF;
            width: 14px;
            height: 14px;
        }

        @media (max-width: 768px) {
            .featuredSwiper .swiper-slide {
                width: 300px;
            }
        }

        /* This is before you 12/2/25 */
        #onDeckCarousel .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background-color: transparent;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        #onDeckCarousel .carousel-indicators button.active {
            background-color: white;
            border-color: white;
        }

        #onDeckCarousel .carousel-indicators button:hover {
            background-color: rgba(255, 255, 255, 0.7);
            border-color: rgba(255, 255, 255, 0.8);
        }

        #onDeckCarousel .carousel-item .row {
            min-height: 200px;
        }

        #onDeckCarousel .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        #onDeckCarousel .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        #onDeckCarousel .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>

    @vite(['resources/js/swiperCarousel.js', 'resources/js/odometerAnimation.js'])

@endsection
