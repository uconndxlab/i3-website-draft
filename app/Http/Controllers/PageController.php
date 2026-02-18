<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkItem;
use App\Models\TeamMember;
use App\Models\Post;
use App\Enums\PostTag;
use Illuminate\Support\Facades\File;
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
        
        $dbPosts = $query->get();
        $posts = $dbPosts;

        // Keep legacy template-backed posts visible even after DB posts are published.
        if ($filterTag === null) {
            $posts = $this->mergeTemplateAndDatabasePosts($dbPosts, $sort);
        }
        
        return view('pages.blogs.index', compact('posts', 'filterTag', 'sort'));
    }

    protected function mergeTemplateAndDatabasePosts($dbPosts, string $sort)
    {
        $combined = $dbPosts->concat($this->fallbackBlogPosts($sort));

        $sorted = $sort === 'oldest'
            ? $combined->sortBy(function ($post) {
                $timestamp = $post->published_at?->getTimestamp();
                return [$timestamp ?? PHP_INT_MAX, $post->title ?? ''];
            })
            : $combined->sortByDesc(function ($post) {
                $timestamp = $post->published_at?->getTimestamp();
                return [$timestamp ?? PHP_INT_MIN, $post->title ?? ''];
            });

        return $sorted->values();
    }

    public function blogShow(string $slug)
    {
        $post = Post::where('url_friendly', $slug)
            ->where('published', true)
            ->whereNotNull('published_at')
            ->first();

        if ($post) {
            return $this->renderBlogView($post);
        }

        $fallbackPosts = $this->fallbackBlogPosts('newest')->values();
        $currentIndex = $fallbackPosts->search(
            fn ($fallbackPost) => $fallbackPost->url_friendly === $slug
        );

        if ($currentIndex === false) {
            abort(404);
        }

        $currentPost = $fallbackPosts->get($currentIndex);
        $prevPost = $fallbackPosts->get($currentIndex - 1);
        $nextPost = $fallbackPosts->get($currentIndex + 1);

        return view($currentPost->blade_file, compact('currentPost', 'prevPost', 'nextPost'))
            ->with('post', $currentPost);
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

        $view = $this->resolvePostTemplate($post->blade_file);

        if (!$view) {
            $view = !empty(trim((string) ($post->body_markdown ?? '')))
                ? 'pages.blogs.backgrounds.blogs'
                : 'pages.blogs.template-missing';
        }

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
            if (Str::startsWith($viewName, 'pages.blogs.')) {
                $viewBasename = Str::after($viewName, 'pages.blogs.');
                if (!Str::startsWith($viewBasename, 'blog-')) {
                    continue;
                }
            }
            
            if (View::exists($viewName)) {
                return $viewName;
            }
        }

        return null;
    }

    protected function fallbackBlogPosts(string $sort = 'newest')
    {
        $directory = resource_path('views/pages/blogs');

        if (!is_dir($directory)) {
            return collect();
        }

        $posts = collect(File::files($directory))
            ->filter(fn ($file) => Str::endsWith($file->getFilename(), '.blade.php'))
            ->filter(fn ($file) => Str::startsWith($file->getFilename(), 'blog-'))
            ->map(function ($file) {
                $filename = $file->getFilename();
                $basename = Str::replaceLast('.blade.php', '', $filename);
                $titleBase = Str::after($basename, 'blog-');
                $title = Str::of($titleBase)
                    ->replace(['-', '_'], ' ')
                    ->headline()
                    ->value();

                return (object) [
                    'id' => null,
                    'title' => $title,
                    'subheader' => null,
                    'author' => null,
                    'published' => true,
                    'published_at' => null,
                    'url_friendly' => Str::slug($title),
                    'tags' => [],
                    'blade_file' => 'pages.blogs.' . $basename,
                    'body_markdown' => null,
                    'featured_image' => null,
                    'featured_image_medium' => null,
                    'featured_image_webp' => null,
                    'best_featured_image_url' => null,
                ];
            });

        if ($sort === 'oldest') {
            return $posts->sortBy('title')->values();
        }

        return $posts->sortByDesc('title')->values();
    }
}
