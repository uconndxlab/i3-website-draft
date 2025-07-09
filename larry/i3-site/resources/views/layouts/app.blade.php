<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'i3') | Internal Insights & Innovation | UConn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

    <!-- Your own styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

</head>

<body>
    @include('layouts.header')
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-grow-1 pt-3">
            @yield('content')
        </main>
    </div>

    <div class="footercontain">
        <section id="contact" class="bg-dark text-light d-flex align-items-center px-5" style="min-height: 100vh;">
            <div class="container">
                <h2 class="mb-4 d-inline-block pb-3" data-aos="fade-down"><span
                        class="border-bottom border-2 pb-3 border-primary">CONTACT</span> US</h2>
                <div class="row align-items-top g-5" data-aos-delay="200">
                    {{-- Form --}}
                    <div class="col-lg-6" data-aos="fade-right">
                        <form method="POST" action="#" class="contact-form text-light">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-dark text-light" id="firstName"
                                            placeholder="Lorem">
                                        <label for="firstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-dark text-light" id="lastName"
                                            placeholder="Ipsum">
                                        <label for="lastName">Last Name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control bg-dark text-light" id="email"
                                    placeholder="name@example.com">
                                <label for="email">Email address</label>
                            </div>

                            <div class="form-floating mb-4">
                                <textarea class="form-control bg-dark text-light" placeholder="Leave a comment here" id="message"
                                    style="height: 100px"></textarea>
                                <label for="message">Message</label>
                            </div>
                            <div class="btn display-btn btn-arrow-slide">
                                <a href="#" class="btn-arrow-slide-cont btn-arrow-slide-cont--white"
                                    style="width:200px">
                                    <span class="btn-arrow-slide-circle" aria-hidden="true">
                                        <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                                    </span>
                                    <span class="btn-arrow-slide-text"> Send Message </span>
                                </a>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="maps">
                            <iframe title="Google Map of our Location in the Rowe Building at UConn"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4886.890665260858!2d-72.26192202229005!3d41.807715800000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e68bee10433b09%3A0x9da32f236598c077!2sUConn%20Rowe%20Center%20for%20Undergraduate%20Education%20(ROWE)!5e1!3m2!1sen!2sus!4v1740006421026!5m2!1sen!2sus"
                                width="80%" height="80%" frameborder="0" style="border:0;border-radius: 20px"
                                allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            <p>Visit Us in <strong>Rowe 321!</strong></p>

                        </div>
                        <div class="social-links d-flex justify-content-center gap-3 mt-4">
                            <a href="https://www.linkedin.com/school/university-of-connecticut/" target="_blank"
                                class="text-light fs-4">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/UConn" target="_blank" class="text-light fs-4">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer footer-index py-4 bg-dark text-light">
            <div class="container footer-info d-flex justify-space-between flex-wrap justify-content-center">
                <a class="footer-link" href="https://uconn.edu">© 2025 University of Connecticut</a>
                <a class="footer-link" href="https://uconn.edu/disclaimers-privacy-copyright/">Disclaimers, Privacy &amp;
                    Copyright</a>
                <a class="footer-link" href="https://accessibility.uconn.edu/">Accessibility</a>
            </div>
        </footer>
    </div>
    
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
@vite('resources/js/app.js')
@vite('resources/js/starParticles.js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
const animatedBgFooter = new StarParticles({
        selector: '.footercontain',
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
</body>

</html>
