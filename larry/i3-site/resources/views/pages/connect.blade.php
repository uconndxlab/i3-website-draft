@extends('layouts.app')

@section('content')
    <h1 class="page-h1 display-1">Connect</h1>
    <style>
        .hero-section {
            position: relative;
            overflow: hidden;
            min-height: 70vh;
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
            <img src="{{ asset('img/i3/room.jpg') }}" class="img-fluid" alt="Hero background"
                style="filter: brightness(0.45);"
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

    <section id="hire-us" class="bg-deep py-5">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">Hire Us</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>

                <div class="text-center"  data-aos="fade-down">
                    <p class="lead px-md-5 py-3 mb-0" >
                        Need a website, app, or design help for your grant? Let's talk. We can write you a letter of
                        support, help you plan your submission, and, when the work starts, bill directly to your grant, all while helping you navigate UConn's branding and go-live
                        approvals without losing your mind.
                    </p>
                </div>
            </div>

            <div class="row g-5 mt-1 mb-5">
                <div class="col-lg-6 offset-lg-3" data-aos="fade-left">
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
                                @foreach ([['label' => 'Director Project Engagement', 'amount' => 158], ['label' => 'Senior App Developer', 'amount' => 114], ['label' => 'Senior UX Designer', 'amount' => 78], ['label' => 'Student Design', 'amount' => 46]] as $fee)
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

    <section class="bg-teal text-light">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center text-uppercase" data-aos="fade-down">Hire You</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>

                <!-- Section Heading -->
                <div class="text-center mb-5" data-aos="fade-down">
                    <p class="lead px-md-5">
                        We're always looking for talented, high-energy UConn lovers to join our team.
                        If you’re a student with a passion for technology, design, and innovation,
                        we want to hear from you! Whether you're into web development, UX design, or digital consulting,
                        writing, illustration, project management, or anything in between,
                        there’s a place for you at i3.
                    </p>

                    <p class="lead px-md-5">Like you, we're pretty confused about the current state of the Student Job
                        Application process, so it might be easier to just
                        <a class="text-white fw-bold" href="#contact">contact us</a> to get the ball rolling. Start by
                        telling us what type of work you like doing,
                        why you'd want to work with us, and what you hope to learn.
                    </p>
                </div>
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

                    <style>
                        :root {
                            --waveYTranslate: 75%;
                            --waveDuration: 15s;
                            --waveX25Percent: -750px;
                            --waveX50Percent: -1500px;
                            --waveX75Percent: -2250px;
                        }

                        .coffee-wrapper {
                            position: relative;
                            overflow: hidden;
                            z-index: 1;
                        }


                        .coffee {
                            width: 60vw;
                            z-index: 2;
                            height: 60vw;

                        }

                        #coffee-outline {
                            z-index: 4;
                        }

                        .coffee-flow-wrapper {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            top: -2px;
                            left: 27%;
                            transform: translateX(-50%);
                            -webkit-mask-image: url(/img/i3/i3-coffee-fill.svg);
                            -webkit-mask-repeat: no-repeat;
                            -webkit-mask-size: contain;
                            -webkit-mask-position: center;
                            overflow: hidden;
                            z-index: 2;
                        }


                        .coffee-track {
                            position: absolute;
                            bottom: 0;
                            display: flex;
                            transform: translateY(80%);
                            left: 0;
                            height: auto;
                            width: 6000px;
                            align-items: flex-end;
                        }

                        .coffee-flow {
                            animation-name: coffee-flow;
                            animation-duration: var(--waveDuration);
                            animation-timing-function: linear;
                            animation-iteration-count: infinite;
                        }

                        @keyframes coffee-flow {
                            0% {
                                transform: translateX(0%)
                            }

                            25% {
                                transform: translateX(var(--waveX25Percent))
                            }

                            50% {
                                transform: translateX(var(--waveX50Percent))
                            }

                            75% {
                                transform: translateX(var(--waveX75Percent))
                            }

                            100% {
                                transform: translateX(-3000px)
                            }
                        }

                        .coffee-liquid {
                            width: 3000px;
                            height: auto;
                            transition: transform 2s ease-in;
                            transform-origin: bottom;
                            transform: translateY(100%) translateX(15%) scaleY(1);
                        }




                        .loop {
                            opacity: 1;
                            width: 100vw;
                            height: auto;
                            pointer-events: none;
                            position: absolute;
                            z-index: -1;
                            left: 0;
                            top: 0;
                        }

                        #loopy-reveal {
                            z-index: 1;
                        }

                        #loopy {
                            z-index: 0;
                        }
                    </style>

                    <button class="fill-coffee px-4 py-2 d-flex align-items-center gap-2 my-2" id="coffee"
                        style="font-size:1rem; background: #dbf7f0; color: #13404a; border: none;">
                        Fill Our Cup!
                    </button>
                    <div class="coffee-wrapper">
                        <div class="coffee-flow-wrapper coffee">
                            <div class="coffee-track animated">
                                <svg class="coffee-liquid coffee-flow" width="3000" height="510"
                                    viewBox="0 0 3000 510" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path style="fill:#47230b;opacity:1"
                                        d="M66.12,113.1c52.08,5.38,64.66,10.91,95.72,10.3,23.38-.46,24.32-4.16,93.49-20.79,71.33-17.16,99.42-19.78,126.58-19.79,30.74-.02,47.26,3.8,60.31,8.73,29.26,11.06,27.37,22.54,49.04,31.42,44.37,18.2,72.99-21.4,137.85-12.23,27.39,3.87,39.89,4.47,64.9,5.66,9.75.46,17.6-.08,21.05-.38,2.51-.21,4.75-.46,6.68-.71,0,0,19.92-1.75,39.41-6.27,53.89-12.52,82.77-31.2,107.78-43.11,83.07-39.54,213.95-36.71,266.97-6.4,5.8,3.32,23.43,14.25,51.14,23.86,13.73,4.76,32.4,11.08,58.22,12.81,4.42.3,24.76,1.5,53.5-3.5,27.57-4.8,40.33-11.37,66.09-20.37,42.9-14.97,68.72-23.98,101.49-24.44,38.18-.53,54.45,12.38,92.05,23.28,82.73,23.98,166.16,6.6,200.62-.58,105.1-21.9,101.79-60.8,188.03-69.26,64.51-6.32,119.47,10.63,169.94,26.19,64.4,19.86,80.58,37.02,118.8,52.06,23.38,9.21,36.06,12.84,50.35,14.85,46.15,6.51,69.95-8.76,131.37-19.75,18.75-3.35,66.83-11.69,121.44-8.18,71.01,4.57,69.73,23.83,127.98,27.16,87.44,5.01,117.42-36.8,179.38-18.61,29.92,8.79,31.64,21.09,70.28,28.7,35.85,7.06,83.42,5.43,83.42,5.43v400.81H0V109.19c34.79-.02,52.33,2.49,66.12,3.92h0Z" />
                                </svg>
                                <svg class="coffee-liquid coffee-flow" width="3000" height="510"
                                    viewBox="0 0 3000 510" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path style="fill:#47230b;opacity:1"
                                        d="M66.12,113.1c52.08,5.38,64.66,10.91,95.72,10.3,23.38-.46,24.32-4.16,93.49-20.79,71.33-17.16,99.42-19.78,126.58-19.79,30.74-.02,47.26,3.8,60.31,8.73,29.26,11.06,27.37,22.54,49.04,31.42,44.37,18.2,72.99-21.4,137.85-12.23,27.39,3.87,39.89,4.47,64.9,5.66,9.75.46,17.6-.08,21.05-.38,2.51-.21,4.75-.46,6.68-.71,0,0,19.92-1.75,39.41-6.27,53.89-12.52,82.77-31.2,107.78-43.11,83.07-39.54,213.95-36.71,266.97-6.4,5.8,3.32,23.43,14.25,51.14,23.86,13.73,4.76,32.4,11.08,58.22,12.81,4.42.3,24.76,1.5,53.5-3.5,27.57-4.8,40.33-11.37,66.09-20.37,42.9-14.97,68.72-23.98,101.49-24.44,38.18-.53,54.45,12.38,92.05,23.28,82.73,23.98,166.16,6.6,200.62-.58,105.1-21.9,101.79-60.8,188.03-69.26,64.51-6.32,119.47,10.63,169.94,26.19,64.4,19.86,80.58,37.02,118.8,52.06,23.38,9.21,36.06,12.84,50.35,14.85,46.15,6.51,69.95-8.76,131.37-19.75,18.75-3.35,66.83-11.69,121.44-8.18,71.01,4.57,69.73,23.83,127.98,27.16,87.44,5.01,117.42-36.8,179.38-18.61,29.92,8.79,31.64,21.09,70.28,28.7,35.85,7.06,83.42,5.43,83.42,5.43v400.81H0V109.19c34.79-.02,52.33,2.49,66.12,3.92h0Z" />
                                </svg>
                            </div>
                        </div>
                        <svg class="coffee-outline" id="coffee-outline" width="336" height="285"
                            viewBox="0 0 336 285" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path style="fill:none;stroke:#1a1a1a;stroke-width: 2px"
                                d="M334.87,124.9c0-27.52-23.35-50.17-50.87-50.21V11.08c0-5.56-4.52-10.08-10.08-10.08H11.08C5.52,1,1,5.52,1,11.08v262.84c0,5.56,4.52,10.08,10.08,10.08h262.84c5.56,0,10.08-4.52,10.08-11.13v-98.55c27.52-.03,50.87-21.89,50.87-49.42ZM191.79,44.54c4.75,0,9.22,1.24,13.08,3.44,8.1,4.57,13.58,13.26,13.58,23.2s-5.48,18.63-13.58,23.2c-3.86,2.2-8.33,3.44-13.08,3.44s-9.21-1.24-13.07-3.44l-.75-.44c-7.69-4.66-12.83-12.82-12.83-22.76s5.47-18.64,13.57-23.2l.73-.4c3.68-1.95,7.89-3.04,12.34-3.04h.01ZM102.75,15.8h77.46v7.17h-.88c-21.45,5.54-37.35,25.02-37.35,48.22s15.96,42.76,37.47,48.26l.75.19v17.1l-.75.19c-21.51,5.49-37.47,25.04-37.47,48.25,0,.95.03,1.91.08,2.87l.03.68-.61.28-37.31,17.2-1.42.66v-32.3l.75-.19c21.51-5.5,37.46-25.04,37.46-48.25s-15.96-42.75-37.46-48.25l-.75-.19V15.8ZM79.59,267.16h-21.93v-14l.58-.27,19.93-9.19h0s1.42-.66,1.42-.66v24.12ZM79.58,174.58v42.97l-.58.27-37.77,17.42-.38.18c-3.89,1.96-6.35,5.95-6.35,10.33v21.41h-17.68V15.8h62.77v61.89l-.75.19c-21.51,5.5-37.47,25.04-37.47,48.25s15.96,42.75,37.47,48.25l.75.19h0ZM78.09,149.32l-.75-.44c-7.69-4.66-12.83-13.13-12.83-22.76s5.48-18.64,13.58-23.2l.73-.4c3.68-1.95,7.89-3.04,12.34-3.04,4.75,0,9.2,1.25,13.07,3.44l.75.44c7.69,4.67,12.82,12.82,12.82,22.76s-5.47,18.63-13.57,23.2c-3.86,2.19-8.32,3.44-13.07,3.44s-9.21-1.24-13.07-3.44ZM180.21,267.18h-77.46v-34.8l.58-.27,45.06-20.78.79-.37.47.74c6.72,10.62,17.33,18.55,29.8,21.73l.75.19v.02s0,33.54,0,33.54ZM178.72,208.38l-.75-.44c-7.69-4.66-12.83-12.82-12.83-22.76s5.47-18.64,13.57-23.2l.73-.4c3.68-1.95,7.89-3.04,12.34-3.04h.01c4.75,0,9.22,1.24,13.08,3.44,8.1,4.57,13.58,13.26,13.58,23.2s-5.48,18.63-13.58,23.2c-3.86,2.2-8.34,3.44-13.08,3.44s-9.21-1.24-13.07-3.44ZM268.18,267.15h-64.83v-33.54l.75-.19c21.51-5.5,37.47-25.05,37.47-48.25s-15.96-42.75-37.47-48.25l-.75-.19v-17.11l.75-.19c21.51-5.5,37.47-25.04,37.47-48.25s-15.96-42.75-37.47-48.25l-.75-.19v-6.95h64.83v251.36ZM284,159.82v-70.98.09s0,0,0,0c19.41.25,35.19,16.41,34.98,35.83-.21,19.27-15.78,35.01-34.98,35.07Z" />
                        </svg>
                    </div>

                    <svg class="loop" viewBox="0 0 2025.08 1001.09" preserveAspectRatio="none">
                        <path id="loopy"
                            d="M1.25.84s179.42,267.7,316.14,257.22S583.02,84.72,477.82,54.66s-82.94,327.41,212.31,287.31,459.17-118.22,491.34,192.75-204.35,131.01-204.35,131.01c0,0-230.71-175.44-247.56,103.37s226.72,176.17,226.72,176.17c0,0,364.6-171.57,444.26-291.06s50.55-556.09,257.36-470.3-75.06,320.17-114.89,128.68S1918.31,30.73,1918.31,30.73"
                            fill="none" stroke="#1a1a1a" stroke-width="3" stroke-dasharray="15"
                            stroke-miterlimit="10" stroke-dashoffset="0" />
                        <path id="loopy-reveal"
                            d="M1.25.84s179.42,267.7,316.14,257.22S583.02,84.72,477.82,54.66s-82.94,327.41,212.31,287.31,459.17-118.22,491.34,192.75-204.35,131.01-204.35,131.01c0,0-230.71-175.44-247.56,103.37s226.72,176.17,226.72,176.17c0,0,364.6-171.57,444.26-291.06s50.55-556.09,257.36-470.3-75.06,320.17-114.89,128.68S1918.31,30.73,1918.31,30.73"
                            fill="none" stroke="#ffbb4e" stroke-width="5" stroke-dasharray="15"
                            stroke-miterlimit="10" stroke-dashoffset="0" />

                    </svg>
                </div>


                @vite(['resources/js/coffeeAnimation.js'])
                <script type="module">
                    const path = document.getElementById('loopy-reveal');


                    const length = path.getTotalLength();
                    path.setAttribute('stroke-dasharray', `${length}`);
                    path.setAttribute('stroke-dashoffset', 0);

                    function animateLoop() {
                        setTimeout(() => {
                            path.style.transition = 'stroke-dashoffset 6s ease-in-out';
                            path.setAttribute(`stroke-dashoffset`, `${-length}`);
                        }, 200);
                    }
                    window.animateLoop = animateLoop;

                    animateLoop();
                </script>
            </div>
        </div>
    @endsection
