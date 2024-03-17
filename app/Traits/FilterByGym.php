<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterByGym
{
    static function boot()
    {
        parent::boot();

        $currentGymId = auth()->user()->gym_id;

        self::creating(function ($model) use ($currentGymId) {
            $model->gym_id = $currentGymId;
        });

        self::addGlobalScope(function (Builder $builder) use ($currentGymId) {
            $builder->where('gym_id', $currentGymId);
        });
    }
}
