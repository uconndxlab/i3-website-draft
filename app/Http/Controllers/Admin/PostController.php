<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Enums\PostTag;
use App\Services\ImageProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    protected ImageProcessingService $imageProcessingService;

    public function __construct(ImageProcessingService $imageProcessingService)
    {
        $this->imageProcessingService = $imageProcessingService;
    }

    public function index()
    {
        $posts = Post::orderByRaw('CASE WHEN published_at IS NULL THEN 1 ELSE 0 END')
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create', [
            'backgroundTemplates' => $this->backgroundTemplates(),
            'editorTemplates' => $this->editorTemplates(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subheader' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:10240',
            'url_friendly' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|in:' . implode(',', PostTag::all()),
            'blade_file' => ['nullable', 'string', Rule::in(array_keys($this->backgroundTemplates()))],
            'body_markdown' => 'nullable|string',
        ], [
            'featured_image.image' => 'The featured image must be a valid image file.',
            'featured_image.max' => 'The featured image must not be larger than 10MB.',
            'blade_file.in' => 'Please choose a valid background template.',
        ]);

        $data['url_friendly'] = $data['url_friendly']
            ? Str::slug($data['url_friendly'])
            : Str::slug($data['title']);

        if (Post::where('url_friendly', $data['url_friendly'])->exists()) {
            return back()
                ->withInput()
                ->withErrors(['url_friendly' => 'This permalink is already in use. Please use a different slug.']);
        }

        if ($request->hasFile('featured_image')) {
            try {
                $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('featured_image'), 'post_images');
                $data['featured_image'] = $imagePaths['original'];
                $data['featured_image_medium'] = $imagePaths['medium'];
                $data['featured_image_webp'] = $imagePaths['webp'];
            } catch (\Exception $e) {
                Log::error('Featured image processing failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return back()
                    ->withInput()
                    ->withErrors(['featured_image' => 'Failed to process image. Please ensure the file is a valid image format (JPEG, PNG, GIF, WebP) and try again.']);
            }
        }

        $shouldPublish = $request->input('publish_action') === 'publish';
        
        if ($shouldPublish && !$request->filled('published_at')) {
            return back()
                ->withInput()
                ->withErrors(['published_at' => 'Please select a published date to publish this post.']);
        }

        $hasBody = !empty(trim((string) ($data['body_markdown'] ?? '')));
        if ($shouldPublish && !$hasBody) {
            return back()
                ->withInput()
                ->withErrors(['body_markdown' => 'Add post content in the visual editor before publishing.']);
        }

        $data['published'] = $shouldPublish;

        // Allow blank publish date to keep as draft
        if (!$request->filled('published_at')) {
            $data['published_at'] = null;
            if (!$shouldPublish) {
                $data['published'] = false;
            }
        }
        
        // Handle tags - checkboxes return array, convert to empty array if not set
        if (!isset($data['tags']) || !is_array($data['tags'])) {
            $data['tags'] = [];
        }

        $post = Post::create($data);

        $message = $shouldPublish 
            ? 'Post created and published successfully.' 
            : 'Post saved as draft.';

        return redirect()->route('admin.posts.index')->with('success', $message);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'backgroundTemplates' => $this->backgroundTemplates(),
            'editorTemplates' => $this->editorTemplates(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subheader' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:10240',
            'url_friendly' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|in:' . implode(',', PostTag::all()),
            'blade_file' => ['nullable', 'string', Rule::in(array_keys($this->backgroundTemplates()))],
            'body_markdown' => 'nullable|string',
        ], [
            'featured_image.image' => 'The featured image must be a valid image file.',
            'featured_image.max' => 'The featured image must not be larger than 10MB.',
            'blade_file.in' => 'Please choose a valid background template.',
        ]);

        $data['url_friendly'] = $data['url_friendly']
            ? Str::slug($data['url_friendly'])
            : Str::slug($data['title']);

        if (Post::where('url_friendly', $data['url_friendly'])
            ->where('id', '!=', $post->id)
            ->exists()) {
            return back()
                ->withInput()
                ->withErrors(['url_friendly' => 'This permalink is already in use. Please use a different slug.']);
        }

        if ($request->hasFile('featured_image')) {
            try {
                $oldImages = [
                    $post->featured_image,
                    $post->featured_image_medium,
                    $post->featured_image_webp
                ];
                $this->imageProcessingService->deleteWorkItemThumbnails($oldImages);

                $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('featured_image'), 'post_images');
                $data['featured_image'] = $imagePaths['original'];
                $data['featured_image_medium'] = $imagePaths['medium'];
                $data['featured_image_webp'] = $imagePaths['webp'];
            } catch (\Exception $e) {
                Log::error('Featured image processing failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return back()
                    ->withInput()
                    ->withErrors(['featured_image' => 'Failed to process image. Please ensure the file is a valid image format (JPEG, PNG, GIF, WebP) and try again.']);
            }
        } else {
            unset($data['featured_image']);
        }

        // Handle tags - checkboxes return array, convert to empty array if not set
        if (!isset($data['tags']) || !is_array($data['tags'])) {
            $data['tags'] = [];
        }

        $shouldPublish = $request->input('publish_action') === 'publish';

        if ($shouldPublish && !$request->filled('published_at')) {
            return back()
                ->withInput()
                ->withErrors(['published_at' => 'Please select a published date to publish this post.']);
        }

        $hasBody = !empty(trim((string) ($data['body_markdown'] ?? '')));
        if ($shouldPublish && !$hasBody) {
            return back()
                ->withInput()
                ->withErrors(['body_markdown' => 'Add post content in the visual editor before publishing.']);
        }

        if (!$request->filled('published_at')) {
            $data['published_at'] = null;
            $data['published'] = false;
        } else {
            $wasPublished = $post->published;
            if ($shouldPublish || $wasPublished) {
                $data['published'] = true;
            }
        }

        $post->update($data);

        if ($shouldPublish) {
            $message = 'Post saved and published successfully.';
        } elseif (($post->published && $request->filled('published_at')) || ($post->published && isset($data['published']) && $data['published'])) {
            $message = 'Post updated and republished successfully.';
        } else {
            $message = 'Post updated successfully.';
        }

        return redirect()->route('admin.posts.index')->with('success', $message);
    }

    public function destroy(Post $post)
    {
        $images = [
            $post->featured_image,
            $post->featured_image_medium,
            $post->featured_image_webp
        ];
        $this->imageProcessingService->deleteWorkItemThumbnails($images);

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }

    public function publish(Post $post)
    {
        if (!$post->published_at) {
            return back()->with('error', 'Cannot publish post without a published date. Please edit the post and set a published date first.');
        }

        if (empty(trim((string) ($post->body_markdown ?? '')))) {
            return back()->with('error', 'Cannot publish post without editor content. Add post body content first.');
        }
        
        $post->update(['published' => true]);
        return back()->with('success', 'Post published successfully.');
    }

    public function unpublish(Post $post)
    {
        $post->update(['published' => false]);
        return back()->with('success', 'Post unpublished successfully.');
    }

    public function preview(Post $post)
    {
        $view = !empty(trim((string) ($post->body_markdown ?? '')))
            ? 'pages.blogs.backgrounds.blogs'
            : 'pages.blogs.template-missing';

        return view($view, [
            'post' => $post,
            'prevPost' => null,
            'nextPost' => null,
        ]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10000',
        ]);

        $image = $request->file('image');
        $path = $image->store('post_images', 'public');
        $url = asset('storage/' . $path);

        return response()->json([
            'success' => true,
            'url' => $url
        ]);
    }

    protected function backgroundTemplates(): array
    {
        return [
            'ocean-blue' => [
                'label' => 'Ocean Blue',
                'preview' => 'linear-gradient(180deg, #071826 0%, #0f2e4b 60%, #111 100%)',
            ],
            'teal' => [
                'label' => 'Teal',
                'preview' => 'linear-gradient(180deg, #072e28 0%, #0d3941 60%, #111 100%)',
            ],
            'purple' => [
                'label' => 'Purple',
                'preview' => 'linear-gradient(180deg, #1a0828 0%, #280E3A 60%, #111 100%)',
            ],
        ];
    }

    protected function editorTemplates(): array
    {
        return [
            'announcement' => [
                'label' => 'Announcement',
                'html' => '<h2>What is changing</h2><p>Share the key update in 2-3 sentences.</p><h2>Why it matters</h2><p>Explain impact for your audience.</p><h2>What to do next</h2><ul><li>Step one</li><li>Step two</li></ul>',
            ],
            'event-recap' => [
                'label' => 'Event Recap',
                'html' => '<h2>Event overview</h2><p>Summarize the event, date, and location.</p><h2>Highlights</h2><ul><li>Highlight one</li><li>Highlight two</li><li>Highlight three</li></ul><h2>Photos and links</h2><p>Add links, resources, or follow-up details.</p>',
            ],
            'feature-story' => [
                'label' => 'Feature Story',
                'html' => '<h2>Context</h2><p>Introduce the problem, project, or person.</p><h2>Process</h2><p>Describe how the work happened and who contributed.</p><h2>Outcomes</h2><p>Summarize results and next steps.</p>',
            ],
        ];
    }

}

