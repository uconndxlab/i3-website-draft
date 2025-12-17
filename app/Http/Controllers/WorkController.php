<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkItem;
use App\Models\Tag;
use App\Models\Tool;
class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $tag = null)
    {
        $allTags = Tag::all();
      

        if ($tag && $tag !== 'for-all') {
            $tagModel = Tag::where('slug', $tag)->first();
            $items = WorkItem::whereHas('tags', function ($query) use ($tagModel) {
                $query->where('tags.slug', $tagModel->slug ?? '');
            })->with('tags')->latest()->paginate(18);
        } else {
            $items = WorkItem::with('tags')->latest()->paginate(18);
        }

        return view('pages.work', compact('items', 'allTags', 'tag'));
    }

    public function tools()
    {
        $tools = Tool::where('is_active', true)
            ->get();
        
        return view('pages.tools', compact('tools'));
    }

    /*public function grantFunded()
    {
        // TODO :: DECIDE HOW We want to get display images.
        $tools = WorkItem::whereNotNull('thumbnail')
            ->with('tags')
            ->latest()
            ->take(6)
            ->get();
        return view('pages.grant-funded', compact('tools'));
    }*/

    public function services()
    {
        return view('pages.services');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.work.show', compact('workItem'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workItem = WorkItem::findOrFail($id);
        $workItem->delete();
        return redirect()->route('work.index')->with('success', 'Work item deleted successfully.');
    }
}
