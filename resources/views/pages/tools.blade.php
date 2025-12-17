@extends('layouts.app')
@section('title', 'Tools')
@section('meta_description', 'Explore our diverse portfolio of web design, web development, and UX design projects at i3. See how we create innovative digital solutions for the UConn community.')

@section('content')

<div class="container">
    <h1 class="hero-title text-center">Tools</h1>  
    
    <div class="row justify-content-center pb-5 py-5">
        <div class="col-md-6">
            <p class="text-center">
                Built for the university, by the university, and available to all.
            </p>
            <p class="text-center">
            We are proud to offer a suite of enterprise tools that are already in use throughout the university. Check back often, as our tool belt is always growing as we continue to build unique solutions for and alongside our ever-innovative university community.
            </p>
        </div>
    </div>


    @if($tools && $tools->count() > 0)
        @php
            $topRowTools = $tools->take(3);
            $bottomRowTools = $tools->skip(3)->take(3);
        @endphp
        
        @if($topRowTools->count() > 0)
            <div class="row justify-content-center mb-4 mb-md-5 image-row" id="toolsTopRow">
                @foreach($topRowTools as $tool)
                    <div class="col-auto px-3 tool-image-container">
                        @if($tool->best_thumbnail_url)
                            <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->title }}" 
                                 class="img-fluid w-100 rounded tool-image" 
                                 style="cursor: pointer; visibility: hidden;" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#toolModal{{ $tool->id }}">
                            <x-tool-modal :tool="$tool" />
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        
        @if($bottomRowTools->count() > 0)
            <div class="row justify-content-center mb-4 mb-md-5 pb-5 image-row" id="toolsBottomRow">
                @foreach($bottomRowTools as $tool)
                    <div class="col-auto px-3 tool-image-container">
                        @if($tool->best_thumbnail_url)
                            <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->title }}" 
                                 class="img-fluid w-100 rounded tool-image" 
                                 style="cursor: pointer; visibility: hidden;" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#toolModal{{ $tool->id }}">
                            <x-tool-modal :tool="$tool" />
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

<style>

@media (min-width: 768px) {
    #toolsTopRow {
        margin-left: calc(-100px - 10rem);
    }
    .image-row .tool-image-container{
        max-width: 200px;
    }
}
@media (max-width: 768px) {
    .image-row .tool-image-container, 
    .image-row .tool-image-container{
        padding-bottom: 1rem;
    }

    .image-row .tool-image-container{
        width: 90% !important;
        max-width: 90% !important;
    }
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toolImages = document.querySelectorAll('.tool-image');
    
    if (toolImages.length === 0) {
        return;
    }
    
    let loadedCount = 0;
    const totalImages = toolImages.length;
    let allImagesLoaded = false;
    
    function showAllImages() {
        if (allImagesLoaded) return;
        allImagesLoaded = true;
        
        toolImages.forEach(function(img) {
            img.style.visibility = '';
            img.style.opacity = '0';
            
            requestAnimationFrame(function() {
                img.style.transition = 'opacity 0.5s ease-in-out';
                requestAnimationFrame(function() {
                    img.style.opacity = '1';
                });
            });
        });
    }
    
    toolImages.forEach(function(img) {
        if (img.complete && img.naturalHeight !== 0) {
            loadedCount++;
            if (loadedCount === totalImages) {
                setTimeout(showAllImages, 50);
            }
        } else {
            img.addEventListener('load', function() {
                loadedCount++;
                if (loadedCount === totalImages) {
                    setTimeout(showAllImages, 50);
                }
            }, { once: true });
            
            img.addEventListener('error', function() {
                loadedCount++;
                if (loadedCount === totalImages) {
                    setTimeout(showAllImages, 50);
                }
            }, { once: true });
        }
    });
    
    setTimeout(function() {
        if (!allImagesLoaded) {
            showAllImages();
        }
    }, 3000);
});
</script>

@endsection