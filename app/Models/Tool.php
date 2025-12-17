<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['image', 'image_medium', 'image_webp', 'description', 'link', 'alt_text', 'is_active'];

    /**
     * Get the URL for the tool image.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Get the best available thumbnail for this tool.
     * Returns medium size if available, otherwise WebP optimized, 
     * and finally falls back to original.
     *
     * @return string|null
     */
    public function getBestThumbnailAttribute()
    {
        if ($this->image_medium) {
            return $this->image_medium;
        }

        if ($this->image_webp) {
            return $this->image_webp;
        }

        return $this->image;
    }

    /**
     * Get the best available thumbnail URL (alias for image_url for compatibility).
     *
     * @return string|null
     */
    public function getBestThumbnailUrlAttribute()
    {
        $thumbnail = $this->getBestThumbnailAttribute();
        return $thumbnail ? asset('storage/' . $thumbnail) : null;
    }
}

