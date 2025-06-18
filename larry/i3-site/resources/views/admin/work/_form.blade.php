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

<button class="btn btn-primary">Save</button>
