<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = ['gym_id', 'name'];

    public $timestamps = true;

    public function nutritionalValues(): HasMany
    {
        return $this->hasMany(NutritionalValue::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    public function diets(): BelongsToMany
    {
        return $this->belongsToMany(Diet::class, 'Diet_food');
    }

    public function DietFood(): HasMany
    {
        return $this->hasMany(DietFood::class, 'Diet_food');
    }
}
