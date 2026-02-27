@csrf

<input type="hidden" name="publish_action" id="publish_action" value="">
@php
    $backgroundTemplates = $backgroundTemplates ?? [];
    $editorTemplates = $editorTemplates ?? [];
    $selectedBackground = old('blade_file', $post->blade_file ?? '');
    $selectedEditorTemplate = old('editor_template', '');
    $isEdit = isset($post) && $post->exists;
    $isPublished = $isEdit && $post->published;
@endphp

<div class="row g-4">
   
    <!-- LEFT SIDEBAR — Title + Subheader + Editor -->
    
    <div class="col-12 col-xl-8">
        <div class="mb-3">
            <input name="title" class="form-control form-control-lg fw-semibold" value="{{ old('title', $post->title ?? '') }}" required placeholder="Post title">
            @error('title')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <input name="subheader" class="form-control text-muted" value="{{ old('subheader', $post->subheader ?? '') }}" placeholder="Optional subtitle or brief description">
            @error('subheader')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Editor Template selector + Quill Toolbar in one row --}}
        <div class="editor-toolbar-row d-flex align-items-center gap-2 border rounded-top bg-light px-2 py-1 flex-wrap">
            <div id="editor-toolbar" class="d-flex flex-wrap align-items-center flex-grow-1">
                <span class="ql-formats">
                    <select class="ql-header">
                        <option selected></option>
                        <option value="1"></option>
                        <option value="2"></option>
                        <option value="3"></option>
                    </select>
                    <select class="ql-align"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-blockquote"></button>
                    <button class="ql-code-block"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-list" value="ordered"></button>
                    <button class="ql-list" value="bullet"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-link"></button>
                    <button class="ql-image"></button>
                    <button class="ql-insertTable" type="button" title="Insert table">
                        <i class="bi bi-table"></i>
                    </button>
                </span>
                <span class="ql-formats">
                    <button class="ql-imageAlignLeft" type="button" title="Image align left">
                        <i class="bi bi-layout-text-sidebar"></i>
                    </button>
                    <button class="ql-imageAlignCenter" type="button" title="Image center">
                        <i class="bi bi-text-center"></i>
                    </button>
                    <button class="ql-imageAlignRight" type="button" title="Image align right">
                        <i class="bi bi-layout-text-sidebar-reverse"></i>
                    </button>
                    <button class="ql-imageAlignFull" type="button" title="Image full width">
                        <i class="bi bi-arrows-fullscreen"></i>
                    </button>
                </span>
                <span class="ql-formats">
                    <button class="ql-clean"></button>
                </span>
            </div>

            <div class="editor-template-inline d-flex align-items-center gap-1 border-start ps-2">
                <select id="editor_template" name="editor_template" class="form-select form-select-sm" style="width: auto; min-width: 130px;">
                    <option value="">Template...</option>
                    @foreach($editorTemplates as $templateKey => $template)
                        <option value="{{ $templateKey }}" {{ $selectedEditorTemplate === $templateKey ? 'selected' : '' }}>
                            {{ $template['label'] }}
                        </option>
                    @endforeach
                </select>
                <button type="button" id="apply_editor_template" class="btn btn-outline-secondary btn-sm" title="Apply template to editor">
                    <i class="bi bi-arrow-down-circle"></i>
                </button>
            </div>
        </div>

        <input type="hidden" name="body_markdown" id="body_markdown" value="{{ old('body_markdown', $post->body_markdown ?? '') }}">
        <div id="editor-container" class="bg-white text-dark rounded-bottom border border-top-0"></div>
        <div class="d-flex justify-content-between align-items-center mt-1">
            <div id="autosave-status" class="small text-muted"></div>
            @error('body_markdown')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- RIGHT SIDEBAR — Sticky cards for actions + metadata -->
    
    <div class="col-12 col-xl-4">
        <div class="sidebar-sticky">

            <!-- Publish Card -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <span class="fw-semibold small text-uppercase">Publish</span>
                    @if($isEdit)
                        @if($isPublished)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    @else
                        <span class="badge bg-secondary">New</span>
                    @endif
                </div>
                <div class="card-body py-3">
                    <div class="mb-3">
                        <label class="form-label small mb-1">Published Date</label>
                        <input type="date" name="published_at" class="form-control form-control-sm"
                               value="{{ old('published_at', $isEdit && $post->published_at ? $post->published_at->format('Y-m-d') : '') }}">
                        @error('published_at')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-column gap-2">
                        @if(!$isEdit || !$isPublished)
                            <button type="submit"
                                    class="btn btn-success btn-sm w-100"
                                    onclick="document.getElementById('publish_action').value='publish';">
                                <i class="bi bi-check-circle me-1"></i>Save & Publish
                            </button>
                        @endif
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-save me-1"></i>{{ $isPublished ? 'Update' : 'Save Draft' }}
                        </button>
                        @if($isEdit)
                            <a href="{{ route('admin.posts.preview', $post) }}"
                               class="btn btn-outline-secondary btn-sm w-100"
                               target="_blank">
                                <i class="bi bi-eye me-1"></i>Preview
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Featured Image Card -->
            <div class="card mb-3">
                <div class="card-header py-2">
                    <span class="fw-semibold small text-uppercase">Featured Image</span>
                </div>
                <div class="card-body py-3">
                    @if ($isEdit && !empty($post->featured_image))
                        <div class="mb-2">
                            <img src="{{ $post->best_featured_image_url }}" class="img-fluid rounded" alt="Featured image">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control form-control-sm" accept="image/*">
                    @error('featured_image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Details Card -->
            <div class="card mb-3">
                <div class="card-header py-2">
                    <span class="fw-semibold small text-uppercase">Details</span>
                </div>
                <div class="card-body py-3">
                    <div class="mb-3">
                        <label class="form-label small mb-1">Author</label>
                        <input name="author" class="form-control form-control-sm" value="{{ old('author', $post->author ?? '') }}" placeholder="Author name">
                        @error('author')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small mb-1">Tags</label>
                        <div class="d-flex gap-2 flex-wrap">
                            @foreach(\App\Enums\PostTag::all() as $tag)
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="checkbox" name="tags[]"
                                           value="{{ $tag }}"
                                           id="tag-{{ strtolower($tag) }}"
                                           @if(old('tags', isset($post) && is_array($post->tags) ? $post->tags : []))
                                               {{ in_array($tag, old('tags', is_array($post->tags ?? null) ? $post->tags : [])) ? 'checked' : '' }}
                                           @endif>
                                    <label class="form-check-label small" for="tag-{{ strtolower($tag) }}">{{ $tag }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('tags')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label small mb-1">Permalink</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text text-muted" style="font-size: 0.75rem;">/blog/</span>
                            <input name="url_friendly" id="url_friendly" class="form-control" value="{{ old('url_friendly', $post->url_friendly ?? '') }}" placeholder="auto-generated">
                        </div>
                        @error('url_friendly')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        @if($isEdit && $isPublished)
                            <a href="{{ route('blog.show', ['slug' => $post->url_friendly]) }}" target="_blank" class="small">
                                <i class="bi bi-box-arrow-up-right me-1"></i>View live
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Appearance Card -->
            <div class="card mb-3">
                <div class="card-header py-2">
                    <span class="fw-semibold small text-uppercase">Appearance</span>
                </div>
                <div class="card-body py-3">
                    <label class="form-label small mb-2">Background</label>
                    <div class="d-flex gap-2 flex-wrap">
                        @foreach($backgroundTemplates as $key => $bg)
                            @php $isActive = $selectedBackground === $key || ($loop->first && empty($selectedBackground)); @endphp
                            <label class="bg-template-option {{ $isActive ? 'active' : '' }}">
                                <input type="radio" name="blade_file" value="{{ $key }}" class="d-none"
                                       {{ $isActive ? 'checked' : '' }}>
                                <div class="bg-template-preview rounded {{ $isActive ? 'ring-active' : '' }}"
                                     style="background: {{ $bg['preview'] }};">
                                </div>
                                <div class="text-center mt-1 {{ $isActive ? 'fw-semibold' : '' }}" style="font-size: 0.7rem;">{{ $bg['label'] }}</div>
                            </label>
                        @endforeach
                    </div>
                    @error('blade_file')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill-better-table@1.2.10/dist/quill-better-table.css" rel="stylesheet">
<style>
    .sidebar-sticky {
        position: sticky;
        top: 1rem;
    }

    .sidebar-sticky .card {
        border-color: #dee2e6;
    }

    .sidebar-sticky .card-header {
        background: #f8f9fa;
        border-bottom-color: #dee2e6;
    }

    .editor-toolbar-row {
        min-height: 42px;
    }

    .editor-toolbar-row #editor-toolbar {
        border: none !important;
        padding: 0;
        margin: 0;
    }

    .editor-toolbar-row .ql-toolbar {
        border: none !important;
        padding: 0 !important;
    }

    #editor-toolbar .ql-formats {
        margin-right: 8px;
    }

    #editor-toolbar button i {
        pointer-events: none;
    }

    #editor-container {
        min-height: 520px;
    }

    #editor-container .ql-editor img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        display: block;
        margin: 1rem auto;
    }

    #editor-container .ql-editor .editor-image-left {
        float: left;
        max-width: 50%;
        margin: 0.5rem 1.25rem 0.75rem 0;
    }

    #editor-container .ql-editor .editor-image-right {
        float: right;
        max-width: 50%;
        margin: 0.5rem 0 0.75rem 1.25rem;
    }

    #editor-container .ql-editor .editor-image-center {
        float: none;
        display: block;
        margin: 1rem auto;
        max-width: 80%;
    }

    #editor-container .ql-editor .editor-image-full {
        width: 100%;
        max-width: 100%;
        margin: 1rem 0;
        float: none;
        display: block;
    }

    #editor-container .ql-editor table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }

    #editor-container .ql-editor table td,
    #editor-container .ql-editor table th {
        border: 1px solid #d1d5db;
        padding: 0.5rem;
    }

    #editor-container .ql-editor::after {
        clear: both;
        content: '';
        display: block;
    }

    .bg-template-option {
        cursor: pointer;
        transition: transform 0.15s ease;
        text-align: center;
    }

    .bg-template-option:hover {
        transform: translateY(-2px);
    }

    .bg-template-preview {
        width: 72px;
        height: 48px;
        border: 2px solid transparent;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .bg-template-preview.ring-active {
        border-color: #0d6efd;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
    }

    .editor-template-inline select {
        font-size: 0.8rem;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-better-table@1.2.10/dist/quill-better-table.min.js"></script>
<script>
    const editorTemplates = @json($editorTemplates);
    const bodyInput = document.getElementById('body_markdown');
    const editorContainer = document.getElementById('editor-container');
    const autosaveStatus = document.getElementById('autosave-status');

    if (bodyInput && editorContainer) {
        const modules = {
            toolbar: '#editor-toolbar',
            history: {
                delay: 1000,
                maxStack: 200,
                userOnly: true,
            },
        };

        if (window.ImageResize) {
            Quill.register('modules/imageResize', window.ImageResize.default || window.ImageResize);
            modules.imageResize = {};
        }

        if (window.QuillBetterTable) {
            Quill.register({
                'modules/better-table': window.QuillBetterTable
            }, true);
            modules['better-table'] = {
                operationMenu: {
                    items: {
                        unmergeCells: {
                            text: 'Unmerge cells'
                        }
                    }
                }
            };
            modules.keyboard = {
                bindings: window.QuillBetterTable.keyboardBindings
            };
        }

        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your post here...',
            modules
        });

        const form = bodyInput.closest('form');
        const storageKey = `blog-draft:${window.location.pathname}`;
        let userHasTyped = false;

        const setStatus = (text) => {
            if (autosaveStatus) {
                autosaveStatus.textContent = text;
            }
        };

        const syncBodyInput = () => {
            const isEmpty = quill.getText().trim().length === 0;
            bodyInput.value = isEmpty ? '' : quill.root.innerHTML;
        };

        const hydrateEditor = (value) => {
            if (!value) {
                return;
            }
            if (/<[a-z][\s\S]*>/i.test(value)) {
                quill.root.innerHTML = value;
            } else if (value.trim().length > 0) {
                quill.setText(value);
            }
            syncBodyInput();
        };

        const initialValue = bodyInput.value || '';
        hydrateEditor(initialValue);

        const existingDraftRaw = localStorage.getItem(storageKey);
        if (existingDraftRaw && !initialValue) {
            try {
                const draft = JSON.parse(existingDraftRaw);
                if (draft?.body) {
                    hydrateEditor(draft.body);
                    const title = document.querySelector('input[name="title"]');
                    const subheader = document.querySelector('input[name="subheader"]');
                    const author = document.querySelector('input[name="author"]');
                    const slug = document.getElementById('url_friendly');
                    if (title && draft.title) title.value = draft.title;
                    if (subheader && draft.subheader) subheader.value = draft.subheader;
                    if (author && draft.author) author.value = draft.author;
                    if (slug && draft.slug) slug.value = draft.slug;
                    setStatus(`Draft restored (${new Date(draft.savedAt).toLocaleTimeString()}).`);
                }
            } catch (error) {
                console.error('Failed to restore draft', error);
            }
        }

        quill.on('text-change', () => {
            userHasTyped = true;
            syncBodyInput();
        });

        if (form) {
            form.addEventListener('submit', () => {
                syncBodyInput();
                localStorage.removeItem(storageKey);
                setStatus('');
            });
        }

        const autosave = () => {
            if (!userHasTyped) {
                return;
            }

            const title = document.querySelector('input[name="title"]')?.value ?? '';
            const subheader = document.querySelector('input[name="subheader"]')?.value ?? '';
            const author = document.querySelector('input[name="author"]')?.value ?? '';
            const slug = document.getElementById('url_friendly')?.value ?? '';
            const body = quill.getText().trim().length ? quill.root.innerHTML : '';

            if (!title && !subheader && !author && !slug && !body) {
                localStorage.removeItem(storageKey);
                setStatus('Autosave cleared.');
                return;
            }

            const payload = {
                title,
                subheader,
                author,
                slug,
                body,
                savedAt: new Date().toISOString(),
            };
            localStorage.setItem(storageKey, JSON.stringify(payload));
            setStatus(`Draft autosaved at ${new Date(payload.savedAt).toLocaleTimeString()}.`);
        };

        setInterval(autosave, 5000);

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const uploadImage = async (file, insertIndex = null) => {
            if (!file.type.startsWith('image/')) {
                return;
            }

            if (file.size > (10 * 1024 * 1024)) {
                alert('Image too large. Max size is 10MB.');
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            const response = await fetch("{{ route('admin.posts.upload-image') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                },
                body: formData
            });

            if (!response.ok) {
                throw new Error('Image upload failed.');
            }

            const data = await response.json();
            if (!data?.url) {
                throw new Error('No image URL returned.');
            }

            const index = insertIndex ?? quill.getSelection(true)?.index ?? quill.getLength();
            quill.insertEmbed(index, 'image', data.url, 'user');
            quill.setSelection(index + 1, 0);
            syncBodyInput();
        };

        const toolbar = quill.getModule('toolbar');
        toolbar.addHandler('image', function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async () => {
                const file = input.files?.[0];
                if (!file) {
                    return;
                }

                try {
                    const range = quill.getSelection(true);
                    await uploadImage(file, range?.index ?? null);
                } catch (error) {
                    alert('Image upload failed. Please try again.');
                    console.error(error);
                }
            };
        });

        quill.root.addEventListener('dragover', (event) => {
            if (event.dataTransfer?.files?.length) {
                event.preventDefault();
            }
        });

        quill.root.addEventListener('drop', async (event) => {
            const file = event.dataTransfer?.files?.[0];
            if (!file || !file.type.startsWith('image/')) {
                return;
            }
            event.preventDefault();
            try {
                const range = quill.getSelection(true);
                await uploadImage(file, range?.index ?? null);
            } catch (error) {
                alert('Drop upload failed. Please try again.');
                console.error(error);
            }
        });

        quill.root.addEventListener('paste', async (event) => {
            const items = event.clipboardData?.items;
            if (!items || !items.length) {
                return;
            }

            const imageItem = Array.from(items).find((item) => item.type?.startsWith('image/'));
            if (!imageItem) {
                return;
            }

            event.preventDefault();
            const file = imageItem.getAsFile();
            if (!file) {
                return;
            }

            try {
                const range = quill.getSelection(true);
                await uploadImage(file, range?.index ?? null);
            } catch (error) {
                alert('Paste upload failed. Please try again.');
                console.error(error);
            }
        });

        const imageClassMap = ['editor-image-left', 'editor-image-center', 'editor-image-right', 'editor-image-full'];
        const getSelectedImage = () => {
            const range = quill.getSelection(true);
            if (!range) {
                return null;
            }

            const [blot] = quill.scroll.descendant(Quill.import('formats/image'), range.index);
            if (blot?.domNode) {
                return blot.domNode;
            }

            if (range.index > 0) {
                const [previousBlot] = quill.scroll.descendant(Quill.import('formats/image'), range.index - 1);
                return previousBlot?.domNode ?? null;
            }

            return null;
        };

        const applyImageAlignment = (alignmentClass) => {
            const image = getSelectedImage();
            if (!image) {
                setStatus('Select an image first, then choose alignment.');
                return;
            }

            image.classList.remove(...imageClassMap);
            image.classList.add(alignmentClass);
            syncBodyInput();
            setStatus('Image alignment updated.');
        };

        document.querySelector('.ql-imageAlignLeft')?.addEventListener('click', () => applyImageAlignment('editor-image-left'));
        document.querySelector('.ql-imageAlignCenter')?.addEventListener('click', () => applyImageAlignment('editor-image-center'));
        document.querySelector('.ql-imageAlignRight')?.addEventListener('click', () => applyImageAlignment('editor-image-right'));
        document.querySelector('.ql-imageAlignFull')?.addEventListener('click', () => applyImageAlignment('editor-image-full'));

        document.querySelector('.ql-insertTable')?.addEventListener('click', () => {
            if (window.QuillBetterTable) {
                const tableModule = quill.getModule('better-table');
                tableModule?.insertTable(3, 3);
                return;
            }

            const range = quill.getSelection(true);
            const tableHtml = `
                <table>
                    <tbody>
                        <tr><td>Cell</td><td>Cell</td><td>Cell</td></tr>
                        <tr><td>Cell</td><td>Cell</td><td>Cell</td></tr>
                        <tr><td>Cell</td><td>Cell</td><td>Cell</td></tr>
                    </tbody>
                </table>
                <p><br></p>
            `;
            quill.clipboard.dangerouslyPasteHTML(range?.index ?? quill.getLength(), tableHtml, 'user');
            syncBodyInput();
        });

        const editorTemplateSelect = document.getElementById('editor_template');
        const applyEditorTemplateButton = document.getElementById('apply_editor_template');
        const applyEditorTemplate = () => {
            const selectedKey = editorTemplateSelect?.value || '';
            if (!selectedKey) {
                return;
            }

            const selectedTemplate = editorTemplates?.[selectedKey];
            if (!selectedTemplate?.html) {
                return;
            }

            const hasExistingContent = quill.getText().trim().length > 0;
            if (hasExistingContent && !window.confirm('Replace current editor content with this template?')) {
                return;
            }

            quill.root.innerHTML = selectedTemplate.html;
            syncBodyInput();
            userHasTyped = true;
            setStatus(`Template "${selectedTemplate.label}" applied.`);
        };

        applyEditorTemplateButton?.addEventListener('click', applyEditorTemplate);
    }

    document.querySelectorAll('.bg-template-option input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('.bg-template-option').forEach(opt => {
                opt.classList.remove('active');
                opt.querySelector('.bg-template-preview')?.classList.remove('ring-active');
                opt.querySelector('div:last-child')?.classList.remove('fw-semibold');
            });
            const label = radio.closest('.bg-template-option');
            label.classList.add('active');
            label.querySelector('.bg-template-preview')?.classList.add('ring-active');
            label.querySelector('div:last-child')?.classList.add('fw-semibold');
        });
    });

    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.getElementById('url_friendly');
    const slugify = (text) => {
        return (text || '')
            .toString()
            .normalize('NFKD')
            .replace(/[\u0300-\u036f]/g, '')
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
