@csrf

<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" value="{{ old('title', $work->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Excerpt</label>
            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $work->excerpt ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="8">{{ old('body', $work->body ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
            @if (!empty($work?->thumbnail))
                <div class="mt-2">
                    <img src="{{ $work->best_thumbnail_url }}" class="img-fluid rounded border">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <div class="form-check me-2">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            id="tag-{{ $tag->id }}"
                            {{ (collect(old('tags', isset($work) && $work->tags ? $work->tags->pluck('id')->toArray() : []))->contains($tag->id)) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="mt-4 text-end">
    <button class="btn btn-primary px-4 py-2">
        <i class="bi bi-save me-2"></i>Save
    </button>
</div>
