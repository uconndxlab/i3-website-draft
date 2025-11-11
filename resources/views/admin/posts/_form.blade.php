@csrf

<input type="hidden" name="publish_action" id="publish_action" value="">

<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
            @error('title')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Subheader</label>
            <input name="subheader" class="form-control" value="{{ old('subheader', $post->subheader ?? '') }}" placeholder="Optional subtitle or brief description">
            <small class="text-muted">Optional subtext that appears below the title</small>
            @error('subheader')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input name="author" class="form-control" value="{{ old('author', $post->author ?? '') }}">
            @error('author')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>
            <div class="d-flex gap-3 flex-wrap">
                @foreach(['People', 'News', 'Projects'] as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" 
                               value="{{ $tag }}" 
                               id="tag-{{ strtolower($tag) }}"
                               @if(old('tags', isset($post) && is_array($post->tags) ? $post->tags : []))
                                   {{ in_array($tag, old('tags', is_array($post->tags ?? null) ? $post->tags : [])) ? 'checked' : '' }}
                               @endif>
                        <label class="form-check-label" for="tag-{{ strtolower($tag) }}">
                            {{ $tag }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('tags')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Permalink (slug)</label>
            <div class="input-group">
                <span class="input-group-text">{{ url('blogs') }}/</span>
                <input name="url_friendly" id="url_friendly" class="form-control" value="{{ old('url_friendly', $post->url_friendly ?? '') }}" placeholder="auto-generated-from-title">
            </div>
            <small class="text-muted">Customize the URL slug. Leave blank to auto-generate from the title.</small>
            @error('url_friendly')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            @if(isset($post))
            <div class="mt-1">
                @if($post->published)
                    <a href="{{ route('blog.show', ['slug' => $post->url_friendly]) }}" target="_blank">View public permalink</a>
                @endif
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Published Date</label>
            <input type="date" name="published_at" class="form-control" 
                   value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d') : '') }}">
            @error('published_at')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Blade Template</label>
            <select name="blade_file" class="form-select">
                <option value="">Select a template</option>
                @foreach(($bladeTemplates ?? []) as $template)
                    <option value="{{ $template['value'] }}"
                        {{ old('blade_file', $post->blade_file ?? '') === $template['value'] ? 'selected' : '' }}>
                        {{ $template['label'] }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Templates are loaded from <code>resources/views/pages/blogs</code>.</small>
            @error('blade_file')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" name="featured_image" class="form-control" accept="image/*">
            @error('featured_image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            @if (isset($post) && !empty($post->featured_image))
                <div class="mt-2">
                    <img src="{{ $post->best_featured_image_url }}" class="img-fluid rounded border">
                    <small class="text-muted d-block mt-2">Current featured image</small>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-between align-items-center">
    <div>
        @if(isset($post))
            <a href="{{ route('admin.posts.preview', $post) }}" 
               class="btn btn-outline-info"
               target="_blank">
                <i class="bi bi-eye me-2"></i>Preview
            </a>
        @endif
    </div>
    <div class="d-flex gap-2">
        @if(!isset($post) || !$post->published)
            <button type="submit" 
                    class="btn btn-success px-4 py-2"
                    onclick="document.getElementById('publish_action').value='publish';">
                <i class="bi bi-check-circle me-2"></i>Save & Publish
            </button>
        @endif
        <button type="submit" class="btn btn-primary px-4 py-2">
            <i class="bi bi-save me-2"></i>Save
        </button>
    </div>
</div>


</div>
<script>
   
    // Auto-generate slug from title when url_friendly is empty or when editing title initially
    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.getElementById('url_friendly');
    const slugify = (text) => {
        return (text || '')
            .toString()
            .normalize('NFKD')
            .replace(/[\u0300-\u036f]/g, '') // remove diacritics
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    };
    if (titleInput && slugInput) {
        let userEditedSlug = slugInput.value && slugInput.value.length > 0;
        titleInput.addEventListener('input', function() {
            if (!userEditedSlug) {
                slugInput.value = slugify(titleInput.value);
            }
        });
        slugInput.addEventListener('input', function() {
            userEditedSlug = slugInput.value.length > 0;
        });
        slugInput.addEventListener('blur', function() {
            slugInput.value = slugify(slugInput.value);
        });
    }
</script>