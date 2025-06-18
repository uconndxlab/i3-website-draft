<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkItem;

class PageController extends Controller
{
    public function home()   { 
        $featuredWork = WorkItem::latest()->take(6)->get();
        return view('pages.home', compact('featuredWork'));
    }
    public function about()  { return view('pages.about'); }
    public function team()   { return view('pages.team'); }
    public function contact(){ return view('pages.contact'); }
}
