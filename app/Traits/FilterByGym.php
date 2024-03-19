<?php

namespace App\Traits;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Builder;

trait FilterByGym
{
    public static function boot()
    {
        parent::boot();
        $currentGymId = Gym::first()->id;
        if (auth()->user()) {
            $currentGymId = auth()->user()->gym_id;
        }

        self::creating(function ($model) use ($currentGymId) {
            $model->gym_id = $currentGymId;
        });

        self::addGlobalScope(function (Builder $builder) use ($currentGymId) {
            $builder->where('gym_id', $currentGymId);
        });
    }
}
