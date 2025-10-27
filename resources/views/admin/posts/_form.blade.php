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
</script>

