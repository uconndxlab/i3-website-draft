@extends('layouts.app')
@section('title', 'Our Web Design, Web Development, and UX Design Projects')

@section('content')


    <h1 class="page-h1 display-1">Projects</h1>

    <section id="completed-projects" class=" d-flex align-items-center px-5" style="min-height: 80vh;">

        <div class="container my-5">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">Completed</span> Projects</h2>
            <div class="d-flex mb-3 justify-content-between align-items-center">
                <div>
                    <a class="btn btn-outline-primary me-3 bg-white" href="#">For Research</a>
                    <a class="btn btn-dark" href="#">For UConn</a>
                </div>
                <!-- Filter Modal Trigger -->
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#filterModal">
                    Filter Projects
                </button>

                <!-- Filter Modal -->
                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">Filter Projects</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="filterForm">
                                    <div class="mb-3">
                                        <label for="categoryFilter" class="form-label">Category</label>
                                        <select class="form-select" id="categoryFilter" name="category">
                                            <option value="">All Categories</option>
                                            <option value="web-design">Web Design</option>
                                            <option value="web-development">Web Development</option>
                                            <option value="ux-design">UX Design</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateFilter" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="dateFilter" name="date">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="applyFilters">Apply Filters</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                @foreach ($items as $project)
                @dump($project)
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden;">
                            <img src="{{ asset('storage/' . $project->thumbnail) }}?v={{ time()}}" alt="{{ $project->title }}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;  border-radius:10px;">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $items->links() }}
            </div>

            <div class="text-center mt-5">
                <div class="btn display-btn btn-arrow-slide">
                    <a href="#" class="btn-arrow-slide-cont btn-arrow-slide-cont--white" style="width:190px">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                            <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> More Projects </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="the-stats" class="bg-light text-dark d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <div class="row text-center g-5 py-5" data-aos="fade-up">
                <!-- Stat 1 -->
                <div class="col-md-3 col-6">
                    <div class="mb-3">
                        <svg width="48" height="48" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
                            <path d="M10.478 1.647a.5.5 0 0 1 .318.63l-3 10a.5.5 0 0 1-.948-.29l3-10a.5.5 0 0 1 .63-.318zM4.854 4.146a.5.5 0 0 0-.708.708L6.293 7.5 4.146 9.646a.5.5 0 0 0 .708.708L7.707 7.5 4.854 4.146zm6.292 0a.5.5 0 0 1 .708.708L9.707 7.5l2.147 2.146a.5.5 0 0 1-.708.708L8.293 7.5l2.853-2.854z"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold display-5">37</h2>
                    <p class="text-muted">Projects This Year</p>
                </div>
            
                <!-- Stat 2 -->
                <div class="col-md-3 col-6">
                    <div class="mb-3">
                        <svg width="48" height="48" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path d="M9 6a3 3 0 1 0-2 0v1H3.5A1.5 1.5 0 0 0 2 8.5v.55l.342 2.737a2.5 2.5 0 0 0 .625 1.34l.683.76A1 1 0 0 0 4.464 15h7.072a1 1 0 0 0 .814-.413l.683-.76a2.5 2.5 0 0 0 .625-1.34L14 9.05v-.55A1.5 1.5 0 0 0 12.5 7H9V6z"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold display-5">15</h2>
                    <p class="text-muted">Different UConn Departments Served</p>
                </div>
            
                <!-- Stat 3 -->
                <div class="col-md-3 col-6">
                    <div class="mb-3">
                        <svg width="48" height="48" fill="currentColor" class="bi bi-lightbulb" viewBox="0 0 16 16">
                            <path d="M2 6a6 6 0 1 1 11.09 2.64c-.138.18-.281.356-.43.53a5.578 5.578 0 0 0-.741.9c-.318.442-.552.942-.705 1.468a.5.5 0 0 1-.472.362H5.258a.5.5 0 0 1-.472-.362 5.28 5.28 0 0 0-.705-1.468 5.578 5.578 0 0 0-.741-.9 7.003 7.003 0 0 1-.43-.53A6.002 6.002 0 0 1 2 6z"/>
                            <path d="M6.5 14a1.5 1.5 0 0 0 3 0h-3z"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold display-5">10,000</h2>
                    <p class="text-muted">Pageviews per Month</p>
                </div>
            
                <!-- Stat 4 -->
                <div class="col-md-3 col-6">
                    <div class="mb-3">
                        <svg width="48" height="48" fill="currentColor" class="bi bi-cup-hot" viewBox="0 0 16 16">
                            <path d="M.5 6a.5.5 0 0 0-.5.5c0 .638.14 1.243.383 1.793C.802 9.812 2.1 12.25 8 12.25s7.198-2.438 7.617-3.957A4.992 4.992 0 0 0 16 6.5a.5.5 0 0 0-.5-.5h-15zm1.02 1h13.96c-.066.322-.16.633-.278.933C13.713 9.327 12.532 11.25 8 11.25S2.287 9.327 1.798 7.933A3.99 3.99 0 0 1 1.52 7z"/>
                            <path d="M4.5 0a.5.5 0 0 1 .5.5v2c0 .128.05.256.146.354l.708.708a.5.5 0 0 1-.708.708L4.5 3.707V.5a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v2c0 .128.05.256.146.354l.708.708a.5.5 0 0 1-.708.708L7.5 3.707V.5a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v2c0 .128.05.256.146.354l.708.708a.5.5 0 0 1-.708.708L10.5 3.707V.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold display-5">∞</h2>
                    <p class="text-muted">Cups of Coffee</p>
                </div>
            </div>
            
        </div>
    </section>

    <section class="bg-deep text-light py-5 position-relative d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">
            <!-- Section Heading -->
            <div class=" mb-5" data-aos="fade-down">
                <h2 class="mb-3 text-center fw-bold">ON DECK</h2>
                <p class="lead px-md-5">
                    We’ve got some exciting work in progress right now. From custom websites to mobile apps,
                    we’re building digital experiences that are thoughtful, creative, and built to perform.
                    Our team is deep in design and development, and this is just a sneak peek at what is to come!
                </p>
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
    

    <section class="news-section py-5 bg-light text-dark">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase text-dark" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">In The</span> News</h2>
            <div class="row g-4" data-aos="fade-up" data-aos-duration="1200">
                {{-- Example cards, replace with dynamic content --}}
                @for ($i = 0; $i < 5; $i++)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card text-white border-0 shadow-sm overflow-hidden rounded-4">
                            <img src="https://picsum.photos/600/40{{ $i }}" class="card-img"
                                alt="placeholder image">
                            <div class="card-img-overlay d-flex flex-column justify-content-end bg-dark bg-opacity-50 p-3">
                                <h5 class="card-title fw-bold">Title of Article</h5>
                                <p class="card-text small mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et nunc non eros congue
                                    tincidunt.
                                </p>
                                <p class="card-text small text-white-50 mb-0">
                                    <strong>Author of Article</strong> • 01/02/3456
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>






@endsection
