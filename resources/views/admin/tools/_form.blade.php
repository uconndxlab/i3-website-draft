@csrf

@if ($errors->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> {{ $errors->first('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $tool->description ?? '') }}</textarea>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $tool->link ?? '') }}" placeholder="https://example.com">
            @error('link')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alt Text</label>
            <input type="text" name="alt_text" class="form-control" value="{{ old('alt_text', $tool->alt_text ?? '') }}" placeholder="Descriptive text for the image">
            @error('alt_text')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
            <small class="form-text text-muted">
                Accepted formats: JPEG, JPG, PNG, GIF, WebP. Maximum size: 10MB.
            </small>
            @error('image')
                <div class="text-danger small mt-1">
                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                </div>
            @enderror
            @if ($tool?->best_thumbnail_url)
                <div class="mt-2">
                    <img src="{{ $tool->best_thumbnail_url }}" alt="{{ $tool->alt_text ?? 'Tool image' }}" class="img-fluid rounded border" style="max-height: 200px; object-fit: contain;">
                    <small class="text-muted d-block mt-1">Current image</small>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" 
                    {{ old('is_active', $tool->is_active ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active
                </label>
            </div>
            <small class="text-muted">Only active tools will be displayed on the website.</small>
        </div>
    </div>
</div>

