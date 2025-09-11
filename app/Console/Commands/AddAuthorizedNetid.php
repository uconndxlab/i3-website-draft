<?php

namespace App\Console\Commands;

use App\Models\AuthorizedNetid;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class AddAuthorizedNetid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'netid:add 
                            {netid : The NetID to authorize} 
                            {--name= : Optional name for the user}
                            {--email= : Optional email for the user}
                            {--inactive : Add the NetID as inactive}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add an authorized NetID for admin access';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $netid = $this->argument('netid');
        $name = $this->option('name');
        $email = $this->option('email');
        $isActive = !$this->option('inactive');

        // Validate email format if provided
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email format provided.');
            return Command::FAILURE;
        }

        try {
            // Check if NetID already exists
            if (AuthorizedNetid::where('netid', $netid)->exists()) {
                $this->error("NetID '{$netid}' is already authorized.");
                return Command::FAILURE;
            }

            // Create the authorized NetID
            $authorizedNetid = AuthorizedNetid::create([
                'netid' => $netid,
                'name' => $name,
                'email' => $email,
                'is_active' => $isActive,
            ]);

            $status = $isActive ? 'active' : 'inactive';
            $this->info("Successfully added NetID '{$netid}' as {$status}.");
            
            if ($name) {
                $this->line("Name: {$name}");
            }
            if ($email) {
                $this->line("Email: {$email}");
            }

            return Command::SUCCESS;

        } catch (QueryException $e) {
            $this->error('Database error occurred while adding the NetID.');
            $this->error($e->getMessage());
            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error('An unexpected error occurred.');
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
