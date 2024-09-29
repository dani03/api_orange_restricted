<?php

namespace App\Enums;

enum OptionSecureServer: int
{

    case PROTECTION_EXTENDED =  0 ;
    case PROTECTION_CHIFFREMENT = 1;
    case PARE_FEU =  2;


    public function label(): string
    {
        return match ($this) {
            self::PROTECTION_EXTENDED => 'protection étendue',
            self::PROTECTION_CHIFFREMENT => 'protection contre le chiffrement',
            self::PARE_FEU => 'pare-feu',

        };
    }

    //afin de récupérer les valeurs grace au nombre
    public static function fromValue(int $value): OptionSecureServer
    {
        return match ($value) {
            0 => self::PROTECTION_EXTENDED,
            1 => self::PROTECTION_CHIFFREMENT,
            2 => self::PARE_FEU,
        };
    }


    public static function fromLabel(string $label): ?OptionSecureServer
    {
        return match ($label) {
            "protection étendue" => self::PROTECTION_EXTENDED,
            "protection contre le chiffrement" => self::PROTECTION_CHIFFREMENT,
            "pare-feu" => self::PARE_FEU,
        };
    }

    public static function allStatusValues(): array
    {
        return [
            self::PROTECTION_EXTENDED->value,
            self::PROTECTION_CHIFFREMENT->value,
            self::PARE_FEU->value,
        ];
    }

    public static function allStatusLabel(): array
    {
        return [
            self::PROTECTION_EXTENDED->label(),
            self::PROTECTION_CHIFFREMENT->label(),
            self::PARE_FEU->label(),

        ];
    }

}
