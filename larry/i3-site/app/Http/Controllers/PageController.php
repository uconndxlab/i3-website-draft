<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkItem;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function home()
    {
        $featuredWork = WorkItem::latest()->take(8)->get();
        $teamMembers = TeamMember::inRandomOrder()->take(4)->get();
        $totalTeamMembers = TeamMember::count();
        return view('pages.home', compact('featuredWork', 'teamMembers', 'totalTeamMembers'));
    }
    public function story()
    {
        return view('pages.story');
    }
    public function team()
    {
        $people = TeamMember::all();
        return view('pages.people', compact('people'));
    }
    public function connect()
    {
        return view('pages.connect');
    }
}
