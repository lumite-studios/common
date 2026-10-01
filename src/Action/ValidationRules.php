<?php

namespace LumiteStudios\Common\Action;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ValidationRules
{
    public static function alphaDashRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be alpha character or a dash" => [
                fn () => [$field => $customMessage ?? __('validation.alpha_dash', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'with space')),
            ],
        ];
    }

    public static function arrayRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be an array" => [
                fn () => [$field => $customMessage ?? __('validation.array', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function booleanRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be a boolean" => [
                fn () => [$field => $customMessage ?? __('validation.boolean', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function confirmedRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be confirmed" => [
                fn () => [$field => $customMessage ?? __('validation.confirmed', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string', false)),
            ],
        ];
    }

    public static function currentPasswordRule(string $field = 'current_password', ?string $customMessage = null): array
    {
        return [
            "{$field} must be the current password" => [
                fn () => [$field => $customMessage ?? __('validation.current_password', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function dateRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be a date" => [
                fn () => [$field => $customMessage ?? __('validation.date', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function dateFormatRule(string $field, $format = 'Y-m-d', ?string $customMessage = null): array
    {
        $parts = explode('-', $format);
        $incorrectFormat = "{$parts[2]}-{$parts[1]}-{$parts[0]}";

        return [
            "{$field} must be correct date format" => [
                fn () => [$field => $customMessage ?? __('validation.date_format', ['attribute' => self::getName($field), 'format' => $format])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, Carbon::now()->format($incorrectFormat))),
            ],
        ];
    }

    public static function emailRule(string $field = 'email', ?string $customMessage = null): array
    {
        return [
            "{$field} must be an email" => [
                fn () => [$field => $customMessage ?? __('validation.email', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function enumRule(string $field, string $enum, string $value = 'incorrect', ?string $customMessage = null): array
    {
        return [
            "{$field} must be match an enum value" => [
                fn () => [$field => $customMessage ?? __('enum::validation.enum', ['attribute' => self::getName($field), 'enum' => $enum])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, $value)),
            ],
        ];
    }

    public static function existsRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must exist" => [
                fn () => [$field => $customMessage ?? __('validation.exists', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function inRule(string $field, string $value = 'incorrect', ?string $customMessage = null)
    {
        return [
            "{$field} can only be a certain value" => [
                fn () => [$field => $customMessage ?? __('validation.in', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, $value)),
            ],
        ];
    }

    public static function imageRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be an image" => [
                fn () => [$field => $customMessage ?? __('validation.image', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function integerRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be an integer" => [
                fn () => [$field => $customMessage ?? __('validation.integer', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function ipRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be an ip" => [
                fn () => [$field => $customMessage ?? __('validation.ip', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'string')),
            ],
        ];
    }

    public static function lowercaseRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be lowercase" => [
                fn () => [$field => $customMessage ?? __('validation.lowercase', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 'UPPERCASE')),
            ],
        ];
    }

    public static function maxIntegerRule(string $field, int $size, ?string $customMessage = null)
    {
        return [
            "{$field} is too short" => [
                fn () => [$field => $customMessage ?? __('validation.max.numeric', ['attribute' => self::getName($field), 'max' => $size])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, $size + 1)),
            ],
        ];
    }

    public static function maxStringRule(string $field, int $size, ?string $customMessage = null)
    {
        return [
            "{$field} is too long" => [
                fn () => [$field => $customMessage ?? __('validation.max.string', ['attribute' => self::getName($field), 'max' => $size])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, Str::random($size + 1))),
            ],
        ];
    }

    public static function minIntegerRule(string $field, int $size, ?string $customMessage = null)
    {
        return [
            "{$field} is too short" => [
                fn () => [$field => $customMessage ?? __('validation.min.numeric', ['attribute' => self::getName($field), 'min' => $size])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, $size - 1)),
            ],
        ];
    }

    public static function minStringRule(string $field, int $size, ?string $customMessage = null)
    {
        return [
            "{$field} is too short" => [
                fn () => [$field => $customMessage ?? __('validation.min.string', ['attribute' => self::getName($field), 'min' => $size])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, Str::random($size - 1))),
            ],
        ];
    }

    public static function passwordRules(string $field = 'password', int $size = 8, ?string $customMessage = null): array
    {
        return array_merge(
            self::minStringRule($field, $size),
            [
                "{$field} must contain letters" => [
                    fn () => [$field => $customMessage ?? __('validation.password.mixed', ['attribute' => self::getName($field)])],
                    fn ($parameters) => array_merge($parameters, self::getFields($field, '12345678!')),
                ],
                "{$field} must contain mixed case letters (lowercase only)" => [
                    fn () => [$field => $customMessage ?? __('validation.password.mixed', ['attribute' => self::getName($field)])],
                    fn ($parameters) => array_merge($parameters, self::getFields($field, 'a12345678!')),
                ],
                "{$field} must contain mixed case letters (uppercase only)" => [
                    fn () => [$field => $customMessage ?? __('validation.password.mixed', ['attribute' => self::getName($field)])],
                    fn ($parameters) => array_merge($parameters, self::getFields($field, 'A12345678!')),
                ],
                "{$field} must contain numbers" => [
                    fn () => [$field => $customMessage ?? __('validation.password.numbers', ['attribute' => self::getName($field)])],
                    fn ($parameters) => array_merge($parameters, self::getFields($field, 'Abcdefgh!')),
                ],
                "{$field} must contain symbols" => [
                    fn () => [$field => $customMessage ?? __('validation.password.symbols', ['attribute' => self::getName($field)])],
                    fn ($parameters) => array_merge($parameters, self::getFields($field, 'Abcdefgh1')),
                ],
            ],
        );
    }

    public static function requiredRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} is required" => [
                fn () => [$field => $customMessage ?? __('validation.required', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, null)),
            ],
        ];
    }

    public static function sizeRule(string $field, int $size, ?string $customMessage = null): array
    {
        return [
            "{$field} is too short" => [
                fn () => [$field => __('validation.size.string', ['attribute' => self::getName($field), 'size' => $size])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, Str::random($size - 1))),
            ],
            "{$field} is too long" => [
                fn () => [$field => __('validation.size.string', ['attribute' => self::getName($field), 'size' => $size])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, Str::random($size + 1))),
            ],
        ];
    }

    public static function stringRule(string $field, ?string $customMessage = null): array
    {
        return [
            "{$field} must be a string" => [
                fn () => [$field => $customMessage ?? __('validation.string', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, 100)),
            ],
        ];
    }

    public static function uniqueRule(string $field, Closure $value, ?string $customMessage = null)
    {
        return [
            "{$field} must be unique" => [
                fn () => [$field => $customMessage ?? __('validation.unique', ['attribute' => self::getName($field)])],
                fn ($parameters) => array_merge($parameters, self::getFields($field, $value()->$field)),
            ],
        ];
    }

    public static function getName(string $field): string
    {
        return Str::replace('_', ' ', $field);
    }

    public static function getFields(string $field, mixed $value, bool $includeConfirmation = true)
    {
        $attributes = [$field => $value];
        if ($includeConfirmation) {
            $attributes["{$field}_confirmation"] = $value;
        }

        return Arr::undot($attributes);
    }
}
