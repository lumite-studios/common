<?php

namespace LumiteStudios\Common\Model\Attributes;

use Illuminate\Support\Arr;

trait AttributeParameters
{
    private function getParameters(array $fields): array
    {
        return collect($fields)
            ->merge(Arr::map($this->properties, function (mixed $value) {
                if (is_array($value)) {
                    if (Arr::isAssoc($value)) {
                        return http_build_query($value, '', '&');
                    }

                    return implode('&', $value);
                }

                return $value;
            }))
            ->transform(fn ($val) => urldecode($val))
            ->toArray();
    }
}
