<?php

namespace App\Domains\Club\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
            ])->with('media')
            ->paginate(request()->get('per_page'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('sm')
            ->width(150)
            ->height(150);

        $this->addMediaConversion('md')
            ->width(300)
            ->height(300);

        $this->addMediaConversion('lg')
            ->width(500)
            ->height(500);
    }
}
