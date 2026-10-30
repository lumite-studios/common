<?php

namespace LumiteStudios\Common\Model\Methods;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static string getBySlug(string $slug)
 * @method static string forSlug(string $slug)
 */
trait MethodGetBySlug
{
    public static function getBySlug(string $slug): static
    {
        return static::where('slug', $slug)->first();
    }

    #[Scope]
    public function forSlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
    }
}
