@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
    {{-- <div class="scroll-snap-container"> --}}
    {{-- Hero --}}
    <section
        class="hero-section d-flex align-items-center position-relative text-light position-relative pb-3 pb-lg-5 justify-content-start justify-content-center">
        <div class="container z-2">
            <div class="hero-content text-md-center" data-aos="fade-up" data-aos-duration="1000">
                {{-- <h1 class="visually-hidden">Institutional Insights &amp; Innovation</h1> --}}
                <h1 class="hero-title mb-4 pt-md-0 text-center" aria-label="Institutional Insights & Innovation">
                    <span class="d-block" aria-hidden="true">Welcome to i3.</span>

                </h1>

                <div class="phrase-animator-container text-white bg-dark d-inline-block px-4 " aria-hidden="true">
                    <span class="d-inline">We</span>
                    <div id="phrase-animator-uconn" class="phrase-animator">make stuff</div>
                    <span class="d-inline">for UConn.</span>
                </div>

                {{-- Screen reader friendly static version --}}
                <div class="visually-hidden">We build apps, design websites, innovate, and create custom solutions for
                    UConn.</div>

            </div>
        </div>
    </section>


    <div id="projectScrollerContainer"
        style="top: 0; bottom: 0; left: 0; right: 0; height: 100vh; position: fixed; display: flex; align-items:center; justify-content: center; transform: translateY(50%); z-index: 0; overflow:hidden;"
        aria-hidden="true" role="presentation">
        <div class="mobile-scaledown">
            <div id="projectsScroller" style="visibility:hidden;">
                @foreach (\App\Models\WorkItem::all() as $item)
                    <div class="project-card" data-title="{{ $item->title }}"
                        data-thumbnail="{{ $item->best_thumbnail_url }}">
                        <img src="{{ $item->best_thumbnail_url }}" alt="" role="presentation">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scroller = document.getElementById('projectScrollerContainer');
            const whatWeDo = document.getElementById('what-we-do');
            const teamSection = document.getElementById('team');

            function updateScrollerPosition() {
                const rect = whatWeDo.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                // Calculate the vertical center of the viewport
                const viewportCenter = windowHeight / 2;
                // Calculate the vertical center of the section relative to the viewport
                const sectionCenter = rect.top + rect.height / 2;

                // Fade out as we scroll into #team
                let teamRect = teamSection.getBoundingClientRect();
                let teamEnter = teamRect.top;
                let teamFadeDistance = Math.min(windowHeight, teamRect.height);

                let fadeOutRatio = 1;
                if (teamEnter < windowHeight && teamEnter > 0) {
                    // Start fading out sooner: begin fade when #team is 60% from bottom of viewport
                    const fadeStart = windowHeight * 0.6;
                    const fadeDistance = teamFadeDistance * 0.2; // fade over 80% of #team's height
                    if (teamEnter < fadeStart) {
                        fadeOutRatio = Math.max(0, Math.min(1, (teamEnter - (fadeStart - fadeDistance)) /
                            fadeDistance));
                    }
                } else if (teamEnter <= 0) {
                    fadeOutRatio = 0;
                }

                // If the section's center is above the viewport center, stick at 0%
                if (sectionCenter <= viewportCenter) {
                    scroller.style.transform = 'translateY(0%)';
                    scroller.style.opacity = (0.05 * fadeOutRatio).toString();
                } else {
                    // Otherwise, interpolate from 50% (desktop) or 30% (mobile) to 0% as the section's center approaches the viewport center
                    const isMobile = window.innerWidth <= 768;
                    const startTranslateY = isMobile ? 30 : 50;
                    const distance = sectionCenter - viewportCenter;
                    const maxDistance = windowHeight / 2 + rect.height / 2;
                    const ratio = Math.max(0, Math.min(1, distance / maxDistance));
                    const translateY = 50 * ratio;
                    // Opacity interpolates from 1 (fully visible) to 0.05 (faded), then multiplies by fadeOutRatio
                    const opacity = (0.05 + 0.95 * ratio) * fadeOutRatio;
                    scroller.style.transform = `translateY(${translateY}vh)`;
                    scroller.style.opacity = opacity.toString();
                }
            }

            window.addEventListener('scroll', updateScrollerPosition, {
                passive: true
            });
            window.addEventListener('resize', updateScrollerPosition);
            updateScrollerPosition();
        });
    </script>


    {{-- What We Do --}}
    <section role="region" aria-label="What We Do" id="what-we-do"
        class="bg-deep-gradient text-light d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">What</span> We Do</h2>
            <div class="row align-items-top g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <p class="text-light">
                        The Institutional Insights & Innovation (i3) team provides custom software development, web design,
                        design thinking, and other innovation services in support of improving UConn's business processes,
                        academic operations, and research enterprise.
                    </p>
                    <p class="text-light">
                        We're not trying to reinvent the wheel—sometimes, we just help our colleagues find the wheel and use
                        it,
                        making the most of the tools already available at UConn. But when the wheel doesn't fit the task,
                        we step in with a lean, agile approach—building, testing, and refining solutions that adapt to the
                        university's evolving needs.
                    </p>

                    <div class="btn display-btn btn-arrow-slide">
                        <a href="{{ route('work.index') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text"> See Our Work </span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left">
                    <x-service-badges />
                </div>
            </div>
        </div>
    </section>
    <section id="for-uconn" class="bg-purple-gradient text-light d-flex align-items-center px-5 py-5"
        style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 d-block justify-content-center position-relative" data-aos="fade-right">
                    {{-- <div class="position-relative text-center" style="width: 240px; height: 240px;">
                        <div
                            class="rounded-circle border-2 border-light w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                            <div class="fs-2 fw-bold text-accent">30+</div>
                            <div class="text-secondary small">Grant-funded projects</div>
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle bg-light rounded-circle"
                            style="width: 20px; height: 20px;"></div>
                    </div> --}}
                    <div class="d-flex justify-content-center align-items-center for-uni-stat-wrapper"
                        style="min-height: 400px;"
                        aria-label="We've worked on over 37 projects this year for the University of Connecticut.">
                        <div class="for-uni-stat" id="for-uni-stat" aria-hidden="true">
                            <h2 id="stat-head">37+</h2>
                            <span id="stat-span" class="fs-4 fw-bolder">Projects This Year</span>
                        </div>
                        <div class="svg-wrapper">
                            <svg class="for-uni-stat-circle" width="70" height="70" viewBox="0 0 70 70"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle style="fill:#f2f1f1" cx="35" cy="4.44" r="4.44" />
                                <circle style="fill:none;stroke:#f2f1f1;stroke-miterlimit:10;stroke-width:.5px"
                                    cx="35" cy="35" r="30.56" />
                                <circle style="fill:none" cx="4.44" cy="35" r="4.44" />
                                <circle style="fill:none" cx="35" cy="65.56" r="4.44" />
                                <circle style="fill:none" cx="65.56" cy="35" r="4.44" />
                            </svg>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down">For The <span class="border-bottom border-2 pb-3 border-primary">University</span></h2>

                    <p class="text-light">
                        Our goal is to support UConn's mission by providing practical, purpose-driven services and tools
                        that help the university run more efficiently, support innovation, and improve the day-to-day
                        experience of working, researching, and learning here. </p>
                    <p class="text-light">
                        Sometimes that means quick fixes or process improvements. Other times, it means replacing a vendor
                        system or imagining something new from scratch.

                    </p>


                    <div class="btn display-btn btn-arrow-slide">
                        <a href="{{ route('story') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text"> Read Our Story </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Team --}}


    <section id="team" class="bg-teal-gradient text-light d-flex align-items-center px-5 position-relative"
        style="min-height: 100vh;">
        {{-- Feathered Top Edge --}}
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 160px; pointer-events: none; z-index: 2;">
            <div
                style="
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, #111 50%, rgba(0,0,0,0) 100%);
                transform: translateY(-50%);
            ">
            </div>
        </div>
        <div class="container z-1">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center" data-aos="fade-down">BY THE UNIVERSITY</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up"
                    style="width:50px"></span>
            </div>

            <div class="row py-4 text-center">
                <div class="col-lg-6 offset-lg-3" data-aos="fade-up">
                    <p class="text-light">
                        Our team runs on the talent and drive of UConn students. They're some of the brightest minds around,
                        and they bring serious skill, creativity, and hustle to everything we build.
                    </p>
                    <p class="text-light">
                        We pair that student energy with professional oversight to deliver real, production-grade work. It's
                        not just busy work. It's impact, and it's powering the university every day.
                    </p>
                    <p class="text-light">
                        Like UConn itself, we thrive on pride, collaboration, and doing work that matters. When you work
                        with us, you're getting a team that's smart, capable, and 100% all in.
                    </p>

                    <div class="btn display-btn btn-arrow-slide">
                        <a href="{{ route('team') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text"> Meet Our People </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @php
            use App\Models\TeamMember;
            $teamMembers = TeamMember::where(function ($query) {
                $query->whereNull('tags')->orWhere('tags', 'not like', '%alumni%');
            })->get();
        @endphp


        <div id="teamScrollerContainer1"
            class="position-absolute w-100 h-100 d-flex align-items-center justify-content-start start-0 z-0"
            style="visibility: hidden; overflow: hidden; opacity: 0.2; padding-left: 15vw;" aria-hidden="true"
            role="presentation">
            <div class="mobile-scaledown">
                <div id="teamScroller1">
                    @foreach ($teamMembers as $member)
                        <img src="{{ $member->best_image_url }}" alt="" role="presentation">
                    @endforeach
                </div>
            </div>
        </div>

        <div id="teamScrollerContainer2"
            class="position-absolute w-100 h-100 d-flex align-items-center justify-content-end end-0 z-0"
            style="visibility: hidden; overflow: hidden; opacity: 0.2; padding-right: 15vw;" aria-hidden="true"
            role="presentation">
            <div class="mobile-scaledown">
                <div id="teamScroller2">
                    @foreach ($teamMembers->reverse() as $member)
                        <img src="{{ $member->best_image_url }}" alt="" role="presentation">
                    @endforeach
                </div>
            </div>
        </div>


        {{-- Feathered Bottom Edge --}}
        <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 120px; pointer-events: none; z-index: 2;">
            <div
                style="
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, #111 50%, rgba(0,0,0,0) 100%);
                transform: translateY(50%);
            ">
            </div>
        </div>
    </section>


    {{-- </div> --}}


    @vite('resources/js/explodingPhrases.js')
    @vite('resources/js/photoScroller.js')
    @vite('resources/js/starParticles.js')
    @vite('resources/js/circleTurnAnimation.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            //prefersReducedMotion = true;

            // Always initialize phrase animator, but with reduced motion if preferred
            window.startPhraseAnimator({
                phrases: ["think big", "build apps", "innovate", "design solutions", "ideate", "nerd out",
                    "spark curiosity", "pull all-nighters"
                ],
                selector: "#phrase-animator-uconn",
                reducedMotion: prefersReducedMotion
            });

            // Only create scrollers if motion is not reduced
            if (!prefersReducedMotion) {
                const projectScroller = window.createPhotoScroller({
                    selector: "#projectsScroller",
                    rows: 2,
                    aspectRatio: 16 / 9,
                    speed: 20,
                    maxImageWidth: 400,
                    gap: 70,
                    rowGap: 100,
                    direction: -10,
                    imageClass: 'photo-scroller-image',
                    wrapperClass: 'photo-box-effect'
                });
                document.getElementById('projectsScroller').style.visibility = '';

                const teamScroller1 = window.createPhotoScroller({
                    selector: "#teamScroller1",
                    rows: 1,
                    aspectRatio: 1.5 / 1,
                    speed: 50,
                    gap: 70,
                    rowGap: 100,
                    maxImageWidth: 200,
                    direction: 85,
                    imageClass: 'photo-scroller-image',
                    wrapperClass: 'photo-box-effect'
                });
                document.getElementById('teamScrollerContainer1').style.visibility = '';

                const teamScroller2 = window.createPhotoScroller({
                    selector: "#teamScroller2",
                    rows: 1,
                    aspectRatio: 1.5 / 1,
                    speed: 50,
                    gap: 70,
                    maxImageWidth: 200,
                    direction: -85,
                    imageClass: 'photo-scroller-image ',
                    wrapperClass: 'photo-box-effect'
                });
                document.getElementById('teamScrollerContainer2').style.visibility = '';

                // Animated background particles - only if motion is enabled
                const animatedBg = new StarParticles({
                    selector: '.hero-section',
                    particleCount: 200,
                    particleColor: 'rgba(255,255,255,0.3)',
                    mousePush: true,
                    pushRadius: 100,
                    maxSpeed: 0.1,
                    connections: true,
                });
            } else {
                // For reduced motion users, show static content instead of scrollers
                document.getElementById('projectsScroller').style.display = 'none';
                document.getElementById('teamScrollerContainer1').style.display = 'none';
                document.getElementById('teamScrollerContainer2').style.display = 'none';

                // Hide the entire project scroller container since it's decorative
                document.getElementById('projectScrollerContainer').style.display = 'none';
            }
        });
    </script>
    <style>
        .rotate-270 {
            transform: rotate(270deg);
        }

        .opacity-01 {
            opacity: 0.1;
        }


        .for-uni-stat-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .for-uni-stat {
            margin-top: 0;
            position: absolute;
            text-align: center;
            max-width: 250px;
            transition: transform 0.65s ease-in-out;
        }

        #stat-head {
            font-size: 50px;
            color: #4DB3FF;
            margin: 0;
        }

        #stat-span {
            display: inline-block;
            font-size: 14px;
        }

        .for-uni-stat-circle {
            position: relative;
            width: 300px;
            height: 300px;
        }

        .svg-wrapper {
            will-change: transform;
            transition: transform 1.5s ease-in-out;
            width: fit-content;
            height: fit-content;
            position: absolute;
        }


        #for-uni {
            height: 100vh;
            width: 100vw;
            position: relative;
            margin-top: 10rem;
        }

        /* Dismissable Banner Styles */
        .dismissable-banner {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #204950;
            color: white;
            padding: 12px 16px;
            border-radius: 0px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            max-width: 95vw;
            width: auto;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            gap: 8px;
            animation: slideUp 0.4s ease-out;
        }

        .banner-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .banner-cta {
            margin-top: 0px;
            display: flex;
            justify-content: flex-end;
        }

        .dismissable-banner.hidden {
            animation: slideDown 0.3s ease-in forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateX(-50%) translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }

            to {
                transform: translateX(-50%) translateY(100%);
                opacity: 0;
            }
        }

        .dismissable-banner .banner-icon {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }

        .dismissable-banner .banner-icon svg {
            width: 100%;
            height: 100%;
            fill: rgba(255, 255, 255, 0.1);

        }

        .banner-content {
            flex: 1;
            font-size: 14px;
            line-height: 1.4;
        }

        .banner-title {
            font-weight: 600;
            margin: 0 0 4px 0;
            font-size: 15px;
        }

        .banner-text {
            margin: 0;
            opacity: 0.9;
        }

        .banner-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .dismissable-banner code {
            color: #ffbb4d;
        }


        .banner-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
            font-size: 18px;
            line-height: 1;
            margin-left: 8px;
            min-width: 44px;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-close:hover,
        .banner-close:focus {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            outline: 2px solid rgba(255, 255, 255, 0.5);
            outline-offset: 2px;
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            .dismissable-banner {
                animation: none;
            }

            .dismissable-banner.hidden {
                animation: none;
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .dismissable-banner {
                bottom: 16px;
                left: 16px;
                right: 16px;
                transform: none;
                max-width: none;
                padding: 8px 12px;
                flex-direction: row;
                align-items: center;
                gap: 8px;
            }

            .banner-header {
                gap: 8px;
                flex: 1;
                min-width: 0;
            }

            .banner-icon {
                display: none;
            }

            .banner-actions {
                display: flex;
                align-items: center;
            }

            .banner-cta {
                margin-top: 0;
                display: flex;
                justify-content: flex-end;
                flex-shrink: 0;
            }

            .banner-cta .d-md-none {
                display: none !important;
            }

            .banner-cta .btn-arrow-slide-cont {
                padding: 4px 8px;
                font-size: 12px;
            }

            .banner-cta .btn-arrow-slide-text {
                font-size: 12px;
            }

            .banner-close {
                min-width: 40px;
                min-height: 40px;
                flex-shrink: 0;
            }

            .banner-content {
                font-size: 13px;
                min-width: 0;
            }

            .banner-title {
                font-size: 11px;
                margin: 0 0 2px 0;
            }


            .banner-text {
                margin: 0;
                font-size: 13px;
                opacity: 1;
                display: none;
            }

            .banner-text strong {
                display: inline;
                font-weight: 600;
            }



            /* Override the banner text content on mobile */
            .banner-text::before {
                content: "We've merged with Greenhouse Studios!";
                font-weight: 600;
            }

            .banner-text * {
                display: none;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .dismissable-banner {
                border: 2px solid white;
            }

            .banner-close {
                border: 1px solid white;
            }
        }

        /* Focus visible for better keyboard navigation */
        .dismissable-banner *:focus-visible {
            outline: 2px solid #4DB3FF;
            outline-offset: 2px;
        }
    </style>

    <!-- Dismissable Banner - Only show after September 3, 2025 -->
    @if (now()->gte('2025-09-03'))
        <div id="merger-banner" class="dismissable-banner" role="region"
            aria-label="Important announcement about i3 merger" aria-live="polite" style="display:none;">
            <div class="banner-header">
                <div class="banner-icon" aria-hidden="true">
                    <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg fill="#000000" width="800px" height="800px" viewBox="0 0 512 512"
                        xmlns="http://www.w3.org/2000/svg">
                        <title>git merge icon</title>
                        <path
                            d="M385,224a64,64,0,0,0-55.33,31.89c-42.23-1.21-85.19-12.72-116.21-31.33-32.2-19.32-49.71-44-52.15-73.35a64,64,0,1,0-64.31.18V360.61a64,64,0,1,0,64,0V266.15c44.76,34,107.28,52.38,168.56,53.76A64,64,0,1,0,385,224ZM129,64A32,32,0,1,1,97,96,32,32,0,0,1,129,64Zm0,384a32,32,0,1,1,32-32A32,32,0,0,1,129,448ZM385,320a32,32,0,1,1,32-32A32,32,0,0,1,385,320Z" />
                    </svg>
                </div>
                <div class="banner-content">
                    <div class="banner-title"><code class="d-none d-md-inline" style="font-size:16px">git merge
                            greenhouse</code>
                        <span class="d-inline d-md-none">We've merged with Greenhouse Studios! <a
                                href="{{ route('merger') }}"
                                style="color:#4DB3FF; text-decoration:underline; font-weight:normal;">Learn more</a></span>
                    </div>
                    <div class="banner-text fs-6">
                        <strong>i3 is merging with Greenhouse Studios.</strong>
                        UConn is bringing together the functions and staff of
                        two highly innovative groups, Greenhouse Studios and i3 (Institutional Insights &amp; Innovation). This
                        merger creates a stronger hub for digital scholarship at UConn, combining i3's technical expertise
                        with Greenhouse's innovative design approach to support research and academic work across campus.
                    </div>
                </div>
                <div class="banner-actions">
                    <button class="banner-close" onclick="dismissBanner()" aria-label="Close merger announcement"
                        title="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>

            <div class="banner-cta">
                <a href="{{ route('merger') }}"
                    class="d-none d-md-inline-block btn-arrow-slide-cont btn-arrow-slide-cont--white" style="padding:0;"
                    aria-describedby="merger-description">
                    <span class="btn-arrow-slide-circle" aria-hidden="true">
                        <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                    </span>
                    <span class="btn-arrow-slide-text">About Our Merger</span>
                </a>

                <a href="{{ route('merger') }}" class="d-md-none"
                    style="font-size:13px; color:#fff; text-decoration:underline; margin-left:8px;">
                    Learn More
                </a>

            </div>

            <div id="merger-description" class="visually-hidden">
                Learn more about the merger between i3 and Greenhouse Studios
            </div>
        </div>

        <script>
            function dismissBanner() {
                const banner = document.getElementById('merger-banner');
                banner.classList.add('hidden');
                setTimeout(() => {
                    banner.style.display = 'none';
                }, 300);
                localStorage.setItem('merger-banner-dismissed', 'true');
            }

            function handleBannerKeydown(event) {
                if (event.key === 'Escape') {
                    dismissBanner();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // localStorage.removeItem('merger-banner-dismissed');
                const banner = document.getElementById('merger-banner');
                if (localStorage.getItem('merger-banner-dismissed') === 'true') {
                    if (banner) {
                        banner.style.display = 'none';
                    }
                    return;
                }
                if (banner) {
                    banner.style.display = '';
                    document.addEventListener('keydown', handleBannerKeydown);
                    setTimeout(() => {
                        const closeButton = banner.querySelector('.banner-close');
                        if (closeButton && document.activeElement === document.body) {
                            closeButton.focus();
                        }
                    }, 500);
                    const originalDismiss = window.dismissBanner;
                    window.dismissBanner = function() {
                        document.removeEventListener('keydown', handleBannerKeydown);
                        originalDismiss();
                    };
                }
            });
        </script>
    @endif
@endsection
