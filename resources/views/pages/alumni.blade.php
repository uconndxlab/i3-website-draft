@extends('layouts.app')
@section('title', 'Alumni')
@section('meta_description', 'Alumni from Squared Labs, DX Lab, DX Group, Greenhouse Studios, and i3. Discover how our former team members are making an impact in the tech industry and beyond.')

@section('content')

<style>
.person-card {
    background-color: transparent;
    border-radius: 1rem;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    position: relative;
}

.person-card .card-outline {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    border: 2px solid white;
    border-radius: 1rem;
    z-index: 0;

}

.person-photo {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;

}

.person-overlay {
    /* position: absolute; */
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 2;
    bottom: -10px;
    left: 10px;
    border-radius: 0 0 1rem 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;


    overflow: hidden;
}

.person-name-and-role {
    text-shadow: rgba(0, 0, 0, 0.78) 0px 2px 10px;
    /* Dark highlight background color */
    padding: 5px;
    /* Add some padding for better appearance */
    border-radius: 5px;
    /* Rounded corners for the highlight */
    padding-left: 10px;
    padding-right: 10px;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    position: relative;
}

.lastname {
    height: 0px;
    opacity: 0;
    transform: translateY(20px);
    overflow: hidden;
    transition:
        opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1),
        height 0.7s cubic-bezier(0.4, 0, 0.2, 1),
        transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.person-role {
    opacity: 0;
    height: 0px;
    transform: translateY(20px);
    overflow: hidden;
    transition:
        opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1),
        height 0.7s cubic-bezier(0.4, 0, 0.2, 1),
        transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.person-card:hover .person-photo,
.person-card:hover .person-overlay {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);

}

.person-card:hover .lastname,
.person-card:hover .person-role {
    display: inline;
    opacity: 1;
    height: auto;
    transform: translateY(0);
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

@endphp

<section role="region" aria-label="Our Leadership" id="senior-staff" class="bg-blue-gradient d-flex align-items-center px-5 py-5" style="min-height: 100vh;">
    <div class="container">
        <div class="row align-items-center justify-content-center mb-3 ">
            <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">i3 Alumni</h2>
            <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                style="width:50px"></span>

        </div>
        <div class="row mt-5">
            @foreach ($alumni as $person)
                <div class="col-md-3 mb-5" data-aos="fade-up">
                    <h3 class="fs-5 mb-1">{{ $person->name }}</h3>
                    <p class="mb-0">{{ $person->role }}</p>
                    @php
                        $matchedTags = collect($person->tags)
                            ->filter(fn($tag) => array_key_exists($tag, $tagmap))
                            ->map(fn($tag) => $tagmap[$tag])
                            ->values();
                    @endphp
                    @if ($matchedTags->isNotEmpty())
                        <p class="text-muted fst-italic mb-0">{{ $matchedTags->join(', ') }}</p>
                    @endif

                    @if ( $person->linkedin )
                        <a href="{{ $person->linkedin }}" target="_blank" rel="noopener noreferrer"
                            class="mb-2" title="LinkedIn Profile for {{ $person->name }}" aria-label="LinkedIn for {{ $person->name }}"><i class="bi bi-linkedin fs-3 text-white" style="text-shadow: 0 2px 6px rgba(0,0,0,0.3);"></i></a>
                    @endif
                </div>
            @endforeach
        </div>
</section>
    <section class="bg-white text-dark d-flex align-items-center py-5 overflow-hidden">


        <div class="container py-5">
            <div class="row justify-content-center align-items-center g-5">
                @foreach (\App\Services\Brands::$brands as $name => $logo)
                    <div class="col-4 col-sm-3 col-md-2 text-center">
                        <img src="{{ asset('img/brands/' . $logo) }}" alt="{{ $name }} logo" title="{{ $name }}"
                             class="img-fluid mb-2" style="max-height: 60px; object-fit: contain;">
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
                Our alumni are out in the real world doing real things: designing digital products, building tools, and shaping the future of technology. For more information about our student workforce, their stories, or their skills, feel free to drop us a line.
            </p>
            <x-slide-button href="{{ route('connect') }}">Connect with Us</x-slide-button>
        </div>
    </div>
</section>
@endsection