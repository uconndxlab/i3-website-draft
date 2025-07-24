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

        .timeline-navigation {
            backdrop-filter: blur(10px);
        }

        .year-marker .marker-dot:hover {
            transform: scale(1.2);
            box-shadow: 0 0 15px rgba(77, 179, 255, 0.5);
        }

        .year-marker:focus {
            outline: 2px solid #4DB3FF;
            outline-offset: 4px;
            border-radius: 50%;
        }

        .year-marker:focus .marker-dot {
            transform: scale(1.2);
            box-shadow: 0 0 15px rgba(77, 179, 255, 0.7);
        }

        .year-marker.active .marker-dot {
            background-color: #4DB3FF !important;
            transform: scale(1.3);
            box-shadow: 0 0 20px rgba(77, 179, 255, 0.7);
        }

        .year-marker.active .year-label {
            color: #4DB3FF !important;
            font-weight: bold;
        }
    </style>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = Array.from(document.querySelectorAll('#origins .slide'));
            const yearMarkers = Array.from(document.querySelectorAll('.year-marker'));
            let currentIndex = 0;
            let isAnimating = false; // Track animation state
            let autoAdvanceTimer = null;
            let progressTimer = null;
            let isAutoPlaying = true;
            const autoAdvanceDelay = 4500; // 4.5 seconds per slide

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

            // Initialize timeline navigation
            function updateTimelineNavigation(activeIndex) {
                yearMarkers.forEach((marker, index) => {
                    marker.classList.toggle('active', index === activeIndex);
                });
            }

            // Set initial active marker
            updateTimelineNavigation(currentIndex);

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

                // Update timeline navigation
                updateTimelineNavigation(targetIndex);

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
                        
                        // Restart auto-advance timer if auto-playing
                        if (isAutoPlaying) {
                            startAutoAdvance();
                        }
                    }
                });

                tl.to(currentSlide, {
                    autoAlpha: 0,
                    duration: 1,
                    ease: 'power2.out'
                }).to(nextSlide, {
                    autoAlpha: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power2.out'
                }, '<0.1').to('body', {
                    backgroundColor: newBgColor,
                    duration: 1,
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

            function autoAdvance() {
                if (!isAutoPlaying || isAnimating) return;
                
                const nextIndex = (currentIndex + 1) % slides.length;
                showSlide(nextIndex);
            }

            function updateProgressBar() {
                const progressBar = document.getElementById('timeline-progress');
                if (!isAutoPlaying || isAnimating) {
                    progressBar.style.width = '0%';
                    return;
                }

                // Calculate positions based on slide positions (0, 80, 160, 240 out of 240px total)
                const slidePositions = [0, 80, 160, 240]; // pixel positions of each slide
                const totalWidth = 240; // total timeline width
                
                const currentPosition = slidePositions[currentIndex];
                const nextIndex = (currentIndex + 1) % slides.length;
                const nextPosition = slidePositions[nextIndex];
                
                // Calculate the segment width we need to fill
                const segmentStart = (currentPosition / totalWidth) * 100;
                const segmentWidth = ((nextPosition - currentPosition) / totalWidth) * 100;
                
                let startTime = Date.now();
                
                function animate() {
                    if (!isAutoPlaying || isAnimating) {
                        // Reset to just show up to current position
                        progressBar.style.width = segmentStart + '%';
                        return;
                    }
                    
                    const elapsed = Date.now() - startTime;
                    const progress = Math.min(elapsed / autoAdvanceDelay, 1);
                    
                    // Fill from current position to next position
                    const currentWidth = segmentStart + (segmentWidth * progress);
                    progressBar.style.width = currentWidth + '%';
                    
                    if (progress < 1) {
                        progressTimer = requestAnimationFrame(animate);
                    }
                }
                
                progressTimer = requestAnimationFrame(animate);
            }

            function startAutoAdvance() {
                clearTimeout(autoAdvanceTimer);
                if (progressTimer) {
                    cancelAnimationFrame(progressTimer);
                }
                
                if (isAutoPlaying) {
                    updateProgressBar();
                    autoAdvanceTimer = setTimeout(autoAdvance, autoAdvanceDelay);
                }
            }

            function stopAutoAdvance() {
                clearTimeout(autoAdvanceTimer);
                if (progressTimer) {
                    cancelAnimationFrame(progressTimer);
                }
                
                // Keep progress bar showing up to current slide position
                const progressBar = document.getElementById('timeline-progress');
                const slidePositions = [0, 80, 160, 240];
                const totalWidth = 240;
                const currentPosition = slidePositions[currentIndex];
                const segmentStart = (currentPosition / totalWidth) * 100;
                progressBar.style.width = segmentStart + '%';
            }

            function toggleAutoPlay() {
                isAutoPlaying = !isAutoPlaying;
                const playPauseBtn = document.getElementById('timeline-play-pause');
                const icon = playPauseBtn.querySelector('i');
                
                if (isAutoPlaying) {
                    icon.className = 'bi bi-pause-fill';
                    playPauseBtn.title = 'Pause auto-advance';
                    startAutoAdvance();
                } else {
                    icon.className = 'bi bi-play-fill';
                    playPauseBtn.title = 'Resume auto-advance';
                    stopAutoAdvance();
                }
            }

            // Timeline navigation click handlers
            yearMarkers.forEach((marker, index) => {
                marker.addEventListener('click', function() {
                    if (isAnimating) return;
                    stopAutoAdvance();
                    showSlide(index);
                });
            });

            slides.forEach((slide) => {
                slide.querySelectorAll('a[href^="#slide-"]').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (isAnimating) return; // Prevent clicks during animation
                        stopAutoAdvance();
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
                        stopAutoAdvance();
                        showSlide(currentIndex - 1);
                    }
                } else if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                    if (currentIndex < slides.length - 1) {
                        stopAutoAdvance();
                        showSlide(currentIndex + 1);
                    }
                } else if (e.key === ' ') { // Spacebar to toggle play/pause
                    e.preventDefault();
                    toggleAutoPlay();
                }
            });

            // Play/Pause button handler
            document.getElementById('timeline-play-pause').addEventListener('click', toggleAutoPlay);

            // Start auto-advance
            startAutoAdvance();
        });
    </script>





    <h1 class="page-h1 display-1">Story</h1>


    <section id="origins" class="d-flex align-items-stretch px-5">

        <div class="container position-relative my-5">
        <!-- Horizontal Timeline Navigation -->
        <div class="timeline-navigation mb-4" style="z-index: 1000; max-width:450px; margin:0 auto; position: absolute;">
            <div class="d-flex align-items-center justify-content-center rounded-pill px-4 py-3">
                <!-- Play/Pause Button -->
                <button id="timeline-play-pause" class="btn btn-sm btn-outline-light me-3 rounded-circle" 
                        style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.3);" 
                        title="Pause auto-advance" aria-label="Pause or resume timeline auto-advance">
                    <i class="bi bi-pause-fill"></i>
                </button>
                
                <!-- Timeline line -->
                <div class="timeline-line position-relative d-flex align-items-center justify-content-center">
                    <div class="line bg-light opacity-25" style="height: 2px; width: 240px;"></div>
                    <!-- Progress indicator line -->
                    <div id="timeline-progress" class="position-absolute bg-primary" style="height: 2px; width: 0%; left: 0; top: 50%; transform: translateY(-50%); transition: width 0.1s linear;"></div>
                    
                    <!-- Year markers -->
                    <button class="year-marker position-absolute btn p-0 border-0 bg-transparent" 
                            data-year="2017" data-slide="slide-2017" style="left: 0;" 
                            aria-label="Go to 2017: Our Origins" role="button" tabindex="0">
                        <div class="marker-dot bg-primary rounded-circle" style="width: 12px; height: 12px; cursor: pointer; transition: all 0.3s ease;"></div>
                        <span class="year-label position-absolute text-light small" style="top: 20px; left: 50%; transform: translateX(-50%); white-space: nowrap;">2017</span>
                    </button>
                    
                    <button class="year-marker position-absolute btn p-0 border-0 bg-transparent" 
                            data-year="2019" data-slide="slide-2019" style="left: 80px;" 
                            aria-label="Go to 2019: Born in the DX Lab" role="button" tabindex="0">
                        <div class="marker-dot bg-light rounded-circle" style="width: 12px; height: 12px; cursor: pointer; transition: all 0.3s ease;"></div>
                        <span class="year-label position-absolute text-light small" style="top: 20px; left: 50%; transform: translateX(-50%); white-space: nowrap;">2019</span>
                    </button>
                    
                    <button class="year-marker position-absolute btn p-0 border-0 bg-transparent" 
                            data-year="2020" data-slide="slide-2020" style="left: 160px;" 
                            aria-label="Go to 2020: The DX Group Emerges" role="button" tabindex="0">
                        <div class="marker-dot bg-light rounded-circle" style="width: 12px; height: 12px; cursor: pointer; transition: all 0.3s ease;"></div>
                        <span class="year-label position-absolute text-light small" style="top: 20px; left: 50%; transform: translateX(-50%); white-space: nowrap;">2020</span>
                    </button>
                    
                    <button class="year-marker position-absolute btn p-0 border-0 bg-transparent" 
                            data-year="2024" data-slide="slide-2024" style="left: 240px;" 
                            aria-label="Go to 2024: i3 is Born" role="button" tabindex="0">
                        <div class="marker-dot bg-light rounded-circle" style="width: 12px; height: 12px; cursor: pointer; transition: all 0.3s ease;"></div>
                        <span class="year-label position-absolute text-light small" style="top: 20px; left: 50%; transform: translateX(-50%); white-space: nowrap;">2024</span>
                    </button>
                </div>
            </div>
        </div>


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
                        <a title="Next: 2019" href="#slide-2019" class="btn btn-outline-light p-1"
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
                        <a title="Previous: 2017" href="#slide-2017" class="btn btn-outline-light p-1"
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
                        <a title="Next: 2020" href="#slide-2020" class="btn btn-outline-light p-1"
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
                        <a title="Previous: 2019" href="#slide-2019" class="btn btn-outline-light p-1"
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
                        <a title="Next: 2024" href="#slide-2024" class="btn btn-outline-light p-1"
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
                        <a title="Previous: 2020" href="#slide-2020" class="btn btn-outline-light p-1"
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
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <div class="btn display-btn btn-arrow-slide btn-arrow-slide--down">
                            <a href="#approach" class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text"> What's it Like Working with Us? </span>
                            </a>
                        </div>
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
                    <h3 class="text-dark">Start small. Learn fast. Build what matters.</h3>
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
                        <svg viewBox="0 0 800 200" class="w-100" id="processSvg" style="overflow:visible" aria-hidden="true" role="presentation">
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
                            <g id="huskyCharacter" transform="translate(100,80)" title="This was really the UConn Husky logo in 1959.">
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
                                        alt="UConn Husky Logo from 1959"
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
    <style>
        .news-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        
        .news-card img {
            transition: transform 0.3s ease;
        }
        
        .news-card:hover img {
            transform: scale(1.05);
        }
    </style>

    <section class="news-section py-5 bg-light text-dark">
        <div class="container">
            <h2 class="mb-3 d-inline-block pb-3 text-uppercase text-dark" data-aos="fade-down"><span
                    class="border-bottom border-2 pb-3 border-primary">In The</span> News</h2>
            <div class="row g-4" data-aos="fade-up" data-aos-duration="1200">
                {{-- Example cards, replace with dynamic content --}}

                @php 
                    $stories =  array(
                        ['title' => 'UConn Funds Five COVID-19 Research Projects, Announces Additional Funding', 'publication' => 'UConn Today', 'date' => '10/02/2020', 'link' => 'https://today.uconn.edu/2020/10/uconn-funds-five-covid-19-research-projects-announces-additional-funding/', 'img' => 'https://today.uconn.edu/wp-content/uploads/2020/05/GettyImages-1220459949-e1615807575563.jpg'],
                        ['title' => 'Scorecard for Safer Play: Athletic Field Assessment Form Updated for Mobile Use', 'publication' => 'UConn Today', 'date' => '06/23/2025', 'link' => 'https://today.uconn.edu/2025/06/scorecard-for-safer-play-athletic-field-assessment-form-updated-for-mobile-use/', 'img' => 'https://today.uconn.edu/wp-content/uploads/2025/06/Drag-mat-cultivation-by-Alyssa-Siegel-Miles-1024x683.jpg'],
                        ['title' => 'New UConn Extension Publication Website Shares Answers Connecticut Residents Can Trust', 'publication' => 'UConn Today', 'date' => '04/19/2024', 'link' => 'https://today.uconn.edu/2024/04/new-uconn-extension-publication-website-shares-answers-connecticut-residents-can-trust/', 'img' => 'https://today.uconn.edu/wp-content/uploads/2023/04/DJI_0622-HDR-Edit-Crop-1024x683.jpg'],
                        ['title' => 'New Game Makes Financial Education Fun', 'publication' => 'UConn Today', 'date' => '04/26/2023', 'link' => 'https://today.uconn.edu/2023/04/new-game-makes-financial-education-fun/', 'img' => 'https://today.uconn.edu/wp-content/uploads/2023/03/law170419a219-1024x683.jpg'],
                        ['title' => "Research Spotlight: Pushing the boundaries of digital media with UConn's DX Lab",  'publication' => 'The Daily Campus', 'date' => '04/20/2020', 'link' => 'https://dailycampus.com/2020/04/20/2020-4-20-research-spotlight-pushing-the-boundaries-of-digital-media-with-uconns-dx-lab/', 'img' => 'https://i0.wp.com/images.squarespace-cdn.com/content/v1/54f74f23e4b0952b4e0011c0/1587340490915-L4Y26FHIGTYJR4GYY71L/ke17ZwdGBToddI8pDm48kMiC1kkJMCC5CmdIxgmMBQRZw-zPPgdn4jUwVcJE1ZvWQUxwkmyExglNqGp0IvTJZUJFbgE-7XRK3dMEBRBhUpwDkWRUVPzILwwU1Cm0tACnQ-gsxKt_jcXVfT9FtNluPGWW0QT5AQYLWdKSnWNUYi4/TREE.jpg?w=696&ssl=1'],
                        ['title' => 'Pilot testing an intervention to educate and promote nutritious choices at food pantries', 'publication' => 'Journal of Public Health', 'date' => '05/25/2021', 'link' => 'https://link.springer.com/article/10.1007/s10389-021-01570-6', 'img' => asset('img/i3/work/wellscan.png')],
                        ['title' => 'Strengthening Connecticut Farms with Risk Management Training and Tools', 'publication' => 'UConn Today', 'date' => '04/01/2025', 'link' => 'https://today.uconn.edu/2025/04/strengthening-connecticut-farms-with-risk-management-training-and-tools/', 'img' => 'https://today.uconn.edu/wp-content/uploads/2020/11/Farm160719c092-e1697619059398.jpg'],
                        ['title' => 'Website Breaks Down Statewide Benefit of UConn Research Funding', 'publication' => 'UConn Today', 'date' => '10/02/2017', 'link' => 'https://today.uconn.edu/2017/10/website-breaks-statewide-benefit-uconn-research-funding/', 'img' => 'https://today.uconn.edu/wp-content/uploads/2017/09/CTMapGrantExpenditures.jpg'],
                        ['title' => 'App Supporting Archival Research Continues Development with Community Partnerships', 'publication' => 'UConn Today', 'date' => '02/15/2022', 'link' => 'https://today.uconn.edu/2022/02/app-supporting-archival-research-continue-development-with-community-partnerships/', 'img' => asset('img/i3/work/sourcery.png')]
                    );

                    // order by date desc
                    usort($stories, function($a, $b) {
                        return strtotime($b['date']) - strtotime($a['date']);
                    });

                @endphp
                
                @foreach ($stories as $story)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="position-relative" style="padding-top: 62.5%;">
                            <div class="card news-card text-white border-0 shadow-sm overflow-hidden rounded-4 position-absolute top-0 start-0 w-100 h-100">
                                <img src="{{ $story['img'] }}" class="card-img h-100 w-100 object-fit-cover"
                                    alt="Image for {{ $story['title'] }}" loading="lazy" style="object-fit: cover;">
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0) 100%);">
                                    <h3 class="card-title fw-bold">{{ $story['title'] }}</h3>
                                    <p class="card-text small text-white mb-0">
                                        <strong>{{ $story['publication'] }}</strong> • {{ $story['date'] }}
                                    </p>
                                </div>
                                <a href="{{ $story['link'] }}" target="_blank" class="stretched-link" aria-label="Read more about {{ $story['title'] }}"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
