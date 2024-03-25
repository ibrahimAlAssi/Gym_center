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
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->mapApiRoutes();

            $this->mapWebRoutes();

            $this->mapAdminRoutes();
            $this->mapPlayerRoutes();
            $this->mapCoachRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Define the "web" routes for your application.
     *
     * These routes all receive session state, CSRF protection, and more.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for your application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "admin" routes for your application.
     */
    protected function mapAdminRoutes(): void
    {
        Route::prefix('admins')
            ->middleware('api')
            ->name('admins.')
            ->group(base_path('routes/admin/entities.php'));

        Route::prefix('admins')
            ->middleware('api')
            ->name('admins.')
            ->group(base_path('routes/admin/club.php'));
    }

    /**
     * Define the "player" routes for your application.
     */
    protected function mapPlayerRoutes(): void
    {
        Route::prefix('players')
            ->middleware('api')
            ->name('players.')
            ->group(base_path('routes/player/entities.php'));
    }

    /**
     * Define the "coach" routes for your application.
     */
    protected function mapCoachRoutes(): void
    {
        Route::prefix('coaches')
            ->middleware('api')
            ->name('coaches.')
            ->group(base_path('routes/coach/entities.php'));
    }
}
