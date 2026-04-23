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

    public function lincus() {
        return view('pages.lincus');
    }

    public function tldr()
    {
        $stats = [
            'projects' => 0,
            'departments' => 0,
            'grants' => 0,
            'clients' => 0,
            'ongoing_in_progress' => 0,
            'maintenance' => 0,
        ];
        $allProjects = [];
        $allDepartments = [];
        $departmentCounts = [];
        $workforceStats = [
            'staff' => 0,
            'students' => 0,
        ];

        $csvPath = public_path('data/Project Inventory(Sheet1).csv');
        if (is_readable($csvPath)) {
            $stats = $this->calculateProjectInventoryStats($csvPath);
            $allProjects = $this->parseAllProjects($csvPath);
            $allDepartments = $this->parseUniqueDepartments($csvPath);
            $departmentCounts = $this->getDepartmentProjectCounts($csvPath);
        }

        $people = TeamMember::all();
        $workforceStats['students'] = $people->filter(function ($person) {
            $tags = is_array($person->tags) ? $person->tags : [];
            return in_array('student-staff', $tags, true);
        })->count();

        $workforceStats['staff'] = $people->filter(function ($person) {
            $tags = is_array($person->tags) ? $person->tags : [];
            $isStaff = in_array('staff', $tags, true) || in_array('senior-staff', $tags, true);
            $isStudent = in_array('student-staff', $tags, true);
            return $isStaff && !$isStudent;
        })->count();

        return view('pages.tldr', [
            'projectInventoryStats' => $stats,
            'allProjects' => $allProjects,
            'allDepartments' => $allDepartments,
            'departmentCounts' => $departmentCounts,
            'workforceStats' => $workforceStats,
        ]);
    }

    public function jobs() {
        return view('pages.jobs');
    }

    public function jobWebDev() {
        return view('pages.jobs.2026-web-application-developer');
    }

    public function jobProjectSpecialist() {
        return view('pages.jobs.2026-junior-digital-project-specialist');
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

    protected function calculateProjectInventoryStats(string $csvPath): array
    {
        $handle = fopen($csvPath, 'r');
        if ($handle === false) {
            return [
                'projects' => 0,
                'departments' => 0,
                'grants' => 0,
                'clients' => 0,
                'ongoing_in_progress' => 0,
                'maintenance' => 0,
            ];
        }

        $header = fgetcsv($handle);
        if (!is_array($header)) {
            fclose($handle);
            return [
                'projects' => 0,
                'departments' => 0,
                'grants' => 0,
                'clients' => 0,
                'ongoing_in_progress' => 0,
                'maintenance' => 0,
            ];
        }

        $headerMap = [];
        foreach ($header as $index => $columnName) {
            $normalizedColumn = trim((string) $columnName);
            if ($normalizedColumn !== '') {
                $headerMap[$normalizedColumn] = $index;
            }
        }

        $projects = 0;
        $grants = 0;
        $departments = [];
        $clients = [];
        $ongoingInProgress = 0;
        $maintenance = 0;

        while (($row = fgetcsv($handle)) !== false) {
            if (!is_array($row)) {
                continue;
            }

            $status = $this->csvColumnValue($row, $headerMap, 'Status');
            $projectName = $this->csvColumnValue($row, $headerMap, 'Project Name');
            $department = $this->csvColumnValue($row, $headerMap, 'Home Department');
            $client = $this->csvColumnValue($row, $headerMap, 'Client/PI');
            $grantValue = $this->csvColumnValue($row, $headerMap, 'Grant Y/N');

            $hasContent = $status !== '' || $projectName !== '' || $department !== '' || $client !== '' || $grantValue !== '';
            if (!$hasContent) {
                continue;
            }

            $projects++;

            if ($department !== '') {
                $departments[Str::lower($department)] = true;
            }

            if ($client !== '') {
                $clients[Str::lower($client)] = true;
            }

            if (Str::upper($grantValue) === 'Y') {
                $grants++;
            }

            $normalizedStatus = Str::lower($status);
            if (in_array($normalizedStatus, ['ongoing', 'being built'], true)) {
                $ongoingInProgress++;
            }

            if ($normalizedStatus === 'maintenance') {
                $maintenance++;
            }
        }

        fclose($handle);

        return [
            'projects' => $projects,
            'departments' => count($departments),
            'grants' => $grants,
            'clients' => count($clients),
            'ongoing_in_progress' => $ongoingInProgress,
            'maintenance' => $maintenance,
        ];
    }

    protected function csvColumnValue(array $row, array $headerMap, string $columnName): string
    {
        if (!array_key_exists($columnName, $headerMap)) {
            return '';
        }

        $columnIndex = $headerMap[$columnName];
        $value = $row[$columnIndex] ?? '';

        if (!is_string($value)) {
            return '';
        }

        return trim(preg_replace('/\s+/', ' ', $value) ?? '');
    }

    protected function parseAllProjects(string $csvPath): array
    {
        $projects = [];
        $handle = fopen($csvPath, 'r');
        if ($handle === false) {
            return [];
        }

        $header = fgetcsv($handle);
        if (!is_array($header)) {
            fclose($handle);
            return [];
        }

        $headerMap = [];
        foreach ($header as $index => $columnName) {
            $normalizedColumn = trim((string) $columnName);
            if ($normalizedColumn !== '') {
                $headerMap[$normalizedColumn] = $index;
            }
        }

        while (($row = fgetcsv($handle)) !== false) {
            if (!is_array($row)) {
                continue;
            }

            $status = $this->csvColumnValue($row, $headerMap, 'Status');
            $projectName = $this->csvColumnValue($row, $headerMap, 'Project Name');
            $department = $this->csvColumnValue($row, $headerMap, 'Home Department');
            $client = $this->csvColumnValue($row, $headerMap, 'Client/PI');
            $grantValue = $this->csvColumnValue($row, $headerMap, 'Grant Y/N');

            $hasContent = $status !== '' || $projectName !== '' || $department !== '' || $client !== '' || $grantValue !== '';
            if (!$hasContent || $projectName === '') {
                continue;
            }

            $projects[] = [
                'name' => $projectName,
                'status' => $status,
                'department' => $department,
                'client' => $client,
                'is_grant' => Str::upper($grantValue) === 'Y',
            ];
        }

        fclose($handle);
        return $projects;
    }

    protected function parseUniqueDepartments(string $csvPath): array
    {
        $departments = [];
        $handle = fopen($csvPath, 'r');
        if ($handle === false) {
            return [];
        }

        $header = fgetcsv($handle);
        if (!is_array($header)) {
            fclose($handle);
            return [];
        }

        $headerMap = [];
        foreach ($header as $index => $columnName) {
            $normalizedColumn = trim((string) $columnName);
            if ($normalizedColumn !== '') {
                $headerMap[$normalizedColumn] = $index;
            }
        }

        while (($row = fgetcsv($handle)) !== false) {
            if (!is_array($row)) {
                continue;
            }

            $department = $this->csvColumnValue($row, $headerMap, 'Home Department');
            if ($department !== '') {
                $departments[$department] = true;
            }
        }

        fclose($handle);
        return array_keys($departments);
    }

    protected function getDepartmentProjectCounts(string $csvPath): array
    {
        $counts = [];
        $originalNames = [];
        $handle = fopen($csvPath, 'r');
        if ($handle === false) {
            return [];
        }

        $header = fgetcsv($handle);
        if (!is_array($header)) {
            fclose($handle);
            return [];
        }

        $headerMap = [];
        foreach ($header as $index => $columnName) {
            $normalizedColumn = trim((string) $columnName);
            if ($normalizedColumn !== '') {
                $headerMap[$normalizedColumn] = $index;
            }
        }

        while (($row = fgetcsv($handle)) !== false) {
            if (!is_array($row)) {
                continue;
            }

            $projectName = $this->csvColumnValue($row, $headerMap, 'Project Name');
            $department = $this->csvColumnValue($row, $headerMap, 'Home Department');
            
            // Only count rows with a project name and department
            if ($projectName !== '' && $department !== '') {
                $deptKey = Str::lower(trim($department));
                if ($deptKey === '') {
                    continue;
                }
                if (!isset($counts[$deptKey])) {
                    $counts[$deptKey] = 0;
                    $originalNames[$deptKey] = $department;
                }
                $counts[$deptKey]++;
            }
        }

        fclose($handle);
        
        // Sort by count descending
        arsort($counts);

        // Calculate size weights (1-5 scale for CSS sizing)
        $values = array_values($counts);
        $max = max($values) ?: 1;
        $min = min($values) ?: 1;
        $range = $max - $min ?: 1;

        $weighted = [];
        foreach ($counts as $deptKey => $count) {
            $normalized = ($count - $min) / $range;
            $size = 1 + ($normalized * 1.5); // Scale 1-2.5
            $weighted[] = [
                'name' => $originalNames[$deptKey] ?? $deptKey,
                'count' => $count,
                'size' => $size,
            ];
        }

        return $weighted;
    }
}
