@extends('layouts.app')
@section('title', 'i3 + Greenhouse Studios Merger')
@section('meta_description', 'Learn about the exciting merger between i3 and Greenhouse Studios, combining innovation and technology to enhance scholarly practices at UConn.')

@section('content')
<style>
.gs-content {
    max-width: 800px;
    margin: 0 auto;
}

.gs-link {
    text-decoration-line: none;
}
</style>

<section>
    <div class="container">
        <div class="gs-content">

            <!-- Heading -->
            <div class="text-center mb-5">
                

                <h1 class="display-5 fw-bold mb-3">
                    <span style="color: #8CC947;">Greenhouse Studios</span>
                </h1>

                <!-- <img src="{{ asset('img/i3/gs-knockout.png') }}" alt="Greenhouse Studios Logo"> -->
                
            </div>

            

            <!-- Main Content -->
            <div class="text-center mb-5">
                <h3 class="h4 mb-3">About Greenhouse Studios</h3>
                <p>
                    Predicated on a history of forging new approaches to scholarly work rooted in radical collaboration and 
                    design thinking methodologies, Greenhouse Studios has always been a place for imagining new futures and growing 
                    big ideas, together. This new phase of growth poses and exciting opportunity for our team to increase the breadth 
                    and depth of our reach, both within and beyond the university.
                </p>
                <p>
                    As we merge with our incredible colleagues at i3, we are already dreaming up so many exciting new directions that we will take on together. By joining forces, we look forward to integrating Greenhouse Studios' pioneering approach directly into the university's core practices, all while preserving the innovative and human-centered spirit which remains at the center of our practice. Stay tuned!
                </p>
            </div>

            <div class="text-center mt-4">
                <button type="button" class="btn-arrow-slide-cont btn-arrow-slide-cont--white"
                    data-bs-toggle="modal" data-bs-target="#announcementModal">
                    <span class="btn-arrow-slide-circle" aria-hidden="true">
                        <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                    </span>
                    <a class="btn-arrow-slide-text gs-link" href="/merger">Read About The Merger</a>
                </button>
            </div>
        </div>
    </div>
</section>
@endsection