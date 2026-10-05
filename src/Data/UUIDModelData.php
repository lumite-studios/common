<?php

namespace LumiteStudios\Common\Data;

use Carbon\Carbon;
use Spatie\TypeScriptTransformer\Attributes\Optional;

class UUIDModelData extends Data
{
    public string $id;
    public Carbon $created_at;
    public Carbon $updated_at;
    #[Optional] public ?Carbon $deleted_at;
}
