@extends('layouts.app')
@section('title', 'Alumni')
@section('meta_description', 'Alumni from Squared Labs, DX Lab, DX Group, Greenhouse Studios, and i3. Discover how our
    former team members are making an impact in the tech industry and beyond.')

@section('content')

    <style>
        .person-card {
            background-color: transparent;
            border-radius: 1rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            text-align: center;
            padding: 18px 10px 10px 10px;
        }

        .person-card .card-outline {
            display: none;
        }

        .person-photo {
            width: 100%;
            aspect-ratio: 4 / 5;
            height: auto;
            object-fit: cover;
            border-radius: 1rem;
            margin-bottom: 12px;
            position: static;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            background: #222;
            display: block;
        }

        .person-name {
            font-weight: 600;
            font-size: 1.1em;
            color: #fff;
            margin-bottom: 2px;
        }

        .person-role {
            color: #fff;
            font-size: 0.95em;
            margin-bottom: 2px;
        }

        .person-tags {
            color: #b8c6d1;
            font-size: 0.9em;
            font-style: italic;
            margin-bottom: 2px;
        }

        .person-linkedin {
            display: inline-block;
            margin-top: 4px;
        }
    </style>

    <h1 class="page-h1 display-1">Alumni</h1>

    @php
        $tagmap = [
            'squared-labs' => 'Squared Labs',
            'greenhouse' => 'Greenhouse Studios',
            'i3' => 'i3',
            'dxg' => 'Digital Experience Group',
            'dxl' => 'Digital Experience Lab',
        ];

        $search = request('search');
        $selectedTags = (array) request('tags');
        $filteredAlumni = collect($alumni)->filter(function ($person) use ($search, $selectedTags) {
            $matchesSearch = true;
            $matchesTags = true;
            if ($search) {
                $matchesSearch = stripos($person->name, $search) !== false;
            }
            if (!empty($selectedTags)) {
                $personTags = is_array($person->tags) ? $person->tags : [];
                $matchesTags = !empty(array_intersect($selectedTags, $personTags));
            }
            return $matchesSearch && $matchesTags;
        });
    @endphp

    <section role="region" aria-label="i3 Alumni" id="i3-alumni" class="bg-blue-gradient d-flex align-items-center px-5 py-5"
        style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center justify-content-center mb-3 ">
                <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">i3 Alumni</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>

            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <form id="alumni-filter-form" class="d-flex justify-content-center" hx-get="{{ route('alumni') }}"
                        hx-target="#alumni-grid" hx-trigger="keyup changed delay:200ms" hx-target="#alumni-grid"
                        hx-select="#alumni-grid">
                        <input type="search" name="search" class="form-control form-control-lg text-center"
                            placeholder="Search alumni by name..." style="max-width:500px; font-size:2rem;"
                            value="{{ request('search') }}" autocomplete="off" />
                    </form>
                </div>
            </div>
            <div class="row mt-5 justify-content-center" id="alumni-grid">
                @forelse ($filteredAlumni as $person)
                    <div class="col-6 col-md-3 mb-4" data-aos="fade-up">
                        <div class="person-card">
                            @if ($person->best_image_url)
                                <img src="{{ $person->best_image_url }}" alt="Photo of {{ $person->name }}"
                                    class="person-photo">
                            @endif
                            <div class="person-name">{{ $person->name }}</div>
                            <div class="person-role">{{ $person->role }}</div>
                            @php
                                $matchedTags = collect($person->tags)
                                    ->filter(fn($tag) => array_key_exists($tag, $tagmap))
                                    ->map(fn($tag) => $tagmap[$tag])
                                    ->values();
                            @endphp
                            @if ($matchedTags->isNotEmpty())
                                <div class="person-tags">{{ $matchedTags->join(', ') }}</div>
                            @endif
                            @if ($person->linkedin)
                                <a href="{{ $person->linkedin }}" target="_blank" rel="noopener noreferrer"
                                    class="person-linkedin" title="LinkedIn Profile for {{ $person->name }}"
                                    aria-label="LinkedIn for {{ $person->name }}"><i class="bi bi-linkedin fs-3 text-white"
                                        style="text-shadow: 0 2px 6px rgba(0,0,0,0.3);"></i></a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-light">No alumni found matching your search or filters.</div>
                    </div>
                @endforelse
            </div>
    </section>
    <section class="bg-white text-dark d-flex align-items-center py-5 overflow-hidden">


        <div class="container py-5">
            <div class="row justify-content-center align-items-center g-5">
                @foreach (\App\Services\Brands::$brands as $name => $logo)
                    <div class="col-4 col-sm-3 col-md-2 text-center">
                        <img src="{{ asset('img/brands/' . $logo) }}" alt="{{ $name }} logo"
                            title="{{ $name }}" class="img-fluid mb-2"
                            style="max-height: 60px; object-fit: contain;">
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <section class="bg-dark text-light">

        <div class="container py-5">

            <div class="row align-items-center justify-content-center my-5">
                <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Looking for More?</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>

            </div>
            <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                <p>
                    Our alumni are out in the real world doing real things: designing digital products, building tools, and
                    shaping the future of technology. For more information about our student workforce, their stories, or
                    their skills, feel free to drop us a line.
                </p>
                <x-slide-button href="{{ route('connect') }}">Connect with Us</x-slide-button>
            </div>
        </div>
    </section>
@endsection
