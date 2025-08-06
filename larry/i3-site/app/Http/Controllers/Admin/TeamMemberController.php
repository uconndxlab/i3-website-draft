<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Services\ImageProcessingService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    protected ImageProcessingService $imageProcessingService;

    public function __construct(ImageProcessingService $imageProcessingService)
    {
        $this->imageProcessingService = $imageProcessingService;
    }
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
            $imagePaths = $this->imageProcessingService->processTeamMemberPhoto($request->file('photo'));
            $data['photo'] = $imagePaths['original'];
            $data['photo_medium'] = $imagePaths['medium'];
            $data['photo_webp'] = $imagePaths['webp'];
        }

        // Handle LinkedIn URL if provided
        if ($request->has('linkedin')) {
            $data['linkedin'] = $request->input('linkedin');
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
            // Delete old images if they exist
            $oldImages = [
                $team->photo,
                $team->photo_medium,
                $team->photo_webp
            ];
            $this->imageProcessingService->deleteTeamMemberImages($oldImages);

            // Process new image
            $imagePaths = $this->imageProcessingService->processTeamMemberPhoto($request->file('photo'));
            $data['photo'] = $imagePaths['original'];
            $data['photo_medium'] = $imagePaths['medium'];
            $data['photo_webp'] = $imagePaths['webp'];
        }

        $data['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        // Update LinkedIn URL if provided
        if ($request->has('linkedin')) {
            $data['linkedin'] = $request->input('linkedin');
        }

        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team)
    {
        // Delete all associated images
        $images = [
            $team->photo,
            $team->photo_medium,
            $team->photo_webp
        ];
        $this->imageProcessingService->deleteTeamMemberImages($images);

        $team->delete();
        return back()->with('success', 'Team member deleted.');
    }
}
