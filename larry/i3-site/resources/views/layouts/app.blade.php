<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'i3')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-..." crossorigin="anonymous">
    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Your own styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/js/app.js')
</head>

<body>
    @include('layouts.header')
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-grow-1 py-3">
            @yield('content')
        </main>
    </div>
</body>
<section id="contact" class="bg-deep text-light d-flex align-items-center px-5" style="min-height: 100vh;">
    <div class="container">
        <h2 class="mb-4 d-inline-block pb-3" data-aos="fade-down"><span
                class="border-bottom border-2 pb-3 border-primary">CONTACT</span> US</h2>
        <div class="row align-items-top g-5" data-aos-delay="200">
            {{-- Form --}}
            <div class="col-lg-6" data-aos="fade-right">
                <form method="POST" action="#" class="contact-form">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="type" class="form-control" id="floatingInputGrid" placeholder="Lorem">
                                <label for="floatingInputGrid">First Name</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="type" class="form-control" id="floatingInputGrid" placeholder="Ipsum">
                                <label for="floatingInputGrid">Last Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="email" class="form-control" id="floatingInputGrid"
                            placeholder="name@example.com">
                        <label for="floatingInputGrid">Email address</label>
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Message</label>
                    </div>

                    <div class="btn display-btn btn-arrow-slide">
                        <a href="#" class="btn-arrow-slide-cont btn-arrow-slide-cont--white" style="width:205px">
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
                    <p>Visit Us in <strong>Rowe 321!</strong></p>
                    <iframe title="Google Map of our Location in the Rowe Building at UConn"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4886.890665260858!2d-72.26192202229005!3d41.807715800000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e68bee10433b09%3A0x9da32f236598c077!2sUConn%20Rowe%20Center%20for%20Undergraduate%20Education%20(ROWE)!5e1!3m2!1sen!2sus!4v1740006421026!5m2!1sen!2sus"
                        width="80%" height="80%" frameborder="0" style="border:0;border-radius: 20px"
                        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
<footer class="footer footer-index py-4" style="background:#030303;">
    <div class="container footer-info d-flex justify-space-between flex-wrap justify-content-center">
        <a class="footer-link" href="https://uconn.edu">© 2025 University of Connecticut</a>
        <a class="footer-link" href="https://uconn.edu/disclaimers-privacy-copyright/">Disclaimers, Privacy &amp;
            Copyright</a>
        <a class="footer-link" href="https://accessibility.uconn.edu/">Accessibility</a>
    </div>
</footer>

</html>
