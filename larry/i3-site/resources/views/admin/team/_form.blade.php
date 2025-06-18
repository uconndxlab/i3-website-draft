@csrf

<div class="mb-3">
    <label class="form-label">Name</label>
    <input name="name" class="form-control" value="{{ old('name', $team->name ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <input name="role" class="form-control" value="{{ old('role', $team->role ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Tags <small>(comma-separated)</small></label>
    <input name="tags" class="form-control" value="{{ old('tags', isset($team->tags) ? implode(', ', $team->tags) : '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Photo</label>
    <input type="file" name="photo" class="form-control">
    @if (!empty($team?->photo))
        <img src="{{ asset('storage/' . $team->photo) }}" class="img-fluid mt-2" style="max-height: 150px;">
    @endif
</div>

<button class="btn btn-primary">Save</button>
