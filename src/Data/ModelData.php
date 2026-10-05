<?php

namespace LumiteStudios\Common\Data;

use Carbon\Carbon;
use Spatie\TypeScriptTransformer\Attributes\Optional;

class ModelData extends Data
{
    public int $id;
    public Carbon $created_at;
    public Carbon $updated_at;
    #[Optional] public ?Carbon $deleted_at;
}
