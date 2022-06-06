<?php

namespace App\Enums;

enum Currency: string
{
    case PLN = 'PLN';
    case EUR = 'EUR';
    case USD = 'USD';

    /**
     * Return currencies as array of strings
     */
    public static function currencies()
    {
        $currencies = [];
        foreach (static::cases() as $currency) {
            $currencies[] = $currency->value;
        }

        return $currencies;
    }
}
// enum Currency: string
// {
//     case PLN = 'PLN';
//     case EUR = 'EUR';
//     case USD = 'USD';
// }
