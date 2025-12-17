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
        $people = TeamMember::all()->sortBy(function ($person) {
            $nameParts = explode(' ', $person->name);
            return end($nameParts); // Sort by the last part of the name
        });
        $people = $people->sortBy(function ($person) {
            // if ($person->name === 'Joel Salisbury') {
            // return '0000'; // Ensures Joel comes first
            // }
            $nameParts = explode(' ', $person->name);
            return end($nameParts);
        });

        $senior_staff = $people->filter(function ($person) {
            return in_array('senior-staff', $person->tags);
        });

        $staff = $people->filter(function ($person) {
                return in_array('staff', $person->tags);
        });

        $student_staff = $people->filter(function ($person) {
            return in_array('student-staff', $person->tags);
        });

        $faculty_advisors = $people->filter(function ($person) {
            return in_array('faculty-advisor', $person->tags);
        });

        return view('pages.people', compact('people', 'senior_staff', 'staff', 'student_staff', 'faculty_advisors'));
    }
    public function connect()
    {
        return view('pages.connect');
    }
    public function contactSuccess()
    {
        return view('pages.contact-success');
    }

    public function alumni() {
        $alumni = TeamMember::where('tags', 'like', '%alumni%')
            ->get()
            ->sortBy(function ($person) {
                $parts = explode(' ', $person->name);
                return end($parts);
            });
        return view('pages.alumni', compact('alumni'));
    }

    public function merger() {
        return view('pages.merger');
    }

    public function greenhouse() {
        return view('pages.greenhouse');
    }

    public function beyond_nuremberg() {
        return view('pages.beyond-nuremberg');
    }
}
