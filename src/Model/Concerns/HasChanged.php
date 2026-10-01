<?php

namespace LumiteStudios\Common\Model\Concerns;

trait HasChanged
{
    protected array $ignoreChanged = ['id', 'password', 'created_at', 'updated_at', 'deleted_at'];

    public function hasChanged(): bool
    {
        return count($this->getChanged()) > 0;
    }

    public function getChanged(): array
    {
        return collect($this->wasRecentlyCreated ? $this->getAttributes() : $this->getChanges())
            ->except($this->ignoreChanged)
            ->transform(fn ($value) => is_null($value) ? 'null' : $value)
            ->all();
    }
}
