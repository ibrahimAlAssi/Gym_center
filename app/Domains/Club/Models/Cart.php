<?php

namespace App\Domains\Club\Models;

use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\QueryBuilder\QueryBuilder;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'product_id',
        'player_id',
        'coach_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function getForGrid(?int $coachId = null, ?int $playerId = null)
    {
        return QueryBuilder::for(Cart::class)
            ->allowedFilters([
                'products.name',
            ])
            ->select([
                'carts.id',
                'carts.quantity',
                'carts.product_id',
            ])
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->with(['product' => function ($query) {
                $query->select([
                    'products.id',
                    'products.name',
                ])->with('media');
            }])
            ->when($playerId != null, fn ($query) => $query->where('player_id', $playerId))
            ->when($coachId != null, fn ($query) => $query->where('coach_id', $coachId))
            ->get();
    }
}
