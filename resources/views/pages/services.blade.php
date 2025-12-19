@extends('layouts.app')
@section('title', 'Tools')
@section('meta_description', 'Explore our diverse portfolio of web design, web development, and UX design projects at
    i3. See how we create innovative digital solutions for the UConn community.')

@section('content')

<section id="intro">
    <div class="container">
        <h1 class="page-h1">Services</h1>
    </div>
</section>

    <section id="work-with-us" class="bg-deep-gradient py-5">
        <div class="container py-5">

            <div class="row align-items-center justify-content-center py-5">
                <h2 class="mb-3 d-inline-block pb-3 text-center text-uppercase"><span
                        class="border-bottom border-2 pb-3 border-primary">What We Offer</span></h2>
            </div>

            <div class="text-light text-center mx-auto aos-init aos-animate my-4" style="max-width: 600px;"
                data-aos="fade-up">
                <p class="text-center">
                    Nothing makes our team happier than bringing big ideas to fruition. We love meeting new people,
                    learning about their needs, and dreaming up solutions that exceed the status quo. From early
                    discovery & ideation to design and shipping, the i3 team is here to partner with you every step of
                    the way!

                </p>
            </div>

            <div class="row g-5 mt-1 mb-5">
                <div class="col-lg-6 offset-lg-3" data-aos="fade-left">
                    <x-service-badges />
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card bg-primary-subtle text-light shadow-lg border-0">
                        <div class="card-body px-0">
                            <h3 class="card-title text-center mb-4 text-uppercase text-light letter-spacing-1">Fees</h3>
                            <div class="list-group list-group-flush">
                                @foreach ([['label' => 'Director Project Engagement', 'amount' => 158], ['label' => 'Senior App Developer', 'amount' => 120], ['label' => 'Senior UX Designer', 'amount' => 79], ['label' => 'Student Design', 'amount' => 46]] as $fee)
                                    <div
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 border-bottom border-primary-subtle py-3 px-4">
                                        <span>{{ $fee['label'] }}</span>
                                        <span class="fw-bold text-end"
                                            style="min-width: 80px;">${{ $fee['amount'] }}/hr</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>

    <style>
        .tools-top-row {
            margin-left: calc(-100px - 10rem);
        }

        @media (max-width: 768px) {
            .tools-top-row {
                margin-left: calc(-75px - 1rem);
            }

            .tools-top-row img,
            .row.justify-content-center:not(.tools-top-row) img {
                max-width: 150px !important;
            }
        }
    </style>

@endsection
