@props([
    'person',
    'overlayClass' => 'bg-dark-to-transparent',
    'nameSize' => 'fs-5'
])

<div class="position-relative person-card rounded-3">
    <div class="card-outline"></div>

    @if ($person->linkedin)
        <a title="Linkedin Profile for {{ $person->name }}" href="{{ $person->linkedin }}"
            target="_blank" rel="noopener" aria-label="LinkedIn for {{ $person->name }}"
            style="position: absolute; top:20px; right: 5px; z-index: 3; padding: 5px;">
            <i class="bi bi-linkedin fs-3 text-white" style="text-shadow: 0 2px 6px rgba(0,0,0,0.3);"></i>
        </a>
    @endif

    <img src="{{ $person->best_image_url }}" alt="{{ $person->name }}"
        class="person-photo">
    <div class="person-overlay {{ $overlayClass }} text-white p-3 pt-5">
        <div class="person-name-and-role">
            <h3 class="mb-0 fw-bold person-name {{ $nameSize }}">
                <span class="firstname">{{ explode(' ', $person->name)[0] }}</span>
                <span class="lastname">
                    {{ implode(' ', array_slice(explode(' ', $person->name), 1)) }}</span>
            </h3>
            <small class="person-role">{{ $person->role }}</small>
        </div>
    </div>
</div>
