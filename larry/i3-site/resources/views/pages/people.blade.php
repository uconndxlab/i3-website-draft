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

    <section id="senior-staff" class="bg-blue-gradient d-flex align-items-center px-5" style="min-height: 80vh;">

        <div class="container">
            <div class="row align-items-center justify-content-center mb-3 ">
                <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Our Leadership</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>

            </div>
            <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                <p>
                    We're the type of nerds who eat, sleep, and breathe UConn. This team of senior staff members is
                    dedicated to making i3 a hub of innovation and creativity. From leading projects to mentoring students,
                    we are committed to pushing the boundaries of what's possible at UConn.
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
        </div>
    </section>

    <section id="faculty-advisors" class="d-flex align-items-center px-5 bg-deep-gradient" style="min-height: 80vh;">
        <div class="container">
            <div class="row align-items-center justify-content-center mb-3 ">
                <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Our Faculty Advisors</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>
            <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                <p>
                    Our faculty advisors are the backbone of i3, providing invaluable guidance and support. They bring a
                    wealth of knowledge and experience to our team, helping us navigate challenges and seize opportunities.
                </p>
                <p>Interested in becoming a faculty advisor? <a class="text-white fw-bold"
                        href="{{ route('connect') }}">Connect with us</a> to learn more about how you can get involved.</p>

            </div>
            <div class="row justify-content-center">
                @foreach ($faculty_advisors as $person)
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
        </div>
    </section>
    <section id="students" class="d-flex align-items-center px-5 bg-purple-gradient" style="min-height: 80vh;">
        <div class="container">


            <div class="row align-items-center justify-content-center mb-3 ">

                <div class="col-md-12 text-center">
                    <div class="row align-items-center justify-content-center mb-3">
                        <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Student Staff</h2>
                        <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                            style="width:50px"></span>
                    </div>

                    <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                        <p>
                            Our student staff are the heart of i3. They bring fresh perspectives, technical skills, and a
                            passion for innovation that drives our projects forward. From app development to research
                            support,
                            they make it happen.
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
