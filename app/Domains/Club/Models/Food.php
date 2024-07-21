<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\QueryBuilder\QueryBuilder;

class Food extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'food';

    protected $fillable = ['name'];

    public $timestamps = true;

    public function nutritionalValues(): HasMany
    {
        return $this->hasMany(NutritionalValue::class);
    }

    public function diets(): BelongsToMany
    {
        return $this->belongsToMany(Diet::class, 'diet_food');
    }

    public function dietFood(): HasMany
    {
        return $this->hasMany(DietFood::class, 'diet_food');
    }

    public function getForGrid()
    {
        return QueryBuilder::for(Food::class)
            ->allowedFilters([
                'name',
            ])->with('media', 'nutritionalValues')
            ->paginate(request()->get('per_page'));
    }
}
