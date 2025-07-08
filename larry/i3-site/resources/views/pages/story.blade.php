@extends('layouts.app')
@section('title', 'Our Web Design, Web Development, and UX Design Projects')

@section('content')
<style>
    #origins h1 {
        font-size: 6rem;
    }

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
        margin-top:1.2rem;
    }
</style>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = Array.from(document.querySelectorAll('#origins .slide'));
    let currentIndex = 0;

    gsap.set(slides, {
        autoAlpha: 0,
        y: 100,
        position: 'absolute',
        top: '35%',
        left: 0,
        width: '100%',
        zIndex: 0
    });

    gsap.set(slides[currentIndex], {
        autoAlpha: 1,
        y: 0,
        zIndex: 1
    });

    function getSlideIndexById(id) {
        return slides.findIndex(slide => slide.id === id);
    }

    function showSlide(targetIndex) {
        if (targetIndex === currentIndex || targetIndex < 0 || targetIndex >= slides.length) return;

        const currentSlide = slides[currentIndex];
        const nextSlide = slides[targetIndex];

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
        }, '<0.1');
    }

    slides.forEach((slide) => {
        slide.querySelectorAll('a[href^="#slide-"]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetIndex = getSlideIndexById(targetId);
                if (targetIndex !== -1) showSlide(targetIndex);
            });
        });
    });
});

</script>





    <h1 class="page-h1 display-1">Story</h1>


    <section id="origins" class="bg-dark d-flex align-items-center px-5" style="min-height: 80vh;">

        <div class="container my-5">
            <div class="row slide" id="slide-2017">
                <div class="col-md-6 text-center timeline-header">
                    <h1 class="text-light">2017</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center timeline-content">
                    <p class="text-light">
                        Dan Schwartz, now UConn's Vice Provost for Academic Operations (and our biggest supporter!) formed
                        Squared Labs, an all-star team of developers,
                        designers, and communications students to work on high-
                        value institutional projects. ​
                    </p>
                    <a href="#slide-2019" class="btn btn-outline-light p-1"
                        style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">
                        <i class="bi bi-arrow-down" style="font-size:1rem;"></i>
                    </a>
                </div>
            </div>

            <div class="row slide" id="slide-2019">
                <div class="col-md-6 text-center timeline-header">
                    <h1 class="text-light">2019</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center timeline-content">

                    <a href="#slide-2017" class="btn btn-outline-light p-1"
                        style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">
                        <i class="bi bi-arrow-up" style="font-size:1rem;"></i>
                    </a>

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
                        design.​​
                    </p>

                    <a href="#slide-2020" class="btn btn-outline-light p-1"
                        style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">
                        <i class="bi bi-arrow-down" style="font-size:1rem;"></i>
                    </a>
                </div>
            </div>

            <div class="row slide" id="slide-2020">
                <div class="col-md-6 text-center timeline-header">
                    <h1 class="text-light">2020</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center timeline-content">
                    <a href="#slide-2019" class="btn btn-outline-light p-1"
                        style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">
                        <i class="bi bi-arrow-up" style="font-size:1rem;"></i>
                    </a>

                    <p class="text-light">
                        DX Lab moves into COR²E and becomes the DX Group, one of the only core facilities in the country to
                        offer app development and design services for faculty research. Squared Labs moved to fall under the
                        DXG​​
                    </p>

                    <a href="#slide-2024" class="btn btn-outline-light p-1"
                        style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">
                        <i class="bi bi-arrow-down" style="font-size:1rem;"></i>
                    </a>
                </div>
            </div>

            <div class="row slide" id="slide-2024">
                <div class="col-md-6 text-center timeline-header">
                    <h1 class="text-light">2024</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center timeline-content">
                    <a href="#slide-2020" class="btn btn-outline-light p-1"
                        style="border-radius:50%; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">
                        <i class="bi bi-arrow-up" style="font-size:1rem;"></i>
                    </a>
                    <p class="text-light">
                        Internal Insights & Innovation (i3) launches as a strategic development team under the Vice Provost
                        for Academic Operations (hey, remember him?!). Built on the foundation of DXG and Squared Labs, i3
                        extends its mission beyond research support—partnering with administrative and academic units to
                        design and build custom tools that improve how the university works.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <section id="approach" style="background-color: #ffbb4d; min-height: 100vh; padding: 50px 0;"
        class="d-flex align-items-center">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4 text-dark"">Our Approach</h2>
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
                        You’ll see progress early, you’ll have input often, and you won’t be left wondering what’s happening
                        behind the scenes.

                        We know this process isn’t one-size-fits-all. We haven’t always gotten it right. But this is how we
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
@endsection
