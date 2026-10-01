<?php

namespace LumiteStudios\Common\Extend;

use Illuminate\Contracts\Validation\ValidationRule;

abstract class Rule implements ValidationRule
{
    abstract public static function getMessage(): string;
}
