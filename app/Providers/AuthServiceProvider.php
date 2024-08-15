<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Opcodes\LogViewer\Facades\LogViewer;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        LogViewer::auth(function ($request) {
            $user = Auth::guard('admin-web')->user();

            return $user
               && in_array($user->email, [
                   'admin@gmail.com',
               ]);
        });
    }
}
