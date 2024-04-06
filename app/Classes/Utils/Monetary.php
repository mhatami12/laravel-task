<?php


namespace App\Classes\Utils;


use InvalidArgumentException;

class Monetary
{
    public const DIVIDER = 10;

    /**
     * Convert the specified monetary value into an integer.
     *
     * @param mixed $value
     *
     * @return int
     */
    public static function convertToRial($value): int
    {
        if ( ! \is_numeric($value)) {
            throw new InvalidArgumentException(
                'Invalid numeric string "' . $value . '" provided during converting the value into an integer.'
            );
        }

        return \round($value * self::DIVIDER);
    }
}
