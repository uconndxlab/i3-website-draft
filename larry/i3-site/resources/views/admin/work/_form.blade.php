@csrf

<div class="mb-3">
    <label class="form-label">Title</label>
    <input name="title" class="form-control" value="{{ old('title', $work->title ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Excerpt</label>
    <textarea name="excerpt" class="form-control">{{ old('excerpt', $work->excerpt ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Body</label>
    <textarea name="body" class="form-control" rows="6">{{ old('body', $work->body ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control">
    @if (!empty($work?->thumbnail))
        <img src="{{ asset('storage/' . $work->thumbnail) }}" class="img-fluid mt-2" style="max-height: 150px;">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Tags</label>
    <div class="d-flex flex-wrap gap-2">
        @foreach ($tags as $tag)
            <div class="form-check">
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

<button class="btn btn-primary">Save</button>
