<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthorizedNetid;
use Illuminate\Http\Request;

class AuthorizedNetidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorizedNetids = AuthorizedNetid::orderBy('netid')->paginate(20);
        return view('admin.authorized-netids.index', compact('authorizedNetids'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authorized-netids.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'netid' => 'required|string|max:255|unique:authorized_netids,netid',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'is_active' => 'boolean'
        ]);

        AuthorizedNetid::create($request->all());

        return redirect()->route('admin.authorized-netids.index')
            ->with('success', 'Authorized NetID created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AuthorizedNetid $authorizedNetid)
    {
        return view('admin.authorized-netids.show', compact('authorizedNetid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuthorizedNetid $authorizedNetid)
    {
        return view('admin.authorized-netids.edit', compact('authorizedNetid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuthorizedNetid $authorizedNetid)
    {
        $request->validate([
            'netid' => 'required|string|max:255|unique:authorized_netids,netid,' . $authorizedNetid->id,
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'is_active' => 'boolean'
        ]);

        $authorizedNetid->update($request->all());

        return redirect()->route('admin.authorized-netids.index')
            ->with('success', 'Authorized NetID updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuthorizedNetid $authorizedNetid)
    {
        $authorizedNetid->delete();
        return redirect()->route('admin.authorized-netids.index')
            ->with('success', 'Authorized NetID deleted successfully.');
    }
}
