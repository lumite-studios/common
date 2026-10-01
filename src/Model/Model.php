<?php

namespace LumiteStudios\Common\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    use Concerns\HasChanged;
    use Concerns\HasFactoryMethods;
    use HasFactory;
}
