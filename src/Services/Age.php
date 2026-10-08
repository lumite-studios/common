<?php

namespace LumiteStudios\Common\Services;

use Carbon\Carbon;
use Exception;

/**
 * @method static int fetchAge(?string $birthday) Return an age in years from a date of birth.
 */
class Age
{
    public static function fetchAge(?string $birthday = null): int
    {
        $birthday = $birthday ?? '';
        try {
            return Carbon::parse($birthday)->age;
        } catch (Exception $e) {
            return 0;
        }
    }
}
