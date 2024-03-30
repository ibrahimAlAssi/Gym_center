<?php

namespace App\Src\Shared\Traits;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Builder;

trait FilterByGym
{
    public static function boot()
    {
        parent::boot();
        $currentGymId = Gym::first()->id;
        $guards = config('auth.guards');
        foreach ($guards as $guardName => $guardConfig) {
            if (auth()->guard($guardName)->check()) {
                // Retrieve the authenticated user's gym ID using the current guard
                $currentGymId = auth($guardName)->user()->gym_id;
                break;
            }
        }

        self::addGlobalScope(function (Builder $builder) use ($currentGymId) {
            $builder->where('gym_id', $currentGymId);
        });
    }
}
