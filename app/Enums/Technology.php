<?php

namespace App\Enums;

enum Technology: int
{
    case SERVER_STRIKE = 0;
    case SECURE_SERVER = 1;

    public function label(): string
    {
        return match ($this) {
            self::SERVER_STRIKE => 'serverStrike',
            self::SECURE_SERVER => 'secureServer',

        };
    }

    public static function fromValue(int $value): Technology
    {
        return match ($value) {
            0 => self::SERVER_STRIKE,
            1 => self::SECURE_SERVER,
            default => null
        };
    }

    public static function fromLabel(string $label): Technology
    {
        return match ($label) {
            'serverStrike' => self::SERVER_STRIKE,
            'secureServer' => self::SECURE_SERVER,

        };
    }

    // afin de récupérer toutes les valeurs
    public static function allStatusValues(): array
    {
        return [
            self::SERVER_STRIKE->value,
            self::SECURE_SERVER->value,

        ];
    }

    public static function allStatusLabel(): array
    {
        return [
            self::SERVER_STRIKE->label(),
            self::SECURE_SERVER->label(),

        ];
    }

    public static function serverStrikeLabel() : string {
        return self::SERVER_STRIKE->label();
    }

    public static function secureServerLabel() : string {
        return self::SECURE_SERVER->label();
    }
}
