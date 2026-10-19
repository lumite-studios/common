<?php

namespace LumiteStudios\Common\Model\Concerns;

/**
 * @method static string generateCacheKey(string $cacheId, string $table, ?string $field = null, ?string $key = null)
 * @method        string getCacheKey(?string $field = null, ?string $key = null)
 * @method static mixed  getCachedRelation(string $attr)
 */
trait HasCacheKey
{
    protected string $cacheId = 'id';

    public static function generateCacheKey(string $cacheId, string $table, ?string $field = null, ?string $key = null): string
    {
        $start = $key
            ? "{$table}:{$key}"
            : "{$table}:{$cacheId}";

        return $field
            ? "{$start}:{$field}"
            : $start;
    }

    public function getCacheKey(?string $field = null, ?string $key = null): string
    {
        return $this->generateCacheKey(
            $this[$this->cacheId],
            $this->getTable(),
            $field,
            $key,
        );
    }
}
