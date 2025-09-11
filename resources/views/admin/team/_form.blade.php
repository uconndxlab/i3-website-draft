@csrf

<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $team->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <input name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $team->role ?? '') }}">
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">LinkedIn Profile URL</label>
            <input name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $team->linkedin ?? '') }}">
            @error('linkedin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tags <small class="text-muted">(comma-separated)</small></label>
            <input name="tags" class="form-control @error('tags') is-invalid @enderror" value="{{ old('tags', isset($team->tags) ? implode(', ', $team->tags) : '') }}" placeholder="e.g., senior-staff, student-staff, faculty-advisor">
            @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if (!empty($team?->photo))
            <div class="mb-3 text-center">
                <img src="{{ $team->best_image_url }}" class="img-fluid rounded shadow" style="max-width: 200px;">
                <div class="small text-muted mt-2">
                    @if($team->photo_medium)
                        <i class="bi bi-check-circle-fill text-success"></i> Medium version available<br>
                    @endif
                    @if($team->photo_webp)
                        <i class="bi bi-check-circle-fill text-success"></i> WebP version available
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<div class="mt-4 text-end">
    <button class="btn btn-primary px-4 py-2">
        <i class="bi bi-save me-2"></i>Save
    </button>
</div>
