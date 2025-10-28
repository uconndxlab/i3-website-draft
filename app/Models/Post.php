<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'subheader',
        'author',
        'url_friendly',
        'published',
        'published_at',
        'content',
        'featured_image',
        'featured_image_medium',
        'featured_image_webp',
        'image_position',
        'tags',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'date',
        'tags' => 'array',
    ];


    /**
     * Return the best available featured image for this post.
     * We optimize by reducing the size and coverting to webp but have fall backs if neccesary.
     * @return string|null
     */
    public function getBestFeaturedImageAttribute()
    {
        if ($this->featured_image_medium) {
            return $this->featured_image_medium;
        }

        if ($this->featured_image_webp) {
            return $this->featured_image_webp;
        }

        return $this->featured_image;
    }

    /**
     * Returns the url for the image.
     * @return string|null
     */
    public function getBestFeaturedImageUrlAttribute()
    {
        $image = $this->getBestFeaturedImageAttribute();
        return $image ? asset('storage/' . $image) : null;
    }
}
