<?php

namespace App\Providers;

use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\Product;
use App\Domains\Entities\Models\Admin;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Plan;
use App\Domains\Tasks\Models\Task;
use App\Domains\Tasks\Models\Type;
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
            'plan' => Plan::class,
            'food' => Food::class,
            'product' => Product::class,
            'Task' => Task::class,
            'diet' => Diet::class,
            'type' => Type::class,
        ]);
    }
}
