@extends('layouts.app')
@section('title', 'Home')

@section('content')
{{-- Hero Section --}}
<section class="hero-section position-relative text-light d-flex align-items-center" style="height: 80vh;">
    <div class="container position-relative z-2">
        <h1 class="display-1 fw-bold text-outline mb-0">
            INTERNAL<br>
            INSIGHTS &<br>
            INNOVATION
        </h1>
    </div>

    {{-- Optional: subtle background star pattern via CSS or SVG --}}
    <div class="starfield position-absolute top-0 start-0 w-100 h-100 z-1"></div>
</section>

{{-- What We Do Section --}}
<section class="py-5 bg-deep text-light position-relative overflow-hidden">
    <div class="container position-relative">
        <div class="row align-items-center">
            {{-- Left: Text --}}
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="fw-bold mb-3 border-bottom pb-2 border-primary d-inline-block">What We Do</h2>
                <p class="text-secondary">
                    The Internal Insights & Innovation (i3) team provides custom software development, web design,
                    and other digital services in support of improving UConn’s business processes, academic operations,
                    and research enterprise.
                </p>
                <p class="text-secondary">
                    We’re not trying to reinvent the wheel—sometimes, we just help our colleagues find the wheel and use it,
                    making the most of the tools already available at UConn. But when the wheel doesn’t fit the task,
                    we step in with a lean, agile approach—building, testing, and refining solutions that adapt to the university’s evolving needs.
                </p>
            </div>

            {{-- Right: Stat Circle --}}
            <div class="col-lg-6 d-flex justify-content-center position-relative">
                <div class="position-relative text-center" style="width: 220px; height: 220px;">
                    <div class="rounded-circle border border-2 border-light w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                        <div class="fs-2 fw-bold text-accent">30+</div>
                        <div class="text-secondary small">Grant-funded projects</div>
                    </div>
                    <div class="position-absolute top-0 start-50 translate-middle bg-light rounded-circle" style="width: 20px; height: 20px;"></div>
                </div>

                {{-- Vertical Label on Right --}}
                <div class="position-absolute top-50 end-0 translate-middle-y pe-3 d-none d-lg-block">
                    <div class="text-outline text-uppercase fw-bold rotate-text">What We Do</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark text-light py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Featured Work</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @forelse($featuredWork as $item)
                <div class="col">
                    <div class="card bg-secondary text-light h-100 shadow-sm border-0">
                        @if ($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top" alt="{{ $item->title }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                            <p class="card-text small text-muted">{{ Str::limit($item->excerpt, 100) }}</p>
                            <a href="{{ route('work.show', $item) }}" class="mt-auto btn btn-outline-light btn-sm">View Project</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No work items found.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Team Section --}}
<section class="bg-dark text-light py-5 position-relative">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">By the University</h2>
        <div class="text-center mb-4">
            <a href="{{ route('team') }}" class="btn btn-outline-light">Our Team</a>
        </div>

        <div class="position-relative">
            {{-- Left/Right Buttons --}}
            <button class="carousel-btn start-0" onclick="scrollCarousel(-1)">
                ‹
            </button>
            <button class="carousel-btn end-0" onclick="scrollCarousel(1)">
                ›
            </button>

            {{-- Carousel --}}
            <div id="teamCarousel" class="team-carousel d-flex overflow-auto gap-3 px-3 pb-3">
                @foreach($teamMembers as $member)
                    <div class="team-card flex-shrink-0 bg-secondary rounded-4 shadow text-white position-relative"
                         style="width: 240px; scroll-snap-align: start;">
                        @if ($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}"
                                 class="img-fluid rounded-top-4"
                                 style="object-fit: cover; height: 240px; width: 100%;">
                        @endif
                        <div class="p-3">
                            <h6 class="fw-bold mb-1">{{ $member->name }}</h6>
                            <p class="small text-muted mb-2">{{ $member->role }}</p>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($member->tags ?? [] as $tag)
                                    <span class="badge bg-primary">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection
