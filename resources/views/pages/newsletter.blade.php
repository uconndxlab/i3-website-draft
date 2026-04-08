@extends('layouts.app')
@section('title', 'Newsletter — Spring 2026')
@section('meta_description', 'The i3 Spring 2026 newsletter. Learn about our latest projects, meet our alumni, and discover how you can join our team.')

@section('content')

    <style>
        :root {
            --nl-amber: #D4943C;
            --nl-amber-light: #E0A84E;
            --nl-bg: #0B1220;
            --nl-bg-light: #0F1A2E;
            --nl-blue: #4DB3FF;
        }

        .nl-page {
            background: var(--nl-bg);
            position: relative;
            overflow: hidden;
        }

        .nl-page::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 140%;
            height: 900px;
            background: radial-gradient(ellipse at 50% 30%, rgba(25, 55, 110, 0.4) 0%, rgba(15, 35, 80, 0.15) 40%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .nl-section {
            position: relative;
            z-index: 1;
        }

        /* Hero */
        .nl-hero {
            position: relative;
            z-index: 1;
            padding-top: 2.5rem;
            padding-bottom: 2rem;
        }

        .nl-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 3rem;
        }

        .nl-header-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nl-header-logo img {
            width: 44px;
        }

        .nl-header-logo-text {
            font-size: 0.85rem;
            color: #fff;
            line-height: 1.3;
            font-weight: 600;
        }

        .nl-header-logo-text span {
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
        }

        .nl-header-meta {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            text-align: right;
            line-height: 1.4;
        }

        .nl-hero-title {
            font-size: clamp(2.8rem, 8vw, 5.5rem);
            font-weight: 800;
            line-height: 1;
            text-transform: uppercase;
            font-family: 'area-normal', sans-serif;
            color: transparent;
            -webkit-text-stroke: 2px #fff;
            margin-bottom: 0;
            text-align: center;
        }

        .nl-hero-title .accent {
            -webkit-text-stroke: 0;
            color: var(--nl-blue);
        }

        .nl-hero-title .dot {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 3px solid #fff;
            vertical-align: baseline;
            margin-left: 6px;
            position: relative;
            top: -4px;
        }

        .nl-subheading {
            font-size: clamp(1.5rem, 4vw, 2.2rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .nl-subheading .highlight {
            color: #fff;
        }

        .nl-subheading .blue {
            color: var(--nl-blue);
        }

        .nl-hero-photo {
            width: 100%;
            aspect-ratio: 16 / 10;
            object-fit: cover;
            border-radius: 10px;
            background: var(--nl-bg-light);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        /* Section Labels */
        .nl-section-label {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--nl-amber);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        /* Headings override for newsletter */
        .nl-page h2 {
            color: var(--nl-amber-light);
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .nl-page h2 .text-underline {
            text-decoration: underline;
            text-decoration-color: var(--nl-blue);
            text-underline-offset: 4px;
        }

        /* Intro section - kept for potential reuse */

        /* Stats */
        .nl-stats-row {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 2rem 1rem;
            background: rgba(255, 255, 255, 0.02);
        }

        .nl-stat-card {
            text-align: center;
            padding: 1rem;
        }

        .nl-stat-number {
            font-size: clamp(2.2rem, 5vw, 3rem);
            font-weight: 800;
            color: var(--nl-amber);
            line-height: 1;
            font-family: 'area-normal', sans-serif;
        }

        .nl-stat-label {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 0.4rem;
            letter-spacing: 1px;
        }

        .nl-stat-sublabel {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.65rem;
            color: var(--nl-amber);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Featured project */
        .nl-featured-img {
            width: 100%;
            aspect-ratio: 16 / 10;
            object-fit: cover;
            border-radius: 12px;
            background: var(--nl-bg-light);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* Alumni */
        .nl-alumni-card {
            text-align: center;
            padding: 1rem 0.5rem;
        }

        .nl-alumni-photo {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 0.75rem;
            border: 2px solid rgba(212, 148, 60, 0.3);
            background: var(--nl-bg-light);
            display: block;
        }

        .nl-alumni-name {
            font-weight: 600;
            font-size: 0.85rem;
            color: #fff;
            margin-bottom: 2px;
        }

        .nl-alumni-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Brand logos */
        .nl-brand-logo {
            max-height: 28px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: 0.5;
            transition: opacity 0.2s ease;
        }

        .nl-brand-logo:hover {
            opacity: 0.8;
        }

        /* Join Our Team */
        .nl-join-card {
            background: linear-gradient(135deg, #0d2a35 0%, #122838 100%);
            border: 1px solid rgba(77, 179, 255, 0.1);
            border-radius: 16px;
            padding: 2.5rem;
        }

        .nl-skill-tag {
            display: inline-block;
            font-size: 0.8rem;
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid var(--nl-amber);
            color: var(--nl-amber);
            margin: 4px;
            transition: all 0.2s ease;
        }

        .nl-skill-tag:hover {
            background: rgba(212, 148, 60, 0.1);
        }

        /* Spotlight card */
        .nl-spotlight-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 2.5rem;
        }

        .nl-spotlight-badge {
            display: inline-block;
            font-family: 'Roboto Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--nl-amber);
            background: rgba(212, 148, 60, 0.1);
            border: 1px solid rgba(212, 148, 60, 0.2);
            padding: 4px 12px;
            border-radius: 2px;
            margin-bottom: 1rem;
        }

        .nl-spotlight-img {
            width: 100%;
            aspect-ratio: 3 / 4;
            object-fit: cover;
            border-radius: 10px;
            background: var(--nl-bg-light);
            margin-bottom: 0;
        }

        .nl-spotlight-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
        }

        .nl-spotlight-role {
            font-size: 0.85rem;
            color: var(--nl-amber);
            margin-bottom: 0.75rem;
        }

        /* Divider */
        .nl-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.08), transparent);
            margin: 0;
            border: none;
        }

        /* Footer */
        .nl-footer-links a {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.2s ease;
        }

        .nl-footer-links a:hover {
            color: var(--nl-amber);
        }

        .nl-social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nl-social-icon:hover {
            border-color: var(--nl-amber);
            color: var(--nl-amber);
        }

        /* Glow accents */
        .nl-glow-blue {
            position: relative;
        }

        .nl-glow-blue::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 140%;
            height: 200%;
            background: radial-gradient(ellipse, rgba(20, 70, 140, 0.15) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }
    </style>

    <div class="nl-page">

        {{-- Hero Section --}}
        <section class="nl-hero nl-section px-4 px-md-5">
            <div class="container">
                <div class="nl-header-bar">
                    <div class="nl-header-logo">
                        <img src="{{ asset('img/i3/i3-symbol-light-blue.svg') }}" alt="i3 logo">
                        <div class="nl-header-logo-text">
                            Institutional Insights<br>
                            <span>& Innovation</span>
                        </div>
                    </div>
                    
                </div>

                <h1 class="nl-hero-title mb-5" data-aos="fade-up">
                    Welcome to <span class="accent">i3</span><span class="dot"></span>
                </h1>

                <div class="nl-subheading mb-4" data-aos="fade-up" data-aos-delay="50">
                    We do <span class="highlight">(digital)</span> for <span class="blue">UConn</span>
                </div>

                <div class="row">
                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="nl-hero-photo d-flex align-items-center justify-content-center"
                            style="background: linear-gradient(135deg, #0F1A2E, #1a2a45);">
                            <span class="text-white opacity-25 fs-5">Team Photo Placeholder</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Featured Project --}}
        <section class="nl-section nl-glow-blue px-4 px-md-5 py-5">
            <div class="container py-3 position-relative z-1">
                <div class="nl-section-label" data-aos="fade-up">// Featured Project</div>
                <div class="row mt-3">
                    <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
                        <p class="text-light">
                            The Institutional Insights & Innovation (i3) team provides custom software
                            development, web design, design thinking, and other innovation services in support
                            of improving UConn's business processes, academic operations, and research enterprise.
                        </p>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="nl-featured-img d-flex align-items-center justify-content-center">
                            <span class="text-white opacity-25">Project Image Placeholder</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Stats --}}
        <section class="nl-section px-4 px-md-5 py-5">
            <div class="container py-3">
                <div class="nl-stats-row" data-aos="fade-up">
                    <div class="row g-3 justify-content-center align-items-center">
                        <div class="col-md-4">
                            <div class="nl-stat-card">
                                <div class="nl-stat-number">35+</div>
                                <div class="nl-stat-label">UConn Partners</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="nl-stat-card">
                                <div class="nl-stat-number">100+</div>
                                <div class="nl-stat-label">Projects Delivered</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="nl-stat-card">
                                <div class="nl-stat-number">50+</div>
                                <div class="nl-stat-label">Student Alumni</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <div class="nl-stat-sublabel">// Different UConn Partners (and counting!)</div>
                    </div>
                </div>
                <div class="text-center mt-4" data-aos="fade-up">
                    <x-slide-button href="{{ route('work.index') }}">Read More</x-slide-button>
                </div>
            </div>
        </section>

        <hr class="nl-divider">

        {{-- Alumni Section --}}
        <section class="nl-section px-4 px-md-5 py-5">
            <div class="container py-3">
                <div class="nl-section-label" data-aos="fade-up">// Where Are Our Alumni Now?</div>
                <div class="row mb-4">
                    <div class="col-lg-8" data-aos="fade-up">
                        <p class="text-light">
                            Our goal is to support UConn's mission by providing practical, purpose-driven
                            services and tools that help the university run more efficiently, support innovation,
                            and improve the day-to-day experience of working, researching, and learning here.
                        </p>
                    </div>
                </div>

                {{-- Brand Logos --}}
                <div class="row g-4 justify-content-center align-items-center mb-5" data-aos="fade-up">
                    @foreach (\App\Services\Brands::$brands as $name => $logo)
                        <div class="col-4 col-sm-3 col-md-2 text-center">
                            <img src="{{ asset('img/brands/' . $logo) }}" alt="{{ $name }} logo"
                                title="{{ $name }}" class="img-fluid nl-brand-logo">
                        </div>
                    @endforeach
                </div>

                {{-- Alumni Cards --}}
                <div class="row g-3 justify-content-center" data-aos="fade-up">
                    @if(isset($alumni) && $alumni->count())
                        @foreach($alumni->take(5) as $person)
                            <div class="col-6 col-sm-4 col-lg">
                                <div class="nl-alumni-card">
                                    @if($person->best_image_url)
                                        <img src="{{ $person->best_image_url }}" alt="Photo of {{ $person->name }}"
                                            class="nl-alumni-photo">
                                    @else
                                        <div class="nl-alumni-photo d-flex align-items-center justify-content-center"
                                            style="background: rgba(212,148,60,0.08);">
                                            <i class="bi bi-person fs-4" style="color: var(--nl-amber); opacity: 0.5;"></i>
                                        </div>
                                    @endif
                                    <div class="nl-alumni-name">{{ $person->name }}</div>
                                    <div class="nl-alumni-role">{{ $person->role }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @php
                            $placeholderAlumni = [
                                ['name' => 'Ryan Cohutt', 'role' => 'Software Developer, Amazon'],
                                ['name' => 'Yuna Kim', 'role' => 'Professor, University of Georgia'],
                                ['name' => 'Hannah Mechtenberg', 'role' => 'Associate Director'],
                                ['name' => 'Sam Chichester', 'role' => 'Software Developer, Epic Games'],
                                ['name' => 'Aaron Mark', 'role' => 'Software Developer, Activision'],
                            ];
                        @endphp
                        @foreach($placeholderAlumni as $person)
                            <div class="col-6 col-sm-4 col-lg">
                                <div class="nl-alumni-card">
                                    <div class="nl-alumni-photo d-flex align-items-center justify-content-center"
                                        style="background: rgba(212,148,60,0.08);">
                                        <i class="bi bi-person fs-4" style="color: var(--nl-amber); opacity: 0.5;"></i>
                                    </div>
                                    <div class="nl-alumni-name">{{ $person['name'] }}</div>
                                    <div class="nl-alumni-role">{{ $person['role'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="text-center mt-4" data-aos="fade-up">
                    <x-slide-button href="{{ route('alumni') }}">Meet Our Alumni</x-slide-button>
                </div>
            </div>
        </section>

        <hr class="nl-divider">

        {{-- Join Our Team --}}
        <section class="nl-section px-4 px-md-5 py-5">
            <div class="container py-3">
                <div class="nl-section-label" data-aos="fade-up">// Join Our Team</div>
                <div class="nl-join-card" data-aos="fade-up">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-6">
                            <h3 class="text-white fw-bold mb-3">There's a place for you at <span style="color: var(--nl-blue);">i3</span></h3>
                            <p class="text-light mb-4">
                                Our goal is to support UConn's mission by providing practical, purpose-driven
                                services and tools that help the university run more efficiently.
                            </p>
                            <x-slide-button href="{{ route('connect') }}">Apply Now</x-slide-button>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-2">
                                <span class="nl-skill-tag">+Web Development</span>
                                <span class="nl-skill-tag">+UX Design</span>
                                <span class="nl-skill-tag">+Digital Consulting</span>
                                <span class="nl-skill-tag">+Illustration</span>
                                <span class="nl-skill-tag">+Project Management</span>
                                <span class="nl-skill-tag">+Writing</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="nl-divider">

        {{-- Get to Know Us / Staff Spotlight --}}
        <section class="nl-section px-4 px-md-5 py-5">
            <div class="container py-3">
                <div class="nl-section-label" data-aos="fade-up">// Get to Know Us</div>
                <div class="row mb-4">
                    <div class="col-lg-8" data-aos="fade-up">
                        <p class="text-light">
                            Get to know the people behind the work. This section highlights our team
                            members — faculty and students — who contribute their skills, research, and
                            creativity to the projects.
                        </p>
                    </div>
                </div>
                <div class="text-center mb-4" data-aos="fade-up">
                    <x-slide-button href="{{ route('team') }}">Meet Our Staff</x-slide-button>
                </div>

                {{-- Spotlight Card --}}
                <div class="nl-spotlight-card mt-4" data-aos="fade-up">
                    <div class="nl-spotlight-badge mb-3">Spotlight</div>
                    <div class="row align-items-stretch g-4">
                        <div class="col-md-5">
                            @if(isset($spotlight) && $spotlight->best_image_url)
                                <img src="{{ $spotlight->best_image_url }}" alt="Photo of {{ $spotlight->name }}"
                                    class="nl-spotlight-img" style="height: 100%; aspect-ratio: auto;">
                            @else
                                <div class="nl-spotlight-img d-flex align-items-center justify-content-center"
                                    style="height: 100%; aspect-ratio: auto; min-height: 280px;">
                                    <i class="bi bi-person fs-1 text-white opacity-25"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7 d-flex flex-column justify-content-center">
                            <div class="nl-spotlight-name">{{ $spotlight->name ?? 'Clarissa Ceglio' }}</div>
                            <div class="nl-spotlight-role">{{ $spotlight->role ?? 'Associate Director' }}</div>
                            <p class="text-light mt-3">
                                As a U.S. cultural historian trained in the interdisciplinary field of American Studies,
                                Clarissa Ceglio works at the intersections of museum studies, public humanities, and
                                digital scholarship. Her work explores how communities engage with cultural heritage
                                through technology and collaborative practice.
                            </p>
                            <div class="mt-2">
                                <x-slide-button href="{{ route('team') }}">Read More</x-slide-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Newsletter Footer --}}
        <section class="nl-section px-4 px-md-5 py-4" style="background: rgba(0,0,0,0.3);">
            <div class="container">
                <div class="row align-items-center g-3 py-3">
                    <div class="col-md-4 text-center text-md-start">
                        <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                            <img src="{{ asset('img/i3/i3-symbol-light-blue.svg') }}" alt="i3 logo" style="width: 28px;">
                            <div>
                                <div class="text-white small fw-bold" style="line-height: 1.2;">Institutional Insights</div>
                                <div class="small" style="color: rgba(255,255,255,0.5); line-height: 1.2;">& Innovation</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="small mb-2" style="color: var(--nl-amber);">Follow Us!</div>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="https://github.com/uconndxlab" target="_blank" class="nl-social-icon"
                                aria-label="GitHub"><i class="bi bi-github"></i></a>
                            <a href="https://www.linkedin.com/company/uconn-i3/" target="_blank" class="nl-social-icon"
                                aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            <a href="mailto:i3@uconn.edu" class="nl-social-icon" aria-label="Email"><i
                                    class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center text-md-end">
                        <div class="nl-footer-links d-flex gap-3 justify-content-center justify-content-md-end flex-wrap">
                            <a href="#">Unsubscribe</a>
                            <a href="#">Preferences</a>
                            <a href="{{ route('home') }}">View Online</a>
                        </div>
                    </div>
                </div>
                <hr class="nl-divider">
                <div class="text-center py-3">
                    <p class="small mb-0" style="color: rgba(255,255,255,0.25); font-size: 0.7rem;">
                        You're receiving this because you subscribe to our newsletter.
                    </p>
                </div>
            </div>
        </section>

    </div>

    @vite('resources/js/starParticles.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                new StarParticles({
                    selector: '.nl-hero',
                    particleCount: 120,
                    particleColor: 'rgba(255,255,255,0.2)',
                    mousePush: true,
                    pushRadius: 80,
                    maxSpeed: 0.05,
                    connections: true,
                });
            }
        });
    </script>

@endsection
