<?php

namespace BlueMedia\OnlinePayments\Util;

class Formatter
{

    /**
     * Format amount.
     *
     * @param float|number $amount
     *
     * @return string
     */
    public static function formatAmount($amount): string
    {
        return number_format((float)$amount, 2, '.', '');
    }

    /**
     * Format description.
     *
     * @param string $value
     *
     * @return string
     */
    public static function formatDescription($value): string
    {
        $value = trim($value);

        if (EnvironmentRequirements::hasPhpExtension('iconv')) {
            $return = iconv('UTF-8', 'ASCII//TRANSLIT', $value);

            return $return;
        }

        if (EnvironmentRequirements::hasPhpExtension('mbstring')) {
            $tmp = ini_get('mbstring.substitute_character');
            @ini_set('mbstring.substitute_character', 'none');

            $return = mb_convert_encoding($value, 'ASCII', 'UTF-8');
            @ini_set('mbstring.substitute_character', $tmp);

            return $return;
        }

        return $value;
    }
}
