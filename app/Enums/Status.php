<?php

namespace App\Enums;

enum Status: int
{
    case NOUVELLE = 0;
    case EN_ATTENTE = 1;
    case EN_COURS = 2;
    case COMPLETED = 3;

    public function label(): string
    {
        return match ($this) {
            self::NOUVELLE => 'nouvelle',
            self::EN_ATTENTE => 'en attente',
            self::EN_COURS => 'en cours',
            self::COMPLETED => 'completée',
        };
    }

    public static function fromValue(int $value): ?Status
    {
        return match ($value) {
            0 => self::NOUVELLE,
            1 => self::EN_ATTENTE,
            2 => self::EN_COURS,
            3 => self::COMPLETED,
            default => null
        };
    }

    public static function fromLabel(string $label): ?Status
    {
        return match ($label) {
            'nouvelle' => self::NOUVELLE,
            'en attente' => self::EN_ATTENTE,
            'en cours' => self::EN_COURS,
            'completée' => self::COMPLETED,
        };
    }

    // afin de récupérer toutes les valeurs des status
    public static function allStatusValues(): array
    {
        return [
            self::NOUVELLE->value,
            self::EN_ATTENTE->value,
            self::EN_COURS->value,
            self::COMPLETED->value,
        ];
    }

    public static function allStatusLabel(): array
    {
        return [
            self::NOUVELLE->label(),
            self::EN_ATTENTE->label(),
            self::EN_COURS->label(),
            self::COMPLETED->label(),
        ];
    }

    public function completedValue() {
        return self::COMPLETED->value;
    }
}
