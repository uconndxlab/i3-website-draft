<?php

namespace App\Console\Commands;

use App\Models\TeamMember;
use App\Services\ImageProcessingService;
use Illuminate\Console\Command;

class RegenerateTeamMemberImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:regenerate-team-members {--force : Force regeneration even if processed images exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate medium and WebP versions of team member photos';

    protected ImageProcessingService $imageProcessingService;

    public function __construct(ImageProcessingService $imageProcessingService)
    {
        parent::__construct();
        $this->imageProcessingService = $imageProcessingService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting team member image regeneration...');
        
        $teamMembers = TeamMember::whereNotNull('photo')->get();
        
        if ($teamMembers->isEmpty()) {
            $this->warn('No team members with photos found.');
            return Command::SUCCESS;
        }

        $this->info("Found {$teamMembers->count()} team members with photos.");
        
        $progressBar = $this->output->createProgressBar($teamMembers->count());
        $progressBar->start();
        
        $processed = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($teamMembers as $member) {
            try {
                // Check if we should skip if images already exist
                if (!$this->option('force') && $member->photo_medium && $member->photo_webp) {
                    $skipped++;
                    $progressBar->advance();
                    continue;
                }

                // Delete existing processed images if force regenerating
                if ($this->option('force') && ($member->photo_medium || $member->photo_webp)) {
                    $this->imageProcessingService->deleteTeamMemberImages([
                        $member->photo_medium,
                        $member->photo_webp
                    ]);
                }

                // Process the original image
                $imagePaths = $this->imageProcessingService->processExistingImage($member->photo);
                
                // Update the team member with new image paths
                $member->update([
                    'photo_medium' => $imagePaths['medium'],
                    'photo_webp' => $imagePaths['webp'],
                ]);

                $processed++;
            } catch (\Exception $e) {
                $this->error("\nError processing {$member->name}: " . $e->getMessage());
                $errors++;
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);
        
        $this->info("Image regeneration completed!");
        $this->table(['Status', 'Count'], [
            ['Processed', $processed],
            ['Skipped', $skipped],
            ['Errors', $errors],
        ]);

        return Command::SUCCESS;
    }
}
