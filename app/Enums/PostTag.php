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

    public function cssClass(): string
    {
        return match($this) {
            self::PEOPLE => 'bg-orange',
            self::NEWS => 'bg-light-green',
            self::PROJECTS => 'bg-light-purple',
        };
    }

    public function cssMutedClass(): string
    {
        return match($this) {
            self::PEOPLE => 'btn-orange-muted',
            self::NEWS => 'btn-success-muted',
            self::PROJECTS => 'btn-purple-muted',
        };
    }
}
