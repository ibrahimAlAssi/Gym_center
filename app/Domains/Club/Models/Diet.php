<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\QueryBuilder;

class Diet extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'diets';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'is_free',
    ];

    protected $casts = [
        'is_free' => 'boolean',
    ];

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'diet_food')->withPivot('allowed');
    }

    public function allowedFoods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'diet_food')->withPivot('allowed')
            ->wherePivot('allowed', '1');
    }

    public function notAllowedFoods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'diet_food')->withPivot('allowed')
            ->wherePivot('allowed', '0');
    }

    public function dietFood(): HasMany
    {
        return $this->hasMany(DietFood::class, 'diet_food');
    }

    public function getForGrid(?int $playerId = null, ?array $filter = null)
    {
        return QueryBuilder::for(Diet::class)
            ->allowedFilters([
                'diets.name',
                'diets.is_free',
            ])
            ->select([
                'diets.id',
                'diets.name',
                'diets.is_free',
            ])
            ->with(['media', 'allowedFoods' => function ($query) {
                $query->select([
                    'food.id',
                    'food.name',
                ])->with('media');
            }, 'notAllowedFoods' => function ($query) {
                $query->select([
                    'food.id',
                    'food.name',
                ])->with('media');
            }],)
            ->when($playerId != null, function ($query) {
                $query->leftJoin('players', 'diets.id', '=', 'players.diet_id')
                    ->where(function ($query) {
                        $query->where('diets.is_free', 1)
                            ->orWhereColumn('players.diet_id', 'diets.id');
                    })->orderBy('is_free');
            })
            ->with('media')
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
