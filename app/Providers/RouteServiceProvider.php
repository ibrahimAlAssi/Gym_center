<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            $this->adminRoutes();
            $this->playerRoutes();
            $this->coachRoutes();
        });
    }

    private function adminRoutes()
    {
        Route::middleware('api')
            ->prefix('admins')
            ->name('admins.')
            ->group(base_path('routes/admin/entities.php'));
        Route::middleware('api')
            ->prefix('admins')
            ->name('admins.')
            ->group(base_path('routes/admin/club.php'));
    }

    private function playerRoutes()
    {
        Route::middleware('api')
            ->prefix('players')
            ->name('players.')
            ->group(base_path('routes/player/entities.php'));
    }

    private function coachRoutes()
    {
        Route::middleware('api')
            ->prefix('coaches')
            ->name('coaches.')
            ->group(base_path('routes/coach/entities.php'));
    }
}
