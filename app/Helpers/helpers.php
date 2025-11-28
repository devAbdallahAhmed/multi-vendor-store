<?php

namespace App\Helpers;

use NumberFormatter;

class Helpers
{

    public function __invoke(...$params)
    {
        return static::format(...$params);
    }


  public static function format($amount, $currency = null)
{
    $currency = $currency ?? config('app.currency', 'USD');

    if (class_exists(\NumberFormatter::class)) {
        $formatter = new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $currency);
    }

    // Fallback format (من غير intl)
    return number_format($amount, 2) . ' ' . $currency;
}

}
