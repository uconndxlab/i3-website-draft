<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorizedNetid extends Model
{
    protected $fillable = [
        'netid',
        'name',
        'email',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Check if a NetID is authorized
     */
    public static function isAuthorized(string $netid): bool
    {
        return static::where('netid', $netid)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Get active authorized NetIDs
     */
    public static function getActiveNetids(): array
    {
        return static::where('is_active', true)
            ->pluck('netid')
            ->toArray();
    }
}
