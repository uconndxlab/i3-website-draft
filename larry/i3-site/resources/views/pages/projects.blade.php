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
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Filter Projects
                </button>

                <!-- Filter Modal -->
                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">Filter Projects</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden;">
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}"
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

        </div>
    </section>

    <section class="bg-deep on-deck-section text-light py-5 position-relative align-items-center d-flex"
        style="min-height: 100vh;">
        <div class="container text-center mb-5">
            <h2 class="mb-3 d-inline-block pb-3 text-center" data-aos="fade-down">ON DECK</h2>
            <p class="lead px-md-5">
                We’ve got some exciting work in progress right now. From custom websites to mobile apps,
                we’re building digital experiences that are thoughtful, creative, and built to perform.
                Our team is deep in design and development, and this is just a sneak peek at what is to come!
            </p>
        </div>

        <div class="position-relative d-flex justify-content-center">
            <!-- Background mockups -->
            <div class="bg-layer position-absolute" style="z-index: 0; left: 5%; top: 20%; opacity: 0.2;">
                <img src="/images/mockup-1.png" class="img-fluid rounded" style="max-width: 300px;">
            </div>
            <div class="bg-layer position-absolute" style="z-index: 0; right: 5%; top: 25%; opacity: 0.2;">
                <img src="/images/mockup-2.png" class="img-fluid rounded" style="max-width: 300px;">
            </div>

            <!-- Foreground carousel -->
            <div id="onDeckCarousel" class="carousel slide z-1" data-bs-ride="carousel" style="max-width: 700px;">
                <div class="carousel-inner rounded shadow overflow-hidden">
                    <div class="carousel-item active">
                        <img src="/images/featured-project-1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/images/featured-project-2.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <div class="carousel-indicators mt-4">
                    <button type="button" data-bs-target="#onDeckCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true"></button>
                    <button type="button" data-bs-target="#onDeckCarousel" data-bs-slide-to="1"></button>
                </div>
            </div>
        </div>
    </section>

    <section class="news-section py-5 bg-light text-dark">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">Completed</span> Projects</h2>
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
