<?php

namespace LumiteStudios\Common\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Eloquent;

class Authenticatable extends Eloquent
{
    use Concerns\HasChanged;
    use Concerns\HasFactoryMethods;
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    public $incrementing = false;
}
