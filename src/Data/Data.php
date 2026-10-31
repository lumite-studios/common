<?php

namespace LumiteStudios\Common\Data;

use Spatie\LaravelData\Data as BaseData;

class Data extends BaseData
{
    public function forFilamentForm(): array
    {
        return collect($this->toArray())
            ->transform(fn ($v) => is_bool($v) ? ($v ? '1' : '0') : $v)
            ->toArray();
    }
}
