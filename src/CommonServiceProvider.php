<?php

namespace LumiteStudios\Common;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class CommonServiceProvider extends ServiceProvider
{
    protected string $root = __DIR__.'/..';

    public function boot(): void
    {
        $this->bootDefaults();
    }

    protected function bootDefaults(): static
    {
        Model::automaticallyEagerLoadRelationships();
        Model::shouldBeStrict();
        Model::unguard();
        Date::use(CarbonImmutable::class);
        DB::prohibitDestructiveCommands(app()->isProduction());
        Password::defaults(fn () => Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->max(255)
            ->uncompromised());
        Gate::guessPolicyNamesUsing(fn (string $modelClass) => "{$modelClass}Policy");

        return $this;
    }
}
