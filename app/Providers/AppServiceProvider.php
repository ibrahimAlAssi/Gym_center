<?php

namespace App\Providers;

use App\Domains\Entities\Models\Admin;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Relation::enforceMorphMap([
            'player' => Player::class,
            'coach' => Coach::class,
            'admin' => Admin::class,
        ]);
    }
}
