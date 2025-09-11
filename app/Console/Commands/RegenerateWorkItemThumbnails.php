<?php

namespace App\Console\Commands;

use App\Models\WorkItem;
use App\Services\ImageProcessingService;
use Illuminate\Console\Command;

class RegenerateWorkItemThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:regenerate-work-items {--force : Force regeneration even if processed images exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate medium and WebP versions of work item thumbnails';

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
        $this->info('Starting work item thumbnail regeneration...');
        
        $workItems = WorkItem::whereNotNull('thumbnail')->get();
        
        if ($workItems->isEmpty()) {
            $this->warn('No work items with thumbnails found.');
            return Command::SUCCESS;
        }

        $this->info("Found {$workItems->count()} work items with thumbnails.");
        
        $progressBar = $this->output->createProgressBar($workItems->count());
        $progressBar->start();
        
        $processed = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($workItems as $workItem) {
            try {
                // Check if we should skip if images already exist
                if (!$this->option('force') && $workItem->thumbnail_medium && $workItem->thumbnail_webp) {
                    $skipped++;
                    $progressBar->advance();
                    continue;
                }

                // Delete existing processed images if force regenerating
                if ($this->option('force') && ($workItem->thumbnail_medium || $workItem->thumbnail_webp)) {
                    $this->imageProcessingService->deleteWorkItemThumbnails([
                        $workItem->thumbnail_medium,
                        $workItem->thumbnail_webp
                    ]);
                }

                // Process the original image
                $imagePaths = $this->imageProcessingService->processExistingWorkItemThumbnail($workItem->thumbnail);
                
                // Update the work item with new image paths
                $workItem->update([
                    'thumbnail_medium' => $imagePaths['medium'],
                    'thumbnail_webp' => $imagePaths['webp'],
                ]);

                $processed++;
            } catch (\Exception $e) {
                $this->error("\nError processing work item '{$workItem->title}': " . $e->getMessage());
                $errors++;
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);
        
        $this->info("Thumbnail regeneration completed!");
        $this->table(['Status', 'Count'], [
            ['Processed', $processed],
            ['Skipped', $skipped],
            ['Errors', $errors],
        ]);

        return Command::SUCCESS;
    }
}
