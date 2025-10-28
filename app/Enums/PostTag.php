<?php

namespace App\Enums;

enum PostTag: string
{
    case PEOPLE = 'People';
    case NEWS = 'News';
    case PROJECTS = 'Projects';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public function color(): string
    {
        return match($this) {
            self::PEOPLE => '#f97316',     // Orange
            self::NEWS => '#3b82f6',       // Blue
            self::PROJECTS => '#10b981',    // Green
        };
    }
}
