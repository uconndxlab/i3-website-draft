<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ImageProcessingService
{
    protected ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    /**
     * Process an uploaded team member photo and generate multiple formats.
     *
     * @param UploadedFile $uploadedFile
     * @param string $directory
     * @return array Array containing paths to original, medium, and webp versions
     */
    public function processTeamMemberPhoto(UploadedFile $uploadedFile, string $directory = 'team_photos'): array
    {
        $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $timestamp = time();
        
        // Create unique filenames
        $originalPath = "{$directory}/{$originalName}_{$timestamp}." . $uploadedFile->getClientOriginalExtension();
        $mediumPath = "{$directory}/{$originalName}_{$timestamp}_medium.webp";
        $webpPath = "{$directory}/{$originalName}_{$timestamp}_webp.webp";

        // Store the original file
        $uploadedFile->storeAs('public', $originalPath);

        // Load the image
        $image = $this->imageManager->read($uploadedFile->getRealPath());

        // Generate medium sized version (600px width, maintain aspect ratio)
        $mediumImage = clone $image;
        $mediumImage->scaleDown(width: 600);
        Storage::disk('public')->put($mediumPath, $mediumImage->toWebp(75)->toString());

        // Generate optimized WebP version (90% quality)
        $webpImage = clone $image;
        Storage::disk('public')->put($webpPath, $webpImage->toWebp(75)->toString());

        return [
            'original' => $originalPath,
            'medium' => $mediumPath,
            'webp' => $webpPath,
        ];
    }

    /**
     * Process an existing image file from storage and generate additional formats.
     *
     * @param string $existingPath Path to existing image in storage
     * @return array Array containing paths to original, medium, and webp versions
     */
    public function processExistingImage(string $existingPath): array
    {
        $fullPath = storage_path('app/public/' . $existingPath);
        
        if (!file_exists($fullPath)) {
            throw new \InvalidArgumentException("Image file not found: {$fullPath}");
        }

        $pathInfo = pathinfo($existingPath);
        $directory = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];
        $timestamp = time();
        
        // Create unique filenames for new versions
        $mediumPath = "{$directory}/{$filename}_{$timestamp}_medium.webp";
        $webpPath = "{$directory}/{$filename}_{$timestamp}_webp.webp";

        // Load the existing image
        $image = $this->imageManager->read($fullPath);

        // Generate medium sized version (600px width, maintain aspect ratio)
        $mediumImage = clone $image;
        $mediumImage->scaleDown(width: 600);
        Storage::disk('public')->put($mediumPath, $mediumImage->toWebp(75)->toString());

        // Generate optimized WebP version (90% quality)
        $webpImage = clone $image;
        Storage::disk('public')->put($webpPath, $webpImage->toWebp(75)->toString());

        return [
            'original' => $existingPath,
            'medium' => $mediumPath,
            'webp' => $webpPath,
        ];
    }

    /**
     * Delete all versions of a team member photo.
     *
     * @param array $imagePaths Array of image paths to delete
     * @return void
     */
    public function deleteTeamMemberImages(array $imagePaths): void
    {
        foreach ($imagePaths as $path) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    /**
     * Process an uploaded work item thumbnail and generate multiple formats.
     *
     * @param UploadedFile $uploadedFile
     * @param string $directory
     * @return array Array containing paths to original, medium, and webp versions
     */
    public function processWorkItemThumbnail(UploadedFile $uploadedFile, string $directory = 'work_thumbnails'): array
    {
        $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $timestamp = time();
        
        // Create unique filenames
        $originalPath = "{$directory}/{$originalName}_{$timestamp}." . $uploadedFile->getClientOriginalExtension();
        $mediumPath = "{$directory}/{$originalName}_{$timestamp}_medium.webp";
        $webpPath = "{$directory}/{$originalName}_{$timestamp}_webp.webp";

        // Store the original file
        $uploadedFile->storeAs('public', $originalPath);

        // Load the image
        $image = $this->imageManager->read($uploadedFile->getRealPath());

        // Generate medium sized version (600px width, maintain aspect ratio)
        $mediumImage = clone $image;
        $mediumImage->scaleDown(width: 600);
        Storage::disk('public')->put($mediumPath, $mediumImage->toWebp(75)->toString());

        // Generate optimized WebP version (90% quality)
        $webpImage = clone $image;
        Storage::disk('public')->put($webpPath, $webpImage->toWebp(75)->toString());

        return [
            'original' => $originalPath,
            'medium' => $mediumPath,
            'webp' => $webpPath,
        ];
    }

    /**
     * Process an existing work item thumbnail and generate additional formats.
     *
     * @param string $existingPath Path to existing thumbnail in storage
     * @return array Array containing paths to original, medium, and webp versions
     */
    public function processExistingWorkItemThumbnail(string $existingPath): array
    {
        $fullPath = storage_path('app/public/' . $existingPath);
        
        if (!file_exists($fullPath)) {
            throw new \InvalidArgumentException("Thumbnail file not found: {$fullPath}");
        }

        $pathInfo = pathinfo($existingPath);
        $directory = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];
        $timestamp = time();
        
        // Create unique filenames for new versions
        $mediumPath = "{$directory}/{$filename}_{$timestamp}_medium.webp";
        $webpPath = "{$directory}/{$filename}_{$timestamp}_webp.webp";

        // Load the existing image
        $image = $this->imageManager->read($fullPath);

        // Generate medium sized version (600px width, maintain aspect ratio)
        $mediumImage = clone $image;
        $mediumImage->scaleDown(width: 600);
        Storage::disk('public')->put($mediumPath, $mediumImage->toWebp(75)->toString());

        // Generate optimized WebP version (90% quality)
        $webpImage = clone $image;
        Storage::disk('public')->put($webpPath, $webpImage->toWebp(75)->toString());

        return [
            'original' => $existingPath,
            'medium' => $mediumPath,
            'webp' => $webpPath,
        ];
    }

    /**
     * Delete all versions of a work item thumbnail.
     *
     * @param array $imagePaths Array of image paths to delete
     * @return void
     */
    public function deleteWorkItemThumbnails(array $imagePaths): void
    {
        foreach ($imagePaths as $path) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
