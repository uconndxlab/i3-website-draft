<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class FetchGitHubCommits extends Command
{
    protected $signature = 'github:fetch-commits
        {org=uconndxlab : GitHub organization name}
        {--token= : GitHub API token}
        {--year=2025 : Year to fetch commit history for}';

    protected $description = 'Fetch daily GitHub commit counts for all repos in an org for a given year.';

    public function handle()
    {
        $org = $this->argument('org');
        $token = $this->option('token') ?? env('GITHUB_API_TOKEN');
        $year = (int) $this->option('year');

        if (!$token) {
            $this->error('GitHub API token is required.');
            return 1;
        }

        $start = Carbon::create($year, 1, 1)->startOfDay();
        $end = ($year === (int) date('Y'))
            ? Carbon::now()->endOfDay()
            : Carbon::create($year, 12, 31)->endOfDay();

        $sinceISO = $start->toIso8601String();
        $untilISO = $end->toIso8601String();

        // Initialize daily counts
        $dailyCounts = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $dailyCounts[$cursor->format('Y-m-d')] = 0;
            $cursor->addDay();
        }

        $headers = [
            'Authorization' => "Bearer {$token}",
            'Accept' => 'application/vnd.github+json',
            'User-Agent' => 'Laravel-GitHub-Fetcher/1.0',
        ];

        // Configure HTTP client with longer timeout
        $httpClient = Http::withHeaders($headers)->timeout(30);

        // Fetch all repositories (with pagination)
        $repos = [];
        $page = 1;
        do {
            $response = $httpClient
                ->get("https://api.github.com/orgs/{$org}/repos", [
                    'per_page' => 100,
                    'page' => $page,
                    'type' => 'all',
                    'sort' => 'updated',
                    'direction' => 'desc',
                ]);

            if ($response->failed()) {
                $this->error("Failed to fetch repos: " . $response->body());
                return 1;
            }

            $pageRepos = $response->json();
            $repos = array_merge($repos, $pageRepos);
            $page++;
            
            // Rate limiting for repo fetching
            usleep(100000); // 100ms delay
        } while (count($pageRepos) === 100);

        $this->info("Found " . count($repos) . " repositories.");
        $bar = $this->output->createProgressBar(count($repos));
        $bar->start();

        foreach ($repos as $repo) {
            $repoName = $repo['name'];
            $seenCommits = [];
            
            $this->info("\nProcessing repository: {$repoName}");

            // Fetch all branches with pagination
            $branches = [];
            $branchPage = 1;
            do {
                $branchesResponse = $httpClient
                    ->get("https://api.github.com/repos/{$org}/{$repoName}/branches", [
                        'per_page' => 100,
                        'page' => $branchPage
                    ]);

                if ($branchesResponse->failed()) {
                    $this->warn("Failed to fetch branches for {$repoName}: " . $branchesResponse->body());
                    break;
                }

                $pageBranches = $branchesResponse->json();
                $branches = array_merge($branches, $pageBranches);
                $branchPage++;
                
                // Rate limiting
                usleep(100000); // 100ms delay
            } while (count($pageBranches) === 100);

            $this->info("Found " . count($branches) . " branches in {$repoName}");

            foreach ($branches as $branch) {
                $branchName = $branch['name'];
                $nextPageUrl = "https://api.github.com/repos/{$org}/{$repoName}/commits?sha={$branchName}&since={$sinceISO}&until={$untilISO}&per_page=100";

                while ($nextPageUrl) {
                    try {
                        $commitResponse = $httpClient->get($nextPageUrl);
                    } catch (\Exception $e) {
                        $this->warn("Error fetching commits for {$repoName}/{$branchName}: " . $e->getMessage());
                        break;
                    }
                    
                    if ($commitResponse->failed()) {
                        $this->warn("Failed to fetch commits for {$repoName}/{$branchName}: " . $commitResponse->body());
                        break;
                    }

                    $commits = $commitResponse->json();
                    
                    foreach ($commits as $commit) {
                        $sha = $commit['sha'];
                        if (isset($seenCommits[$sha])) continue;

                        $seenCommits[$sha] = true;
                        
                        // Use author date instead of committer date for more accuracy
                        $commitDate = $commit['commit']['author']['date'] ?? $commit['commit']['committer']['date'];
                        $date = substr($commitDate, 0, 10);
                        
                        if (isset($dailyCounts[$date])) {
                            $dailyCounts[$date]++;
                        }
                    }

                    // Parse Link header for pagination
                    $nextPageUrl = null;
                    if ($commitResponse->hasHeader('Link')) {
                        $links = explode(',', $commitResponse->header('Link'));
                        foreach ($links as $link) {
                            if (strpos($link, 'rel="next"') !== false) {
                                preg_match('/<([^>]+)>/', $link, $matches);
                                if (isset($matches[1])) {
                                    $nextPageUrl = $matches[1];
                                }
                            }
                        }
                    }
                    
                    // Rate limiting
                    usleep(100000); // 100ms delay between API calls
                }
            }
            
            $repoCommitCount = count($seenCommits);
            $this->info("Found {$repoCommitCount} unique commits in {$repoName}");

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $totalCommits = array_sum($dailyCounts);
        $this->info("Total commits in {$year}: {$totalCommits}");

        $data = [
            'organization' => $org,
            'year' => (string) $year,
            'totalContributions' => $totalCommits,
            'contributionsByDay' => $dailyCounts,
        ];

        $filename = "github-contributions-{$org}-{$year}.json";
        $filepath = public_path("data/{$filename}");

        if (!File::exists(public_path('data'))) {
            File::makeDirectory(public_path('data'), 0755, true);
        }

        File::put($filepath, json_encode($data, JSON_PRETTY_PRINT));
        $this->info("Saved to {$filepath}");

        return 0;
    }
}
