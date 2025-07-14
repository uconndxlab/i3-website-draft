@extends('layouts.app')
@section('title', 'Mobile Apps, Web Apps, UX Design, Web Development, and Web Design')

@section('content')
{{-- <div class="scroll-snap-container"> --}}
    {{-- Hero --}}
    <section class="hero-section d-flex align-items-center position-relative text-light position-relative pb-3 pb-lg-5 justify-content-center justify-content-md-start">
        <div class="container z-2">
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title mb-4">
                    Internal<br>
                    Insights &<br>
                    Innovation
                </h1>

                <div class="phrase-animator-container text-white">
                    <span class="d-block d-md-inline">We</span>
                    <div id="phrase-animator-uconn" class="phrase-animator"></div>
                    <span class="d-block d-md-inline">for UConn.</span>
                </div>
                
            </div>
        </div>
    </section>


    <div id="projectScrollerContainer" style="top: 0; bottom: 0; left: 0; right: 0; height: 100vh; position: fixed; display: flex; align-items:center; justify-content: center; transform: translateY(50%); z-index: 0; overflow:hidden;">
        <div class="mobile-scaledown">
            <div id="projectsScroller" style="visibility:hidden;">
                @foreach(\App\Models\WorkItem::all() as $item)
                <div class="project-card" data-title="{{ $item->title }}" data-thumbnail="{{ $item->thumbnail }}" >
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}">
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
                    fadeOutRatio = Math.max(0, Math.min(1, (teamEnter - (fadeStart - fadeDistance)) / fadeDistance));
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

        window.addEventListener('scroll', updateScrollerPosition, { passive: true });
        window.addEventListener('resize', updateScrollerPosition);
        updateScrollerPosition();
    });
    </script>
    

    {{-- What We Do --}}
    <section role="region" aria-label="What We Do" id="what-we-do" class="bg-deep-gradient text-light d-flex align-items-center px-5" style="min-height: 100vh;">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span class="border-bottom border-2 pb-3 border-primary">What</span> We Do</h2>
            <div class="row align-items-top g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <p class="text-light">
                        The Internal Insights & Innovation (i3) team provides custom software development, web design,
                        and other digital services in support of improving UConn's business processes, academic operations,
                        and research enterprise.
                    </p>
                    <p class="text-light">
                        We're not trying to reinvent the wheel—sometimes, we just help our colleagues find the wheel and use
                        it,
                        making the most of the tools already available at UConn. But when the wheel doesn't fit the task,
                        we step in with a lean, agile approach—building, testing, and refining solutions that adapt to the
                        university's evolving needs.
                    </p>

                    <div class="btn display-btn btn-arrow-slide">
                      <a href="{{ route('projects.index') }}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                        <span class="btn-arrow-slide-circle" aria-hidden="true">
                          <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                        </span>
                        <span class="btn-arrow-slide-text"> See Our Projects </span>
                      </a>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left">
                    @php
                        $directions = ['from-left', 'from-right', 'from-top', 'from-bottom'];
                    @endphp

                    <div class="row">
                        @foreach ([['label' => 'Web Design', 'icon' => 'laptop', 'class' => 'web-design-color'],
                                ['label' => 'UX Design', 'icon' => 'pencil', 'class' => 'ux-design-color'],
                                ['label' => 'App Development', 'icon' => 'phone', 'class' => 'app-development-color'],
                                ['label' => 'Digital Services for Research', 'icon' => 'beaker', 'class' => 'tech-support-color'],
                                ['label' => 'Digital Consulting', 'icon' => 'chat-dots', 'class' => 'digital-consulting-color'],
                                ['label' => 'Custom Tech Solutions', 'icon' => 'tools', 'class' => 'custom-tech-solutions-color']
                                ] as $badge)
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
        </div>
    </section>
    <section id="for-uconn" class="bg-dark text-light d-flex align-items-center px-5 py-5" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 d-block justify-content-center position-relative" data-aos="fade-right" >
                    {{-- <div class="position-relative text-center" style="width: 240px; height: 240px;">
                        <div
                            class="rounded-circle border-2 border-light w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                            <div class="fs-2 fw-bold text-accent">30+</div>
                            <div class="text-secondary small">Grant-funded projects</div>
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle bg-light rounded-circle"
                            style="width: 20px; height: 20px;"></div>
                    </div> --}}
                    <div class="d-flex justify-content-center align-items-center for-uni-stat-wrapper" style="min-height: 400px;">
                        <div class="for-uni-stat" id="for-uni-stat">
                            <h2 id="stat-head">37+</h2>
                            <span id="stat-span" class="fs-4 fw-bolder">Projects This Year</span>
                        </div>
                        <div class="svg-wrapper">
                            <svg class="for-uni-stat-circle" width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle style="fill:#f2f1f1" cx="35" cy="4.44" r="4.44"/>
                                <circle style="fill:none;stroke:#f2f1f1;stroke-miterlimit:10;stroke-width:.5px" cx="35" cy="35" r="30.56"/>
                                <circle style="fill:none" cx="4.44" cy="35" r="4.44"/>
                                <circle style="fill:none" cx="35" cy="65.56" r="4.44"/>
                                <circle style="fill:none" cx="65.56" cy="35" r="4.44"/>
                            </svg>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down"><span class="border-bottom border-2 pb-3 border-primary">For</span> The University</h2>

                    <p class="text-light">
                        We work directly with faculty, staff, and researchers to understand real needs and build tools that solve real problems. Sometimes that means shipping quick fixes. Other times it means digging into legacy systems or designing something from scratch. Either way, we stay close to the work, iterate fast, and make sure what we deliver actually helps.                    </p>
                    <p class="text-light">
                        We're here to help UConn work smarter. That means replacing expensive vendor tools when we can, streamlining operations, and applying custom technology to reduce friction and improve outcomes. Whether it's administrative processes or research infrastructure, we build with the goal of making the university stronger.
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
    

    <section id="team" class="bg-teal-gradient text-light d-flex align-items-center px-5 position-relative" style="min-height: 100vh;">
        {{-- Feathered Top Edge --}}
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 160px; pointer-events: none; z-index: 2;">
            <div style="
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, #111 50%, rgba(0,0,0,0) 100%);
                transform: translateY(-50%);
            "></div>
        </div>
        <div class="container z-1">
            <div class="row align-items-center justify-content-center">
                <h2 class="mb-0 d-inline-block pb-3 text-center" data-aos="fade-down">BY THE UNIVERSITY</h2>
                <span class="border-bottom border-2 border-primary text-center" data-aos="fade-up" style="width:50px"></span>
            </div>

            <div class="row py-4 text-center">
                <div class="col-lg-6 offset-lg-3" data-aos="fade-up">
                    <p class="text-light">
                        Our team runs on the talent and drive of UConn students. They're some of the brightest minds around, and they bring serious skill, creativity, and hustle to everything we build.
                    </p>
                    <p class="text-light">
                        We pair that student energy with professional oversight to deliver real, production-grade work. It's not just busy work. It's impact, and it's powering the university every day.
                    </p>
                    <p class="text-light">
                        Like UConn itself, we thrive on pride, collaboration, and doing work that matters. When you work with us, you're getting a team that's smart, capable, and 100% all in.
                    </p>

                    <div class="btn display-btn btn-arrow-slide">
                        <a href="{{route('team')}}" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
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
        $teamMembers = \App\Models\TeamMember::all();
        @endphp

        
            <div id="teamScrollerContainer1" class="position-absolute w-100 h-100 d-flex align-items-center justify-content-start start-0 z-0" style="visibility: hidden; overflow: hidden; opacity: 0.2; padding-left: 15vw;">
                <div class="mobile-scaledown">
                    <div id="teamScroller1">
                        @foreach($teamMembers as $member)
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" >
                        @endforeach
                    </div>
                </div>
            </div>

            <div id="teamScrollerContainer2" class="position-absolute w-100 h-100 d-flex align-items-center justify-content-end end-0 z-0" style="visibility: hidden; overflow: hidden; opacity: 0.2; padding-right: 15vw;">
                <div class="mobile-scaledown">
                    <div id="teamScroller2">
                        @foreach($teamMembers->reverse() as $member)
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" >
                        @endforeach
                    </div>
                </div>
            </div>
        

        {{-- Feathered Bottom Edge --}}
        <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 120px; pointer-events: none; z-index: 2;">
            <div style="
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, #111 50%, rgba(0,0,0,0) 100%);
                transform: translateY(50%);
            "></div>
        </div>
    </section>

    
{{-- </div> --}}
    

@vite('resources/js/explodingPhrases.js')
@vite('resources/js/photoScroller.js')
@vite('resources/js/starParticles.js')
@vite('resources/js/circleTurnAnimation.js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.startPhraseAnimator({
        phrases: ["build systems", "create websites", "explore tech", "implement solutions", "develop apps"],
        selector: "#phrase-animator-uconn",
    });

    const projectScroller = window.createPhotoScroller({
        selector: "#projectsScroller",
        rows: 2,
        aspectRatio: 16/9,
        speed: 50,
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
        aspectRatio: 1.5/1,
        speed: 50,
        gap: 70,
        maxImageWidth: 200,
        direction: -85,
        imageClass: 'photo-scroller-image ',
        wrapperClass: 'photo-box-effect'
    });
    document.getElementById('teamScrollerContainer2').style.visibility = '';

    // Animated background particles
    const animatedBg = new StarParticles({
        selector: '.hero-section',
        particleCount: 200,
        particleColor: 'rgba(255,255,255,0.3)',
        // direction: 45, // 45 degree angle
        mousePush: true,
        pushRadius: 100,
        maxSpeed: 0.1,
        connections: true,
    });

    
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

@media(max-width: 1200px) {
  .mobile-scaledown {
    transform: scale(0.7);
    transform-origin: center;
  }
}

@media(max-width: 1000px) {
  .mobile-scaledown {
    transform: scale(0.6);
    transform-origin: center;
  }
}

@media(max-width: 768px) {
  .mobile-scaledown {
  transform: scale(0.5);
  transform-origin: center;
}
}





</style>
@endsection