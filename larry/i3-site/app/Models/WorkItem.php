<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class WorkItem extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'thumbnail', 'link'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
