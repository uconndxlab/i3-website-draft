@extends('layouts.app')

@section('content')
    <h1 class="page-h1 display-1">Connect</h1>
    <style>
        .hero-section {
            position: relative;
            overflow: hidden;
            min-height: 60vh;
            z-index: 999;
            display: flex;
            align-items: center;
        }

        .hero-img-wrapper {
            position: absolute;
            top: -10%;
            left: 0;
            width: 100%;
            height: 120%;
            transform: rotate(-2deg);
            transform-origin: top left;
            z-index: 1;
        }

        .hero-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            height: 100%;
            padding: 2rem;
        }

        .hero-card {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 0.75rem;
            padding: 2rem;
            max-width: 500px;
        }

        .hero-card h1 {
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-card p {
            margin: 1rem 0;
        }

        .hero-button {
            margin-top: 1rem;
            font-weight: 600;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: white;
            color: black;
            border: none;
        }

        .hero-button:hover {
            background-color: #eee;
        }

        .hero-icon {
            width: 1.25rem;
            height: 1.25rem;
        }
    </style>

    <section class="hero-section" style="background-color: #f8f9fa; ">
        <div class="hero-img-wrapper">
            <img src="https://images.unsplash.com/photo-1750764611091-93ac9e7d4c92?q=80&w=1674&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Hero background">
        </div>
        <div class="container hero-overlay">
            <div class="hero-card shadow-lg">
                <div class="mb-2 text-light small">
                    <i class="bi bi-geo-alt"></i> Rowe 321, Storrs Campus
                </div>
                <h2 class="my-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                        class="border-bottom border-2 pb-3 border-primary">Let's</span> Connect</h2>
                <p>
                    All aboard the Rowe Boat! Here at Rowe 321, we're always shipping.
                    Conveniently located in the heart of campus (and right by The Beanery), we’re in a great spot for
                    students and clients to collaborate. Swing by to check out what we’re working on, hang out on our comfy
                    couches, and get a great view of campus!
                </p>
                <div class="btn display-btn btn-arrow-slide">
                    <a href="#contact" class="btn-arrow-slide-cont btn-arrow-slide-cont--white" style="width:225px">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                            <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> Send us a Message </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="hire-us" class="bg-deep">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">Hire Us</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>

            <div class="row g-5 mt-4">
                <div class="col-lg-6 offset-3" data-aos="fade-left">
                    @php
                        $directions = ['from-left', 'from-right', 'from-top', 'from-bottom'];
                    @endphp

                    <div class="row">
                        @foreach ([['label' => 'Web Design', 'icon' => 'laptop', 'class' => 'web-design-color'], ['label' => 'UX Design', 'icon' => 'pencil', 'class' => 'ux-design-color'], ['label' => 'App Development', 'icon' => 'phone', 'class' => 'app-development-color'], ['label' => 'Digital Services for Research', 'icon' => 'beaker', 'class' => 'tech-support-color'], ['label' => 'Digital Consulting', 'icon' => 'chat-dots', 'class' => 'digital-consulting-color'], ['label' => 'Custom Tech Solutions', 'icon' => 'tools', 'class' => 'custom-tech-solutions-color']] as $badge)
                            <div class="col-md-6 mb-3">
                                <div class="service-badge text-light px-3 py-2 rounded-pill shadow-sm {{ $badge['class'] }}"
                                    data-aos="fade" data-aos-duration="1200" data-aos-delay="{{ rand(100, 500) }}"
                                    data-aos-easing="ease-out-back" data-aos-once="true">
                                    <i class="bi bi-{{ $badge['icon'] }} me-2"></i> {{ $badge['label'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card bg-primary-subtle text-light shadow-lg border-0">
                        <div class="card-body px-0">
                            <h3 class="card-title text-center mb-4 text-uppercase text-dark letter-spacing-1">Fees</h3>
                            <div class="list-group list-group-flush">
                                @foreach([
                                    ['label' => 'Director Project Engagement', 'amount' => 158],
                                    ['label' => 'Senior App Developer', 'amount' => 114],
                                    ['label' => 'Senior UX Designer', 'amount' => 78],
                                    ['label' => 'Student Design', 'amount' => 46],
                                ] as $fee)
                                    <div
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 border-bottom border-primary-subtle py-3 px-4">
                                        <span>{{ $fee['label'] }}</span>
                                        <span class="fw-bold text-end" style="min-width: 80px;">${{ $fee['amount'] }}/hr</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>


    </section>

    <section class="bg-teal text-light">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">Hire You</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>
            <div class="row mt-4 g-5">
                <div class="col-6">
                    <div class="position-relative mb-4">
                        <div class="card-outline"></div>
                        <div class="card-content p-4 rounded-3">
                            <div class="badge bg-warning text-dark mb-2">Class IV</div>
                            <h5 class="fw-bold">Student Developer</h5>
                            <p>Got a passion for coding and making things happen? The Internal Insights & Innovation [i3]
                                unit
                                is
                                looking for driven Student Web Developers...</p>
                            <a href="#" class="btn btn-link ps-0 fw-bold d-inline-flex align-items-center">
                                <span class="me-2 display-6 lh-1">➔</span> Apply on JobX
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="position-relative mb-4">
                        <div class="card-outline"></div>
                        <div class="card-content p-4 rounded-3">
                            <div class="badge bg-warning text-dark mb-2">Class IV</div>
                            <h5 class="fw-bold">Student Developer</h5>
                            <p>Got a passion for coding and making things happen? The Internal Insights & Innovation [i3]
                                unit
                                is
                                looking for driven Student Web Developers...</p>
                            <a href="#" class="btn btn-link ps-0 fw-bold d-inline-flex align-items-center">
                                <span class="me-2 display-6 lh-1">➔</span> Apply on JobX
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="bg-white text-dark d-flex align-items-center py-5">
        <div class="container py-5">
            <div class="row mt-4 g-5 d-flex align-items-center">
                <div class="col-lg-6">
                    <h2 class="my-3 d-inline-block pb-3 text-uppercase text-dark" data-aos="fade-down"><span
                        class="border-bottom border-2 pb-3 border-primary">Support</span> Us</h2>
                    <p class=" text-dark">The i3 team is a self-funded unit, and we rely on the support of our
                        community to continue our work. If you believe in the value of innovation and collaboration at
                        UConn, consider supporting us through donations or partnerships.</p>
                </div>

                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Support i3" class="img-fluid rounded shadow">
                </div>



            </div>
        </div>
@endsection
