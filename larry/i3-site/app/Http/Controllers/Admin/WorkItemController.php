<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;

class WorkItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = WorkItem::latest()->paginate(10);
        return view('admin.work.index', compact('items'));
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
            $data['thumbnail'] = $request->file('thumbnail')->store('work_thumbnails', 'public');
        }

        if ($request->has('link')) {
            $data['link'] = $request->input('link');
        } else {
            $data['link'] = null; // Ensure link is set to null if not provided
        }

        WorkItem::create($data);

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
            $data['thumbnail'] = $request->file('thumbnail')->store('work_thumbnails', 'public');
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
        
        $work->delete();
        return redirect()->route('admin.work.index')->with('success', 'Work item deleted.');
    }
}
