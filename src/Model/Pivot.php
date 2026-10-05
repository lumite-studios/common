<?php

namespace LumiteStudios\Common\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot as Eloquent;

class Pivot extends Eloquent
{
    use Concerns\HasChanged;
    use Concerns\HasFactoryMethods;
    use HasFactory;
}
