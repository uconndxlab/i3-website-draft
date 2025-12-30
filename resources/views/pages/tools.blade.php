@extends('layouts.app')
@section('title', 'Tools')
@section('meta_description', 'Explore our diverse portfolio of web design, web development, and UX design projects at
    i3. See how we create innovative digital solutions for the UConn community.')

@section('content')

    <div class="container" style="min-height:800px;">
        <h1 class="page-h1">Tools</h1>
        <div class="row align-items-center justify-content-center mb-4 py-5">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase text-center"><span
                    class="border-bottom border-2 pb-3 border-primary">Our Tools</span></h2>
        </div>
        <div class="row justify-content-center py-5">
            <div class="col-md-6">
                <p class="text-center">
                    Built for the university, by the university, and available to all.
                </p>
                <p class="text-center">
                    We are proud to offer a suite of enterprise tools that are already in use throughout the university.
                    Check back often, as our tool belt is always growing as we continue to build unique solutions for and
                    alongside our ever-innovative university community.
                </p>
            </div>
        </div>



        @if ($tools && $tools->count() > 0)
            <div class="row justify-content-center mb-4 mb-md-5 pb-5">
                @foreach ($tools as $tool)
                    <div class="col-12 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if ($tool->best_thumbnail_url)
                            <a href="#toolModal{{ $tool->id }}" data-bs-toggle="modal"
                                data-bs-target="#toolModal{{ $tool->id }}"
                                title="View details for {{ $tool->title }}"
                                aria-label="View details for {{ $tool->title }}"
                                style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; cursor:pointer; display:block;">
                                <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->alt_text ?? $tool->title }}"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
                            </a>

                        @endif
                    </div>
                                                <x-tool-modal :tool="$tool" />
                @endforeach
            </div>
        @endif
    </div>

@endsection
