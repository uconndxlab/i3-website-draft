@csrf

<div class="mb-3">
    <label class="form-label text-light">Name</label>
    <input name="name" class="form-control bg-dark text-light" value="{{ old('name', $team->name ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label text-light">Role</label>
    <input name="role" class="form-control bg-dark text-light" value="{{ old('role', $team->role ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label text-light">Tags <small class="text-secondary">(comma-separated)</small></label>
    <input name="tags" class="form-control bg-dark text-light" value="{{ old('tags', isset($team->tags) ? implode(', ', $team->tags) : '') }}">
</div>

<div class="mb-3">
    <label class="form-label text-light">Photo</label>
    <input type="file" name="photo" class="form-control bg-dark text-light">
    @if (!empty($team?->photo))
        <img src="{{ asset('storage/' . $team->photo) }}" class="img-fluid mt-2" style="max-height: 150px;">
    @endif
</div>

<button class="btn btn-primary">Save</button>
