<?php

namespace LumiteStudios\Common\Extend;

use Closure;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Enum as LaravelEnum;

/**
 * @method static array         keyByValue(array|string $label = 'label')
 * @method static Closure|array labels()
 * @method static self          random()
 */
class Enum extends LaravelEnum
{
    public static function keyByValue(array|string $label = 'label'): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [
                $case->value => $label === 'label'
                    ? $case->label
                    : (is_array($label)
                        ? collect($label)->mapWithKeys(fn ($l) => [
                            $l => $l === 'label'
                                ? $case->label
                                : ($case->$l() ?? null),
                        ])->toArray()
                        : ($case->$label() ?? null)
                    ),
            ])
            ->toArray();
    }

    public static function labels(): Closure|array
    {
        return fn (string $name) => Str::headline($name);
    }

    public static function random(): self
    {
        return collect(self::cases())
            ->random();
    }
}
