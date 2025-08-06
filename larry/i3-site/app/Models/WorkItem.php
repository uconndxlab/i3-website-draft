<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class WorkItem extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'thumbnail', 'thumbnail_medium', 'thumbnail_webp', 'link'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the best available thumbnail for this work item.
     * Returns medium size if available, otherwise WebP optimized, 
     * and finally falls back to original.
     *
     * @return string|null
     */
    public function getBestThumbnailAttribute()
    {
        if ($this->thumbnail_medium && file_exists(storage_path('app/public/' . $this->thumbnail_medium))) {
            return $this->thumbnail_medium;
        }

        if ($this->thumbnail_webp && file_exists(storage_path('app/public/' . $this->thumbnail_webp))) {
            return $this->thumbnail_webp;
        }

        return $this->thumbnail;
    }

    /**
     * Get the URL for the best available thumbnail.
     *
     * @return string|null
     */
    public function getBestThumbnailUrlAttribute()
    {
        $thumbnail = $this->getBestThumbnailAttribute();
        return $thumbnail ? asset('storage/' . $thumbnail) : null;
    }
}
