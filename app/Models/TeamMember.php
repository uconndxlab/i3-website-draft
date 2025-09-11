<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'role', 'photo', 'photo_medium', 'photo_webp', 'tags', 'linkedin'];

    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * Get the best available image for this team member.
     * Returns medium size if available, otherwise WebP optimized, 
     * and finally falls back to original.
     *
     * @return string|null
     */
    public function getBestImageAttribute()
    {
        if ($this->photo_medium && file_exists(storage_path('app/public/' . $this->photo_medium))) {
            return $this->photo_medium;
        }

        if ($this->photo_webp && file_exists(storage_path('app/public/' . $this->photo_webp))) {
            return $this->photo_webp;
        }

        return $this->photo;
    }

    /**
     * Get the URL for the best available image.
     *
     * @return string|null
     */
    public function getBestImageUrlAttribute()
    {
        $image = $this->getBestImageAttribute();
        return $image ? asset('storage/' . $image) : null;
    }
}
