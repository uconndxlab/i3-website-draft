@extends('layouts.app')
@section('title', 'Work')
@section('meta_description', 'Explore our diverse portfolio of web design, web development, and UX design projects at
    i3. See how we create innovative digital solutions for the UConn community.')

@section('content')

    <section id = "into" style="background-color: #111111!important;">
        <div class = "container">
            <h1 class="page-h1">Work</h1>
           <div class="row align-items-center justify-content-center py-5">
                <h2 class="mb-3 d-inline-block pb-3 text-center text-uppercase"><span
                        class="border-bottom border-2 pb-3 border-primary">Featured Work</span></h2>
            </div>

            <div class="row justify-content-center pb-5">
                <div class="col-md-6">
                    <p class="text-center">
                        Our team takes great pride in creating bespoke solutions that make people's lives better. From
                        producing innovative tools that solve complex problems for the university to developing cutting-edge
                        products for principal investigators, we love biting into big challenges. Have a great idea but not
                        sure where to start? We can help you with that, too.
                    </p>
                </div>
            </div>

            <!-- LINKS TOOLS AND SERVICES -->
            <div class="row justify-content-center">
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


            <!-- Featured Carousel -->
            <div class="row justify-content-center py-4 py-5">
                <div class="col-md-8">
                    <div id="featuredCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                        data-bs-interval="5000">
                        <div class="carousel-inner featured-carousel-inner">
                            @foreach ($featured as $index => $item)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="5000">
                                    @php
                                        // Get previous, current, and next items for the 3-item display
                                        $prevIndex = $index > 0 ? $index - 1 : count($featured) - 1;
                                        $nextIndex = $index < count($featured) - 1 ? $index + 1 : 0;
                                        $prevItem = $featured[$prevIndex];
                                        $nextItem = $featured[$nextIndex];
                                    @endphp
                                    <div class="featured-carousel-container">
                                        <div class="featured-item featured-item-left" data-bs-target="#featuredCarousel"
                                            data-bs-slide="prev" role="button" tabindex="0">
                                            @if (!empty($prevItem->best_thumbnail_url))
                                                <img src="{{ $prevItem->best_thumbnail_url }}" alt="{{ $prevItem->title }}"
                                                    class="featured-image">
                                            @endif
                                        </div>
                                        <div class="featured-item featured-item-center">
                                            @if (!empty($item->best_thumbnail_url))
                                                <img src="{{ $item->best_thumbnail_url }}" alt="{{ $item->title }}"
                                                    class="featured-image">
                                            @endif
                                        </div>
                                        <div class="featured-item featured-item-right" data-bs-target="#featuredCarousel"
                                            data-bs-slide="next" role="button" tabindex="0">
                                            @if (!empty($nextItem->best_thumbnail_url))
                                                <img src="{{ $nextItem->best_thumbnail_url }}" alt="{{ $nextItem->title }}"
                                                    class="featured-image">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                        <h3 class="text-dark fw-bold display-5 odometer" data-odometer-final="37" data-aos="odometer">0</h3>
                        <p class="text-muted">Active Projects This Year</p>
                    </dd>
                </div>

                <!-- Stat 2 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-person-workspace" style="font-size: 3rem;" aria-hidden="true"></i>
                    </dt>
                    <dd>
                        <h3 class="text-dark fw-bold display-5 odometer" data-odometer-final="35" data-aos="odometer">0</h3>
                        <p class="text-muted">Different UConn Partners Served (and counting!)</p>
                    </dd>
                </div>

                <!-- Stat 3 -->
                <div class="col-md-3 col-6">
                    <dt class="mb-3">
                        <i class="bi bi-eye" style="font-size: 3rem;" aria-hidden="true"></i>
                    </dt>
                    <dd>
                        <h3 class="text-dark fw-bold display-5 odometer" data-odometer-final="500000" data-aos="odometer">0
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
                        <h3 class="fw-bold display-5 text-dark" data-infinity="true">∞</h3>
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
            <div class="d-flex w-100 justify-content-center align-items-center mt-5">
                <div class="btn display-btn btn-arrow-slide btn-arrow-slide--down">
                    <a href="#in-progress" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                            <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> See What We're Working On </span>
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
            <div class="d-flex w-100 justify-content-center align-items-center mt-5">
                <div class="btn display-btn btn-arrow-slide btn-arrow-slide--down">
                    <a href="#in-progress" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                            <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> See What We're Working On </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="in-progress" class="bg-deep-gradient text-light py-5 position-relative d-flex align-items-center "
        style="min-height: 100vh;">
        <div class="container">

            @php
                $inProgressProjects = collect([
                    (object) [
                        'title' => '2025 Honeycrisp Improvements',
                        'client' => 'OVPR',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => '2025 RIF Improvements',
                        'client' => 'OVPR',
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'V1.5 of the Outreach & Engagement Database',
                        'client' => 'Outreach & Engagement',
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'Botantical Conservatory Website & Database',
                        'client' => 'UConn EEB',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Impact.uconn.edu: Aurora Migration',
                        'client' => 'BPIR',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Farm2School "Compass" Data Collection Tool',
                        'client' => 'CT Fresh Ed',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Sourcery 2025 Launch',
                        'client' => 'Greenhouse Studios',
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'Lincus V2',
                        'client' => "Provost's Office",
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'CT Children with Incarcerated Parents Initiative',
                        'client' => 'IMRP',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Project #ESSY Data Collection/Processing Tool',
                        'client' => 'CSCH',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Centers & Institutes Data Repository',
                        'client' => "Provost's Office",
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'Research Space Planning Dashboard',
                        'client' => "Provost's Office",
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'Healing Hearts Improvements App Improvements',
                        'client' => 'HDFS',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'US Animal Vaccinology Research Coordination Network Members database',
                        'client' => 'CAHNR',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Proteome-X Improvements',
                        'client' => 'Schwartz Lab',
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'PrEPChoices Improvements',
                        'client' => 'Allied Health Sciences',
                        'status' => 'Fall 2025',
                    ],
                    (object) [
                        'title' => 'Puerto Rican Research Consortium',
                        'client' => 'Puerto Rican Research Initiative',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'PR Oral Histories Project',
                        'client' => 'Puerto Rican Research Initiative',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Sing Sing Prison Museum Archive',
                        'client' => 'Sing Sing Prison Museum',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'IAQ Website (Indoor Air Quality Initiative)',
                        'client' => 'Indoor Air Quality Initiative',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Coming out With Care',
                        'client' => 'SOGIE Center',
                        'status' => 'Summer 2025',
                    ],
                    (object) [
                        'title' => 'Mansfield Training & Museum Website',
                        'client' => 'UCHI',
                        'status' => 'Summer 2025',
                    ],
                ]);

                $inProgressProjects = $inProgressProjects->sortBy('title');

                $chunks = $inProgressProjects->chunk(8);
            @endphp

            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">In Progress</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>

            <div class="text-light text-center mx-auto aos-init aos-animate my-4" style="max-width: 600px;"
                data-aos="fade-up">
                <p class="mb-2">
                    <span class="fw-bold display-5 odometer" data-odometer-final="{{ $inProgressProjects->count() }}"
                        data-aos="odometer">0</span>
                    <span class="ms-2">projects currently in progress</span>
                </p>
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
                    @foreach ($chunks as $chunkIndex => $projects)
                        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                            <div class="row g-4 justify-content-center px-3 py-4">
                                @foreach ($projects->chunk(4) as $rowProjects)
                                    <div class="row g-4 w-100">
                                        @foreach ($rowProjects as $project)
                                            <div class="col-md-3 col-12 d-flex">
                                                <div class="position-relative w-100" data-aos="fade-up"
                                                    data-aos-delay="{{ $loop->parent->index * 100 }}">
                                                    <div
                                                        class="bg-white bg-opacity-90 rounded-3 p-4 h-100 border border-light shadow-sm hover-lift d-flex flex-column">
                                                        <div class="d-flex align-items-start mb-3 flex-grow-1">
                                                            <div class="flex-grow-1">
                                                                <span
                                                                    class="badge bg-dark text-white mb-2">{{ $project->status ?? 'In Progress' }}</span>
                                                                <h3 class="fs-6 text-dark mb-2 fw-bold"
                                                                    style="text-shadow: none!important;">
                                                                    {{ $project->title }}</h3>
                                                                <p class="text-muted mb-0 small">
                                                                    {{ $project->client ?? 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                            class="rounded-circle {{ $chunkIndex === 0 ? 'active' : '' }}"
                            aria-current="{{ $chunkIndex === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $chunkIndex + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.min.css" />

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

        /* Featured Carousel Styles */
        .featured-carousel-inner {
            position: relative;
            overflow: hidden;
        }

        #featuredCarousel.carousel-fade .carousel-item {
            opacity: 0;
            transition-property: opacity;
            transform: none;
        }

        #featuredCarousel.carousel-fade .carousel-item.active,
        #featuredCarousel.carousel-fade .carousel-item-next.carousel-item-start,
        #featuredCarousel.carousel-fade .carousel-item-prev.carousel-item-end {
            opacity: 1;
        }

        #featuredCarousel.carousel-fade .active.carousel-item-start,
        #featuredCarousel.carousel-fade .active.carousel-item-end {
            opacity: 0;
        }

        .featured-carousel-container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            gap: 0;
        }

        .featured-item {
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
            cursor: pointer;
            aspect-ratio: 16 / 9;
            /* Trying optimizations idk */
            transform: translateZ(0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .featured-item-left {
            width: 30%;
            opacity: 0.4;
            transform: translateX(-10px) scale(0.85) translateZ(0);
            z-index: 1;
            margin-right: -8%;
        }

        .featured-item-left:hover {
            opacity: 0.6;
            transform: translateX(-5px) scale(0.9) translateZ(0);
        }

        .featured-item-center {
            width: 44%;
            opacity: 1;
            transform: scale(1) translateZ(0);
            z-index: 3;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            cursor: default;
            position: relative;
        }

        .featured-item-right {
            width: 30%;
            opacity: 0.4;
            transform: translateX(10px) scale(0.85) translateZ(0);
            z-index: 1;
            margin-left: -8%;
        }

        .featured-item-right:hover {
            opacity: 0.6;
            transform: translateX(5px) scale(0.9) translateZ(0);
        }

        .featured-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            image-rendering: auto;
            -ms-interpolation-mode: bicubic;
            transform: translateZ(0);
            will-change: transform;
        }

        @media (max-width: 768px) {

            .featured-item-left,
            .featured-item-right {
                width: 25%;
            }

            .featured-item-center {
                width: 50%;
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
