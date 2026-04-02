<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'subheader',
        'author',
        'url_friendly',
        'published',
        'published_at',
        'featured_image',
        'featured_image_medium',
        'featured_image_webp',
        'tags',
        'blade_file',
        'body_markdown',
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

    /**
     * Render post body for frontend display.
     * Supports legacy Markdown and Quill-generated HTML.
     */
    public function getBodyHtmlAttribute(): string
    {
        if (empty($this->body_markdown)) {
            return '';
        }

        if ($this->looksLikeHtml($this->body_markdown)) {
            return $this->sanitizeEditorHtml($this->body_markdown);
        }

        return Str::markdown($this->body_markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    protected function looksLikeHtml(string $content): bool
    {
        return preg_match('/<\s*[a-zA-Z][^>]*>/', $content) === 1;
    }

    protected function sanitizeEditorHtml(string $html): string
    {
        $cleaned = preg_replace('/<(script|style)\b[^>]*>.*?<\/\1>/is', '', $html) ?? '';
        $cleaned = preg_replace('/\son[a-z]+\s*=\s*"[^"]*"/i', '', $cleaned) ?? '';
        $cleaned = preg_replace("/\son[a-z]+\s*=\s*'[^']*'/i", '', $cleaned) ?? '';
        $cleaned = preg_replace('/\son[a-z]+\s*=\s*[^\s>]+/i', '', $cleaned) ?? '';
        $cleaned = preg_replace('/\s(href|src)\s*=\s*([\"\'])\s*javascript:[^\"\']*\2/i', ' $1="#"', $cleaned) ?? '';

        return $cleaned;
    }
}
