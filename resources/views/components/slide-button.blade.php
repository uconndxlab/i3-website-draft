<div class="btn display-btn btn-arrow-slide">
    <a {{ $attributes->merge(['href' => route('home')]) }} class="btn-arrow-slide-cont btn-arrow-slide-cont--white">
        <span class="btn-arrow-slide-circle" aria-hidden="true">
            <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
        </span>
        <span class="btn-arrow-slide-text">{{ $slot }}</span>
    </a>
</div>