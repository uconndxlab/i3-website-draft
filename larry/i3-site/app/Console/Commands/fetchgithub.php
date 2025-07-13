<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class fetchgithub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetchgithub {org? : The GitHub organization name} {--token= : GitHub API token} {--days=365 : Number of days of history to fetch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch GitHub contributions for an organization. Command is fetchgithub {org} --token={githubtoken} --days={num}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get command arguments and options
        $org = $this->argument('org') ?? 'uconndxlab';
        $token = $this->option('token') ?? env('GITHUB_API_TOKEN');
        $days = $this->option('days');
        $year = date('Y');
        
        if (!$token) {
            $token = $this->secret('Enter your GitHub API token:');
        }

        $this->info("Fetching contributions for organization: {$org} for year {$year}");
        
        // Calculate date range for the year
        $startDate = new \DateTime("{$year}-01-01");
        $endDate = new \DateTime("{$year}-12-31");
        if ($year == date('Y')) {
            $endDate = new \DateTime(); // Today if current year
        }
        
        $startDateISO = $startDate->format('Y-m-d');
        $endDateISO = $endDate->format('Y-m-d');
        
        try {
            // Initialize all dates with zero contributions
            $contributionsData = [];
            $currentDate = clone $startDate;
            while ($currentDate <= $endDate) {
                $dateStr = $currentDate->format('Y-m-d');
                $contributionsData[$dateStr] = 0;
                $currentDate->modify('+1 day');
            }
            
            // Get repos from organization
            $this->info("Fetching repositories for {$org}...");
            $graphqlQuery = <<<QUERY
            query {
                organization(login: "{$org}") {
                    repositories(first: 100, orderBy: {field: PUSHED_AT, direction: DESC}) {
                        nodes {
                            name
                        }
                    }
                }
            }
            QUERY;
            
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ])->post('https://api.github.com/graphql', [
                'query' => $graphqlQuery
            ]);
            
            if ($response->failed()) {
                $this->error("API request failed: " . $response->body());
                return 1;
            }
            
            $data = $response->json();
            $repos = $data['data']['organization']['repositories']['nodes'] ?? [];
            
            if (empty($repos)) {
                $this->warn("No repositories found");
                return 1;
            }
            
            $this->info("Found " . count($repos) . " repositories");
            
            // Only process the 10 most recently updated repos to respect rate limits
            $reposToProcess = array_slice($repos, 0, 10);
            $bar = $this->output->createProgressBar(count($reposToProcess));
            $bar->start();
            
            foreach ($reposToProcess as $repo) {
                $repoName = $repo['name'];
                
                // Query for commit activity in this repo
                $commitQuery = <<<QUERY
                query {
                    repository(owner: "{$org}", name: "{$repoName}") {
                        defaultBranchRef {
                            target {
                                ... on Commit {
                                    history(since: "{$startDateISO}T00:00:00Z", until: "{$endDateISO}T23:59:59Z") {
                                        edges {
                                            node {
                                                committedDate
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                QUERY;
                
                $commitResponse = Http::withHeaders([
                    'Authorization' => "Bearer {$token}",
                    'Content-Type' => 'application/json',
                ])->post('https://api.github.com/graphql', [
                    'query' => $commitQuery
                ]);
                
                if ($commitResponse->successful()) {
                    $commitData = $commitResponse->json();
                    $history = $commitData['data']['repository']['defaultBranchRef']['target']['history'] ?? null;
                    
                    if ($history && isset($history['edges'])) {
                        foreach ($history['edges'] as $edge) {
                            $commitDate = substr($edge['node']['committedDate'], 0, 10); // YYYY-MM-DD format
                            if (isset($contributionsData[$commitDate])) {
                                $contributionsData[$commitDate]++;
                            }
                        }
                    }
                }
                
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine();
            
            // Calculate total contributions
            $totalContributions = array_sum($contributionsData);
            $this->info("Total contributions: {$totalContributions}");
            
            // Save data to JSON file
            $outputData = [
                'organization' => $org,
                'year' => $year,
                'totalContributions' => $totalContributions,
                'contributionsByDay' => $contributionsData
            ];
            
            $filename = "github-contributions-{$org}-{$year}.json";
            $path = public_path("data/{$filename}");
            
            // Make sure the directory exists
            if (!file_exists(public_path('data'))) {
                mkdir(public_path('data'), 0755, true);
            }
            
            file_put_contents($path, json_encode($outputData, JSON_PRETTY_PRINT));
            $this->info("Data saved to: {$path}");
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            return 1;
        }
    }
}
