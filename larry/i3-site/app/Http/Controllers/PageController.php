<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkItem;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function home()
    {
        $featuredWork = WorkItem::latest()->take(6)->get();
        $teamMembers = TeamMember::all();
        return view('pages.home', compact('featuredWork', 'teamMembers'));
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
