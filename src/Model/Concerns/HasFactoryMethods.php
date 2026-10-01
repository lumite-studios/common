<?php

namespace LumiteStudios\Common\Model\Concerns;

/**
 * @method static static firstOrFactoryCreate(array $attributes = [])
 * @method static static firstOrFactoryMake(array $attributes = [])
 */
trait HasFactoryMethods
{
    public static function firstOrFactoryCreate(array $attributes = []): static
    {
        if ($model = static::where($attributes)->first()) {
            return $model;
        }

        return static::factory()->create($attributes);
    }

    public static function firstOrFactoryMake(array $attributes = []): static
    {
        if ($model = static::where($attributes)->first()) {
            return $model;
        }

        return static::factory()->make($attributes);
    }
}
