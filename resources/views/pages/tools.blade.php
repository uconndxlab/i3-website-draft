@extends('layouts.app')
@section('title', 'Tools')
@section('meta_description', 'Explore our diverse portfolio of web design, web development, and UX design projects at i3. See how we create innovative digital solutions for the UConn community.')

@section('content')

<div class="container">
    <h1 class="page-h1">Tools</h1>  
    
    <div class="row justify-content-center pb-5">
        <div class="col-md-6">
            <p class="text-center">
                Built for the university, by the university, and available to all.
            </p>
            <p class="text-center">
                We are proud to offer a suite of readily-available and freely accessible tools that are already in use out in the wild. Check back often, as our tool belt is always growing as we continue to build unique solutions alongside our ever-innovative university community.
            </p>
        </div>
    </div>


    @if($tools && $tools->count() > 0)
        @php
            $topRowTools = $tools->take(3);
            $bottomRowTools = $tools->skip(3)->take(3);
        @endphp
        
        @if($topRowTools->count() > 0)
            <div class="row justify-content-center mb-4 mb-md-5 tools-top-row">
                @foreach($topRowTools as $tool)
                    <div class="col-auto px-3">
                        @if($tool->best_thumbnail_url)
                            <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->title }}" 
                                 class="img-fluid w-100 rounded tool-image" 
                                 style="max-width: 200px; cursor: pointer;" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#toolModal{{ $tool->id }}">
                            <x-tool-modal :tool="$tool" />
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        
        @if($bottomRowTools->count() > 0)
            <div class="row justify-content-center mb-4 mb-md-5 pb-5">
                @foreach($bottomRowTools as $tool)
                    <div class="col-auto px-3">
                        @if($tool->best_thumbnail_url)
                            <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->title }}" 
                                 class="img-fluid w-100 rounded tool-image" 
                                 style="max-width: 200px; cursor: pointer;" 
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
.tools-top-row {
    margin-left: calc(-100px - 10rem);
}

@media (max-width: 768px) {
    .tools-top-row {
        margin-left: calc(-75px - 1rem);
    }
    
    .tools-top-row img,
    .row.justify-content-center:not(.tools-top-row) img {
        max-width: 150px !important;
    }
}
</style>

@endsection