<?php

namespace LumiteStudios\Common\Model\Concerns;

/**
 * @method static string generateCacheKey(string $cacheId, string $table, ?string $field = null, ?string $key = null)
 * @method        string getCacheKey(?string $field = null, ?string $key = null)
 * @method static mixed  getCachedRelation(string $attr)
 */
trait HasCacheKey
{
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
            $this[$this->getCacheId()],
            $this->getTable(),
            $field,
            $key,
        );
    }

    public function getCacheId(): string
    {
        return property_exists($this, 'cacheId')
            ? $this->cacheId
            : 'id';
    }
}
