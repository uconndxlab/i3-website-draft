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
            <div class="row align-items-center justify-content-center mb-3">
                <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Our Leadership</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>

            </div>
            <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                <p>
                    Meet the minds steering i3, turning ideas into action and innovation into impact.
                </p>
            </div>
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


            <div class="row py-3">
                <div class="col-md-12 text-center">
                    <div class="row align-items-center justify-content-center mb-3">
                        <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Faculty Advisors</h2>
                        <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
                    </div>

                    <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                        <p>
                            Faculty advisors play a pivotal role in our journey. They help us recruit talent, provide invaluable mentorship, and connect us with their esteemed colleagues, fostering growth and collaboration.
                        </p>
                    </div>
                </div>
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


            <div class="row">

                <div class="col-md-12 text-center">
                    <div class="row align-items-center justify-content-center mb-3">
                        <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Student Staff</h2>
                        <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
                    </div>

                    <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                        <p>
                            Our student staff are the heart of i3. They bring fresh perspectives, technical skills, and a passion for innovation that drives our projects forward. From app development to research support, they make it happen.
                        </p>
                    </div>

                </div>

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
