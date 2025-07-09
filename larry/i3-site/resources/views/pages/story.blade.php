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


    <section id="origins" class="d-flex align-items-stretch px-5" style="min-height: 90vh;">

        <div class="container position-relative my-5">
            <div class="row slide" id="slide-2017" data-bg-color="#111111">
                <div class="col-md-6 text-center d-flex align-items-center timeline-header">
                    <h2 class="text-light">2017</h2>
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
                    <h2 class="text-light">2019</h2>
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
                        course in DMD. The DX Lab was a
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
                    <h2 class="text-light">2020</h2>
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
                    <h2 class="text-light">2024</h2>
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


    <div style="position: relative; overflow: hidden; margin-bottom: -2px; ">
        <svg viewBox="0 0 1440 160" xmlns="http://www.w3.org/2000/svg" style="display: block; width: 100%; fill: #ffbb4d; z-index:2;">
        <path fill="#ffbb4d" d="M0,120 
            C240,200 480,40 720,120 
            C960,200 1200,40 1440,120 
            L1440,160 L0,160 Z"></path>
        </svg>
    </div>
    <section id="approach" style="background-color: #ffbb4d; min-height: 100vh; padding: 50px 0;"
        class="d-flex align-items-center">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4 text-dark text-uppercase">Our Approach</h2>
                    <blockquote class="blockquote text-dark"
                        style="font-size: 1.5rem; font-style: italic; border-left: 5px solid #333; padding-left: 15px;">
                        Create value as soon as possible.
                    </blockquote>
                    <p class="text-dark">That's what we try to do. There's more than one way to do that, and there's no
                        one-size-fits-all solution, but here's what works for us:</p>
                    <h5>Embrace the <acronym title="Minimum Viable Product">MVP</acronym> mindset.</h5>
                    <p class="text-dark">
                        When we can, we like to work in incremental steps. Build something small, test it, and build on it.
                        This way, we can adapt to your needs as they change, and you can see progress along the way.
                    </p>
                    <p class="text-dark">
                        We try to get something on the screen quickly, show it to you, learn from your feedback, and adjust
                        as we go. We think in terms of MVPs (Minimum Viable Products) and iterations, not big bang launches.
                    </p>
                    <p class="text-dark">
                        You'll see progress early, you'll have input often, and you won't be left wondering what's happening
                        behind the scenes.

                        We know this process isn't one-size-fits-all. We haven't always gotten it right. But this is how we
                        think about building things—with flexibility, transparency, and a healthy respect for what actually
                        works. We know this approach can seem strange, and we don't always get it right, but we can promise
                        you this: we won't stop until we get it right.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-scooter" style="font-size: 5rem; margin: 0 15px;"></i>
                        <i class="bi bi-bicycle" style="font-size: 5rem; margin: 0 15px;"></i>
                        <i class="bi bi-car-front" style="font-size: 5rem; margin: 0 15px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="position: relative; overflow: hidden; margin-top: -2px; ">
        <svg viewBox="0 0 1440 160" xmlns="http://www.w3.org/2000/svg" style="display: block; width: 100%; fill: #ffbb4d; z-index:2; transform: scaleY(-1.01);" class="bg-dark">
        <path fill="#ffbb4d" d="M0,120 
            C240,200 480,40 720,120 
            C960,200 1200,40 1440,120 
            L1440,160 L0,160 Z"></path>
        </svg>
    </div>
@endsection
