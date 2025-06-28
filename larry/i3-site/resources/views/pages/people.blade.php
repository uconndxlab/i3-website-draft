@extends('layouts.app')
@section('title', 'Meet Our Nerds - The i3 Team')

@section('content')

    <style>
        .page-h1 {

            position: fixed;
            text-transform: uppercase;
            transform-origin: center;
            transform: rotate(-90deg);
            position: fixed;
            left: -88px;
            bottom: 50%;
            font-size:88px;
            mix-blend-mode: difference;
            z-index: 9999;
        }
    </style>

    <h1 class="page-h1 display-1">People</h1>

    <section id="people" class=" d-flex align-items-center px-5" style="min-height: 80vh;">

        <div class="container my-5">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">Our</span> People</h2>
            <div class="row">
                @foreach ($people as $person)
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div style="position: relative; width: 100%; padding-top: 125%; overflow: hidden;">
                            <img src="{{ asset('storage/' . $person->photo) }}" alt="{{ $person->name }}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
                        </div>
                        <h3 class="mt-2">{{ $person->name }}</h3>
                        <p>{{ $person->role }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
  







@endsection
