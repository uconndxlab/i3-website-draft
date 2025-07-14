@extends('layouts.app')
@section('title', 'Our Web Design, Web Development, and UX Design Projects')

@section('content')
    <style>
        #origins p {
            font-size: 1.2rem;
        }

        #origins .slide {
            opacity: 0;
            visibility: hidden;
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
        }

        #origins .slide.active {
            visibility: visible;
            position: relative;
        }

        #origins {
            position: relative;
            overflow: hidden;
            min-height: 80vh;
        }

        #origins .slide p {
            margin-top: 1.2rem;
        }

        #origins .slide h2 {
            font-family: "Roboto Mono", monospace;
            font-size: 10rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        #origins .slide.active {
                position: relative!important;
            }

        @media (max-width: 768px) {
            
            #origins .slide h2 {
                font-size: 6rem;
            }
        }

        .slide >.col-md-6:first-child {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = Array.from(document.querySelectorAll('#origins .slide'));
            let currentIndex = 0;
            let isAnimating = false; // Track animation state

            gsap.set(slides, {
                autoAlpha: 0,
                yPercent: -50,
                y: 100,
                position: 'absolute',
                top: '50%',
                left: 0,
                width: '100%',
                zIndex: 0,
            });

            gsap.set(slides[currentIndex], {
                autoAlpha: 1,
                y: 0,
                zIndex: 1
            });

            // Set initial background color on body
            const initialBgColor = slides[currentIndex].dataset.bgColor || '#212529';
            gsap.set('body', { backgroundColor: initialBgColor });

            function getSlideIndexById(id) {
                return slides.findIndex(slide => slide.id === id);
            }

            function showSlide(targetIndex) {

                if (isAnimating || targetIndex === currentIndex || targetIndex < 0 || targetIndex >= slides.length) return;

                isAnimating = true; // Prevent new animations

                const currentSlide = slides[currentIndex];
                const nextSlide = slides[targetIndex];
                const newBgColor = nextSlide.dataset.bgColor || '#212529';

                // Remove .active from all slides, add to nextSlide
                slides.forEach(slide => slide.classList.remove('active'));
                nextSlide.classList.add('active');

                gsap.set(nextSlide, {
                    y: 100,
                    zIndex: 2
                });

                const tl = gsap.timeline({
                    onComplete: () => {
                        gsap.set(currentSlide, {
                            autoAlpha: 0,
                            zIndex: 0
                        });
                        currentIndex = targetIndex;
                        isAnimating = false; // Re-enable animations when complete
                    }
                });

                tl.to(currentSlide, {
                    autoAlpha: 0,
                    duration: 0.4,
                    ease: 'power2.out'
                }).to(nextSlide, {
                    autoAlpha: 1,
                    y: 0,
                    duration: 0.5,
                    ease: 'power2.out'
                }, '<0.1').to('body', {
                    backgroundColor: newBgColor,
                    duration: 0.6,
                    ease: 'power2.out'
                }, '<');
                // Animate odometer-like effect for the h2 text
                const currentH2 = slides[currentIndex].querySelector('h2');
                const nextH2 = slides[targetIndex].querySelector('h2');
                if (nextH2.dataset.odometerInitial && nextH2.dataset.odometerFinal) {
                    tl.fromTo(nextH2, {
                        innerText: nextH2.dataset.odometerInitial
                    }, {
                        innerText: nextH2.dataset.odometerFinal,
                        duration: 0.5,
                        snap: { innerText: 1 },
                        ease: "none"
                    }, '<');
                }
            }

            slides.forEach((slide) => {
                slide.querySelectorAll('a[href^="#slide-"]').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (isAnimating) return; // Prevent clicks during animation
                        const targetId = this.getAttribute('href').substring(1);
                        const targetIndex = getSlideIndexById(targetId);
                        if (targetIndex !== -1) showSlide(targetIndex);
                    });
                });
            });

            // Add keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (isAnimating) return; // Prevent keyboard navigation during animation
                if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                    if (currentIndex > 0) {
                        showSlide(currentIndex - 1);
                    }
                } else if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                    if (currentIndex < slides.length - 1) {
                        showSlide(currentIndex + 1);
                    }
                }
            });



        });
    </script>





    <h1 class="page-h1 display-1">Story</h1>


    <section id="origins" class="d-flex align-items-stretch px-5">

        <div class="container position-relative my-5">
            <div class="row slide" id="slide-2017" data-bg-color="#111111">
                <div class="col-md-6 text-center d-flex align-items-center timeline-header">
                    <h2 data-odometer-initial="2025"  data-odometer-final="2017" data-aos="odometer" class="text-light odometer">2017</h2>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center timeline-content">
                    <h3 style="font-family: area-normal,sans-serif; font-size: 40px;" class="fw-bold text-white mb-2 mt-3">Our Origins</h3>
                    <hr style="width: 60px; height: 2px; margin: 1rem 0; border-color: #4DB3FF; background-color: #4DB3FF;opacity: 1;">
                    <p class="text-light">

                        Dan Schwartz, now UConn's Vice Provost for Academic Operations (and our biggest supporter!) formed
                        Squared Labs, an all-star team of developers,
                        designers, and communications students to work on high-
                        value institutional projects. 
                    </p>
                    <div class="mt-3">
                        <a href="#slide-2019" class="btn btn-outline-light p-1"
                            style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; color: #4DB3FF; background-color: #FFFFFF1A; border: none;">
                            <i class="bi bi-arrow-down" style="font-size:1rem;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row slide" id="slide-2019" data-bg-color="#911616">
                <div class="col-md-6 text-center d-flex align-items-center timeline-header">
                    <h2 data-odometer-initial="2017"  data-odometer-final="2019" data-aos="odometer"  class="text-light odometer">2019</h2>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center timeline-content">
                    <div class="mb-3">
                        <a href="#slide-2017" class="btn btn-outline-light p-1"
                            style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; color: #FFBB4D; background-color: #FFFFFF1A; border: none;">
                            <i class="bi bi-arrow-up" style="font-size:1rem;"></i>
                        </a>
                    </div>

                    <h3 style="font-family: area-normal,sans-serif; font-size: 40px;" class="fw-bold text-white mb-2 mt-3">Born in the DX Lab</h3>
                    <hr style="width: 60px; height: 2px; margin: 1rem 0; border-color: #FFBB4D; background-color: #FFBB4D;opacity: 1;">

                    <p class="text-light">
                        The UConn DMD DX Lab (Digital
                        Experience Lab) forms as a
                        special topics/independent study
                        course in UConn's Digital Media & Design department. The DX Lab was a
                        research lab and undergraduate
                        experiential learning offering
                        which explored experimental,
                        next-generation, and unique
                        applications for interactive media
                        design.
                    </p>

                    <div class="mt-3">
                        <a href="#slide-2020" class="btn btn-outline-light p-1"
                            style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; color: #FFBB4D; background-color: #FFFFFF1A; border: none;">
                            <i class="bi bi-arrow-down" style="font-size:1rem;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row slide" id="slide-2020" data-bg-color="#111111">
                <div class="col-md-6 text-center d-flex align-items-center timeline-header">
                    <h2 class="text-light odometer" data-odometer-initial="2019" data-odometer-final="2020" data-aos="odometer">2020</h2>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center timeline-content">
                    <div class="mb-3">
                        <a href="#slide-2019" class="btn btn-outline-light p-1"
                            style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; color: #4DB3FF; background-color: #FFFFFF1A; border: none;">
                            <i class="bi bi-arrow-up" style="font-size:1rem;"></i>
                        </a>
                    </div>

                    <h3 style="font-family: area-normal,sans-serif; font-size: 40px;" class="fw-bold text-white mb-2 mt-3">The DX Group Emerges...</h3>
                    <hr style="width: 60px; height: 2px; margin: 1rem 0; border-color: #4DB3FF; background-color: #4DB3FF;opacity: 1;">

                    <p class="text-light">
                        DX Lab moves into COR²E and becomes the DX Group, one of the only core facilities in the country to
                        offer app development and design services for faculty research. Squared Labs moved to fall under the
                        DXG
                    </p>

                    <div class="mt-3">
                        <a href="#slide-2024" class="btn btn-outline-light p-1"
                            style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; color: #4DB3FF; background-color: #FFFFFF1A; border: none;">
                            <i class="bi bi-arrow-down" style="font-size:1rem;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row slide" id="slide-2024" data-bg-color="var(--deep)">
                <div class="col-md-6 text-center d-flex align-items-center timeline-header">
                    <h2 class="text-light odometer" data-odometer-initial="2020" data-odometer-final="2024" data-aos="odometer">2024</h2>
                </div>
                <div class="col-md-6 d-flex flex-column timeline-content">
                    <div class="mb-3">
                        <a href="#slide-2020" class="btn btn-outline-light p-1"
                            style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center; color: #4DB3FF; background-color: #FFFFFF1A; border: none;">
                            <i class="bi bi-arrow-up" style="font-size:1rem;"></i>
                        </a>
                    </div>

                    <h3 style="font-family: area-normal,sans-serif; font-size: 40px;" class="fw-bold text-white mb-2 mt-3">i3 is Born</h3>
                    <hr style="width: 60px; height: 2px; margin: 1rem 0; border-color: #4DB3FF; background-color: #4DB3FF;opacity: 1;">

                    <p class="text-light">
                        Internal Insights & Innovation (i3) launches as a strategic development team under the Vice Provost
                        for Academic Operations (hey, remember him?!). Built on the foundation of DXG and Squared Labs, i3
                        extends its mission beyond research support—partnering with administrative and academic units to
                        design and build custom tools that improve how the university works.
                    </p>
                    <div class="mt-3">
                        <a href="#approach" class="btn btn-outline-light">
                            What's it Like Working with Us?
                            <i class="bi bi-arrow-down ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section id="approach" style="background-color: #ffbb4d; min-height: 100vh; padding: 50px 0;"
        class="d-flex align-items-center" data-bs-theme="light">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4 text-dark text-uppercase">Our Approach</h2>
                    <blockquote class="blockquote text-dark"
                        style="font-size: 1.5rem; font-style: italic; border-left: 5px solid #333; padding-left: 15px;">
                        Create value early. Iterate quickly.
                    </blockquote>
                    <p class="text-dark">That's the goal. There's no single path to get there, but here's how we like to work:</p>
                    <h5 class="text-dark">Start small. Learn fast. Build what matters.</h5>
                    <p class="text-dark">
                        We usually begin with something simple—a rough draft, a working prototype, a first version you can click. 
                        Then we test, refine, and build from there. It's not about cutting corners. It's about getting feedback sooner, 
                        staying flexible, and keeping the momentum.
                    </p>
                    <p class="text-dark">
                        You'll see results early.
                        We know every project is different, and we don't pretend this approach is perfect. But it's how we think 
                        about progress: iterative, collaborative, and grounded in what actually works.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <div data-aos="fade-left" data-aos-duration="1200">
                        <svg viewBox="0 0 800 200" class="w-100" id="processSvg" style="overflow:visible">
                            <!-- Timeline Line -->
                            <line x1="100" y1="80" x2="700" y2="80" stroke="#333" stroke-width="3" class="svg-element"/>
                            
                            <!-- Station Dots -->
                            <circle cx="100" cy="80" r="8" fill="#4DB3FF" stroke="#333" stroke-width="2" class="svg-element station-dot"/>
                            <circle cx="300" cy="80" r="8" fill="#4DB3FF" stroke="#333" stroke-width="2" class="svg-element station-dot"/>
                            <circle cx="500" cy="80" r="8" fill="#4DB3FF" stroke="#333" stroke-width="2" class="svg-element station-dot"/>
                            <circle cx="700" cy="80" r="8" fill="#4DB3FF" stroke="#333" stroke-width="2" class="svg-element station-dot"/>

                            <!-- Define Badge -->
                            <g class="svg-element" transform="translate(100,80)">
                                <text x="0" y="38" text-anchor="middle" font-family="area-normal" fill="#000" font-weight="bold" font-size="16">Define</text>
                            </g>

                            <!-- Build Badge -->
                            <g class="svg-element" transform="translate(300,80)">
                                <text x="0" y="38" text-anchor="middle" font-family="area-normal" fill="#000" font-weight="bold" font-size="16">Build</text>
                            </g>

                            <!-- Refine Badge -->
                            <g class="svg-element" transform="translate(500,80)">
                                <text x="0" y="38" text-anchor="middle" font-family="area-normal" fill="#000" font-weight="bold" font-size="16">Refine</text>
                            </g>

                            <!-- Repeat Badge -->
                            <g class="svg-element" transform="translate(700,80)">
                                <text x="0" y="38" text-anchor="middle" font-family="area-normal" fill="#000" font-weight="bold" font-size="16">Repeat</text>
                            </g>

                            <!-- Husky Head Character -->
                            <g id="huskyCharacter" transform="translate(100,80)"  title="This was really the UConn Husky logo in 1959.">
>
                                <!-- Rotation wrapper - this will handle only rotation -->
                                <g id="huskyRotation">
                                    <!-- Husky Head (Simple line art) -->
                                    <image 
                                        href="{{ asset('img/i3/1959-uconn-husky.png') }}" 
                                        x="-25" 
                                        y="-75" 
                                        width="50" 
                                        height="50"
                                        preserveAspectRatio="xMidYMid meet"
                                    />
                                </g>
                            </g>

                            <!-- Glow effect -->
                            <defs>
                                <filter id="glow">
                                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                    <feMerge>
                                        <feMergeNode in="coloredBlur"/>
                                        <feMergeNode in="SourceGraphic"/>
                                    </feMerge>
                                </filter>
                            </defs>
                        </svg>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const husky = document.getElementById('huskyCharacter');
                            const huskyRotation = document.getElementById('huskyRotation');
                            
                            const stations = [
                                { x: 100, y: 80 },
                                { x: 300, y: 80 },
                                { x: 500, y: 80 },
                                { x: 700, y: 80 }
                            ];
                            let currentStation = 0;
                            let isAnimating = false;

                            function moveToNextStation() {
                                if (isAnimating) return;
                                
                                isAnimating = true;
                                const nextStation = (currentStation + 1) % stations.length;
                                const target = stations[nextStation];
                                
                                // Move to next station (only translate the main group)
                                gsap.to(husky, {
                                    duration: 1.5,
                                    x: target.x,
                                    y: target.y,
                                    ease: "power2.inOut",
                                    onComplete: () => {
                                        // Bounce the husky a few times at the station
                                        gsap.to(huskyRotation, {
                                            duration: 0.6,
                                            y: -15,
                                            ease: "power2.out",
                                            yoyo: true,
                                            repeat: 5, // 3 bounces (down-up-down-up-down-up)
                                            onComplete: () => {
                                                isAnimating = false;
                                                currentStation = nextStation;
                                                
                                                // Wait a moment before moving to next station
                                                setTimeout(moveToNextStation, 800);
                                            }
                                        });
                                    }
                                });
                                
                                // Add station glow effect
                                const stationDots = document.querySelectorAll('.station-dot');
                                stationDots[nextStation].style.filter = 'url(#glow)';
                                setTimeout(() => {
                                    stationDots[nextStation].style.filter = '';
                                }, 2000);
                            }

                            // Fade in elements sequentially
                            const elements = document.querySelectorAll('.svg-element');
                            elements.forEach((el, index) => {
                                el.style.opacity = 0;
                                setTimeout(() => {
                                    el.style.transition = "opacity 0.8s ease";
                                    el.style.opacity = 1;
                                }, 200 * index);
                            });

                            // Start the husky animation after elements fade in
                            setTimeout(() => {
                                moveToNextStation();
                            }, elements.length * 200 + 1000);
                        });
                        </script>

                        <span class="text-dark text-small mt-2" style="font-size:0.8rem">
                            * this was really the UConn Husky logo in 1959.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="news-section py-5 bg-light text-dark">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase text-dark" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">In The</span> News</h2>
            <div class="row g-4" data-aos="fade-up" data-aos-duration="1200">
                {{-- Example cards, replace with dynamic content --}}
                @for ($i = 0; $i < 5; $i++)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card text-white border-0 shadow-sm overflow-hidden rounded-4">
                            <img src="https://picsum.photos/600/40{{ $i }}" class="card-img"
                                alt="placeholder image">
                            <div class="card-img-overlay d-flex flex-column justify-content-end bg-dark bg-opacity-50 p-3">
                                <h5 class="card-title fw-bold">Title of Article</h5>
                                <p class="card-text small mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et nunc non eros congue
                                    tincidunt.
                                </p>
                                <p class="card-text small text-white-50 mb-0">
                                    <strong>Author of Article</strong> • 01/02/3456
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
