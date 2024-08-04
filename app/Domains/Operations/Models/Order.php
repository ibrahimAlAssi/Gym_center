<?php

namespace App\Domains\Operations\Models;

use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\QueryBuilder\QueryBuilder;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'coach_id',
        'player_id',
    ];

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getForGrid(?int $coachId = null, ?int $playerId = null)
    {
        return QueryBuilder::for(Order::class)
            ->allowedFilters([
                'orders.id',
                'orders.player_id',
                'orders.coach_id',
            ])
            ->defaultSort('-id')
            ->select([
                'orders.id',
                'orders.player_id',
                'orders.coach_id',
            ])
            ->with(['orderDetails' => function ($query) {
                $query->select([
                    'order_details.id',
                    'order_details.order_id',
                    'order_details.quantity',
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.price as product_price',
                ])->join('products', 'products.id', '=', 'order_details.product_id');
            }])
            ->when($coachId != null, fn ($query) => $query->where('coach_id', $coachId))
            ->when($playerId != null, fn ($query) => $query->where('player_id', $playerId))
            ->paginate(request()->get('per_page'));
    }

    public function getById(int $orderId)
    {
        return self::select([
            'orders.id',
            'orders.player_id',
            'orders.coach_id',
        ])
            ->with(['orderDetails' => function ($query) {
                $query->select([
                    'order_details.id',
                    'order_details.order_id',
                    'order_details.quantity',
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.price as product_price',
                ])->join('products', 'products.id', '=', 'order_details.product_id');
            }])
            ->where('orders.id', $orderId)
            ->first();
    }
}
