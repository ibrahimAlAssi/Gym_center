<?php

namespace App\Domains\Club\Models;

use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\QueryBuilder\QueryBuilder;

class OrderDiet extends Model
{
    use HasFactory;

    protected $table = 'order_diets';

    protected $fillable = [
        'player_id',
        'diet_id',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function diet(): BelongsTo
    {
        return $this->belongsTo(Diet::class);
    }

    public function findRecentlyOrderDietByPlayerId(?int $playerId = null)
    {
        return self::where('player_id', $playerId)
            ->where('status', 0)
            ->exists();
    }

    public function getForGrid(?int $playerId = null)
    {
        return QueryBuilder::for(OrderDiet::class)
            ->defaultSort('-id')
            ->select([
                'order_diets.id',
                'order_diets.description',
                'order_diets.status',
                'order_diets.id',
                'players.id as player_id',
                'players.name as player_name',
                'diets.id as diet_id',
                'diets.name as diet_name',
            ])
            ->join('players', 'players.id', '=', 'order_diets.player_id')
            ->leftJoin('diets', 'diets.id', '=', 'order_diets.diet_id')
            ->when(
                $playerId != null,
                fn ($query) => $query->where('order_diets.player_id', $playerId)
            )
            ->paginate(request()->get('per_page'));
    }
}
