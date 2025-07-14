<?php

namespace App\Console\Commands;

use App\Models\AuthorizedNetid;
use Illuminate\Console\Command;

class ListAuthorizedNetids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'netid:list 
                            {--active : Show only active NetIDs}
                            {--inactive : Show only inactive NetIDs}
                            {--search= : Search for NetIDs containing this string}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List authorized NetIDs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = AuthorizedNetid::query();

        // Apply filters
        if ($this->option('active')) {
            $query->where('is_active', true);
        } elseif ($this->option('inactive')) {
            $query->where('is_active', false);
        }

        if ($search = $this->option('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('netid', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $authorizedNetids = $query->orderBy('netid')->get();

        if ($authorizedNetids->isEmpty()) {
            $this->info('No authorized NetIDs found.');
            return Command::SUCCESS;
        }

        // Prepare table data
        $tableData = $authorizedNetids->map(function ($netid) {
            return [
                $netid->netid,
                $netid->name ?? '-',
                $netid->email ?? '-',
                $netid->is_active ? '✓ Active' : '✗ Inactive',
                $netid->created_at->format('Y-m-d H:i:s')
            ];
        })->toArray();

        // Display table
        $this->table(
            ['NetID', 'Name', 'Email', 'Status', 'Created'],
            $tableData
        );

        // Show summary
        $total = $authorizedNetids->count();
        $active = $authorizedNetids->where('is_active', true)->count();
        $inactive = $total - $active;

        $this->info("Total: {$total} | Active: {$active} | Inactive: {$inactive}");

        return Command::SUCCESS;
    }
}
