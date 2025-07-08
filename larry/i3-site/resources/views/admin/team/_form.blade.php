@csrf

<div class="row g-4">
    <div class="col-md-8">
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
    </div>
    <div class="col-md-4 d-flex flex-column align-items-center justify-content-start">
        <div class="mb-3 w-100">
            <label class="form-label text-light">Photo</label>
            <input type="file" name="photo" class="form-control bg-dark text-light">
        </div>
        @if (!empty($team?->photo))
            <div class="mb-3 w-100 text-center">
                <img src="{{ asset('storage/' . $team->photo) }}" class="img-fluid rounded shadow mt-2">
            </div>
        @endif
    </div>
</div>

<div class="mt-4 text-end">
    <button class="btn btn-primary px-4 py-2 fs-5">Save</button>
</div>
