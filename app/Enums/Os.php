<?php

namespace App\Enums;

enum Os: int
{
    case MAC = 0;
    case LINUX = 1;
    case WINDOWS = 2;


    public function label(): string
    {
        return match ($this) {
            self::MAC => 'mac',
            self::LINUX => 'linux',
            self::WINDOWS => 'windows',

        };
    }

    public static function fromValue(int $value): ?Os
    {
        return match ($value) {
            0 => self::MAC,
            1 => self::LINUX,
            2 => self::WINDOWS,
            default => null
        };
    }

    public static function fromLabel(string $label): ?Os
    {
        return match ($label) {
            'mac' => self::MAC,
            'linux' => self::LINUX,
            'windows' => self::WINDOWS,
            default => null

        };
    }

    // afin de récupérer toutes les valeurs des status
    public static function allStatusValues(): array
    {
        return [
            self::MAC->value,
            self::LINUX->value,
            self::WINDOWS->value,

        ];
    }

    public static function allStatusLabel(): array
    {
        return [
            self::MAC->label(),
            self::LINUX->label(),
            self::WINDOWS->label(),
        ];
    }
}
