<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Club\Models\NutritionalValue;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    use HasFactory;
    protected $table = 'food';

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
        return $this->belongsToMany(Diet::class, 'diet_food');
    }

    public function dietFood(): HasMany
    {
        return $this->hasMany(DietFood::class, 'diet_food');
    }
}
