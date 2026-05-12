@extends('layouts.app')

@section('title', 'Case Study: Coming Out With Care - ??')
@section('og_image', 'img/case-studies/care_og.png')
@section('meta_description', '??')

@section('content')
    <!-- Lincus Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Sanchez&amp;display=swap" rel="stylesheet">
    <style>
      @import url('/care-assets/coming-out-with-care.css');
      @import url('https://unpkg.com/aos@next/dist/aos.css');

      /* Care Page Style Reset - Override i3 Global Styles */
      .care-page {
        font-family: "Poppins", Arial, Helvetica, BlinkMacSystemFont, sans-serif;
        color: #212529;
      }
      body {
        background: white;
      }

      .care-page p,
      .care-page h1,
      .care-page h2,
      .care-page h3,
      .care-page h4,
      .care-page h5,
      .care-page h6,
      .care-page span {
        font-family: inherit;
        color: inherit;
        text-text-anchor="middle" transform: unset;
        -webkit-text-stroke: unset;
        text-stroke: unset;
        letter-spacing: 1px;
        line-height: 170%;
      }
      .care-page p,
      .care-page span {
        font-weight: 300;
      }



      .care-page h2 {
        font-size: revert;
      }

      .care-page h3 {
        font-weight: revert;
      }
    </style>
    <div class="care-page">
        <!-- Hero -->
        <div class=" bg-primary text-white pt-5" id="hero-section">
            <div class="container">
                <div class="row pt-3 py-5">
                    <div class="col-lg-8 mx-auto py-5 text-center">
                        <svg id="flower-svg" data-name="Flower SVG" class="mb-3" xmlns="http://www.w3.org/2000/svg" width="75" viewBox="0 0 184.84454 181.235056">
                            <defs>
                                <style>
                                  .cls-1 {
                                    fill: #f9ee13;
                                  }

                                  .cls-2 {
                                    fill: #742b83;
                                  }

                                  .cls-3 {
                                    fill: #3d5eab;
                                  }

                                  .cls-4 {
                                    fill: #e51e25;
                                  }

                                  .cls-5 {
                                    fill: #fff;
                                    stroke: #000;
                                    stroke-miterlimit: 10;
                                    stroke-width: .5px;
                                  }

                                  .cls-6 {
                                    fill: #0d8040;
                                  }

                                  .cls-7 {
                                    fill: #f68c1e;
                                  }
                                </style>
                            </defs>
                            <g id="flower">
                                <path id="petal-yellow" style="transform-origin: 37% 35%" class="cls-1" d="M27.039587,64.3471c-1.601948-1.0182-5.871948-4.028767-8.266961-9.81754-.438873-1.060741-2.349474-5.924118-1.284493-11.818694.082882-.458744.379101-2.238387,1.296379-4.392791.965419-2.26747,2.279529-4.032567,4.116746-6.752547,1.672228-2.475707,3.621026-4.750049,5.856016-6.751005,2.746464-2.458869,5.625218-5.49919,10.334051-7.968242,2.675793-1.403044,7.014942-3.618329,13.064713-3.855447,5.867874-.229978,10.174007,1.525337,11.374118,2.046451,1.795779.779747,4.933303,2.183171,7.561795,5.336125,1.405839,1.686341,2.126683,3.240079,2.4719,3.964962,2.233118,4.68916,4.861769,17.400713,10.462407,36.917399-11.751079,9.965669-7.978095,8.294975-19.729182,18.260641-6.523652-2.703743-13.092809-5.401184-19.70736-8.091447-5.871915-2.388217-11.722121-4.747369-17.550129-7.077865Z"/>
                                <path id="petal-orange" style="transform-origin: 32% 54%" class="cls-7" d="M34.851481,134.08796c-1.690305.863619-6.451348,3.015105-12.654741,2.141094-1.136721-.160147-6.296904-.981935-10.835577-4.890984-.353222-.304221-1.736346-1.462599-3.127211-3.346306-1.463859-1.982567-2.317888-4.010641-3.729235-6.974045-1.284595-2.697274-2.255328-5.530669-2.845257-8.471925-.724931-3.614357-1.883741-7.63778-1.621578-12.948203.148969-3.01765.442186-7.880748,3.308025-13.213939,2.779682-5.172833,6.477458-7.992473,7.535518-8.762106,1.583205-1.151646,4.384722-3.142917,8.435416-3.807719,2.166495-.355569,3.871107-.188198,4.670904-.117792,5.173739.455475,17.460796,4.64136,37.119808,9.719885,2.623568,15.182862,3.098719,11.083977,5.72228,26.266845-5.640353,4.249079-11.298369,8.540567-16.973237,12.874812-5.037731,3.847626-10.039401,7.691298-15.005114,11.530384Z"/>
                                <path id="petal-red" style="transform-origin:44% 67%" class="cls-4" d="M41.711067,139.588902c-1.189314,1.479359-4.264048,5.703388-4.669824,11.954894-.074363,1.145535-.319123,6.36501,2.585257,11.603789.226033.407707,1.078933,1.997497,2.640431,3.74237,1.643448,1.836445,3.455468,3.085058,6.069937,5.069553,2.379676,1.806271,4.956456,3.332919,7.716283,4.508655,3.391409,1.444799,7.095103,3.397599,12.347873,4.220843,2.984887.467814,7.805994,1.169685,13.610541-.551711,5.630018-1.669649,9.142719-4.716754,10.111437-5.596192,1.449542-1.315923,3.968921-3.653954,5.443581-7.484811.788718-2.048915.971494-3.751945,1.065207-4.549346.606176-5.158254-1.134032-20.453381-2.108575-40.734368-14.332072-5.656336-10.081721-2.87443-24.413799-8.530761-5.307314,4.658398-10.659742,9.325467-16.057461,14.000339-4.7917,4.150009-9.572195,8.265513-14.340888,12.346746Z"/>
                                <path id="petal-purple" style="transform-origin: 63% 63%" class="cls-2" d="M112.239931,156.922147c.975591,1.628248,3.872483,5.976171,9.596069,8.52304,1.048796.466699,5.860085,2.504915,11.780702,1.595785.460771-.070753,2.247608-.319928,4.425457-1.18006,2.292146-.905275,4.09129-2.17237,6.858784-3.937204,2.518953-1.606345,4.843907-3.494476,6.903119-5.675909,2.530457-2.680651,5.645651-5.47821,8.238048-10.120279,1.473135-2.637854,3.802101-6.917061,4.19871-12.958474.384673-5.859766-1.256449-10.210701-1.745727-11.42414-.732109-1.815721-2.052287-4.989171-5.134813-7.699913-1.648673-1.44983-3.182856-2.211406-3.898382-2.575623-4.628626-2.356026-17.266421-5.319052-36.62859-11.432527-10.272157,11.484128-8.502525,7.756524-18.77468,19.240661,2.53073,6.592698,5.05396,13.230719,7.568816,19.913929,2.232505,5.932865,4.436526,11.843263,6.612487,17.730714Z"/>
                                <path id="petal-blue" style="transform-origin: 68% 45%" class="cls-3" d="M147.954206,45.639218c1.646244-.944907,6.296868-3.325688,12.535463-2.754799,1.143171.104603,6.337251.674131,11.060898,4.357523.367617.286659,1.80551,1.37631,3.286455,3.19005,1.558667,1.908929,2.510443,3.893009,4.064425,6.784169,1.41442,2.631518,2.521979,5.41428,3.254437,8.323318.900079,3.574767,2.253442,7.536987,2.250191,12.853876-.001842,3.021324-.057894,7.892931-2.660623,13.359352-2.524483,5.302058-6.080564,8.298422-7.099891,9.118667-1.525245,1.227377-4.226469,3.352711-8.239985,4.21398-2.146609.460648-3.85735.376485-4.659626.345111-5.189781-.20299-18.751047-4.122507-38.634043-8.237675-3.359813-15.03709-2.549851-10.58299-5.909657-25.620086,5.426745-4.518705,10.869066-9.08063,16.326137-13.686081,4.844387-4.088383,9.652948-8.17106,14.425819-12.247406Z"/>
                                <path id="petal-green" style="transform-origin: 55% 31%" class="cls-6" d="M144.312156,39.722151c1.101127-1.54612,3.924609-5.942069,3.965569-12.206597.007514-1.147922-.052156-6.372792-3.256744-11.433507-.249396-.393849-1.193448-1.931262-2.853927-3.582222-1.747624-1.737603-3.629295-2.878552-6.354914-4.707395-2.480844-1.664597-5.142171-3.038566-7.965795-4.051557-3.469806-1.24481-7.280954-2.978569-12.572757-3.494461-3.007068-.293161-7.860871-.71303-13.555298,1.343536-5.523209,1.994741-8.852464,5.241274-9.768314,6.175643-1.370434,1.398119-3.749354,3.878925-4.998378,7.789171-.668037,2.091376-.751309,3.802161-.798417,4.603667-.304698,5.184804,2.042605,17.951306,4.196783,38.141097,14.637199,4.811945,10.512861,4.683626,25.150067,9.495565,5.02697-4.95962,10.098472-9.930524,15.214733-14.911856,4.541843-4.422061,9.07451-8.809024,13.59739-13.161086Z"/>
                                <circle id="flower-center" style="transform-origin: 50%;" class="cls-5" cx="92.162914" cy="89.585252" r="33.191772"/>
                            </g>
                        </svg>
                        <h1 class="display-4 fw-bold mb-1" data-aos="fade-up" data-aos-duration="800">Coming Out With Care</h1>
                        <h2 class="lead mb-3 fs-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">A Guide for Your Well-Being</h2>
                        <span class="text-center px-4 fs-6 hero-published text-white rounded-pill d-inline-block" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">PUBLISHED 05/08/2026</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overview -->
        <section id="overview">
            <div class="container overview position-relative">
                <span class="text-start fs-5">01 Overview</span>
                <div class="row mb-2">
                    <span class="fs-3 fw-light py-2">Coming out is a <span class="fw-medium">deeply personal</span> and often <span class="fw-medium">emotionally challenging</span> process.</span>
                    <p class="w-100 fs-5">
                        The University of Connecticut's Institutional Insights and Innovations (i3) helped develop Coming Out With Care:
                        A Guide for Your Well-Being, an interactive platform designed to empower LGBTQIA2S+ individuals to navigate the
                        coming out journey both safely and confidently. As part of this initiative, i3 brought on Victoria Brey '26 (SFA),
                        a senior majoring in Digital Media and Design with a concentration in web design, as a key student contributor
                        and the platform's primary designer. This project was developed in collaboration with the National SOGIE Center
                        and Unicorn Solutions, and combines subject-matter expertise with user-centered design.
                    </p>
                </div>


            </div>

            <!-- Affirmations Carousel -->
            <div id="affirmationsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" data-aos="fade-up" data-aos-delay="600">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="text-center">
                            <div class="card border-3 border-success shadow-sm mx-auto" style="max-width: 500px;">
                                <div class="card-body p-4">
                                    <blockquote class="blockquote mb-0">
                                        <p class="h5 text-success">"I'm worthy of taking up space."</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center">
                            <div class="card border-3 shadow-sm mx-auto" style="max-width: 500px;border-color:var(--primary-button)">
                                <div class="card-body p-4">
                                    <blockquote class="blockquote mb-0">
                                        <p class="h5" style="color:var(--primary-button)">"I'm fabulous and deserve love."</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center">
                            <div class="card border-3 border-info shadow-sm mx-auto" style="max-width: 500px;">
                                <div class="card-body p-4">
                                    <blockquote class="blockquote mb-0">
                                        <p class="h5 text-info">"My journey is valid and important."</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center">
                            <div class="card border-3 border-danger shadow-sm mx-auto" style="max-width: 500px;">
                                <div class="card-body p-4">
                                    <blockquote class="blockquote mb-0">
                                        <p class="h5 text-danger">"I am enough, exactly as I am."</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center">
                            <div class="card border-3 border-secondary shadow-sm mx-auto" style="max-width: 500px;">
                                <div class="card-body p-4">
                                    <blockquote class="blockquote mb-0">
                                        <p class="h5 text-secondary">"I choose self-love and acceptance."</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators position-relative mt-4" style="position: relative; bottom: auto;">
                    <button type="button" data-bs-target="#affirmationsCarousel" data-bs-slide-to="0" class="active bg-primary"></button>
                    <button type="button" data-bs-target="#affirmationsCarousel" data-bs-slide-to="1" class="bg-primary"></button>
                    <button type="button" data-bs-target="#affirmationsCarousel" data-bs-slide-to="2" class="bg-primary"></button>
                    <button type="button" data-bs-target="#affirmationsCarousel" data-bs-slide-to="3" class="bg-primary"></button>
                    <button type="button" data-bs-target="#affirmationsCarousel" data-bs-slide-to="4" class="bg-primary"></button>
                </div>
            </div>

        </section>

        <!-- Process -->
        <section id="process">
            <div class="container process mt-3">
                <span class="text-start fs-5">02 Process</span>
                <div class="row">
        <span class=" fs-3 mb-3">Start small. Learn fast. <span class="fw-medium">Build what
            matters.</span></span>
                    <p class="w-100 fs-5">
                        At i3, we begin by putting something real in front of people. A rough draft,
                        a working prototype, a first version you can click. From there we work closely
                        with stakeholders to test ideas, gather feedback, and refine the system together.
                        Because the work happens inside the University, we can respond quickly and shape the
                        platform around the needs of the community rather than the constraints of a vendor product.
                        The result is a solution that reflects how UConn actually works and evolves alongside it.
                        Every project is different, but this approach helps us turn institutional challenges
                        into tools that the University truly owns and can continue to improve over time.
                    </p>
                </div>

                <!-- Flip cards -->
                <div class="process-row gx-3 row mt-3">


                    <div class="col-xl-3 col-md-6 col-12 mt-2 process-card bg-transparent" data-aos="zoom-out-down" tabindex="0"
                         role="button" aria-pressed="false">
                        <div class="process-card-inner h-100 d-flex flex-column">
                            <div class="process-card-front bg-off-white radius d-flex flex-column p-4">
                                <svg class=" card-arrow arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>
                                <div class="z-2 arrow-bg bg-extralight-grey"></div>
                                <div class="process-content mt-auto">
                                    <span class="z-2 lust-light fs-2 text-start mb-1">Research</span>
                                    <span class="z-2 fs-5 text-start mb-0 process-text">Discover what matters. Understand users, challenges,
                  and opportunities before diving in.</span>
                                </div>
                            </div>

                            <div class="process-card-back bg-white radius d-flex flex-column justify-content-end p-4">
                                <svg class=" card-arrow back arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>
                                <div class="z-2 arrow-bg bg-extralight-grey"></div>

                                <span class="z-2 text-start mb-0 process-text">We begin by meeting with stakeholders and mapping the problem together.
                                    For Coming out with Care, this meant understanding the audience and the anticipated ways users will interact with the guide.</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12 mt-2 process-card bg-transparent" data-aos="zoom-out-down" tabindex="0"
                         role="button" aria-pressed="false">
                        <div class="process-card-inner h-100 d-flex flex-column">
                            <div class="process-card-front bg-off-white radius d-flex flex-column p-4">
                                <svg class=" card-arrow arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>
                                <div class="z-2 arrow-bg bg-extralight-grey"></div>
                                <div class="process-content mt-auto">
                                    <span class="z-2 lust-light fs-2 text-start mb-1">Prototype</span>
                                    <span class="z-2 fs-5 text-start mb-0 process-text">Make it tangible. Turn ideas into something you can
                  click, touch, or explore.</span>
                                </div>
                            </div>

                            <div class="process-card-back bg-white radius d-flex flex-column justify-content-end p-4">
                                <svg class=" card-arrow back arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>

                                <span class="z-2 text-start mb-0 process-text">We quickly built flat designs of the PDF in a website
                                    format so stakeholders could see how the navigation and interactive components come together.
                                    This visual version helps everyone react to something concrete rather than abstract ideas.</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12 mt-2 process-card bg-transparent" data-aos="zoom-out-down" tabindex="0"
                         role="button" aria-pressed="false">
                        <div class="process-card-inner h-100 d-flex flex-column">
                            <div class="process-card-front bg-off-white radius d-flex flex-column p-4">
                                <svg class=" card-arrow arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>
                                <div class="z-2 arrow-bg bg-extralight-grey"></div>
                                <div class="process-content mt-auto">
                                    <span class="z-2 lust-light fs-2 text-start mb-1">Test</span>
                                    <span class="z-2 fs-5 text-start mb-0 process-text">Try, learn, refine. Gather feedback early, spot
                  issues, and see what really works before moving forward.</span>
                                </div>
                            </div>

                            <div class="process-card-back bg-white radius d-flex flex-column justify-content-end p-4">
                                <svg class=" card-arrow back arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>
                                <div class="z-2 arrow-bg bg-extralight-grey"></div>

                                <span class="z-2 text-start mb-0 process-text">As the Care Group explored the system,
                                    their feedback shaped how Coming out with Care evolved. Website behavior, responsiveness,
                                    and messaging were refined through real use.</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12 mt-2 process-card bg-transparent" data-aos="zoom-out-down" tabindex="0"
                         role="button" aria-pressed="false">
                        <div class="process-card-inner h-100 d-flex flex-column">
                            <div class="process-card-front bg-off-white radius d-flex flex-column p-4">
                                <svg class="card-arrow  arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>
                                <div class="z-2 arrow-bg bg-extralight-grey"></div>
                                <div class="process-content mt-auto">
                                    <span class="z-2 lust-light fs-2 text-start mb-1">Deploy</span>
                                    <span class="z-2 fs-5 text-start mb-0 process-text">Launch with confidence. Deliver a working solution
                  while staying flexible for improvements.</span>
                                </div>
                            </div>

                            <div class="process-card-back bg-white radius d-flex flex-column justify-content-end p-4">
                                <svg class=" card-arrow back arrow-bounce z-3" width="23" height="23" viewBox="0 0 23 23" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.74204 16.9442L9.74204 -5.47506e-07L12.5255 -4.25838e-07L12.5255 16.9442L20.3191 9.15056L22.2675 11.1338L11.1338 22.2675L-4.30137e-06 11.1338L1.9484 9.15056L9.74204 16.9442Z"
                                            fill="#000E2F" />
                                </svg>
                                <div class="z-2 arrow-bg bg-extralight-grey"></div>

                                <span class="z-2 text-start mb-0 process-text">Once the platform was ready, Coming out with Care was launched to the community.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Challenge -->
        <section id="challenge">
            <div class="container-fluid mt-5 bg-midnight pt-5 pb-3 rounded-5">
                <div class="container challenge text-white my-4 pb-5">
                    <span class="text-start fs-5">04 The Challenge</span>
                    <div class="row">
                      <span class="fs-3 mb-3">A valuable resource with
                          <span class="fw-medium">limited accessibility.</span></span>
                    <p class="w-100 fs-5 mb-5">Before i3’s involvement, Coming Out With Care existed as a
                        comprehensive PDF guide. While full of practical guidance and support strategies,
                        its static format made it difficult to navigate and limited accessibility
                        for users seeking a personalized learning experience.
                    </p>
                    <p class="w-100 fs-5 mb-3">
                        This static format also restricted the guide’s ability to provide interactive tools,
                        self-reflective exercises, and safety features. These tools can be critical for
                        individuals navigating the complexities of coming out. After being approached
                        by the National SOGIE Center with the idea to turn the PDF into an interactive website,
                        i3 identified the project as an opportunity to text-anchor="middle" transform an important document into an engaging resource.
                    </p>
                    </div>

                    <!-- Gradient cards -->
                    <div class="row px-md-4 px-lg-5 pt-4 pb-5 d-flex align-items-stretch">
                        <div class="col-lg-6 mt-2 d-flex mb-2 mb-md-0">
                            <div class="col-12 ms-auto radius challenge-card left py-3 py-sm-5 px-3 px-sm-5 d-flex flex-column"
                                 data-aos="fade-right">
                                <span class="fs-2 mb-2">Problem</span>
                                <ul class="fs-5 mb-0">
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                </ul>
                            </div>


                        </div>


                        <div class="col-lg-6 mt-2 d-flex">
                            <div class="col-12 me-auto radius challenge-card py-3 py-sm-5 px-3 px-sm-5 d-flex flex-column"
                                 data-aos="fade-left">
                                <span class="fs-2 mb-2 z-2">Solution</span>
                                <ul class="fs-5 mb-0">
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <p class="fs-5 mb-0">Victoria played an important role in shaping the platform’s user experience and tone.
                        As a senior majoring in Digital Media and Design with a concentration in Web Design,
                        she brought both technical skills and personal insight to the project. This unique insight helped
                        ensure the platform felt supportive and approachable to users. Reflecting on her involvement,
                        she shared that the project was especially meaningful because it allowed her to create something
                        she wished she had access to growing up. Her contributions helped ground the platform in lived
                        experience and reinforced its goal of creating a safe and affirming space for users.
                    </p>
                </div>
            </div>
        </section>

        <!-- Build -->
        <section id="build">
            <div class="container-fluid mt-5 position-relative">
                <div class="bars-wrap d-none d-lg-block">
                    <svg id="rainbow-bars" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 241.317397 1152.649562">
                        <defs>
                            <style>
                              .cls-bars-1 {
                                stroke: #6761e5;
                              }

                              .cls-bars-1, .cls-bars-2, .cls-bars-3, .cls-bars-4, .cls-bars-5, .cls-bars-6, .cls-bars-7 {
                                fill: none;
                              }

                              .cls-bars-1, .cls-bars-3, .cls-bars-4, .cls-bars-5, .cls-bars-6, .cls-bars-7 {
                                stroke-miterlimit: 10;
                                stroke-width: 29px;
                              }

                              .cls-bars-3 {
                                stroke: #67cc96;
                              }

                              .cls-bars-4 {
                                stroke: #efa139;
                              }

                              .cls-bars-5 {
                                stroke: #ea9fe8;
                              }

                              .cls-bars-6 {
                                stroke: #ea6242;
                              }

                              .cls-bars-7 {
                                stroke: #644fb5;
                              }

                              .cls-bars-8 {
                                clip-path: url(#clippath);
                              }
                            </style>
                            <clipPath id="clippath">
                                <rect class="cls-bars-2" width="241.317397" height="1152.649562"/>
                            </clipPath>
                        </defs>
                        <g class="cls-bars-8">
                            <polyline class="cls-bars-6" points="413.829425 79.533554 159.282088 268.581391 159.280039 1155.181477"/>
                            <polyline class="cls-bars-4" points="381.40378 67.802448 130.316315 253.925435 130.23229 1155.181477"/>
                            <polyline class="cls-bars-5" points="348.41739 56.34559 101.301194 239.121499 101.299145 1155.181477"/>
                            <polyline class="cls-bars-3" points="315.276596 45 72.337206 224.417561 72.335157 1155.181477"/>
                            <polyline class="cls-bars-1" points="283.698616 32.244778 43.503326 209.970489 43.501277 1155.181477"/>
                            <polyline class="cls-bars-7" points="252.687985 19.282802 14.542635 195.52185 14.540586 1155.181477"/>
                        </g>
                    </svg>
                    <img src="/care-assets/assets/bars-img-1.png" class="bars-img img-1" />
                    <img src="/care-assets/assets/bars-img-2.png" class="bars-img img-2" />
                </div>

                <div class="container">
                    <div class="row book-row mb-5 mb-xxl-0">
                        <span class="text-start fs-5">04 The Challenge</span>
                        <div class="col-12 col-lg-6" data-aos="fade-right" data-aos-duration="800">
                            <span class="fs-3">A valuable resource with
                            <span class="fw-medium">limited accessibility.</span></span>
                            <p class="fs-5 pt-2">
                                The development of the Coming Out With Care website followed an iterative,
                                collaborative process grounded in both technical execution and user needs.
                                The team of three began by closely reviewing the original PDF guide to fully
                                understand its content, tone, and purpose. This initial research ensured
                                that the digital version would remain faithful to the guide’s mission while
                                identifying opportunities to improve accessibility and engagement.
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-end" data-aos="fade-left" data-aos-duration="800">
                            <object class="build-book" data="/care-assets/assets/book-img-small.webp" type="image/webp" aria-label="Image of coming out with care guide in book format">
                                <img class="build-book" src="/care-assets/assets/book-img-full.png" alt="Image of coming out with care guide in book format" />
                            </object>
                        </div>
                    </div>
                    <div class="row blocks-row mb-5 mb-xxl-0 ">
                        <div class="col-12 col-lg-6 mb-5 mt-4 mt-lg-auto order-2 order-lg-1 d-flex d-lg-block justify-content-center" data-aos="fade-up" data-aos-duration="800">
                            <svg id="blocks-svg" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 641.124327 595.238113">
                                <defs>
                                    <style>
                                      .cls-blocks-1 {
                                        letter-spacing: .009961em;
                                      }

                                      .cls-blocks-1, .cls-blocks-2, .cls-blocks-3, .cls-blocks-4, .cls-blocks-5, .cls-blocks-6, .cls-blocks-7, .cls-blocks-8 {
                                        font-family: "Poppins", Arial, Helvetica, BlinkMacSystemFont, sans-serif;
                                        font-size: 15px;
                                        font-weight: 500;
                                      }

                                      .cls-blocks-1, .cls-blocks-4, .cls-blocks-8 {
                                        opacity: .8;
                                      }

                                      .cls-blocks-9 {
                                        fill: #f849c1;
                                      }

                                      .cls-blocks-10 {
                                        fill: #66d575;
                                      }

                                      .cls-blocks-2, .cls-blocks-7, .cls-blocks-8 {
                                        letter-spacing: .010026em;
                                      }

                                      .cls-blocks-3 {
                                        letter-spacing: .010032em;
                                      }

                                      .cls-blocks-3, .cls-blocks-6, .cls-blocks-7 {
                                        fill: #fff;
                                      }

                                      .cls-blocks-4, .cls-blocks-5, .cls-blocks-6 {
                                        letter-spacing: .009993em;
                                      }

                                      .cls-blocks-11 {
                                        fill: none;
                                        stroke: #757575;
                                        stroke-linecap: round;
                                        stroke-miterlimit: 10;
                                        stroke-width: 4px;
                                      }

                                      .cls-blocks-12 {
                                        fill: #1e1e1e;
                                      }

                                      .cls-blocks-13 {
                                        fill: #ffe0c2;
                                      }

                                      .cls-blocks-14 {
                                        fill: #dcccff;
                                      }

                                      .cls-blocks-15 {
                                        fill: #ffc2ec;
                                      }

                                      .cls-blocks-16 {
                                        fill: #cdf4d3;
                                      }

                                      .cls-blocks-17 {
                                        fill: #874fff;
                                      }

                                      .cls-blocks-18 {
                                        fill: #ffecbd;
                                      }

                                      .cls-blocks-19 {
                                        fill: #ff9e42;
                                      }
                                    </style>
                                </defs>
                                <g id="Layer_1-2" data-name="Layer 1">
                                    <g>
                                        <path class="cls-blocks-12" d="M356.2986,0h-129.393468c-1.029567,0-1.866252.83546-1.866252,1.866252v46.345257c0,1.030801.836685,1.866252,1.866252,1.866252h129.393468c1.029567,0,1.866252-.835451,1.866252-1.866252V1.866252c0-1.030792-.836685-1.866252-1.866252-1.866252Z"/>
                                        <text class="cls-blocks-3" text-anchor="middle" transform="translate(291.601312 29.919927) scale(1.0383 1)"><tspan x="0" y="0">Home</tspan></text>
                                    </g>
                                    <g id="section-1-group">
                                        <g id="section-1-6">
                                            <path class="cls-blocks-18" d="M131.570762,545.160352H1.866252c-1.030792,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.83546,1.866252,1.866252,1.866252h129.70451c1.030801,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.835451-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(66.718565 575.937334)"><tspan x="0" y="0">Brain Break!</tspan></text>
                                        </g>
                                        <g id="section-1-5">
                                            <path class="cls-blocks-16" d="M131.570762,478.597366H1.866252c-1.030792,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.83546,1.866252,1.866252,1.866252h129.70451c1.030801,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.835451-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(66.727843 509.374834)"><tspan x="0" y="0">Self-Care</tspan></text>
                                        </g>
                                        <g id="section-1-4">
                                            <path class="cls-blocks-16" d="M131.570762,412.03438H1.866252c-1.030792,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.83546,1.866252,1.866252,1.866252h129.70451c1.030801,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.835451-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(66.872374 442.741045)"><tspan x="0" y="0">Prepare for C...</tspan></text>
                                        </g>


                                        <g id="section-1-3">
                                            <path class="cls-blocks-16" d="M131.570762,345.471394H1.866252c-1.030792,0-1.866252.836685-1.866252,1.866252v46.034215c0,1.029567.83546,1.866252,1.866252,1.866252h129.70451c1.030801,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.029567-.835451-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(66.672179 375.937334)"><tspan x="0" y="0">Take Care of Y...</tspan></text>
                                        </g>

                                        <g id="section-1-2">
                                            <path class="cls-blocks-16" d="M131.570762,278.597366H1.866252c-1.030792,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.83546,1.866252,1.866252,1.866252h129.70451c1.030801,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.835451-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(66.790831 309.528154)"><tspan x="0" y="0">Purpose</tspan></text>
                                        </g>

                                        <g id="section-1-1">
                                            <path class="cls-blocks-16" d="M131.570762,212.03438H1.866252c-1.030792,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.83546,1.866252,1.866252,1.866252h129.70451c1.030801,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.835451-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(66.672179 242.811845)"><tspan x="0" y="0">About Us</tspan></text>
                                        </g>
                                        <g id="section-1-0">
                                            <path class="cls-blocks-10" d="M131.570762,145.471394H1.866252c-1.030792,0-1.866252.835451-1.866252,1.866252v46.034215c0,1.029567.83546,1.866252,1.866252,1.866252h129.70451c1.030801,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.030801-.835451-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-5" text-anchor="middle" transform="translate(66.562987 176.072569)"><tspan x="0" y="0">Section 1</tspan></text>
                                        </g>

                                    </g>
                                    <g id="section-2-group">





                                        <g id="section-2-4">
                                            <path class="cls-blocks-18" d="M281.493002,412.03438h-129.70451c-1.030801,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.835451,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(216.640929 442.812334)"><tspan x="0" y="0">Brain Break!</tspan></text>
                                        </g>
                                        <g id="section-2-3">
                                            <path class="cls-blocks-14" d="M281.493002,345.471394h-129.70451c-1.030801,0-1.866252.836685-1.866252,1.866252v46.034215c0,1.029567.835451,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(216.640747 375.937334)"><tspan x="0" y="0">A Deeper Scri...</tspan></text>
                                        </g>
                                        <g id="section-2-2">
                                            <path class="cls-blocks-14" d="M281.493002,278.597366h-129.70451c-1.030801,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.835451,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-8" text-anchor="middle" transform="translate(216.640747 309.374834)"><tspan x="0" y="0">Developing a...</tspan></text>
                                        </g>
                                        <g id="section-2-1">
                                            <path class="cls-blocks-14" d="M281.493002,212.03438h-129.70451c-1.030801,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.835451,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-4" text-anchor="middle" transform="translate(216.640747 242.811845)"><tspan x="0" y="0">Preparing for...</tspan></text>
                                        </g>
                                        <g id="section-2-0">
                                            <path class="cls-blocks-17" d="M281.493002,145.471394h-129.70451c-1.030801,0-1.866252.835451-1.866252,1.866252v46.034215c0,1.029567.835451,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.030801-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-6" text-anchor="middle" transform="translate(216.640929 175.798173)"><tspan x="0" y="0">Section 2</tspan></text>
                                        </g>
                                    </g>
                                    <g id="section-3-group">
                                        <g id="section-3-6">
                                            <path class="cls-blocks-18" d="M431.415241,545.160352h-129.70451c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-1" text-anchor="middle" transform="translate(366.682921 576.071123)"><tspan x="0" y="0">Brain Break!</tspan></text>
                                        </g>
                                        <g id="section-3-5">
                                            <path class="cls-blocks-13" d="M431.415241,478.597366h-129.70451c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-1" text-anchor="middle" transform="translate(365.784483 509.374834)"><tspan x="0" y="0">Benefits to Co...</tspan></text>
                                        </g>
                                        <g id="section-3-4">
                                            <path class="cls-blocks-13" d="M431.415241,412.03438h-129.70451c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-8" text-anchor="middle" transform="translate(366.562986 442.947081)"><tspan x="0" y="0">Things You Mi...</tspan></text>
                                        </g>
                                        <g id="section-3-3">
                                            <path class="cls-blocks-13" d="M431.415241,345.471394h-129.70451c-1.029567,0-1.866252.836685-1.866252,1.866252v46.034215c0,1.029567.836685,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-1" text-anchor="middle" transform="translate(366.563809 376.072081)"><tspan x="0" y="0">How to Assess...</tspan></text>
                                        </g>
                                        <g id="section-3-2">
                                            <path class="cls-blocks-13" d="M431.415241,278.597366h-129.70451c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-8" text-anchor="middle" transform="translate(366.562986 309.374834)"><tspan x="0" y="0">Reacting to B...</tspan></text>
                                        </g>
                                        <g id="section-3-1">
                                            <path class="cls-blocks-13" d="M431.415241,212.03438h-129.70451c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-8" text-anchor="middle" transform="translate(367.026671 242.811845)"><tspan x="0" y="0">The Painful Exp...</tspan></text>
                                        </g>
                                        <g id="section-3-0">
                                            <path class="cls-blocks-19" d="M431.415241,145.471394h-129.70451c-1.029567,0-1.866252.835451-1.866252,1.866252v46.034215c0,1.029567.836685,1.866252,1.866252,1.866252h129.70451c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.030801-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-2" text-anchor="middle" transform="translate(366.562804 175.937822)"><tspan x="0" y="0">Section 3</tspan></text>
                                        </g>
                                    </g>
                                    <g id="section-4-group">
                                        <g id="section-4-4">
                                            <path class="cls-blocks-15" d="M581.337481,412.03438h-129.393468c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.393468c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-8" text-anchor="middle" transform="translate(516.640929 442.671709)"><tspan x="0" y="0">Resources for...</tspan></text>
                                        </g>
                                        <g id="section-4-3">
                                            <path class="cls-blocks-15" d="M581.337481,345.471394h-129.393468c-1.029567,0-1.866252.836685-1.866252,1.866252v46.034215c0,1.029567.836685,1.866252,1.866252,1.866252h129.393468c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-8" text-anchor="middle" transform="translate(517.054991 375.937334)"><tspan x="0" y="0">The Data Prov...</tspan></text>
                                        </g>
                                        <g id="section-4-2">
                                            <path class="cls-blocks-15" d="M581.337481,278.597366h-129.393468c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.393468c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-1" text-anchor="middle" transform="translate(516.640929 309.534013)"><tspan x="0" y="0">Know Your Hist...</tspan></text>
                                        </g>
                                        <g id="section-4-1">
                                            <path class="cls-blocks-15" d="M581.337481,212.03438h-129.393468c-1.029567,0-1.866252.836685-1.866252,1.866252v46.345257c0,1.029567.836685,1.866252,1.866252,1.866252h129.393468c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.345257c0-1.029567-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-8" text-anchor="middle" transform="translate(517.123351 242.811845)"><tspan x="0" y="0">Centering Que...</tspan></text>
                                        </g>
                                        <g id="section-4-0">
                                            <path class="cls-blocks-9" d="M581.337481,145.471394h-129.393468c-1.029567,0-1.866252.835451-1.866252,1.866252v46.034215c0,1.029567.836685,1.866252,1.866252,1.866252h129.393468c1.029567,0,1.866252-.836685,1.866252-1.866252v-46.034215c0-1.030801-.836685-1.866252-1.866252-1.866252Z"/>
                                            <text class="cls-blocks-7" text-anchor="middle" transform="translate(516.506163 176.082841)"><tspan x="0" y="0">Section 4</tspan></text>
                                        </g>
                                    </g>
                                    <g id="arrow-4">
                                        <g>
                                            <line class="cls-blocks-11" x1="516.640746" y1="141.347805" x2="503.75396" y2="128.461019"/>
                                            <line class="cls-blocks-11" x1="516.640746" y1="141.347805" x2="529.525886" y2="128.462664"/>
                                        </g>
                                        <path class="cls-blocks-11" d="M291.601866,53.12907v34.086771c0,4.128694,3.346968,7.475662,7.475662,7.475662h210.087556c4.128694,0,7.475662,3.346968,7.475662,7.475662v39.18064"/>
                                    </g>
                                    <g id="arrow-3">
                                        <path class="cls-blocks-11" d="M291.601866,53.12907v33.947144c0,4.205809,3.409482,7.615291,7.615291,7.615291h59.730537c4.205809,0,7.615291,3.409482,7.615291,7.615291v39.051238"/>
                                        <g>
                                            <line class="cls-blocks-11" x1="366.563809" y1="141.358035" x2="353.677023" y2="128.471249"/>
                                            <line class="cls-blocks-11" x1="366.563809" y1="141.358035" x2="379.448949" y2="128.472895"/>
                                        </g>
                                    </g>
                                    <g id="arrow-2">
                                        <path class="cls-blocks-11" d="M291.601866,53.123955v33.947144c0,4.205809-3.409482,7.615291-7.615291,7.615291h-59.730537c-4.205809,0-7.615291,3.409482-7.615291,7.615291v39.051238"/>
                                        <g>
                                            <line class="cls-blocks-11" x1="216.639924" y1="141.35292" x2="229.526709" y2="128.466134"/>
                                            <line class="cls-blocks-11" x1="216.639924" y1="141.35292" x2="203.754784" y2="128.467779"/>
                                        </g>
                                    </g>
                                    <g id="arrow-1">
                                        <g>
                                            <line class="cls-blocks-11" x1="66.562987" y1="141.35292" x2="79.449773" y2="128.466134"/>
                                            <line class="cls-blocks-11" x1="66.562987" y1="141.35292" x2="53.677847" y2="128.467779"/>
                                        </g>
                                        <path class="cls-blocks-11" d="M291.601866,53.134185v34.086771c0,4.128694-3.346968,7.475662-7.475662,7.475662H74.038649c-4.128694,0-7.475662,3.346968-7.475662,7.475662v39.18064"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="col-12 col-lg-6 order-1 order-lg-2 mb-5 mb-lg-0 d-flex justify-content-center align-items-center" data-aos="fade-left" data-aos-duration="800">
                            <p class="fs-5 pt-2 my-auto">
                                From there, the team used Eleventy, a software system used to create websites,
                                to generate a simple, barebones version of the site based directly on the PDF.
                                This early prototype established the site’s structure and allowed the team to begin
                                transforming static content into a more dynamic experience. Working closely with the
                                National SOGIE Center, the team refined the platform’s communication style to ensure
                                it felt supportive, affirming, and accessible to users.
                            </p>
                        </div>
                    </div>

                    <div class="row laptop-row">
                        <div class="col-12 col-lg-9 mb-3">
                            <p class="fs-5 my-auto">
                                As development progressed, the team introduced interactive features
                                designed to support both user safety and engagement. These included tools
                                for reflection, interactive activities, and safety-focused elements like the
                                quick escape button. Throughout this process, i3 and the SOGIE team met regularly
                                to review progress, gather feedback, and make iterative improvements based on user
                                needs and safety considerations.
                            </p>
                        </div>
                        <div class="col-12 col-lg-9 my-4">
                            <p class="fs-5 my-auto">
                                The final stages of development focused on ensuring the platform was fully accessible
                                and easy to navigate. After completing these refinements, the SOGIE team presented
                                the site to key stakeholders for final approval. Once approved, the platform was
                                deployed and optimized for search visibility. This consideration helped ensure
                                that users can easily find and benefit from this resource.
                            </p>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <div class="laptop-wrap w-75">
                                <picture>
                                    <source class="w-100 mx-auto" srcset="/care-assets/assets/laptop-blank.png" media="(min-width:576px)">
                                    <img class="w-100 mx-auto" src="/care-assets/assets/laptop.png" alt="Laptop with Coming Out With Care opened">

                                </picture>
                                <div class="cards-abs d-none d-sm-grid">
                                    <div class="flip-card left top" data-aos="fade-up" data-aos-once="true" data-aos-duration="800">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/safety.svg') center / cover no-repeat var(--flip-green);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4"
                                            style="background: url('/care-assets/assets/laptop-card-svgs/text-long.svg') center / cover no-repeat var(--flip-green);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card mid top" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="50">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/acceptance.svg') center / cover no-repeat var(--flip-green);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card right top" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="100">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/emotional.svg') center / cover no-repeat var(--flip-green);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card left center" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="150">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/support.svg') center / cover no-repeat var(--theme-pink);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card mid center" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="200">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/timing.svg') center / cover no-repeat var(--theme-pink);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card right center" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="250">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/education.svg') center / cover no-repeat var(--theme-pink);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card left bot" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="300">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/boundaries.svg') center / cover no-repeat var(--theme-orange);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card mid bot" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="350">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/self-care.svg') center / cover no-repeat var(--theme-orange);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-card right bot" data-aos="fade-up" data-aos-once="true" data-aos-duration="800" data-aos-delay="400">
                                        <div class="flip-card-inner">
                                            <div class="flip-arrow"></div>
                                            <div class="flip-card-front d-flex align-items-center justify-content-center text-center p-4"
                                                 style="background: url('/care-assets/assets/laptop-card-svgs/legal.svg') center / cover no-repeat var(--theme-orange);">
                                            </div>
                                            <div class="flip-card-back d-flex align-items-center justify-content-center text-center p-4">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Result -->
        <section id="result">
            <div class="result-wrap text-black pt-5 pb-5 position-relative rounded-top-5">
                <div class="container result mt-4 pb-0 pb-lg-5">
                    <span class="text-start fs-5">07 The Result</span>

                    <div class="row">
                        <span class=" fs-3 mb-3">Connecting <span class="fw-medium">people, topics, and research</span>.</span>
                        <p class="w-100 fs-5">
                            The interactive Coming Out With Care platform provides more than guidance—it offers an accessible, safe,
                            and empowering space for LGBTQIA2S+ individuals. For i3, the project demonstrates how thoughtful design
                            and collaboration can transform a valuable but underutilized resource into a meaningful, high-impact tool.
                            <br />
                            <br />
                            By leading the transformation, i3 showcased its ability to take mission-driven projects from concept to reality,
                            prioritizing accessibility, user experience, and well-being. The platform continues to provide immediate value to users,
                            helping individuals navigate a complex life experience with confidence and self-respect.
                        </p>
                    </div>


                    <div class="row justify-content-between mx-auto gx-4">
                        <div class="col-xxl-6 col-xl-6 col-sm-11 col-12 d-flex  justify-content-between mx-auto mx-xl-0 align-items-center result-colors text-center gap-1 mt-4">
                            <div class="d-flex flex-column justify-content-center gap-2">
                                <span id="blue-violet" class="color"></span>
                                <span class="fw-medium text-slate-grey fs-6">blue violet</span>
                                <span class="fs-6 text-slate-grey opacity-50">#644FB5</span>
                            </div>
                            <div class="d-flex flex-column justify-content-center gap-2">
                                <span id="slate-blue" class="color"></span>
                                <span class="fw-medium text-slate-grey fs-6">slate blue</span>
                                <span class="fs-6 text-slate-grey opacity-50">#6761E5</span>
                            </div>
                            <div class="d-flex flex-column justify-content-center gap-2">
                                <span id="sea-green" class="color"></span>
                                <span class="fw-medium text-slate-grey fs-6">sea green</span>
                                <span class="fs-6 text-slate-grey opacity-50">#67CC96</span>
                            </div>
                            <div class="d-flex flex-column justify-content-center gap-2">
                                <span id="taffy" class="color"></span>
                                <span class="fw-medium text-slate-grey fs-6">taffy</span>
                                <span class="fs-6 text-slate-grey opacity-50">#EA9FE8</span>
                            </div>
                            <div class="d-flex flex-column justify-content-center gap-2">
                                <span id="cantaloupe" class="color"></span>
                                <span class="fw-medium text-slate-grey fs-6">cantaloupe</span>
                                <span class="fs-6 text-slate-grey opacity-50">#EFA139</span>
                            </div>
                            <div class="d-flex flex-column justify-content-center gap-2">
                                <span id="poppy" class="color"></span>
                                <span class="fw-medium text-slate-grey fs-6">poppy</span>
                                <span class="fs-6 text-slate-grey opacity-50">#EA6242</span>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-xl-6 col-12 heads-wrap d-flex px-2 justify-content-xxl-center justify-content-evenly align-items-center gap-xxl-5 gap-md-5 gap-2 mt-4">
                            <div class="d-flex flex-column">
                                <span class="result-header-1 fw-bold">Header 1</span>
                                <span class="fs-6 text-slate-grey  opacity-50 result-head-1-desc">Bold Poppins / 56px</span>
                                <span class="result-header-2 fw-medium">Header 2</span>
                                <span class="fs-6 text-slate-grey opacity-50 result-head-2-desc">Medium Poppins / 32px</span>
                            </div>

                            <div class="d-flex flex-column me-0 me-sm-0 d-flex justify-content-end h-100 gap-4">
                                <div>
                                    <div class="result-header-3 fw-medium">Header 3</div>
                                    <span class="fs-6 text-slate-grey opacity-50 mb-4">Medium Poppins / 22px</span>
                                </div>
                                <div>
                                    <div class="result-paragraph fw-normal">Paragraph</div>
                                    <span class="fs-6 text-slate-grey opacity-50">Poppins / 16px</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row words-row justify-content-center align-items-center gap-2 gap-xl-5 py-5 mb-0 mb-lg-5">
                        <div class="col-12 col-lg-5 d-flex flex-column justify-content-between">
                            <div class="word-answers">
                                <div class="answer bg-white rounded-2 py-3 py-lg-2 py-xl-4 text-center" data-aos="fade-up">
                                    <span>Fabulous</span>
                                </div>
                                <div class="answer bg-white rounded-2 py-3 py-lg-2 py-xl-4  text-center" data-aos="fade-up">
                                    <span>Pride</span>
                                </div>
                                <div class="answer bg-white rounded-2 py-3 py-lg-2 py-xl-4  text-center" data-aos="fade-up" data-aos-delay="50">
                                    <span>Resilience</span>
                                </div>
                                <div class="answer rounded-2 py-3 py-lg-2 py-xl-4  text-center" style="background: rgba(255,255,255,.4)" data-aos="fade-up" data-aos-delay="50">
                                    <span style="text-decoration: line-through;">Authenticity</span>
                                </div>
                                <div class="answer bg-white rounded-2 py-3 py-lg-2 py-xl-4  text-center" data-aos="fade-up" data-aos-delay="100">
                                    <span>Love</span>
                                </div>
                                <div class="answer bg-white rounded-2 py-3 py-lg-2 py-xl-4  text-center" data-aos="fade-up" data-aos-delay="100">
                                    <span>Solidarity</span>
                                </div>
                                <div class="answer bg-white rounded-2 px-2 py-3 py-lg-2 py-xl-4 text-center" data-aos="fade-up" data-aos-delay="150">
                                    <span>Freedom</span>
                                </div>
                                <div class="answer bg-white rounded-2 px-2 py-3 py-lg-2 py-xl-4 text-center" data-aos="fade-up" data-aos-delay="150">
                                    <span>Visibility</span>
                                </div>
                                <div class="search-info py-3 pe-3 ps-5 rounded-2" data-aos="fade-up" data-aos-delay="200">
                                    <span class="fw-medium fs-5">Wordsearch</span>
                                    <p class="fs-6 fw-normal mb-0">This custom built wordsearch was designed to change each time the user refreshes, ensuring it is reusable and offers a unique experience.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 d-flex d-lg-block justify-content-center mt-4 mt-lg-auto col-xxl-5 grid-container">
                            <svg id="word-search-svg" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1276 1273">
                                <defs>
                                    <style>
                                      .cls-search-1 {
                                        fill: none;
                                        stroke: #000;
                                        stroke-miterlimit: 10;
                                        stroke-width: 3px;
                                      }
                                    </style>
                                </defs>
                                <path class="cls-search-1" d="M162.125923,372.363656v-.000027c0-14.946926,12.116877-27.063803,27.063803-27.063803h981.446863c14.946926,0,27.063803,12.116877,27.063803,27.063803v.000027"/>
                                <path class="cls-search-1" d="M162.125923,372.363656v.000027c0,14.946926,12.116877,27.063803,27.063803,27.063803h981.446863c14.946926,0,27.063803-12.116877,27.063803-27.063803v-.000027"/>
                                <image width="1276" height="1273" xlink:href="/care-assets/assets/word-search.png"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="looking-ahead">
            <div class="container-fluid looking-container rounded-top-5 py-5">
                <div class="container mt-5">
                    <span class="text-start fs-5">08 Looking Ahead</span>

                    <div class="row">
                        <span class="fs-3 mb-3">Providing <span class="fw-medium">guidance and support</span> to our community.</span>
                        <p class="w-100 fs-5 mb-4">
                            Through Coming Out With Care, i3 has supported the creation of a resource that not only meets
                            immediate user needs but also serves as a model for mission-driven, user-focused digital projects.
                            While the development phase has concluded, the platform’s impact endures and demonstrates how i3 turns
                            valuable resources into accessible, meaningful, and empowering tools for the community.
                        </p>
                        <span class="mb-1 fs-2">
                            And for <a target="_blank" href="https://www.linkedin.com/in/victoria-brey/"><span class="fw-medium purple-shadow">Victoria?</span></a></span>
                        <p class="w-100 fs-5">
                            Victoria came into her studies with plans focused primarily on back-end web development,
                            with longer-term ambitions in game design. Her time at i3 reshaped that trajectory entirely.
                            Through her work on projects like Coming Out With Care, she discovered a genuine passion for
                            front-end development — particularly interactive animations and the craft of building experiences
                            that feel alive to the user. She credits i3 with dramatically accelerating both her technical
                            skills and her confidence working with real clients and stakeholders.
                            <br />
                            <br />
                            Looking ahead, Victoria plans to stay rooted in the Mansfield area and pursue a career in
                            web development close to the UConn community she has come to call home. She sees her future
                            path moving toward full-stack development as her career matures
                        </p>
                    </div>

                    <div class="row g-4 align-items-stretch victoria-row mt-4">
                        <div class="col-lg-6">
                            <div class="radius rounded-2 quote-wrap px-5 h-100 position-relative d-flex flex-column justify-content-center position-relative" data-aos="fade-right">
                                <svg width="54" height="30" viewBox="0 0 34 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                                     class="quotation">
                                    <path
                                        d="M6.91197 29.5679C4.77864 29.5679 3.11464 28.7999 1.91997 27.2639C0.639974 25.7279 -2.64645e-05 23.6372 -2.64645e-05 20.9919C-2.64645e-05 17.0666 0.853307 13.4826 2.55997 10.2399C4.35197 6.99723 7.21064 3.9679 11.136 1.1519C12.16 0.383901 12.9706 0.213234 13.568 0.6399C13.9093 0.895902 14.08 1.2799 14.08 1.7919C14.08 2.21857 13.7813 2.64523 13.184 3.0719C10.2826 5.54657 8.40531 7.46657 7.55197 8.8319C6.78397 10.1119 6.39997 11.4772 6.39997 12.9279C6.39997 14.4639 6.74131 15.6586 7.42397 16.5119C8.10664 17.2799 8.87464 17.9626 9.72797 18.5599C10.5813 19.0719 11.3493 19.7119 12.032 20.4799C12.7146 21.2479 13.056 22.3999 13.056 23.9359C13.056 25.4719 12.5013 26.7946 11.392 27.9039C10.368 29.0132 8.87464 29.5679 6.91197 29.5679ZM26.112 29.5679C23.9786 29.5679 22.272 28.7999 20.992 27.2639C19.7973 25.7279 19.2 23.6372 19.2 20.9919C19.2 17.0666 20.0533 13.4826 21.76 10.2399C23.552 6.99723 26.4106 3.9679 30.336 1.1519C31.36 0.383901 32.1706 0.213234 32.768 0.6399C33.1093 0.895902 33.28 1.2799 33.28 1.7919C33.28 2.21857 32.9813 2.64523 32.384 3.0719C29.4826 5.54657 27.6053 7.46657 26.752 8.8319C25.984 10.1119 25.6 11.4772 25.6 12.9279C25.6 14.4639 25.9413 15.6586 26.624 16.5119C27.3066 17.2799 28.0746 17.9626 28.928 18.5599C29.7813 19.0719 30.5493 19.7119 31.232 20.4799C31.9146 21.2479 32.256 22.3999 32.256 23.9359C32.256 25.4719 31.7013 26.7946 30.592 27.9039C29.568 29.0132 28.0746 29.5679 26.112 29.5679Z"
                                        fill="#31324E" fill-opacity="0.2" />
                                </svg>

                                <p class="fs-4 fst-italic">
                                    No matter the hardship someone may be experiencing,
                                    I hope they can learn what it means to be proud of who they are,
                                    and that they deserve to live their life the way they choose.
                                </p>
                                <p class="mb-0 fs-6 fw-normal">Victoria, 2026</p>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <figure class="position-relative h-100 m-0" data-aos="fade-left">
                                <img src="/care-assets/assets/apollo-pic.jpg" alt="Victoria and her cat Apollo"
                                     class="img-fluid w-100 h-100 object-fit-cover rounded-2" style="min-height:340px;">
                                <figcaption class="position-absolute bottom-0 start-0 img-caption m-2 px-2 py-1 fs-6 text-black radius"
                                            style="background:rgba(255,255,255,.6);">
                                    Victoria with her loving cat Apollo.
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="check-out d-flex flex-column align-items-center gap-2 mt-4 pt-5 pb-5">
                        <span class="fs-3 text-center">
                            Check out Coming out with Care!
                        </span>
                        <a class="check-out-search d-flex rounded-4" href="https://coming-out-guide.sogiecenter.org/" target="_blank">


                            <span class="d-flex align-items-center py-2 px-2">
                                <svg class="me-2" width="24" height="24" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.525 15.75L9.0125 10.2375C8.575 10.5875 8.07187 10.8646 7.50312 11.0687C6.93437 11.2729 6.32917 11.375 5.6875 11.375C4.09792 11.375 2.7526 10.8245 1.65156 9.72344C0.550521 8.6224 0 7.27708 0 5.6875C0 4.09792 0.550521 2.7526 1.65156 1.65156C2.7526 0.550521 4.09792 0 5.6875 0C7.27708 0 8.6224 0.550521 9.72344 1.65156C10.8245 2.7526 11.375 4.09792 11.375 5.6875C11.375 6.32917 11.2729 6.93437 11.0687 7.50312C10.8646 8.07187 10.5875 8.575 10.2375 9.0125L15.75 14.525L14.525 15.75ZM5.6875 9.625C6.78125 9.625 7.71094 9.24219 8.47656 8.47656C9.24219 7.71094 9.625 6.78125 9.625 5.6875C9.625 4.59375 9.24219 3.66406 8.47656 2.89844C7.71094 2.13281 6.78125 1.75 5.6875 1.75C4.59375 1.75 3.66406 2.13281 2.89844 2.89844C2.13281 3.66406 1.75 4.59375 1.75 5.6875C1.75 6.78125 2.13281 7.71094 2.89844 8.47656C3.66406 9.24219 4.59375 9.625 5.6875 9.625Z" fill="#6761E5"/>
                                </svg>
                                <span class="check-out-link-hidden fw-medium fs-6 fs-sm-5 fs-md-4 text-nowrap" style="color: rgba(0,0,0,0)">coming-out-guide.sogiecenter.org<span id="check-out-link" class="fw-medium fs-6 fs-sm-5 fs-md-4" style="color: #212529">coming-out-guide.sogiecenter.org</span>
                                </span>

                            </span>
                            <span class="fw-medium text-white fs-5 d-none d-sm-flex align-items-center px-3 py-2 visit">VISIT</span>
                        </a>
                        <a class="fw-medium text-white fs-5 d-flex d-sm-none align-items-center px-3 py-2 mt-2 visit sm rounded-4" href="https://coming-out-guide.sogiecenter.org/" target="_blank">VISIT</a>
                    </div>
                </div>
            </div>

        </section>

        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script src="/care-assets/coming-out-with-care.js"> </script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script>
          AOS.init({
            duration: 800,
            once: true
          });
        </script>
    </div>

@endsection