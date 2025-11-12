<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkItem;
use App\Models\TeamMember;
use App\Models\Post;
use App\Enums\PostTag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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

        $student_staff = $people->filter(function ($person) {
            return in_array('student-staff', $person->tags);
        });

        $faculty_advisors = $people->filter(function ($person) {
            return in_array('faculty-advisor', $person->tags);
        });

        return view('pages.people', compact('people', 'senior_staff', 'student_staff', 'faculty_advisors'));
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

    public function blogs(Request $request) {

        // TODO: SHOW MORE POSTS button to get past the paginate 21
        $query = Post::where('published', true)
            ->whereNotNull('published_at');
        
        $filterTag = $request->get('tag');
        if ($filterTag && $filterTag !== 'all') {
            $query->whereJsonContains('tags', $filterTag);
        } else {
            $filterTag = null;
        }
        
        $sort = $request->get('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('published_at', 'asc');
        } else {
            $query->orderBy('published_at', 'desc');
        }
        
        $posts = $query->paginate(21);
        
        return view('pages.blogs.index', compact('posts', 'filterTag', 'sort'));
    }

    public function blogShow(string $slug)
    {
        $post = Post::where('url_friendly', $slug)
            ->where('published', true)
            ->whereNotNull('published_at')
            ->firstOrFail();

        return $this->renderBlogView($post);
    }

    protected function renderBlogView(?Post $post)
    {
        if (!$post) {
            return view('pages.blogs.empty', [
                'post' => null,
                'nextPost' => null,
                'prevPost' => null,
            ]);
        }

        $nextPost = Post::where('published', true)
            ->whereNotNull('published_at')
            ->where(function ($query) use ($post) {
                $query->where('published_at', '>', $post->published_at)
                    ->orWhere(function ($inner) use ($post) {
                        $inner->where('published_at', $post->published_at)
                            ->where('id', '>', $post->id);
                    });
            })
            ->orderBy('published_at', 'asc')
            ->orderBy('id', 'asc')
            ->first();

        $prevPost = Post::where('published', true)
            ->whereNotNull('published_at')
            ->where(function ($query) use ($post) {
                $query->where('published_at', '<', $post->published_at)
                    ->orWhere(function ($inner) use ($post) {
                        $inner->where('published_at', $post->published_at)
                            ->where('id', '<', $post->id);
                    });
            })
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        $view = $this->resolvePostTemplate($post->blade_file)
            ?: 'pages.blogs.template-missing';

        return view($view, compact('post', 'nextPost', 'prevPost'));
    }

    protected function resolvePostTemplate(?string $bladeFile): ?string
    {
        if (!$bladeFile) {
            return null;
        }

        $bladeFile = trim($bladeFile);

        $candidates = [];
        $candidates[] = $bladeFile;

        $withoutBlade = preg_replace('/\.blade(\.php)?$/', '', $bladeFile);
        if (!empty($withoutBlade)) {
            $candidates[] = $withoutBlade;
        }

        $dotNotation = str_replace(['/', '\\'], '.', $bladeFile);
        if (!empty($dotNotation)) {
            $candidates[] = $dotNotation;
        }

        $dotWithoutBlade = preg_replace('/\.blade(\.php)?$/', '', $dotNotation);
        if (!empty($dotWithoutBlade)) {
            $candidates[] = $dotWithoutBlade;
        }

        $expanded = [];
        foreach ($candidates as $candidate) {
            $candidate = trim($candidate, '.') ;
            if (empty($candidate)) {
                continue;
            }
            $expanded[] = $candidate;

            if (Str::startsWith($candidate, 'resources.views.')) {
                $expanded[] = Str::after($candidate, 'resources.views.');
            }

            if (Str::startsWith($candidate, 'views.')) {
                $expanded[] = Str::after($candidate, 'views.');
            }
        }

        $expanded = array_unique(array_map(function ($value) {
            return trim($value, '.');
        }, array_filter($expanded)));

        foreach ($expanded as $viewName) {
            if (View::exists($viewName)) {
                return $viewName;
            }
        }

        return null;
    }
}
