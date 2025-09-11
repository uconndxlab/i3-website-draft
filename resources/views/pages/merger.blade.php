@extends('layouts.app')
@section('title', 'i3 + Greenhouse Studios Merger')
@section('meta_description', 'Learn about the exciting merger between i3 and Greenhouse Studios, combining innovation and technology to enhance scholarly practices at UConn.')

@section('content')
<style>
    .merger-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        margin: 2rem 0;
    }

    .logo-container img {
        max-height: 80px;
        max-width: 100px;
    }

    .merge-symbol {
        font-size: 2rem;
        color: #4DB3FF;
        font-weight: bold;
    }

    .gs-link {
        text-decoration-line: none;
    }

    .gs-btn {
        background-color: #8cc948;
    }

    .btn-layout {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    @media (max-width: 768px) {
        .logo-container {
            flex-direction: column;
            gap: 1rem;
        }

        .merge-symbol {
            transform: rotate(90deg);
        }

        .btn-layout {
            flex-direction: column;
        }
    }
</style>

<section class="py-5">
    <div class="container">
        <div class="merger-content">

            {{-- Header --}}
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold mb-3">
                    <span style="color: #4DB3FF;">i3</span> + <span style="color: #8CC947;">Greenhouse Studios</span>
                </h1>
                <p class="lead">
                    Two innovative teams. One powerful vision. Stronger together.
                </p>

                {{-- Logo visual --}}
                <div class="logo-container">
                    <img src="{{ asset('img/i3/i3-symbol-fill.svg') }}" alt="i">
                    <div class="merge-symbol">+</div>
                    <img src="{{ asset('img/i3/gs-knockout.png') }}"
                        alt="Greenhouse Studios">
                    =
                    <span class="merge-symbol" style="font-size:2rem; color:#e25555;">&#10084;&#65039;</span>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="text-center mb-5">
                <h2 class="h3 mb-4">A Strategic Partnership</h2>
                <p class="lead text-muted mb-4">
                    This merger is the result of a longstanding and productive collaboration between Greenhouse Studios
                    and i3.
                </p>
            </div>

            <div class="mb-5">
                <h3 class="h4 mb-3">What This Means</h3>
                <p>The expanded i3 combines our original strengths in custom software development, web applications, and
                    university business processes with new capabilities in design thinking, scholarly communication, and
                    collaborative approaches to scholarship.</p>

                <p>Based in the Provost's Office, i3 serves the university on two fronts:</p>

                <ul>
                    <li>Institutional systems and platforms that support everyday academic and operational needs;</li>
                    <li>Research and scholarly projects that benefit from creative design, innovative methods, and
                        digital tools.</li>
                </ul>

                <p>Together, these strengths position i3 as a comprehensive partner for UConn's students, faculty, and
                    staff, building practical solutions for today while creating space for new ideas and groundbreaking
                    research.</p>

                <div class="alert alert-info text-center mt-4" role="alert">
                    <strong>More info to come soon!</strong> Stay tuned for updates about this exciting evolution.
                </div>

                <div class="btn-layout">
                    <!-- Read the Announcement Button -->
                    <div class="text-center mt-4">

                        <button type="button" class="btn-arrow-slide-cont btn-arrow-slide-cont--white"
                            data-bs-toggle="modal" data-bs-target="#announcementModal">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text">Read the Announcement</span>
                        </button>
                    </div>

                    <!-- More about Greenhouse Studios Button -->

                    <div class="text-center mt-4">

                        <button type="button" class="btn-arrow-slide-cont btn-arrow-slide-cont--white"
                            data-bs-toggle="modal" data-bs-target="#announcementModal">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <a class="btn-arrow-slide-text gs-link" href="/greenhouse-studios">More About Greenhouse Studios</a>
                        </button>
                    </div>
                </div>

                <!-- Announcement Modal -->
                <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="announcementModalLabel">i3 + Greenhouse Studios Merger
                                    Announcement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Dear colleagues,</strong></p>

                                <p>
                                    We are writing today to share some exciting news about a significant development for
                                    digital scholarship at UConn. The university is bringing together the functions and
                                    staff of two highly innovative groups: Greenhouse Studios and i3 (Internal Insights
                                    and Innovation).
                                </p>

                                <p>
                                    This merger is the result of a longstanding and productive collaboration between the
                                    two units, which you've seen on projects like Omeka Everywhere and, more recently,
                                    Sourcery. The merged unit will be located in the Provost's Office and will continue
                                    i3's essential work in internal web development, analytics, and digital platforms.
                                    It will also strengthen and expand Greenhouse Studios' work in collaborative
                                    scholarly communications design, enabling a new breadth and scale of activity that
                                    will extend its reach to a wider range of disciplines and PIs from across campus and
                                    beyond.
                                </p>

                                <p>
                                    This is a meaningful milestone for digital scholarship at UConn, integrating
                                    Greenhouse Studios' pioneering work into the university's core practices at a time
                                    when digital communication is more vital than ever. Joel Salisbury, the Director of
                                    i3, will take on leadership of the merged unit. Tom Scheinfeldt, founding Director
                                    of Greenhouse Studios, will make a planned return to full-time teaching and research
                                    but continue to work closely with the merged unit as a collaborating PI.
                                </p>

                                <p>
                                    With this change, UConn is better positioned to take on the challenges and
                                    opportunities of the digital age, combining i3's institutional knowledge and
                                    technical expertise with Greenhouse Studios' innovative and human-centered approach
                                    to academic work. We look forward to seeing what this new chapter brings and how the
                                    merged unit will continue to support and transform research at UConn.
                                </p>

                                <p><strong>Sincerely,</strong><br>
                                    Anne, Dan, Tom, Joel, and the team.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection