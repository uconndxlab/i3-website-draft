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
                <span class="input-group-text">/blog/</span>
                <input name="url_friendly" id="url_friendly" class="form-control" value="{{ old('url_friendly', $post->url_friendly ?? '') }}" placeholder="auto-generated-from-title">
            </div>
            <small class="text-muted">Customize the URL slug. Leave blank to auto-generate from the title.</small>
            @error('url_friendly')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            @if(isset($post))
            <div class="mt-1">
                @if($post->published)
                    <a href="{{ url('/blog/' . ($post->url_friendly ?? '')) }}" target="_blank">View public permalink</a>
                @endif
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Published Date <span class="text-danger">*</span></label>
            <input type="date" name="published_at" class="form-control" 
                   value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d') : '') }}" 
                   required>
            @error('published_at')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Content <span class="text-danger">*</span></label>
            <input type="hidden" name="content" id="content-hidden">
            <div id="content-editor" style="height: 400px;">{!! old('content', $post->content ?? '') !!}</div>
            @error('content')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <small class="text-muted">Use the toolbar above to format your content</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Image Position</label>
            <select name="image_position" class="form-control">
                <option value="before_title" {{ old('image_position', $post->image_position ?? 'before_content') == 'before_title' ? 'selected' : '' }}>Before Title</option>
                <option value="before_content" {{ old('image_position', $post->image_position ?? 'before_content') == 'before_content' ? 'selected' : '' }}>Before Content (Default)</option>
                <option value="after_content" {{ old('image_position', $post->image_position ?? 'before_content') == 'after_content' ? 'selected' : '' }}>After Content</option>
                <option value="no_image" {{ old('image_position', $post->image_position ?? 'before_content') == 'no_image' ? 'selected' : '' }}>No Image</option>
            </select>
            @error('image_position')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

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

<!-- Quill WYSIWYG Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#content-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['clean'],
                ['link']
            ]
        }
    });

    // Update hidden input before form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        document.getElementById('content-hidden').value = quill.root.innerHTML;
    });

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

