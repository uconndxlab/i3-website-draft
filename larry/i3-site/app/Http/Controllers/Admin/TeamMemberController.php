<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::all();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'role' => 'nullable',
            'photo' => 'nullable|image',
            'tags' => 'nullable|string', // comma-separated string
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team_photos', 'public');
        }

        $data['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name' => 'required',
            'role' => 'nullable',
            'photo' => 'nullable|image',
            'tags' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team_photos', 'public');
        }

        $data['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return back()->with('success', 'Team member deleted.');
    }
}
