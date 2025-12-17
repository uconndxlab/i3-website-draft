@props(['tool'])

<!-- Tool Modal -->
<div class="modal fade" id="toolModal{{ $tool->id }}" tabindex="-1" aria-labelledby="toolModalLabel{{ $tool->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 px-4" style="background-color: #1f1f1f; max-width: 500px;">
            <div class="modal-header border-0 pb-2">
                <h5 class="text-white mb-0" id="toolModalLabel{{ $tool->id }}">{{ $tool->title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center py-4">
                @if($tool->best_thumbnail_url)
                    <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->title }}" class="img-fluid rounded" style="max-width: 100%; max-height: 300px; object-fit: contain;">
                @endif
            </div>
            <div class="modal-footer border-0 d-flex align-items-center pt-0" style="flex-wrap: nowrap; gap: 1rem;">
                @if($tool->excerpt)
                    <p class="text-white-50 mb-0 small" style="flex: 1 1 0; min-width: 0; line-height: 1.5; overflow-wrap: break-word; word-wrap: break-word;">{{ $tool->excerpt }}</p>
                @endif
                @if($tool->link)
                    <div class="btn-arrow-slide" style="flex-shrink: 0;">
                        <a href="{{ $tool->link }}" target="_blank" rel="noopener" class="btn-arrow-slide-cont btn-arrow-slide-cont--white tool-modal-btn">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text">Try It</span>
                        </a>
                    </div>
                @else
                    <div class="btn-arrow-slide" style="flex-shrink: 0;">
                        <button type="button" class="btn-arrow-slide-cont btn-arrow-slide-cont--white tool-modal-btn" disabled>
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text">Try It</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
