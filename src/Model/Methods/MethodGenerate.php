<?php

namespace LumiteStudios\Common\Model\Methods;

/**
 * @static string $dictionary
 * @static int $size
 * @method static string generate(?int $size = null, ?string $dictionary = null)
 */
trait MethodGenerate
{
    public static string $dictionary = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static int $size = 12;

    public static function generate(?int $size = null, ?string $dictionary = null): string
    {
        $size = $size ?? self::$size;
        $dictionary = $dictionary ?? self::$dictionary;
        $dictionaryLength = mb_strlen($dictionary);
        $output = '';

        for ($i = 0; $i < $size; $i++) {
            $output .= $dictionary[random_int(0, $dictionaryLength - 1)];
        }

        return $output;
    }
}
