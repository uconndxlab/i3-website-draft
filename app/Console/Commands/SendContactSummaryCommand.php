<?php

namespace App\Console\Commands;

use App\Jobs\SendContactSubmissionSummary;
use Illuminate\Console\Command;

class SendContactSummaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:send-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a summary of new contact form submissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Dispatching contact submission summary job...');
        
        SendContactSubmissionSummary::dispatch();
        
        $this->info('Contact submission summary job dispatched successfully!');
    }
}
