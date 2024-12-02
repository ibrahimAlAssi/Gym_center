<?php

namespace App\Domains\Club\Models;

use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        'weight',
        'length',
    ];

    protected $casts = [
        'status' => 'boolean',
        'weight' => 'integer',
        'length' => 'integer',
    ];

    protected static function booted()
    {
        static::updating(function ($orderDiet) {
            try {
                DB::beginTransaction();
                $orderDiet->status = 1;
                $orderDiet->player()->update(['diet_id' => $orderDiet->diet_id]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error updating player diet_id', ['message' => $e->getMessage()]);
            }
        });
    }

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
            ->select([
                'order_diets.id',
                'order_diets.description',
                'order_diets.status',
                'order_diets.weight',
                'order_diets.length',
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
            ->orderBy('order_diets.status')
            ->paginate(request()->get('per_page'));
    }
}
