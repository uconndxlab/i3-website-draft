@extends('layouts.app')
@section('title', 'Meet Our Nerds - The i3 Team')

@section('content')

    <style>
        .person-card {
            aspect-ratio: 4 / 5;
            background-color: #000;
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
        }

        .person-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 2;
            bottom: -10px;
            left: 10px;
            border-radius: 0 0 1rem 1rem;



        }

        .person-name-and-role {
            text-shadow: rgba(0, 0, 0, 0.78) 0px 2px 10px;
            background-color: rgba(0, 0, 0, 0.5);
            /* Dark highlight background color */
            padding: 5px;
            /* Add some padding for better appearance */
            border-radius: 5px;
            /* Rounded corners for the highlight */
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
    <h1 class="page-h1 display-1">People</h1>

    <section id="people" class=" d-flex align-items-center px-5" style="min-height: 80vh;">

        <div class="container my-5">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">Our</span> People</h2>
            <div class="row">
                @foreach ($senior_staff as $person)
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative person-card rounded-3">
                            <div class="card-outline"></div>
                            <img src="{{ asset('storage/' . $person->photo) }}" alt="{{ $person->name }}"
                                class="person-photo">
                            <div class="person-overlay text-white p-3">
                                <div class="person-name-and-role">
                                    <h5 class="mb-0 fw-bold">{{ $person->name }}</h5>
                                    <small>{{ $person->role }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h2 class="mt-5 mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">Faculty</span> Advisors</h2>
            <div class="row">
                @foreach ($faculty_advisors as $advisor)
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative person-card rounded-3">
                            <div class="card-outline"></div>
                            <img src="{{ asset('storage/' . $advisor->photo) }}" alt="{{ $advisor->name }}"
                                class="person-photo">
                            <div class="person-overlay text-white p-3">
                                <div class="person-name-and-role">
                                    <h5 class="mb-0 fw-bold">{{ $advisor->name }}</h5>
                                    <small>{{ $advisor->role }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h2 class="mt-5 mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">Student</span> Staff</h2>
            <div class="row">
                @foreach ($student_staff as $student)
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative person-card rounded-3">
                            <div class="card-outline"></div>
                            <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}"
                                class="person-photo">
                            <div class="person-overlay text-white p-3">
                                <div class="person-name-and-role">
                                    <h5 class="mb-0 fw-bold">{{ $student->name }}</h5>
                                    <small>{{ $student->role }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    








@endsection
