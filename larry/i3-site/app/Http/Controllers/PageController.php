<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkItem;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function home()
    {
        $featuredWork = WorkItem::latest()->take(12)->get();
        $teamMembers = TeamMember::inRandomOrder()->take(4)->get();
        $totalTeamMembers = TeamMember::count();
        return view('pages.home', compact('featuredWork', 'teamMembers', 'totalTeamMembers'));
    }
    public function about()
    {
        return view('pages.about');
    }
    public function team()
    {
        return view('pages.team');
    }
    public function contact()
    {
        return view('pages.contact');
    }
}
