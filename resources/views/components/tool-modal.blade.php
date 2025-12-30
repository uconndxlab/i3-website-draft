@props(['tool'])

<!-- Tool Modal -->
<div class="modal fade" id="toolModal{{ $tool->id }}" tabindex="-1" aria-labelledby="toolModalLabel{{ $tool->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h3 class="modal-title" id="toolModalLabel{{ $tool->id }}">{{ $tool->title }}</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-2">
                @if($tool->best_thumbnail_url)
                    <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->title }}" class="img-fluid rounded mb-3">
                @endif
                @if($tool->excerpt)
                    <p class="mb-0 px-3">{{ $tool->excerpt }}</p>
                @endif
            </div>
            <div class="modal-footer border-0 justify-content-end pt-2 pb-3">
                @if($tool->link)
                    <div class="btn-arrow-slide">
                        <a href="{{ $tool->link }}" target="_blank" rel="noopener" class="btn-arrow-slide-cont btn-arrow-slide-cont--white tool-modal-btn" aria-label="Try {{ $tool->title }}">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text">Visit {{ $tool->title }}</span>
                        </a>
                    </div>
                @else

                @endif
            </div>
        </div>
    </div>
</div>
