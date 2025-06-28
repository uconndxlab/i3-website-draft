@extends('layouts.app')
@section('title', 'Our Web Design, Web Development, and UX Design Projects')

@section('content')
    <style>
        .page-h1 {
            position: fixed;
            text-transform: uppercase;
            transform-origin: center;
            transform: rotate(-90deg);
            position: fixed;
            left: -50px;
            bottom: 50%;
            font-size: 88px;
            mix-blend-mode: difference;
            z-index: 9999;
        }
    </style>
    <h1 class="page-h1 display-1">Story</h1>


    <section id="origins" class="bg-dark d-flex align-items-center px-5" style="min-height: 80vh;">

        <div class="container my-5">
            <div class="row">
                <div class="col-md-6 text-center">
                    <h1 class="text-light">2017</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <p class="text-light">
                        Dan Schwartz, now UConn's Vice Provost for Academic Operations (and our biggest supporter!) formed
                        Squared Labs, an all-star team of developers,
                        designers, and communications students to work on high-
                        value institutional projects. ​
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 text-center">
                    <h1 class="text-light">2019</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
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
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 text-center">
                    <h1 class="text-light">2020</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <p class="text-light">
                        DX Lab moves into COR²E and becomes the DX Group, one of the only core facilities in the country to offer app development and design services for faculty research.  Squared Labs moved to fall under the DXG​​
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 text-center">
                    <h1 class="text-light">2024</h1>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <p class="text-light">
                        i3 is formed
                    </p>
                </div>
            </div>

        </div>

    </section>


    <section id="approach" style="background-color: #ffbb4d; min-height: 100vh; padding: 50px 0;" class="d-flex align-items-center">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4 text-dark"">Create value as soon as possible.</h2>
                    <p class="text-dark">That's what we try to do. There's more than one way to do that, and there's no one-size-fits-all solution, but here's what works for us:</p>
                    <h5>Embrace the <acronym title="Minimum Viable Product">MVP</acronym> mindset.</h5>
                    <p class="text-dark">
                        When we can, we like to work in incremental steps. Build something small, test it, and build on it. This way, we can adapt to your needs as they change, and you can see progress along the way.
                    </p>
                    <p class="text-dark">
                        We try to get something on the screen quickly, show it to you, learn from your feedback, and adjust as we go. We think in terms of MVPs (Minimum Viable Products) and iterations, not big bang launches.
                    </p>
                    <p class="text-dark">
                        You’ll see progress early, you’ll have input often, and you won’t be left wondering what’s happening behind the scenes.

                        We know this process isn’t one-size-fits-all. We haven’t always gotten it right. But this is how we think about building things—with flexibility, transparency, and a healthy respect for what actually works.                    We know this approach can seem strange, and we don't always get it right, but we can promise you this: we won't stop until we get it right.
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
