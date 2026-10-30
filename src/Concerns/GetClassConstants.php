<?php

namespace LumiteStudios\Common\Concerns;

use Illuminate\Support\Collection;
use ReflectionClass;

trait GetClassConstants
{
    public static function getClassConstants(?string $class = null): Collection
    {
        $class = new ReflectionClass($class ?? self::class);

        return collect($class->getConstants());
    }
}
