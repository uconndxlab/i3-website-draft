<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\ImageProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected ImageProcessingService $imageProcessingService;

    public function __construct(ImageProcessingService $imageProcessingService)
    {
        $this->imageProcessingService = $imageProcessingService;
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'content' => 'required|string',
            'featured_image' => 'nullable|image',
        ]);

        $data['url_friendly'] = Str::slug($data['title']);

        //Better error handling when we already have a post with the same slug
        if (Post::where('url_friendly', $data['url_friendly'])->exists()) {
            return back()
                ->withInput()
                ->withErrors(['title' => 'A post with this title already exists. Please use a different title.']);
        }

        if ($request->hasFile('featured_image')) {
            $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('featured_image'), 'post_images');
            $data['featured_image'] = $imagePaths['original'];
            $data['featured_image_medium'] = $imagePaths['medium'];
            $data['featured_image_webp'] = $imagePaths['webp'];
        }

        // Set default to draft (not published)
        $data['published'] = false;

        $post = Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post saved as draft.');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'content' => 'required|string',
            'featured_image' => 'nullable|image',
        ]);

        $data['url_friendly'] = Str::slug($data['title']);

        //Better error handling when we already have a post with the same slug
        if (Post::where('url_friendly', $data['url_friendly'])
            ->where('id', '!=', $post->id)
            ->exists()) {
            return back()
                ->withInput()
                ->withErrors(['title' => 'A post with this title already exists. Please use a different title.']);
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

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
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
        $post->update(['published' => true]);
        return back()->with('success', 'Post published successfully.');
    }

    public function unpublish(Post $post)
    {
        $post->update(['published' => false]);
        return back()->with('success', 'Post unpublished.');
    }

    public function preview(Post $post)
    {
        return view('pages.blogs', ['posts' => collect([$post])]);
    }
}

