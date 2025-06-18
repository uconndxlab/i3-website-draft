<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.work.create');

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
        return view('admin.work.edit', compact('work'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkItem $workItem)
    {
        $data = $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'thumbnail' => 'nullable|image',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('work_thumbnails', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $workItem->update($data);

        return redirect()->route('admin.work.index')->with('success', 'Work item updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkItem $workItem)
    {
        $workItem->delete();
        return redirect()->route('admin.work.index')->with('success', 'Work item deleted.');
    }
}
