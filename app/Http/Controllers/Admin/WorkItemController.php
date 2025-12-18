<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkItem;
use App\Services\ImageProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;

class WorkItemController extends Controller
{
    protected ImageProcessingService $imageProcessingService;

    public function __construct(ImageProcessingService $imageProcessingService)
    {
        $this->imageProcessingService = $imageProcessingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WorkItem::latest();
        
        if ($request->has('tag') && $request->tag) {
            $tagModel = Tag::where('slug', $request->tag)->first();
            if ($tagModel) {
                $query->whereHas('tags', function ($q) use ($tagModel) {
                    $q->where('tags.id', $tagModel->id);
                });
            }
        }
        
        $items = $query->paginate(100);
        $tags = Tag::all();
        return view('admin.work.index', compact('items', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $tags = Tag::all();
        
        return view('admin.work.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'thumbnail' => 'nullable|image',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('thumbnail')) {
            $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('thumbnail'));
            $data['thumbnail'] = $imagePaths['original'];
            $data['thumbnail_medium'] = $imagePaths['medium'];
            $data['thumbnail_webp'] = $imagePaths['webp'];
        }

        if ($request->has('link')) {
            $data['link'] = $request->input('link');
        } else {
            $data['link'] = null; // Ensure link is set to null if not provided
        }

        $workItem = WorkItem::create($data);

        // Sync tags if provided
        if ($request->has('tags')) {
            $workItem->tags()->sync($request->input('tags'));
        }

        return redirect()->route('admin.work.index')->with('success', 'Work item created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkItem $work)
    {

        // Fetch all tags for the form
        $tags = Tag::all();

        return view('admin.work.edit', compact('work', 'tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $workItem)
    {
        $workItem = WorkItem::findOrFail($workItem);
        $data = $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'thumbnail' => 'nullable|image',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old images if they exist
            $oldImages = [
                $workItem->thumbnail,
                $workItem->thumbnail_medium,
                $workItem->thumbnail_webp
            ];
            $this->imageProcessingService->deleteWorkItemThumbnails($oldImages);

            // Process new thumbnail
            $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('thumbnail'));
            $data['thumbnail'] = $imagePaths['original'];
            $data['thumbnail_medium'] = $imagePaths['medium'];
            $data['thumbnail_webp'] = $imagePaths['webp'];
        } else {
            unset($data['thumbnail']);
        }

        $data['link'] = $request->input('link');

        $data['slug'] = Str::slug($data['title']);

        if ($request->has('tags')) {
            $workItem->tags()->sync($request->input('tags'));
        }

        $workItem->update($data);

        return redirect()->route('admin.work.index')->with('success', 'Work item updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkItem $work)
    {   
        // Delete all associated thumbnails
        $thumbnails = [
            $work->thumbnail,
            $work->thumbnail_medium,
            $work->thumbnail_webp
        ];
        $this->imageProcessingService->deleteWorkItemThumbnails($thumbnails);

        $work->delete();
        return redirect()->route('admin.work.index')->with('success', 'Work item deleted.');
    }
}
