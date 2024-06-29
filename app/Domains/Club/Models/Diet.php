<?php

namespace App\Domains\Club\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\QueryBuilder\QueryBuilder;

class Diet extends Model
{
    use HasFactory;

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

    public function dietFood(): HasMany
    {
        return $this->hasMany(DietFood::class, 'diet_food');
    }

    public function getForGrid(?int $playerId = null)
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
                'diets.created_at',
            ])->with('foods')
            ->when($playerId != null, function ($query) {
                $query->leftJoin('players', 'diets.id', '=', 'players.diet_id')
                    ->where('diets.is_free', 1)
                    ->orWhereColumn('players.diet_id', 'diets.id')
                    ->orderBy('is_free');
            })
            ->paginate(request()->get('per_page'));
    }
}
