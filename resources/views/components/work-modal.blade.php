@props(['project'])

<!-- Project Modal -->
<div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h3 class="modal-title" id="projectModalLabel{{ $project->id }}">{{ $project->title }}</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-2">
                @if($project->best_thumbnail_url)
                    <img src="{{ $project->best_thumbnail_url }}?v={{ time() }}" alt="{{ $project->title }}" loading="lazy" class="img-fluid rounded mb-3">
                @endif
                @if($project->excerpt)
                    <p class="mb-0 px-3">{!! $project->excerpt !!}</p>
                @endif
            </div>
            <div class="modal-footer border-0 justify-content-end pt-2 pb-3">
                @if($project->link)
                    <div class="btn-arrow-slide">
                        <a href="{{ $project->link }}" target="_blank" rel="noopener" class="btn-arrow-slide-cont btn-arrow-slide-cont--white" aria-label="Visit {{ $project->title }}">
                            <span class="btn-arrow-slide-circle" aria-hidden="true">
                                <span class="btn-arrow-slide-arrow btn-arrow-slide-icon"></span>
                            </span>
                            <span class="btn-arrow-slide-text">Visit {{ $project->title }}</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
