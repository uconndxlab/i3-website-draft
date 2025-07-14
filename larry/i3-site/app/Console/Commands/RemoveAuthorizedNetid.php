<?php

namespace App\Console\Commands;

use App\Models\AuthorizedNetid;
use Illuminate\Console\Command;

class RemoveAuthorizedNetid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'netid:remove 
                            {netid : The NetID to remove} 
                            {--force : Skip confirmation prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove an authorized NetID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $netid = $this->argument('netid');
        $force = $this->option('force');

        // Find the authorized NetID
        $authorizedNetid = AuthorizedNetid::where('netid', $netid)->first();

        if (!$authorizedNetid) {
            $this->error("NetID '{$netid}' is not found in the authorized list.");
            return Command::FAILURE;
        }

        // Show current details
        $this->info("Found authorized NetID:");
        $this->table(
            ['NetID', 'Name', 'Email', 'Status', 'Created'],
            [[
                $authorizedNetid->netid,
                $authorizedNetid->name ?? '-',
                $authorizedNetid->email ?? '-',
                $authorizedNetid->is_active ? 'Active' : 'Inactive',
                $authorizedNetid->created_at->format('Y-m-d H:i:s')
            ]]
        );

        // Confirm deletion unless force flag is used
        if (!$force) {
            if (!$this->confirm("Are you sure you want to remove NetID '{$netid}'?")) {
                $this->info('Operation cancelled.');
                return Command::SUCCESS;
            }
        }

        try {
            $authorizedNetid->delete();
            $this->info("Successfully removed NetID '{$netid}' from authorized list.");
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('An error occurred while removing the NetID.');
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
