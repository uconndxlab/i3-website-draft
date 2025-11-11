<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\ImageProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

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
            'bladeTemplates' => $this->getBlogBladeTemplates(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subheader' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image',
            'url_friendly' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|in:People,News,Projects',
            'blade_file' => 'nullable|string',
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
            $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('featured_image'), 'post_images');
            $data['featured_image'] = $imagePaths['original'];
            $data['featured_image_medium'] = $imagePaths['medium'];
            $data['featured_image_webp'] = $imagePaths['webp'];
        }

        $shouldPublish = $request->input('publish_action') === 'publish';
        
        if ($shouldPublish && !$request->filled('published_at')) {
            return back()
                ->withInput()
                ->withErrors(['published_at' => 'Please select a published date to publish this post.']);
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

        if (empty($data['blade_file'])) {
            $data['blade_file'] = null;
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
            'bladeTemplates' => $this->getBlogBladeTemplates(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subheader' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image',
            'url_friendly' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|in:People,News,Projects',
            'blade_file' => 'nullable|string',
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
        } else {
            unset($data['featured_image']);
        }

        // Handle tags - checkboxes return array, convert to empty array if not set
        if (!isset($data['tags']) || !is_array($data['tags'])) {
            $data['tags'] = [];
        }

        if (empty($data['blade_file'])) {
            $data['blade_file'] = null;
        }

        $shouldPublish = $request->input('publish_action') === 'publish';

        if ($shouldPublish && !$request->filled('published_at')) {
            return back()
                ->withInput()
                ->withErrors(['published_at' => 'Please select a published date to publish this post.']);
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
        $view = $post->blade_file && View::exists($post->blade_file)
            ? $post->blade_file
            : 'pages.blogs.default';

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

    protected function getBlogBladeTemplates(): array
    {
        $directory = resource_path('views/pages/blogs');

        if (!is_dir($directory)) {
            return [];
        }

        return collect(File::files($directory))
            ->filter(fn ($file) => Str::endsWith($file->getFilename(), '.blade.php'))
            ->map(function ($file) {
                $filename = $file->getFilename();
                $viewName = 'pages.blogs.' . Str::of($filename)->replace('.blade.php', '');

                return [
                    'value' => $viewName,
                    'label' => Str::of($filename)
                        ->replace('.blade.php', '')
                        ->replace(['-', '_'], ' ')
                        ->title(),
                ];
            })
            ->sortBy('label')
            ->values()
            ->all();
    }
}

