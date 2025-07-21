@extends('layouts.app')
@section('title', 'Meet Our Nerds - The i3 Team')

@section('content')

    <style>
        .person-card {
            aspect-ratio: 4 / 5;
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
            position: absolute;
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
    <h1 class="page-h1 display-1">People</h1>

    <section role="region" aria-label="Our Leadership" id="senior-staff"
        class="bg-blue-gradient d-flex align-items-center px-5" style="min-height: 80vh;">

        <div class="container">
            <div class="row align-items-center justify-content-center mb-3 ">
                <h2 class="mb-0 d-inline-block pb-2 text-center" data-aos="fade-down">Our Leadership</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>

            </div>
            <div class="text-light text-center mx-auto" style="max-width: 600px;" data-aos="fade-up">
                <p>
                    We're the type of nerds who eat, sleep, and breathe UConn. This team of senior staff members is
                    dedicated to making i3 a hub of innovation and creativity. From leading projects to mentoring students,
                    we are committed to pushing the boundaries of what's possible at UConn.
                </p>
            </div>
            <div class="row justify-content-center">
                @foreach ($senior_staff as $person)
                    <div class="col-md-2 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative person-card rounded-3">
                            <div class="card-outline"></div>
                            @if ($person->linkedin)
                                <a title ="Linkedin Profile for {{ $person->name }}" href="{{ $person->linkedin }}"
                                    target="_blank" rel="noopener" aria-label="LinkedIn"
                                    style="position: absolute; top:20px; right: 20px; z-index: 3;">
                                    <i class="bi bi-linkedin fs-3 text-primary"></i>
                                </a>
                            @endif
                            <img src="{{ asset('storage/' . $person->photo) }}" alt="{{ $person->name }}"
                                class="person-photo">
                            <div class="person-overlay bg-blue-to-transparent text-white p-3 pt-5">
                                <div class="person-name-and-role">
                                    <h3 class="mb-0 fw-bold person-name fs-6">
                                        <span class="firstname">{{ explode(' ', $person->name)[0] }}</span>
                                        <span class="lastname">
                                            {{ implode(' ', array_slice(explode(' ', $person->name), 1)) }}</span>
                                    </h3>
                                    <small class="person-role">{{ $person->role }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section role="region" aria-label="Student Staff" id="students"
        class="d-flex align-items-center px-5 bg-purple-gradient" style="min-height: 80vh;">
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
                            support,they make it happen.
                        </p>
                    </div>

                </div>

                @foreach ($student_staff as $student)
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative person-card rounded-3">
                            <div class="card-outline"></div>

                            @if ($student->linkedin)
                                <a title ="Linkedin Profile for {{ $student->name }}" href="{{ $student->linkedin }}"
                                    target="_blank" rel="noopener" aria-label="LinkedIn"
                                    style="position: absolute; top:20px; right: 20px; z-index: 3;">
                                    <i class="bi bi-linkedin fs-3 text-primary"></i>
                                </a>
                            @endif
                            <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}"
                                class="person-photo">
                            <div class="person-overlay bg-purple-to-transparent pt-5 text-white p-3">
                                <div class="person-name-and-role">
                                    <h3 class="mb-0 fw-bold person-name fs-5">
                                        <span class="firstname">{{ explode(' ', $student->name)[0] }}</span>
                                        <span class="lastname">
                                            {{ implode(' ', array_slice(explode(' ', $student->name), 1)) }}</span>
                                    </h3>
                                    <small class="person-role">{{ $student->role }}</small>
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

                            @if ($person->linkedin)
                                <a title ="Linkedin Profile for {{ $person->name }}" href="{{ $person->linkedin }}"
                                    target="_blank" rel="noopener" aria-label="LinkedIn"
                                    style="position: absolute; top:20px; right: 20px; z-index: 3;">
                                    <i class="bi bi-linkedin fs-3 text-primary"></i>
                                </a>
                            @endif

                            <img src="{{ asset('storage/' . $person->photo) }}" alt="{{ $person->name }}"
                                class="person-photo">
                            <div class="person-overlay bg-dark-to-transparent text-white p-3 pt-5">
                                <div class="person-name-and-role">
                                    <h3 class="mb-0 fw-bold person-name fs-5">
                                        <span class="firstname">{{ explode(' ', $person->name)[0] }}</span>
                                        <span class="lastname">
                                            {{ implode(' ', array_slice(explode(' ', $person->name), 1)) }}</span>
                                    </h3>
                                    <small class="person-role">{{ $person->role }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>






@endsection
