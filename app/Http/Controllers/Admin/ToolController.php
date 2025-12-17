<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Services\ImageProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ToolController extends Controller
{
    protected ImageProcessingService $imageProcessingService;

    public function __construct(ImageProcessingService $imageProcessingService)
    {
        $this->imageProcessingService = $imageProcessingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //If you ever get over a 100 do me a favor and just delete some
        // Or just dont care about the old ones
        $tools = Tool::latest()->paginate(100);
        return view('admin.tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'description' => 'nullable|string|max:1000',
            'link' => 'nullable|url|max:255',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ], [
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, gif, or webp.',
            'image.max' => 'The image may not be greater than 10MB.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'link.url' => 'The link must be a valid URL.',
            'link.max' => 'The link may not be greater than 255 characters.',
            'alt_text.max' => 'The alt text may not be greater than 255 characters.',
        ]);

        if ($request->hasFile('image')) {
            try {
                $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('image'), 'tool_images');
                $data['image'] = $imagePaths['original'];
                $data['image_medium'] = $imagePaths['medium'];
                $data['image_webp'] = $imagePaths['webp'];
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to process image: ' . $e->getMessage()]);
            }
        }

        $data['is_active'] = $request->has('is_active') ? true : false;

        try {
            Tool::create($data);
            return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
        } catch (\Exception $e) {
            // Clean up uploaded images if database save fails
            if (isset($data['image'])) {
                $imagePaths = [
                    $data['image'],
                    $data['image_medium'] ?? null,
                    $data['image_webp'] ?? null
                ];
                $this->imageProcessingService->deleteWorkItemThumbnails($imagePaths);
            }
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create tool: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        return view('admin.tools.edit', compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'description' => 'nullable|string|max:1000',
            'link' => 'nullable|url|max:255',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ], [
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, gif, or webp.',
            'image.max' => 'The image may not be greater than 10MB.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'link.url' => 'The link must be a valid URL.',
            'link.max' => 'The link may not be greater than 255 characters.',
            'alt_text.max' => 'The alt text may not be greater than 255 characters.',
        ]);

        $oldImages = [
            $tool->image,
            $tool->image_medium,
            $tool->image_webp
        ];
        $newImagePaths = null;

        if ($request->hasFile('image')) {
            try {
                $imagePaths = $this->imageProcessingService->processWorkItemThumbnail($request->file('image'), 'tool_images');
                $data['image'] = $imagePaths['original'];
                $data['image_medium'] = $imagePaths['medium'];
                $data['image_webp'] = $imagePaths['webp'];
                $newImagePaths = $imagePaths;
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to process image: ' . $e->getMessage()]);
            }
        } else {
            unset($data['image']);
        }

        $data['is_active'] = $request->has('is_active') ? true : false;

        try {
            $tool->update($data);
            
            // Only delete old images after successful update
            if ($newImagePaths) {
                $this->imageProcessingService->deleteWorkItemThumbnails($oldImages);
            }
            
            return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
        } catch (\Exception $e) {
            // Clean up new images if database update fails
            if ($newImagePaths) {
                $this->imageProcessingService->deleteWorkItemThumbnails([
                    $newImagePaths['original'],
                    $newImagePaths['medium'],
                    $newImagePaths['webp']
                ]);
            }
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update tool: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        // Delete all associated images
        $imagePaths = [
            $tool->image,
            $tool->image_medium,
            $tool->image_webp
        ];
        $this->imageProcessingService->deleteWorkItemThumbnails($imagePaths);

        $tool->delete();

        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully.');
    }
}