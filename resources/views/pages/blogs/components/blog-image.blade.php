@php
    $width = $width ?? '260px';
    $imageWidth = $imageWidth ?? '250px';
    $hasCaption = !empty($caption);
    $float = $float ?? 'left'; // 'left' or 'right'
    $floatClass = $float === 'right' ? 'float-lg-end ms-lg-4' : '';
@endphp

<div class="blog-image-with-caption {{ $floatClass }}" style="width: {{ $width }};">
    <img src="{{ asset($src) }}"
         alt="{{ $alt }}"
         class="img-fluid rounded shadow" 
         style="width: {{ $imageWidth }};">
    @if($hasCaption)
        <p class="blog-image-caption mb-0">{{ $caption }}</p>
    @endif
</div>

